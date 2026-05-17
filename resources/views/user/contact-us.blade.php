@extends('layouts.index')

@section('title', 'اتصل بنا | أصوات جزائرية')

@section('content')
<style>
    /* Prevent horizontal scroll on this page. */
    html, body { overflow-x: hidden; max-width: 100%; }

    /* Visibility toggle: show web on desktop, mobile on smaller screens. */
    .web    { display: none; }
    .mobile { display: block; }
    @media (min-width: 992px) {
        .web    { display: block !important; }
        .mobile { display: none  !important; }
    }

    .cu-page { max-width: 760px; margin: 32px auto 64px; padding: 0 16px; direction: rtl; font-family: 'asswat-regular', Arial, Helvetica, sans-serif; }
    .cu-head h1 { font-family: 'asswat-bold', Arial, sans-serif; font-size: 32px; margin: 0 0 8px; }
    .cu-head p  { color: #555; margin: 0 0 28px; line-height: 1.7; }

    .cu-card { background: #fff; border: 1px solid #e5e9f2; border-radius: 0; padding: 28px; box-shadow: 0 2px 8px rgba(15,23,42,.04); }

    .cu-row   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    @media (max-width: 600px) { .cu-row { grid-template-columns: 1fr; } }

    .cu-field { margin-bottom: 14px; }
    .cu-field label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 600; color: #1f2a44; }
    .cu-field input,
    .cu-field textarea {
        width: 100%; padding: 10px 12px; font-size: 14px; color: #1f2a44;
        background: #fff; border: 1px solid #dbdfea; border-radius: 0;
        font-family: inherit; box-sizing: border-box; transition: border-color .15s, box-shadow .15s;
    }
    .cu-field input:focus,
    .cu-field textarea:focus { outline: none; border-color: #2ea44f; box-shadow: 0 0 0 3px rgba(46,164,79,.15); }
    .cu-field textarea { min-height: 140px; resize: vertical; line-height: 1.6; }
    .cu-field input::placeholder,
    .cu-field textarea::placeholder { color: #9aa6b8; }

    .cu-field .err { display: none; margin-top: 6px; color: #c0392b; font-size: 12px; }
    .cu-field.has-err input,
    .cu-field.has-err textarea { border-color: #e07a72; background: #fff8f7; }
    .cu-field.has-err .err { display: block; }

    .cu-actions { margin-top: 18px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
    .cu-submit {
        background: #2ea44f; color: #fff; border: 0; padding: 12px 28px;
        border-radius: 0; font-size: 15px; font-weight: 600; cursor: pointer;
        display: inline-flex; align-items: center; gap: 8px; transition: background .15s;
    }
    .cu-submit:hover:not(:disabled) { background: #25893e; }
    .cu-submit:disabled { background: #c6cbd6; cursor: not-allowed; }

    .cu-alert { padding: 12px 16px; border-radius: 0; font-size: 14px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .cu-alert-ok    { background: #e8f9ee; color: #0a7d3f; border: 1px solid #b9e8c8; }
    .cu-alert-err   { background: #fff5f5; color: #c0392b; border: 1px solid #f0c8c8; }

    /* Honeypot: hidden but not display:none (some bots skip those) */
    .cu-hp { position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden; }

    .cu-meta { margin-top: 28px; padding-top: 22px; border-top: 1px solid #eef1f6; font-size: 14px; color: #526484; }
    .cu-meta a { color: #6576ff; text-decoration: none; }
    .cu-meta a:hover { text-decoration: underline; }
    .cu-meta strong { color: #1f2a44; }
</style>

<div class="web">
    @include('user.components.fixed-nav')

<div class="cu-page">
    <div class="cu-head">
        <h1>اتصل بنا</h1>
        <p>نرحب باستفساراتكم وملاحظاتكم. املأ النموذج أدناه وسنرد عليك في أقرب وقت ممكن.</p>
    </div>

    <div class="cu-card">
        <div id="cu-feedback" style="display:none;"></div>

        <form id="cu-form" action="{{ route('contact-us.submit') }}" method="POST" novalidate>
            @csrf

            {{-- Honeypot anti-spam --}}
            <div class="cu-hp" aria-hidden="true">
                <label for="website">Website (do not fill)</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="cu-row">
                <div class="cu-field" data-field="name">
                    <label for="cu-name">الاسم الكامل <span style="color:#c0392b">*</span></label>
                    <input type="text" id="cu-name" name="name" required maxlength="120" placeholder="مثال: محمد بن أحمد">
                    <div class="err"></div>
                </div>

                <div class="cu-field" data-field="email">
                    <label for="cu-email">البريد الإلكتروني <span style="color:#c0392b">*</span></label>
                    <input type="email" id="cu-email" name="email" required maxlength="180" placeholder="name@example.com">
                    <div class="err"></div>
                </div>
            </div>

            <div class="cu-row">
                <div class="cu-field" data-field="phone">
                    <label for="cu-phone">رقم الهاتف (اختياري)</label>
                    <input type="tel" id="cu-phone" name="phone" maxlength="40" placeholder="+213 ...">
                    <div class="err"></div>
                </div>

                <div class="cu-field" data-field="subject">
                    <label for="cu-subject">الموضوع <span style="color:#c0392b">*</span></label>
                    <input type="text" id="cu-subject" name="subject" required maxlength="160" placeholder="موضوع الرسالة">
                    <div class="err"></div>
                </div>
            </div>

            <div class="cu-field" data-field="message">
                <label for="cu-message">الرسالة <span style="color:#c0392b">*</span></label>
                <textarea id="cu-message" name="message" required maxlength="5000" placeholder="اكتب رسالتك هنا..."></textarea>
                <div class="err"></div>
            </div>

            <div class="cu-actions">
                <button type="submit" class="cu-submit" id="cu-submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>إرسال الرسالة</span>
                </button>
            </div>
        </form>

        <div class="cu-meta">
            للتواصل المباشر: <a href="mailto:{{ config('app.admin_email') }}"><strong>{{ config('app.admin_email') }}</strong></a>
        </div>
    </div>
</div>

    @include('user.components.footer')
</div>{{-- /.web --}}

<div class="mobile">
    @include('user.mobile.mobile-home')

    <div id="greybar" style="background-color:#252525;height:68px;position:fixed;top:0;left:0;right:0;z-index:10;"></div>

    <div class="mobile-flow">
        <div class="mobile-container" style="margin-top:68px;">
            <div class="cu-page" style="margin-top:8px;margin-bottom:32px;">
                <div class="cu-head">
                    <h1 style="font-size:24px;">اتصل بنا</h1>
                    <p>نرحب باستفساراتكم وملاحظاتكم.</p>
                </div>

                <div class="cu-card" style="padding:18px;">
                    <form id="cu-form-m" action="{{ route('contact-us.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="cu-hp" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="cu-field" data-field="name">
                            <label>الاسم الكامل <span style="color:#c0392b">*</span></label>
                            <input type="text" name="name" required maxlength="120" placeholder="مثال: محمد بن أحمد">
                            <div class="err"></div>
                        </div>
                        <div class="cu-field" data-field="email">
                            <label>البريد الإلكتروني <span style="color:#c0392b">*</span></label>
                            <input type="email" name="email" required maxlength="180" placeholder="name@example.com">
                            <div class="err"></div>
                        </div>
                        <div class="cu-field" data-field="phone">
                            <label>رقم الهاتف (اختياري)</label>
                            <input type="tel" name="phone" maxlength="40" placeholder="+213 ...">
                            <div class="err"></div>
                        </div>
                        <div class="cu-field" data-field="subject">
                            <label>الموضوع <span style="color:#c0392b">*</span></label>
                            <input type="text" name="subject" required maxlength="160" placeholder="موضوع الرسالة">
                            <div class="err"></div>
                        </div>
                        <div class="cu-field" data-field="message">
                            <label>الرسالة <span style="color:#c0392b">*</span></label>
                            <textarea name="message" required maxlength="5000" placeholder="اكتب رسالتك هنا..."></textarea>
                            <div class="err"></div>
                        </div>

                        <div class="cu-actions">
                            <button type="submit" class="cu-submit" style="width:100%;justify-content:center;">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>إرسال الرسالة</span>
                            </button>
                        </div>
                        <div class="cu-feedback-m" style="display:none;margin-top:14px;"></div>
                    </form>

                    <div class="cu-meta">
                        للتواصل المباشر: <a href="mailto:{{ config('app.admin_email') }}"><strong>{{ config('app.admin_email') }}</strong></a>
                    </div>
                </div>
            </div>
        </div>

        @include('user.mobile.footer')
    </div>
</div>{{-- /.mobile --}}

<script>
(function () {
    const form = document.getElementById('cu-form-m');
    if (!form) return;
    const fb   = form.querySelector('.cu-feedback-m');
    const btn  = form.querySelector('.cu-submit');
    const btnTxt = btn.querySelector('span');
    const csrf = form.querySelector('input[name="_token"]').value;

    function show(kind, msg) {
        fb.className = 'cu-feedback-m cu-alert ' + (kind === 'ok' ? 'cu-alert-ok' : 'cu-alert-err');
        fb.innerHTML = (kind === 'ok' ? '<i class="fa-solid fa-circle-check"></i>' : '<i class="fa-solid fa-circle-exclamation"></i>') + '<span>' + msg + '</span>';
        fb.style.display = 'flex';
    }
    function clear() {
        form.querySelectorAll('.cu-field').forEach(el => { el.classList.remove('has-err'); const e = el.querySelector('.err'); if (e) e.textContent = ''; });
    }
    function errs(errors) {
        clear();
        Object.keys(errors).forEach(name => {
            const wrap = form.querySelector('.cu-field[data-field="' + name + '"]');
            if (!wrap) return;
            wrap.classList.add('has-err');
            const e = wrap.querySelector('.err');
            if (e) e.textContent = Array.isArray(errors[name]) ? errors[name][0] : errors[name];
        });
    }
    form.addEventListener('submit', async (ev) => {
        ev.preventDefault();
        clear();
        fb.style.display = 'none';
        btn.disabled = true;
        btnTxt.textContent = 'جارٍ الإرسال…';
        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(form),
            });
            if (res.status === 422) {
                const body = await res.json();
                if (body && body.errors) errs(body.errors);
                show('err', (body && body.message) || 'يرجى تصحيح الأخطاء في النموذج.');
                return;
            }
            if (!res.ok) { show('err', 'تعذّر إرسال الرسالة. حاول مرة أخرى لاحقًا.'); return; }
            const body = await res.json().catch(() => ({}));
            show('ok', body.message || 'تم إرسال رسالتك بنجاح. شكرًا لتواصلك معنا.');
            form.reset();
        } catch (e) {
            show('err', 'خطأ في الاتصال بالخادم. حاول مرة أخرى.');
        } finally {
            btn.disabled = false;
            btnTxt.textContent = 'إرسال الرسالة';
        }
    });
})();
</script>

<script>
(function () {
    const form    = document.getElementById('cu-form');
    const btn     = document.getElementById('cu-submit');
    const btnTxt  = btn.querySelector('span');
    const fb      = document.getElementById('cu-feedback');
    const csrf    = form.querySelector('input[name="_token"]').value;
    const action  = form.getAttribute('action');

    function showFeedback(kind, msg) {
        fb.className = 'cu-alert ' + (kind === 'ok' ? 'cu-alert-ok' : 'cu-alert-err');
        fb.innerHTML = (kind === 'ok'
            ? '<i class="fa-solid fa-circle-check"></i>'
            : '<i class="fa-solid fa-circle-exclamation"></i>') + '<span>' + msg + '</span>';
        fb.style.display = 'flex';
        fb.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function clearErrors() {
        form.querySelectorAll('.cu-field').forEach(el => {
            el.classList.remove('has-err');
            const e = el.querySelector('.err');
            if (e) e.textContent = '';
        });
    }

    function showFieldErrors(errors) {
        clearErrors();
        Object.keys(errors).forEach(name => {
            const wrap = form.querySelector('.cu-field[data-field="' + name + '"]');
            if (!wrap) return;
            wrap.classList.add('has-err');
            const e = wrap.querySelector('.err');
            if (e) e.textContent = Array.isArray(errors[name]) ? errors[name][0] : errors[name];
        });
    }

    form.addEventListener('submit', async (ev) => {
        ev.preventDefault();
        clearErrors();
        fb.style.display = 'none';

        const data = new FormData(form);
        btn.disabled = true;
        btnTxt.textContent = 'جارٍ الإرسال…';

        try {
            const res = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: data,
            });

            if (res.status === 422) {
                const body = await res.json();
                if (body && body.errors) showFieldErrors(body.errors);
                showFeedback('err', body.message || 'يرجى تصحيح الأخطاء في النموذج.');
                return;
            }

            if (!res.ok) {
                showFeedback('err', 'تعذّر إرسال الرسالة. حاول مرة أخرى لاحقًا.');
                return;
            }

            const body = await res.json().catch(() => ({}));
            showFeedback('ok', body.message || 'تم إرسال رسالتك بنجاح. شكرًا لتواصلك معنا.');
            form.reset();
        } catch (e) {
            showFeedback('err', 'خطأ في الاتصال بالخادم. حاول مرة أخرى.');
        } finally {
            btn.disabled = false;
            btnTxt.textContent = 'إرسال الرسالة';
        }
    });
})();
</script>
@endsection
