<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Page;

use App\Services\CacheService;
use App\Enums\CacheKeys;

class PagesController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:pages_access']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ttl = config('cache_ttl.pages', 3600);
            $pages = CacheService::remember(CacheKeys::PAGES, function () {
                return Page::all();
            }, $ttl);
            return view('dashboard.allpages', compact('pages'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to load pages: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can be used to show a form for creating a new page
        return view('dashboard.addpage'); // Adjust the view as necessary
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
        ]);

        Page::create($validated);
        CacheService::forget(CacheKeys::PAGES);

        return redirect()->route('dashboard.page.create')
            ->with('success', 'Page created successfully!');
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
        $page = Page::findOrFail($id);
        return view('dashboard.editpage', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
        ]);

        $page->update($validated);
        CacheService::forget(CacheKeys::PAGES);

        return redirect()->route('dashboard.pages.index')
            ->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        CacheService::forget(CacheKeys::PAGES);

        return redirect()->route('dashboard.pages.index')
            ->with('success', 'Page deleted successfully!');
    }
}
