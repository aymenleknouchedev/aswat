<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BreakingContent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class BreakingNewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breakingNews = BreakingContent::latest()->take(10)->get();
        return view('dashboard.addbreakingnew', compact('breakingNews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        BreakingContent::create([
            'text' => $request->title,
            'user_id' => Auth::id(), // Associate news with the logged-in user
            'status' => 'published',
        ]);

        // 🧹 Clear the cached breaking news so frontend updates instantly
        Cache::forget('breaking-news');

        return redirect()
            ->route('dashboard.breakingnew.create')
            ->with('success', 'Breaking news added successfully.');
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
        $breakingNews = BreakingContent::findOrFail($id);
        return view('dashboard.editbreakingnew', compact('breakingNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $breakingNews = BreakingContent::findOrFail($id);
        $breakingNews->update([
            'text' => $request->title,
        ]);

        return redirect()->route('dashboard.breakingnew.create')->with('success', 'Breaking news updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = BreakingContent::findOrFail($id);
        $news->delete();

        return redirect()->route('dashboard.breakingnew.create')->with('success', 'Breaking news deleted successfully.');
    }
}
