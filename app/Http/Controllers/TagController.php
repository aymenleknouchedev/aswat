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
    public function index()

    {
        $tags = Tag::all();
        return view('dashboard.alltags', compact('tags'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create the tag
        Tag::create($request->only('name'));

        return redirect()->route('dashboard.tag.create')->with('success', 'Tag created successfully.');
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
