<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Services\CacheService;
use App\Enums\CacheKeys;

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
        try {
            $ttl = config('cache_ttl.sections', 3600);
            $sections = CacheService::remember(CacheKeys::SECTIONS, function () {
                return Section::all();
            }, $ttl);

            return view('dashboard.allsections', compact('sections'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to load sections.']);
        }
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
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:sections,name',
            ]);

            $section = new Section();       
            $section->name = $request->input('name');
            $section->save();
            CacheService::forget(CacheKeys::SECTIONS);

            return redirect()->route('dashboard.section.create')->with('success', 'Section created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create section.']);
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
        $section = Section::findOrFail($id);
        return view('dashboard.editsection', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $section = Section::findOrFail($id);
            $section->name = $request->input('name');
            $section->save();

            CacheService::forget(CacheKeys::SECTIONS);

            return redirect()->route('dashboard.sections.index')->with('success', 'Section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update section.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();
            CacheService::forget(CacheKeys::SECTIONS);

            return redirect()->route('dashboard.sections.index')->with('success', 'Section deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete section.']);
        }
    }
}
