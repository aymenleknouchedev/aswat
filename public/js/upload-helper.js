/**
 * Aswat upload helper.
 * Exposes:
 *   window.compressImage(file, opts?) -> Promise<File>
 *   window.uploadWithProgress(url, formData, opts?) -> Promise<{ ok, status, body, json }>
 *
 * compressImage downscales large images in the browser before upload.
 * On any error or unsupported file type, it returns the original file unchanged.
 */
(function () {
    'use strict';

    const DEFAULTS = {
        maxWidth: 1920,
        maxHeight: 1920,
        quality: 0.82,
        // Re-encode to webp when the browser supports it; otherwise jpeg.
        // Skip png/gif/svg by default to preserve transparency / animation.
        skipMime: /^image\/(svg|gif)/i,
        // Skip if the file is already small.
        minBytes: 300 * 1024, // 300 KB
    };

    function supportsWebp() {
        try {
            const c = document.createElement('canvas');
            return c.toDataURL && c.toDataURL('image/webp').indexOf('data:image/webp') === 0;
        } catch (_) {
            return false;
        }
    }
    const WEBP_OK = supportsWebp();

    function readImage(file) {
        return new Promise((resolve, reject) => {
            const url = URL.createObjectURL(file);
            const img = new Image();
            img.onload = () => { URL.revokeObjectURL(url); resolve(img); };
            img.onerror = (e) => { URL.revokeObjectURL(url); reject(e); };
            img.src = url;
        });
    }

    async function compressImage(file, userOpts) {
        if (!file || !(file instanceof Blob)) return file;
        const opts = Object.assign({}, DEFAULTS, userOpts || {});

        if (!/^image\//i.test(file.type)) return file;
        if (opts.skipMime.test(file.type)) return file;
        if (file.size < opts.minBytes) return file;

        try {
            const img = await readImage(file);
            const ratio = Math.min(1, opts.maxWidth / img.width, opts.maxHeight / img.height);
            const w = Math.max(1, Math.round(img.width * ratio));
            const h = Math.max(1, Math.round(img.height * ratio));

            const canvas = document.createElement('canvas');
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);

            const targetType = (file.type === 'image/png' && !WEBP_OK)
                ? 'image/png'
                : (WEBP_OK ? 'image/webp' : 'image/jpeg');

            const blob = await new Promise((resolve) =>
                canvas.toBlob(resolve, targetType, opts.quality)
            );
            if (!blob) return file;

            // If our output isn't smaller, keep the original.
            if (blob.size >= file.size) return file;

            const ext = targetType === 'image/webp' ? 'webp' : (targetType === 'image/png' ? 'png' : 'jpg');
            const baseName = (file.name || 'image').replace(/\.[^.]+$/, '');
            return new File([blob], baseName + '.' + ext, { type: targetType, lastModified: Date.now() });
        } catch (e) {
            console.warn('compressImage: falling back to original file', e);
            return file;
        }
    }

    function uploadWithProgress(url, formData, userOpts) {
        const opts = userOpts || {};
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open(opts.method || 'POST', url, true);

            const headers = opts.headers || {};
            Object.keys(headers).forEach((k) => {
                if (k.toLowerCase() === 'content-type') return; // let the browser set it
                xhr.setRequestHeader(k, headers[k]);
            });

            if (typeof opts.onProgress === 'function' && xhr.upload) {
                xhr.upload.addEventListener('progress', (e) => {
                    const pct = e.lengthComputable ? Math.round((e.loaded / e.total) * 100) : null;
                    opts.onProgress({ loaded: e.loaded, total: e.total, percent: pct });
                });
            }

            xhr.onload = () => {
                let json = null;
                try { json = JSON.parse(xhr.responseText); } catch (_) {}
                resolve({
                    ok: xhr.status >= 200 && xhr.status < 300,
                    status: xhr.status,
                    body: xhr.responseText,
                    json: json,
                });
            };
            xhr.onerror = () => reject(new Error('Network error'));
            xhr.onabort = () => reject(new Error('Aborted'));

            xhr.send(formData);
        });
    }

    window.compressImage = compressImage;
    window.uploadWithProgress = uploadWithProgress;

    /**
     * Auto-compress: bind to every <input type="file"> that accepts images.
     * On change, compress each selected image and replace input.files via DataTransfer
     * so the existing form submission (native or JS) sends the smaller file.
     *
     * Skip with: <input type="file" data-no-compress>
     */
    function inputAcceptsImages(input) {
        if (input.dataset && input.dataset.noCompress !== undefined) return false;
        const a = (input.getAttribute('accept') || '').toLowerCase();
        if (!a) return true; // no accept attr → assume any, still try image MIME at runtime
        return a.includes('image/') || /\.(png|jpe?g|webp|gif|bmp)/.test(a);
    }

    function buildFileList(files) {
        try {
            const dt = new DataTransfer();
            files.forEach((f) => dt.items.add(f));
            return dt.files;
        } catch (_) {
            return null; // unsupported (very old Safari)
        }
    }

    async function handleFileInputChange(ev) {
        const input = ev.target;
        if (!input || input.tagName !== 'INPUT' || input.type !== 'file') return;
        if (input.dataset._compressing === '1' || input.dataset._compressed === '1') return;
        if (!input.files || !input.files.length) return;

        const list = Array.from(input.files);
        const hasImage = list.some((f) => /^image\//i.test(f.type));
        if (!hasImage) return;

        input.dataset._compressing = '1';
        try {
            const compressed = await Promise.all(
                list.map((f) => /^image\//i.test(f.type) ? compressImage(f) : Promise.resolve(f))
            );
            const newList = buildFileList(compressed);
            if (newList) {
                input.files = newList;
                input.dataset._compressed = '1';
                // Some frameworks listen to 'input' rather than 'change'; re-fire change.
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        } catch (e) {
            console.warn('auto-compress failed', e);
        } finally {
            delete input.dataset._compressing;
            // Allow re-compression if user picks a different file later
            setTimeout(() => { delete input.dataset._compressed; }, 0);
        }
    }

    function bind() {
        document.addEventListener('change', (ev) => {
            const t = ev.target;
            if (t && t.tagName === 'INPUT' && t.type === 'file' && inputAcceptsImages(t)) {
                handleFileInputChange(ev);
            }
        }, true);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bind);
    } else {
        bind();
    }
})();
