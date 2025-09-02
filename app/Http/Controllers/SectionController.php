<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SectionController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:sections_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all sections from the database
        $sections = Section::all();
        return view('dashboard.allsections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new section
        return view('dashboard.addsection');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $section = new Section();       
        $section->name = $request->input('name');
        $section->save();

        return redirect()->route('dashboard.section.create')->with('success', 'Section created successfully.');
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
