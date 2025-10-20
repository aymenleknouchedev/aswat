<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use App\Models\ContentMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

            // البحث حسب type أو path مثلاً
            if ($search = $request->input('search')) {
                $query->where('type', 'LIKE', "%{$search}%")
                    ->orWhere('path', 'LIKE', "%{$search}%");
            }

            $medias = $query->latest()->paginate($pagination)
                ->appends($request->all());

            return view('dashboard.allmedias', compact('medias'));
        } catch (\Throwable $e) {
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
            'name' => 'required|string|max:255',
            'alt' => 'required|string|max:255',
        ], [
            'media.required' => 'الرجاء اختيار ملف وسائط.',
            'media.file' => 'الملف يجب أن يكون من نوع ملف.',
            'media.max' => 'حجم الملف لا يجب أن يتجاوز 5 ميغابايت.',
        ]);

        // حفظ الملف في التخزين

        try {
            $file = $request->file('media');
            $path = '/storage/' . $file->store('media', 'public');

            $media = new ContentMedia();
            $media->name = $request->input('name');
            $media->alt = $request->input('alt');
            // تحديد نوع الوسائط (صوت، فيديو، صورة، ملف)
            $mimeType = $file->getClientMimeType();
            if (str_starts_with($mimeType, 'audio/')) {
                $media->media_type = 'voice';
            } elseif (str_starts_with($mimeType, 'video/')) {
                $media->media_type = 'video';
            } elseif (str_starts_with($mimeType, 'image/')) {
                $media->media_type = 'image';
            } elseif (filter_var($request->input('media'), FILTER_VALIDATE_URL)) {
                $media->media_type = 'image';
            } else {
                $media->media_type = 'file';
            }
            $media->path = $path;
            $media->user_id = Auth::id();
            $media->save();

            return redirect()
                ->route('dashboard.medias.index')
                ->with('success', 'تم تحميل الوسائط بنجاح.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'فشل تحميل الوسائط. حاول مرة أخرى.'])
                ->withInput();
        }
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
        //
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
