<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Tag;

class TagController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:tags_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Tag::query();
            $pagination = config('pagination.per20', 20);

            if ($search = $request->input('search')) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            if (!$search) {
                $tags = Tag::paginate($pagination)
                           ->appends($request->all());
            } else {
                $tags = $query->orderBy('id', 'desc')
                                    ->paginate($pagination)
                                    ->appends($request->all());
            }
            return view('dashboard.alltags', compact('tags'));
        } catch (\Throwable $e) {
            return redirect()
                ->route('dashboard.permissions.index')
                ->withErrors(['error' => 'فشل تحميل الصلاحيات. حاول مرة أخرى.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new tag
        return view('dashboard.addtag');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:3|max:255|unique:tags,name',
            ]);
            Tag::create($request->only('name'));
            return redirect()->back()->with('success', 'Tag created successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل إنشاء الوسم. حاول مرة أخرى.']);
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
        $tag = Tag::findOrFail($id);
        return view('dashboard.edittag', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $tag = Tag::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $tag->name = $request->input('name');
            $tag->save();

            return redirect()->back()->with('success', 'Tag updated successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل تحديث الوسم. حاول مرة أخرى.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return redirect()->back()->with('success', 'Tag deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'فشل حذف الوسم. حاول مرة أخرى.']);
        }
    }
}
