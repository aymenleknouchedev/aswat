<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use App\Models\ContentMedia;

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
        //
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
        //
    }
}
