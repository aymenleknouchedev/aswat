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
use App\Models\ContentMedia;
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
        $contents = Content::latest()->paginate(5);
        return view('dashboard.allcontents', compact('contents'));
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
        $albumImages = [];

        // --- Uploaded files ---
        if ($request->hasFile('album_images')) {
            foreach ($request->file('album_images') as $file) {
                $albumImages[] = $file; // just add file object, don't save
            }
        }
        // --- URLs ---
        if ($request->album_images_urls) {
            $urls = json_decode($request->album_images_urls, true); // decode JSON string
            $albumImages = array_merge($albumImages, $urls); // combine with uploaded files
        }

        // ✅ Basic validation rules
        $rules = [
            'title'         => 'required|string|max:75',
            'long_title'    => 'required|string|max:210',
            'mobile_title'  => 'required|string|max:40',
            'display_method' => 'required|string',
            'section_id'    => 'required|exists:sections,id',
            'category_id'   => 'nullable|exists:categories,id',
            'continent_id'  => 'nullable|exists:continents,id',
            'country_id'    => 'nullable|exists:countries,id',
            'trend_id'      => 'nullable|exists:trends,id',
            'window_id'     => 'nullable|exists:windows,id',
            'writer_id'     => 'nullable|exists:writers,id',
            'city_id'       => 'nullable|exists:cities,id',
            'summary'       => 'nullable|string',
            'content'       => 'nullable|string',
            'seo_keyword'   => 'nullable|string|max:255',
            'status'        => 'required|in:draft,published,archived',
            'template'      => 'required|string',
            'share_image'      => 'nullable|max:2048',
            'share_title'      => 'nullable|string',
            'share_description'      => 'nullable|string',
            'review_description'      => 'nullable|string',
        ];

        $templateRules = [
            'normal_image' => [
                'normal_main_image' => 'required|max:2048',
                'normal_mobile_image' => 'required|max:2048',
                'normal_content_image' => 'required|max:2048',
            ],
            'video' => [
                'video_main_image' => 'required|max:2048',
                'video_mobile_image' => 'required|max:2048',
                'video_content_image' => 'required|max:2048',
                'video_file' => 'required|max:20480',
            ],
            'podcast' => [
                'podcast_main_image' => 'required|max:2048',
                'podcast_content_image' => 'required|max:2048',
                'podcast_mobile_image' => 'required|max:2048',
                'podcast_file' => 'required|max:20480',
            ],
            'album' => [
                'album_main_image'   => 'required|max:2048',
                'album_content_image' => 'required|max:2048',
                'album_mobile_image' => 'required|max:2048',
            ],
            'no_image' => [
                'no_image_main_image' => 'required|max:2048',
                'no_image_mobile_image' => 'required|max:2048',
            ],
        ];



        $templateMediaMap = [
            'normal_image' => [
                'normal_main_image' => 'main',
                'normal_mobile_image' => 'mobile',
                'normal_content_image' => 'detail',
            ],
            'video' => [
                'video_main_image' => 'main',
                'video_mobile_image' => 'mobile',
                'video_content_image' => 'detail',
                'video_file' => 'video',
            ],
            'podcast' => [
                'podcast_main_image' => 'main',
                'podcast_mobile_image' => 'mobile',
                'podcast_content_image' => 'detail',
                'podcast_file' => 'podcast',
            ],
            'album' => [
                'album_main_image' => 'main',
                'album_mobile_image' => 'mobile',
                'album_content_image' => 'detail',
                'album_images' => 'album',
            ],
            'no_image' => [
                'no_image_main_image' => 'main',
                'no_image_mobile_image' => 'mobile',
            ],
        ];

        $validated = $request->validate($rules);
        $request->validate($templateRules[$request->template]);
        // Validate that $albumImages contains at least one file or URL
        if ($request->template == 'album') {
            if (empty($albumImages) || !is_array($albumImages) || count($albumImages) === 0) {
                return back()->withErrors(['album_images' => 'You must provide at least one album image (file or URL).'])->withInput();
            }
        }

        // Validate that $shareImage is a valid URL
        if ($request->hasFile('share_image')) {
            $file = $request->file('share_image');
            $path = asset('storage/' . $file->store('media', 'public'));
            $validated['share_image'] = $path;
        }


        // ✅ Create content
        $content = Content::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);


        $mediaMap = $templateMediaMap[$request->template];

        // ✅ Loop and save media (simplified)
        if (isset($mediaMap)) {
            foreach ($mediaMap as $field => $type) {

                if ($request->hasFile($field) && $field !== 'album_images') {
                    $file = $request->file($field);
                    $path = asset('storage/' . $file->store('media', 'public'));
                    $mediatype = $file->getClientMimeType();
                    $media = ContentMedia::create([
                        'type' => $type,
                        'path' => $path,
                        'media_type' => $mediatype,
                    ]);
                    $content->media()->attach($media->id);
                    continue;
                }

                // 🎥 Video Url / 🎙️ Podcast URL
                if ($request->filled($field)) {

                    $media = ContentMedia::create([
                        'type' => $type,
                        'path' => $request->input($field),
                        'media_type' => 'url',
                    ]);
                    $content->media()->attach($media->id);
                    continue;
                }


                // 🎵 Album images (multiple: files + urls)
                if ($field === 'album_images') {
                    $items = [];
                    // 1️⃣ Handle uploaded files
                    if ($request->hasFile($field)) {
                        foreach ($request->file($field) as $albumImage) {
                            $path = asset('storage/' . $albumImage->store('media', 'public'));
                            $items[] = $path;
                        }
                    }

                    // 2️⃣ Handle URL images (array of URLs)
                    if ($request->filled('album_images_urls')) {
                        $urls = json_decode($request->album_images_urls, true); // decode JSON string
                        if (is_array($urls)) {
                            foreach ($urls as $url) {
                                $items[] = $url; // add URL directly
                            }
                        }
                    }


                    // 3️⃣ Save all album media
                    foreach ($items as $path) {
                        $mediatype = $file->getClientMimeType();
                        if ($mediatype === null) {
                            $mediatype = 'url';
                        }
                        $media = ContentMedia::create([
                            'type' => $type,
                            'path' => $path,
                            'media_type' => $mediatype,
                        ]);
                        $content->media()->attach($media->id);
                    }

                    continue;
                }
            }
        }


        // ✅ Attach tags
        $content->tags()->sync($request->tags_id);

        return redirect()->route('dashboard.contents.index')
            ->with('success', 'Content created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
        $content = Content::findOrFail($id);
        $content->media()->detach();
        $content->tags()->detach();
        $content->delete();

        return redirect()->route('dashboard.contents.index')
            ->with('success', 'Content deleted successfully.');
    }
}
