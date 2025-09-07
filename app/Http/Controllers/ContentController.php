<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Section;
use App\Models\Category;
use App\Models\Writer;
use App\Models\Location;
use App\Models\Tag;
use App\Models\Trend;
use App\Models\Window;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;


class ContentController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:content_access']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to retrieve and display all contents
        return view('dashboard.allcontents');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {


        // GET DATA FROM DATABASE
        $sections = Section::all();
        $categories = Category::all();
        $writers = Writer::all();
        $cities = Location::where('type', 'city')->get();
        $continents = Location::where('type', 'continent')->get();
        $countries = Location::where('type', 'country')->get();
        $tags = Tag::all();
        $trends = Trend::all();
        $windows = Window::all();

        $existing_images = [];
        $existing_videos = [];
        $existing_podcasts = [];
        $existing_albums = [];

        return view('dashboard.addcontent', compact(
            'sections',
            'categories',
            'writers',
            'cities',
            'continents',
            'countries',
            'tags',
            'trends',
            'windows',
            'existing_images',
            'existing_videos',
            'existing_podcasts',
            'existing_albums'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:75',
            'long_title' => 'required|string|max:210',
            'mobile_title' => 'required|string|max:40',

            'display_method' => 'required',

            'section_id' => 'required|exists:sections,id',
            'category_id' => 'nullable|exists:categories,id',

            'continent_id' => 'nullable|exists:locations,id',
            'country_id' => 'nullable|exists:locations,id',

            'trend_id' => 'nullable|exists:trends,id',
            'window_id' => 'nullable|exists:windows,id',

            'writer_id' => 'nullable|exists:writers,id',
            'city_id' => 'nullable|exists:locations,id',

            'tags_id' => 'required|array',
            'tags_id.*' => 'exists:tags,id',

            'summary' => 'required|string|max:130',

            'content' => 'required|string',
            'seo_keyword' => 'required|string',
            'status' => 'required|in:published,draft',

        ]);


        // //assign value to content
        // $validated['content'] = 'kjhgfd';

        // assign user id
        $content = Content::create(array_merge($validated, [
            'user_id' => Auth::id(),
        ]));

        // sync tags
        $content->tags()->sync($validated['tags_id'] ?? []);

        return redirect()->route('dashboard.contents.index')
            ->with('success', 'Content created successfully.');
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
