<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use App\Models\ContentMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class MediaController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:media_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pagination = config('pagination.per10', 10);

            $query = ContentMedia::with('contents');

            // البحث حسب الاسم، النص البديل، النوع، أو المسار
            if ($search = $request->input('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('alt', 'LIKE', "%{$search}%")
                        ->orWhere('media_type', 'LIKE', "%{$search}%")
                        ->orWhere('path', 'LIKE', "%{$search}%");
                });
            }

            // فلترة حسب نوع الوسائط
            if ($type = $request->input('type')) {
                $query->where('media_type', $type);
            }

            // الترتيب
            $sort = $request->input('sort', 'newest');
            switch ($sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default: // newest
                    $query->latest();
                    break;
            }

            $medias = $query->paginate($pagination)->appends($request->all());

            // Helper methods for media types
            $getMediaTypeBadge = function ($type) {
                $badges = [
                    'image' => 'primary',
                    'video' => 'success',
                    'voice' => 'info',
                    'audio' => 'info',
                    'document' => 'warning'
                ];
                return $badges[$type] ?? 'secondary';
            };

            $getMediaTypeLabel = function ($type) {
                $labels = [
                    'image' => 'صورة',
                    'video' => 'فيديو',
                    'voice' => 'صوت',
                    'audio' => 'صوت',
                    'document' => 'مستند'
                ];
                return $labels[$type] ?? $type;
            };

            $getSortLabel = function ($sort) {
                $labels = [
                    'newest' => 'الأحدث أولاً',
                    'oldest' => 'الأقدم أولاً',
                    'name_asc' => 'الاسم (أ-ي)',
                    'name_desc' => 'الاسم (ي-أ)'
                ];
                return $labels[$sort] ?? $sort;
            };

            // Handle AJAX requests
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'mediaGrid' => view('dashboard.partials.media-grid', compact('medias', 'getMediaTypeBadge', 'getMediaTypeLabel'))->render(),
                    'pagination' => $medias->appends($request->except('page'))->links()->toHtml(),
                    'resultsCount' => view('dashboard.partials.results-count', compact('medias'))->render(),
                    'activeFilters' => view('dashboard.partials.active-filters', compact('getMediaTypeLabel', 'getSortLabel'))->render()
                ]);
            }

            return view('dashboard.allmedias', compact('medias', 'getMediaTypeBadge', 'getMediaTypeLabel', 'getSortLabel'));
        } catch (\Throwable $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'فشل تحميل الوسائط'
                ], 500);
            }

            return redirect()
                ->route('dashboard.medias.index')
                ->withErrors(['error' => 'فشل تحميل الوسائط. حاول مرة أخرى.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.addmedia');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|max:100000', // 100MB
            'name' => 'nullable|string|max:255',
            'alt' => 'nullable|string|max:255',
        ], [
            'media.required' => 'الرجاء اختيار ملف وسائط.',
            'media.file' => 'الملف يجب أن يكون من نوع ملف.',
            'media.max' => 'حجم الملف لا يجب أن يتجاوز 100 ميغابايت.',
        ]);

        try {
            $file = $request->file('media');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();

            // Normalize filename (Arabic-friendly + Unicode-safe)
            $safeName = preg_replace('/\s+/u', '_', $originalName);

            // Determine media type
            $isImage = str_starts_with($mimeType, 'image/');
            $isAudio = str_starts_with($mimeType, 'audio/');
            $isVideo = str_starts_with($mimeType, 'video/');

            // ======== IMAGE HANDLING (WEBP) ========
            if ($isImage) {
                $fileName = $safeName . '_' . time() . '.webp';

                try {
                    if (!extension_loaded('gd')) {
                        throw new \Exception('GD extension not installed');
                    }

                    // Temporary original file
                    $tempPath = $file->store('temp', 'local');

                    $manager = new ImageManager(new Driver());
                    $image = $manager->read(storage_path('app/' . $tempPath));

                    // Save WebP file
                    $webpPath = 'media/' . $fileName;
                    Storage::disk('public')->put($webpPath, (string) $image->toWebp());

                    Storage::disk('local')->delete($tempPath);

                    // FULL URL PATH
                    $path = asset('storage/' . $webpPath);
                } catch (\Throwable $conversionError) {
                    Log::warning('Image WebP conversion failed: ' . $conversionError->getMessage());

                    $fileName = $safeName . '_' . time() . '.' . $extension;
                    $storedPath = $file->storeAs('media', $fileName, 'public');

                    $normalizedPath = str_replace('\\', '/', $storedPath);
                    $path = asset('storage/' . ltrim($normalizedPath, '/'));
                }
            }

            // ======== OTHER MEDIA (VIDEO / AUDIO / ANY FILE) ========
            else {
                $fileName = $safeName . '_' . time() . '.' . $extension;
                $storedPath = $file->storeAs('media', $fileName, 'public');

                $normalizedPath = str_replace('\\', '/', $storedPath);

                if (!Storage::disk('public')->exists($normalizedPath)) {
                    throw new \Exception('Failed to store file: ' . $fileName);
                }

                // FULL URL
                $path = asset('storage/' . ltrim($normalizedPath, '/'));
            }

            // ======== SAVE MEDIA IN DATABASE ========
            $media = new ContentMedia();
            $media->name = $request->input('name', $originalName);
            $media->alt = $request->input('alt', $originalName);

            if ($isAudio) {
                $media->media_type = 'voice';
            } elseif ($isVideo) {
                $media->media_type = 'video';
                Log::info('Video uploaded', [
                    'fileName' => $fileName,
                    'mimeType' => $mimeType,
                    'size' => $file->getSize(),
                ]);
            } elseif ($isImage) {
                $media->media_type = 'image';
            } else {
                $media->media_type = 'file';
            }

            $media->path = $path; // FULL URL
            $media->user_id = Auth::id();
            $media->save();

            Log::info('Media uploaded successfully', [
                'id' => $media->id,
                'type' => $media->media_type,
                'path' => $media->path
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحميل الوسائط بنجاح.',
                    'data' => [
                        'id' => $media->id,
                        'name' => $media->name,
                        'alt' => $media->alt,
                        'path' => $media->path,
                        'media_type' => $media->media_type,
                    ]
                ], 201);
            }

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم تحميل الوسائط بنجاح.');
        }

        // ======== ERROR HANDLING ========
        catch (\Throwable $e) {
            Log::error('Media upload failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'فشل تحميل الوسائط. حاول مرة أخرى.',
                    'error' => config('app.debug') ? $e->getMessage() : 'حدث خطأ غير متوقع'
                ], 500);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => 'فشل تحميل الوسائط. حاول مرة أخرى.'])
                ->withInput();
        }
    }


    public function storeMediaUrl(Request $request)
    {
        // 1) تحقّق مرن
        // URL is required only for file type, optional for list (auto)
        $mediaType = $request->input('media_type', 'auto');
        $urlRules = $mediaType === 'file' ? ['required', 'url', 'max:2048'] : ['nullable', 'url', 'max:2048'];
        
        $validated = $request->validate([
            'url'        => $urlRules,
            'name'       => ['nullable', 'string', 'max:255'],
            'alt'        => ['nullable', 'string', 'max:255'],
            'media_type' => ['nullable', Rule::in(['auto', 'image', 'video', 'voice', 'file'])],
        ], [
            'url.required' => 'الرابط مطلوب في وضع الملف.',
            'url.url'      => 'الرابط غير صالح.',
            'url.max'      => 'طول الرابط لا يجب أن يتجاوز 2048 حرفاً.',
        ]);

        // 2) اشتقاق النوع إن كان auto أو غير مُرسل
        $url = $validated['url'] ?? null;
        $type = $validated['media_type'] ?? 'auto';
        if ($type === 'auto' && $url) {
            $type = $this->guessMediaTypeFromUrl($url); // image | video | voice | file
        }

        // 3) تطبيع الحقول الاختيارية
        $name = $validated['name'] ?? ($url ? $this->defaultNameFromUrl($url) : 'وسيط');
        $alt  = $validated['alt']  ?? $name;

        try {
            $media = new ContentMedia();
            $media->name       = $name;
            $media->alt        = $alt;
            $media->media_type = $type; // image | video | voice | file
            $media->path       = $url;
            $media->user_id    = Auth::id();
            $media->save();

            // إن كان الطلب Ajax نتجاوب JSON، وإلا Redirect
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'ok',
                    'data'   => [
                        'id'   => $media->id,
                        'name' => $media->name,
                        'alt'  => $media->alt,
                        'path' => $media->path,
                        'media_type' => $media->media_type,
                    ],
                ], 201);
            }

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم إضافة رابط الوسائط بنجاح.');
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'فشل إضافة رابط الوسائط.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => 'فشل إضافة رابط الوسائط. حاول مرة أخرى.'])
                ->withInput();
        }
    }

    /**
     * اشتقاق نوع الوسائط من الرابط.
     */
    protected function guessMediaTypeFromUrl(string $url): string
    {
        // YouTube - matches various YouTube URL formats
        // Examples: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/shorts/ID, youtube.com/embed/ID
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/|youtube\.com\/embed\/)([A-Za-z0-9_-]{6,})/i', $url)) {
            return 'video';
        }

        // Vimeo - matches vimeo.com/ID and player.vimeo.com/video/ID
        // Example: vimeo.com/123456789, player.vimeo.com/video/123456789
        if (preg_match('/(?:vimeo\.com\/|player\.vimeo\.com\/video\/)([0-9]+)/i', $url)) {
            return 'video';
        }

        // Dailymotion - matches dailymotion.com/video/ID and dai.ly/ID
        // Example: dailymotion.com/video/x8abc123, dai.ly/x8abc123
        if (preg_match('/(?:dailymotion\.com\/video\/|dailymotion\.com\/embed\/video\/|dai\.ly\/)([a-zA-Z0-9]+)/i', $url)) {
            return 'video';
        }

        // Other video platforms (Wistia, Vidyard, Brightcove, Twitch, Facebook Video, etc.)
        if (preg_match('/(?:wistia\.com|vidyard\.com|brightcove\.net|twitch\.tv|facebook\.com\/.*\/videos|fb\.watch)/i', $url)) {
            return 'video';
        }

        // Check file extension
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Image extensions
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'], true)) {
            return 'image';
        }

        // Video file extensions
        if (in_array($ext, ['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'], true)) {
            return 'video';
        }

        // Audio/Voice file extensions
        if (in_array($ext, ['mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac'], true)) {
            return 'voice';
        }

        // Default to file if unable to determine
        return 'file';
    }

    /**
     * اسم افتراضي مستخرج من الرابط.
     */
    protected function defaultNameFromUrl(string $url): string
    {
        // Check for video platforms and use platform-specific names
        if (preg_match('/youtube\.com\/watch\?v=([A-Za-z0-9_-]{6,})/i', $url, $matches)) {
            return 'YouTube Video - ' . $matches[1];
        }
        if (preg_match('/youtu\.be\/([A-Za-z0-9_-]{6,})/i', $url, $matches)) {
            return 'YouTube Video - ' . $matches[1];
        }
        if (preg_match('/vimeo\.com\/([0-9]+)/i', $url, $matches)) {
            return 'Vimeo Video - ' . $matches[1];
        }
        if (preg_match('/dailymotion\.com\/video\/([a-zA-Z0-9]+)/i', $url, $matches)) {
            return 'Dailymotion Video - ' . $matches[1];
        }

        // For regular URLs, extract filename
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        $base = basename($path) ?: 'Imported Media';
        // إزالة الاستعلام والامتداد
        $base = preg_replace('/\.[^.]+$/', '', $base);
        return trim($base) ?: 'Imported Media';
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alt' => 'required|string|max:255',
        ]);

        try {
            $media = ContentMedia::findOrFail($id);
            $media->name = $request->input('name');
            $media->alt = $request->input('alt');
            // Removed description field as requested
            $media->save();

            // إذا كان الطلب من AJAX نعيد JSON
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث معلومات الوسائط بنجاح.',
                    'data' => $media
                ]);
            }

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم تحديث معلومات الوسائط بنجاح.');
        } catch (\Throwable $e) {
            // إذا كان الطلب من AJAX نعيد JSON
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'فشل تحديث معلومات الوسائط. حاول مرة أخرى.'
                ], 500);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => 'فشل تحديث معلومات الوسائط. حاول مرة أخرى.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $media = ContentMedia::with('contents')->findOrFail($id);

            // التحقق من أن الوسائط غير مرتبطة بأي محتوى
            if ($media->contents->isNotEmpty()) {
                return redirect()
                    ->route('dashboard.medias.index')
                    ->withErrors(['error' => 'لا يمكن حذف هذه الوسائط لأنها مرتبطة بمحتوى.']);
            }

            // حذف الملف من التخزين إذا كان ملف محلي وليس رابط خارجي
            if (str_starts_with($media->path, '/storage/')) {
                // Normalize the path for deletion
                $filePath = str_replace('/storage/', '', $media->path);
                $filePath = str_replace('\\', '/', $filePath);

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                    Log::info('Media file deleted from storage', ['path' => $filePath]);
                }
            }

            // حذف السجل من قاعدة البيانات
            $media->delete();

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم حذف الوسائط بنجاح.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('dashboard.medias.index')
                ->withErrors(['error' => 'فشل حذف الوسائط. حاول مرة أخرى.']);
        }
    }

    public function getAllMediaPaginated(Request $request)
    {
        try {
            $pagination = config('pagination.per10', 10);

            $query = ContentMedia::query();

            // فلترة بالبحث
            if ($search = $request->input('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('alt', 'LIKE', "%{$search}%")
                        ->orWhere('path', 'LIKE', "%{$search}%");
                });
            }

            // فلترة حسب نوع الوسائط
            if ($type = $request->input('type')) {
                // If type is not 'all', filter by media_type
                if ($type !== 'all') {
                    // Map 'audio' to 'voice' for consistency
                    $mediaType = ($type === 'audio') ? 'voice' : $type;
                    $query->where('media_type', $mediaType);
                }
            }

            $medias = $query->latest()->paginate($pagination)
                ->appends($request->all());

            // نعدل الـ response عشان يطلع بيانات منظمة
            $data = [
                'data' => $medias->items(),
                'links' => $medias->linkCollection(),
                'current_page' => $medias->currentPage(),
                'last_page' => $medias->lastPage(),
                'total' => $medias->total(),
            ];

            return response()->json($data);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'فشل تحميل الوسائط. حاول مرة أخرى.'], 500);
        }
    }
}
