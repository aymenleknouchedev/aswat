<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use App\Models\ContentMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


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

            $query = ContentMedia::query();

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
                    'audio' => 'info',
                    'document' => 'warning'
                ];
                return $badges[$type] ?? 'secondary';
            };

            $getMediaTypeLabel = function ($type) {
                $labels = [
                    'image' => 'صورة',
                    'video' => 'فيديو',
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

            // Use Unicode-aware pattern with /u modifier
            $safeName = preg_replace('/\s+/u', '_', $originalName);
            $fileName = $safeName . '_' . time() . '.' . $extension;

            // Rest of your code remains the same...
            $storedPath = $file->storeAs('media', $fileName, 'public');
            $path = '/storage/' . $storedPath;

            $media = new ContentMedia();
            $media->name = $request->input('name', $originalName);
            $media->alt = $request->input('alt', $originalName);

            $mimeType = $file->getClientMimeType();
            if (str_starts_with($mimeType, 'audio/')) {
                $media->media_type = 'voice';
            } elseif (str_starts_with($mimeType, 'video/')) {
                $media->media_type = 'video';
            } elseif (str_starts_with($mimeType, 'image/')) {
                $media->media_type = 'image';
            } else {
                $media->media_type = 'file';
            }

            $media->path = $path;
            $media->user_id = Auth::id();
            $media->save();

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
        } catch (\Throwable $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'فشل تحميل الوسائط. حاول مرة أخرى.'
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
        $validated = $request->validate([
            'url'        => ['required', 'url', 'max:2048'],
            'name'       => ['nullable', 'string', 'max:255'],
            'alt'        => ['nullable', 'string', 'max:255'],
            'media_type' => ['nullable', Rule::in(['auto', 'image', 'video', 'voice', 'file'])],
        ], [
            'url.required' => 'الرجاء إدخال رابط الوسائط.',
            'url.url'      => 'الرابط غير صالح.',
            'url.max'      => 'طول الرابط لا يجب أن يتجاوز 2048 حرفاً.',
        ]);

        // 2) اشتقاق النوع إن كان auto أو غير مُرسل
        $url = $validated['url'];
        $type = $validated['media_type'] ?? 'auto';
        if ($type === 'auto') {
            $type = $this->guessMediaTypeFromUrl($url); // image | video | voice | file
        }

        // 3) تطبيع الحقول الاختيارية
        $name = $validated['name'] ?? $this->defaultNameFromUrl($url);
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
        // YouTube
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)/i', $url)) {
            return 'video';
        }

        $path = parse_url($url, PHP_URL_PATH) ?? '';
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'], true)) return 'image';
        if (in_array($ext, ['mp4', 'webm', 'mkv', 'mov', 'avi', 'm4v'], true))      return 'video';
        if (in_array($ext, ['mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac'], true))       return 'voice';

        return 'file';
    }

    /**
     * اسم افتراضي مستخرج من الرابط.
     */
    protected function defaultNameFromUrl(string $url): string
    {
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
            $media->save();

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم تحديث معلومات الوسائط بنجاح.');
        } catch (\Throwable $e) {
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
            $media = ContentMedia::findOrFail($id);

            // حذف الملف من التخزين
            $filePath = str_replace('/storage/', 'public/', $media->path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
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
                    $q->where('name', 'LIKE', "%{$search}%");
                });
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
