<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Carbon\Carbon;

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
use Illuminate\Validation\Rule;

use App\Jobs\PublishContent;

use App\Services\CacheService;
use App\Enums\CacheKeys;


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
        $pagination = config('pagination.per15', 15);
        $contents = Content::latest()->paginate($pagination);
        return view('dashboard.allcontents', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $ttl_sections = config('cache_ttl.sections', 3600);
        $ttl_writers = config('cache_ttl.writers', 3600);

        $sections = CacheService::remember(CacheKeys::SECTIONS, function () {
            return Section::all();
        }, $ttl_sections);

        // $writers = CacheService::remember(CacheKeys::WRITERS, function () {
        //     return Writer::all();
        // }, $ttl_writers);

        $cities = Location::where('type', 'city')->get();
        $continents = Location::where('type', 'continent')->get();
        $countries = Location::where('type', 'country')->get();


        $categories = Category::take(15)->latest()->get();
        $tags = Tag::take(15)->latest()->get();
        $trends = Trend::take(15)->latest()->get();
        $windows = Window::take(15)->latest()->get();
        $writers = Writer::take(15)->latest()->get();

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
            'display_method' => 'required|string|in:simple,list,file',
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
            // 'status'        => 'required|in:draft,published,scheduled',
            'template'      => 'required|string',
            'tags_id'      => 'required|array',
            // 'template'      => [
            //     Rule::requiredIf(fn ($input) => $input->display_method !== 'simple'),
            //     'string'
            // ],
            'share_image'      => 'nullable|max:2048',
            'share_title'      => 'nullable|string',
            'share_description'      => 'nullable|string',
            'review_description'      => 'nullable|string',
        ];

        if (in_array($request->display_method, ['list', 'file'])) {
            $rules['items'] = 'required|array|min:1';
            $rules['items.*.title'] = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.image'] = [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:10000',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value instanceof \Illuminate\Http\UploadedFile) {
                        [$width, $height] = getimagesize($value->getRealPath());
                        // Example: require 16:9 aspect ratio (width / height ≈ 16/9)
                        $aspectRatio = $width / $height;
                        $expected = 9 / 16;
                        if (abs($aspectRatio - $expected) > 0.05) {
                            $fail('The ' . $attribute . ' must have a 9:16 aspect ratio.');
                        }
                    }
                }
            ];
            $rules['items.*.index'] = 'required|integer';
            $rules['items.*.url'] = $request->display_method === 'list' ? 'required|url' : 'nullable|url';
        }

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

        if (!empty($validated['items']) && is_array($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $imagePath = null;

                // Handle uploaded file
                if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $imagePath = $item['image']->store('content_list_images', 'public');
                } elseif (is_string($item['image'])) {
                    $imagePath = $item['image'];
                }

                // store the whole path
                if ($imagePath && !str_starts_with($imagePath, 'http')) {
                    $imagePath = asset('storage/' . $imagePath);
                }

                $content->contentLists()->create([
                    'title'       => $item['title'],
                    'description' => $item['description'],
                    'url'         => $item['url'] ?? null,
                    'image'       => $imagePath,
                    'index'       => $item['index'],
                ]);
            }
        }


        $mediaMap = $templateMediaMap[$request->template];

        // ✅ Loop and save media (simplified)
        if (isset($mediaMap)) {
            foreach ($mediaMap as $field => $type) {

                if ($request->hasFile($field) && $field !== 'album_images') {
                    $file = $request->file($field);
                    $path = asset('storage/' . $file->store('media', 'public'));
                    $mediatype = $file->getClientMimeType();

                    $media = ContentMedia::create([
                        'path' => $path,
                        'media_type' => $mediatype,
                        'user_id' => Auth::id(),
                        'name' => $file->getClientOriginalName(),
                        'alt' => $content->title,
                    ]);
                    $content->media()->attach($media->id, ['type' => $type]);
                    continue;
                }

                // 🎥 Video Url / 🎙️ Podcast URL
                if ($request->filled($field)) {

                    // Check if ContentMedia with this path already exists
                    $existingMedia = ContentMedia::where('path', $request->input($field))->first();
                    if ($existingMedia) {
                        $content->media()->attach($existingMedia->id, ['type' => $type]);
                    } else {
                        $media = ContentMedia::create([
                            'path' => $request->input($field),
                            'media_type' => 'url',
                            'user_id' => Auth::id(),
                            'name' => 'url_' . bin2hex(random_bytes(10)),
                            'alt' => $content->title,
                        ]);
                        $content->media()->attach($media->id, ['type' => $type]);
                    }
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
                        // Check if ContentMedia with this path already exists
                        $existingMedia = ContentMedia::where('path', $path)->first();
                        if ($existingMedia) {
                            $media = $existingMedia;
                        } else {
                            $media = ContentMedia::create([
                                'path' => $path,
                                'media_type' => $mediatype,
                                'user_id' => Auth::id(),
                                'name' => ($mediatype === 'url')
                                    ? 'url_' . bin2hex(random_bytes(10))
                                    : (isset($file) ? $file->getClientOriginalName() : basename($path)),
                                'alt' => $content->title,
                            ]);
                        }
                        $content->media()->attach($media->id, ['type' => $type]);
                    }

                    continue;
                }
            }
        }

        // ✅ Attach tags
        $content->tags()->sync($request->tags_id);

        if ($request->filled('published_at') && $request->published_at > now()->toDateTimeString()) {
            $content->status = 'scheduled';
            $content->published_at = $request->published_at;
            $content->save();

            $scheduledTime = Carbon::parse($request->published_at, 'Africa/Algiers');

            $delayInSeconds = now()->diffInSeconds($scheduledTime, false);
            if ($delayInSeconds < 0) {
                $delayInSeconds = 0;
            }
            PublishContent::dispatch($content->id)->delay(
                now()->addSeconds($delayInSeconds)
            );
        } elseif ($request->filled('status') && $request->status === 'draft') {
            $content->status = 'draft';
            $content->published_at = null;
            $content->save();
        } else {
            $content->status = 'published';
            $content->published_at = now();
            $content->save();
        }


        return redirect()->back()
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
        $content = Content::with(['media', 'tags', 'contentLists'])->findOrFail($id);

        $ttl_sections = config('cache_ttl.sections', 3600);
        $ttl_writers = config('cache_ttl.writers', 3600);

        $sections = CacheService::remember(CacheKeys::SECTIONS, function () {
            return Section::all();
        }, $ttl_sections);


        $scity = Location::find($content->city_id);
        $scontinent = Location::find($content->continent_id);
        $scountry = Location::find($content->country_id);

        $continents = Location::where('type', 'continent')->get();
        $countries = Location::where('type', 'country')->get();

        $categories = Category::take(15)->latest()->get();
        $tags = Tag::take(15)->latest()->get();
        $trends = Trend::take(15)->latest()->get();
        $windows = Window::take(15)->latest()->get();
        $writers = Writer::take(15)->latest()->get();

        // $existing_images = $content->media->whereIn('pivot.type', ['main', 'mobile', 'detail'])->values()->all();
        // $existing_videos = $content->media->where('pivot.type', 'video')->values()->all();
        // $existing_podcasts = $content->media->where('pivot.type', 'podcast')->values()->all();
        // $existing_albums = $content->media->where('pivot.type', 'album')->values()->all();


        $mainImagePaths = $content->media->where('pivot.type', 'main')->pluck('path')->all();

        $mobileImagePaths = $content->media->where('pivot.type', 'mobile')->pluck('path')->all();
        $contentImagePaths = $content->media->where('pivot.type', 'detail')->pluck('path')->all();
        $albumImagePaths = $content->media->where('pivot.type', 'album')->isEmpty() ? null : $content->media->where('pivot.type', 'album')->pluck('path')->all();
        $videoPaths = $content->media->where('pivot.type', 'video')->isEmpty() ? null : $content->media->where('pivot.type', 'video')->pluck('path')->all();
        $podcastPaths = $content->media->where('pivot.type', 'podcast')->isEmpty() ? null : $content->media->where('pivot.type', 'podcast')->pluck('path')->all();


        return view('dashboard.editcontent', compact(
            'content',
            'sections',
            'categories',
            'writers',
            'scity',
            'scontinent',
            'scountry',
            'continents',
            'countries',
            'tags',
            'trends',
            'windows',
            'mainImagePaths',
            'mobileImagePaths',
            'contentImagePaths',
            'albumImagePaths',
            'videoPaths',
            'podcastPaths',
        ));
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
