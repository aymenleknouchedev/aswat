<?php

namespace App\Http\Controllers;

use App\Models\ContentAction;
use App\Models\ContentReview;
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
    public function index(Request $request)
    {
        $pagination = config('pagination.per15', 15);

        $query = Content::query()->latest();

        // 🔍 Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('mobile_title', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere("long_title", "like", "%{$search}%");
            });
        }

        // 📂 Section filter
        if ($request->filled('section')) {
            $query->where('section_id', $request->section);
        }

        // 📅 Date range filter
        if ($request->filled('date_range')) {
            $dates = explode(" to ", $request->date_range);

            if (count($dates) === 2) {
                [$start, $end] = $dates;

                $query->whereBetween('created_at', [
                    $start . " 00:00:00",
                    $end . " 23:59:59"
                ]);
            }
        }

        // ⏳ Paginate
        $contents = $query->paginate($pagination)->appends($request->query());

        $sections = Section::all();

        return view('dashboard.allcontents', compact('contents', 'sections'));
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
        // ===== 1) Préparer les URLs dأصول الألبوم (album_assets) =====
        // Ex.: album_assets[] = ['url' => 'https://...', 'title' => '...', 'alt' => '...']
        $albumImages = [];
        if ($request->album_assets && is_array($request->album_assets)) {
            foreach ($request->album_assets as $asset) {
                if (!empty($asset['url']) && is_string($asset['url'])) {
                    $albumImages[] = $asset['url'];
                }
            }
        }

        // ===== 2) Règles de validation (générales) — URLs uniquement =====
        $rules = [
            'title'               => 'required|string|max:75',
            'long_title'          => 'required|string|max:210',
            'mobile_title'        => 'required|string|max:40',
            'display_method'      => 'required|string|in:simple,list,file',
            'section_id'          => 'required|exists:sections,id',
            'category_id'         => 'required|exists:categories,id',
            'continent_id'        => 'nullable|exists:locations,id',
            'country_id'          => 'nullable|exists:locations,id',
            'trend_id'            => 'nullable|exists:trends,id',
            'window_id'           => 'nullable|exists:windows,id',
            'writer_id'           => 'nullable|exists:writers,id',
            'city_id'             => 'nullable|exists:locations,id',
            'summary'             => 'nullable|string',
            'content'             => 'nullable|string',
            'seo_keyword'         => 'nullable|string|max:255',
            'template'            => 'required|string|in:normal_image,video,podcast,album,no_image',
            'tags_id'             => 'required|array',
            'tags_id.*'           => 'integer|exists:tags,id',
            'share_image'         => 'nullable|url|max:2048',
            'share_title'         => 'nullable|string',
            'share_description'   => 'nullable|string',
            'review_description'  => 'nullable|string',
            'created_at'          => 'nullable|date',
            'created_at_by_admin' => 'nullable|date',

            // Programmation
            'published_at'        => 'nullable|date',
            'status'              => 'nullable|in:published,draft,scheduled',
            'is_latest'           => 'nullable|boolean',
            'importance'          => 'nullable|integer|min:0|max:10',
        ];

        // ===== 3) Règles pour display_method = list/file (items en URLs) =====
        if (in_array($request->display_method, ['list', 'file'], true)) {
            // Autoriser items vide -> fallback à simple plus bas
            if (!empty($request->items) && is_array($request->items)) {
                $rules['items']               = 'array|min:1';
                $rules['items.*.title']       = 'required|string|max:255';
                $rules['items.*.description'] = 'required|string';
                // image en URL uniquement
                $rules['items.*.image']       = 'required|url|max:2048';
                $rules['items.*.index']       = 'required|integer';
                $rules['items.*.url']         = $request->display_method === 'list' ? 'required|url' : 'nullable|url';
            }
        }

        // ===== 4) Règles « template » (toutes en URL) =====
        // NB: plus aucun fichier téléchargé, toutes les valeurs sont des URLs/strings.
        $templateRules = [
            'normal_image' => [
                'normal_main_image'    => 'required',
                'normal_mobile_image'  => 'required',
                'normal_content_image' => 'required',
            ],
            'video' => [
                'video_main_image'    => 'required',
                'video_mobile_image'  => 'required',
                'video_content_image' => 'required',
                'video_file'          => 'required', // mp4/m3u8/YouTube, etc.
            ],
            'podcast' => [
                'podcast_main_image'    => 'required',
                'podcast_content_image' => 'required',
                'podcast_mobile_image'  => 'required',
                'podcast_file'          => 'required', // mp3/ogg/stream
            ],
            'album' => [
                'album_main_image'    => 'required',
                'album_content_image' => 'required',
                'album_mobile_image'  => 'required',
                // album_assets géré à part (liste d’objets)
            ],
            'no_image' => [
                'no_image_main_image'   => 'required',
                'no_image_mobile_image' => 'required',
            ],
        ];

        // Mappage champ => type de liaison pivot
        $templateMediaMap = [
            'normal_image' => [
                'normal_main_image'    => 'main',
                'normal_mobile_image'  => 'mobile',
                'normal_content_image' => 'detail',
            ],
            'video' => [
                'video_main_image'    => 'main',
                'video_mobile_image'  => 'mobile',
                'video_content_image' => 'detail',
                'video_file'          => 'video',
            ],
            'podcast' => [
                'podcast_main_image'    => 'main',
                'podcast_mobile_image'  => 'mobile',
                'podcast_content_image' => 'detail',
                'podcast_file'          => 'podcast',
            ],
            'album' => [
                'album_main_image'    => 'main',
                'album_mobile_image'  => 'mobile',
                'album_content_image' => 'detail',
                'album_images'        => 'album', // géré via $albumImages
            ],
            'no_image' => [
                'no_image_main_image'   => 'main',
                'no_image_mobile_image' => 'mobile',
            ],
        ];

        // ===== 5) Validation =====
        $validated = $request->validate($rules);
        $request->validate($templateRules[$request->template] ?? []);

        // Vérifier qu’il y a au moins un élément d’album si template = album
        if ($request->template === 'album') {
            if (empty($albumImages)) {
                return back()
                    ->withErrors(['album_assets' => 'You must provide at least one album asset URL.'])
                    ->withInput();
            }
        }

        // Normaliser display_method si items manquants
        if (
            in_array($validated['display_method'], ['list', 'file'], true)
            && (empty($validated['items']) || !is_array($validated['items']))
        ) {
            $validated['display_method'] = 'simple';
        }

        // ===== 6) Créer le contenu =====
        $content = Content::create([
            ...$validated,
            'is_latest'  => $request->boolean('is_latest'),
            'importance' => $request->input('importance'),
            'user_id'    => Auth::id(),
        ]);

        // ===== 7) Enregistrer une note de relecture si fournie =====
        if ($request->filled('review_description')) {
            ContentReview::create([
                'reviewer_id' => Auth::id(),
                'content_id'  => $content->id,
                'message'     => $request->review_description,
            ]);
        }

        // ===== 8) Enregistrer les items (list/file) — images en URLs =====
        if (!empty($validated['items']) && is_array($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $imageUrl = isset($item['image']) && is_string($item['image']) ? $item['image'] : null;

                $content->contentLists()->create([
                    'title'       => $item['title'],
                    'description' => $item['description'],
                    'url'         => $item['url'] ?? null,
                    'image'       => $imageUrl,
                    'index'       => $item['index'],
                ]);
            }
        }

        // ===== 9) Enregistrer les médias liés (tout en URLs) =====
        $mediaMap = $templateMediaMap[$request->template] ?? null;

        // utilitaire pour déduire un type mime logique à partir de l’URL
        $detectTypeFromUrl = function (string $url): string {
            $u = strtolower(parse_url($url, PHP_URL_PATH) ?? '');
            if (preg_match('/\\.(jpe?g|png|gif|webp|bmp|svg)$/', $u)) return 'image';
            if (preg_match('/\\.(mp4|mov|wmv|webm|m4v|m3u8)$/', $u)) return 'video';
            if (preg_match('/\\.(mp3|wav|ogg|m4a|aac|flac)$/', $u)) return 'audio';
            // Détection simple YouTube
            if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) return 'youtube';
            return 'url';
        };

        if ($mediaMap) {
            foreach ($mediaMap as $field => $type) {
                // 9.a) Champs simples (image principale, mobile, detail, video_file, podcast_file) en URL
                if ($field !== 'album_images' && $request->filled($field)) {
                    $url       = $request->input($field);
                    $mediaType = $detectTypeFromUrl($url);

                    // réutiliser si déjà existant
                    $existing = ContentMedia::where('path', $url)->first();
                    if ($existing) {
                        $content->media()->attach($existing->id, ['type' => $type]);
                    } else {
                        $media = ContentMedia::create([
                            'path'       => $url,
                            'media_type' => $mediaType, // 'image'/'video'/'audio'/'youtube'/'url'
                            'user_id'    => Auth::id(),
                            'name'       => basename(parse_url($url, PHP_URL_PATH) ?? 'url_' . Str::random(8)),
                            'alt'        => $content->title,
                        ]);
                        $content->media()->attach($media->id, ['type' => $type]);
                    }
                    continue;
                }

                // 9.b) Album images (multiples URLs)
                if ($field === 'album_images' && !empty($albumImages)) {
                    foreach ($albumImages as $url) {
                        $mediaType = $detectTypeFromUrl($url);
                        $existing  = ContentMedia::where('path', $url)->first();

                        if ($existing) {
                            $content->media()->attach($existing->id, ['type' => $type]);
                        } else {
                            $media = ContentMedia::create([
                                'path'       => $url,
                                'media_type' => $mediaType,
                                'user_id'    => Auth::id(),
                                'name'       => basename(parse_url($url, PHP_URL_PATH) ?? 'url_' . Str::random(8)),
                                'alt'        => $content->title,
                            ]);
                            $content->media()->attach($media->id, ['type' => $type]);
                        }
                    }
                }
            }
        }

        // ===== 10) Tags =====
        $content->tags()->sync($request->tags_id);

        // ===== 11) Publication / Programmation =====
        if ($request->filled('published_at') && $request->published_at > now()->toDateTimeString()) {
            $content->status       = 'scheduled';
            $content->published_at = $request->published_at;
            $content->save();

            $scheduledTime = \Carbon\Carbon::parse($request->published_at, 'Africa/Algiers');
            $delayInSeconds = now()->diffInSeconds($scheduledTime, false);
            if ($delayInSeconds < 0) $delayInSeconds = 0;

            PublishContent::dispatch($content->id)->delay(now()->addSeconds($delayInSeconds));
        } elseif ($request->filled('status') && $request->status === 'draft') {
            $content->status       = 'draft';
            $content->published_at = null;
            $content->save();
        } else {
            $content->status       = 'published';
            $content->published_at = now();
            $content->save();
        }

        return redirect()->back()->with('success', 'Content created successfully.');
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
        $content = Content::with(['media', 'tags'])->findOrFail($id);
        $contentLists = $content->contentLists()->orderBy('index', 'asc')->get();

        $reviews = $content->reviews()->latest()->take(2)->get();

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
            'contentLists',
            'reviews',
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

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $albumImages = [];

        if ($request->hasFile('album_images')) {
            foreach ($request->file('album_images') as $file) {
                $albumImages[] = $file;
            }
        }
        if ($request->album_images_urls) {
            $urls = json_decode($request->album_images_urls, true);
            $albumImages = array_merge($albumImages, $urls);
        }

        $rules = [
            'title' => 'required|string|max:75',
            'long_title' => 'required|string|max:210',
            'mobile_title' => 'required|string|max:40',
            'display_method' => 'required|string|in:simple,list,file',
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'nullable|exists:categories,id',
            'continent_id' => 'nullable|exists:locations,id',
            'country_id' => 'nullable|exists:locations,id',
            'trend_id' => 'nullable|exists:trends,id',
            'window_id' => 'nullable|exists:windows,id',
            'writer_id' => 'nullable|exists:writers,id',
            'city_id' => 'nullable|exists:locations,id',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'seo_keyword' => 'nullable|string|max:255',
            'template' => 'required|string',
            'tags_id' => 'required|array',
            'share_image' => 'nullable|max:2048',
            'share_title' => 'nullable|string',
            'share_description' => 'nullable|string',
            'review_description' => 'nullable|string',
        ];

        if (in_array($request->display_method, ['list', 'file'])) {
            $rules['items'] = 'required|array|min:1';
            $rules['items.*.title'] = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.image'] = 'nullable';
            $rules['items.*.index'] = 'required|integer';
            $rules['items.*.url'] = $request->display_method === 'list' ? 'required|url' : 'nullable|url';
        }

        if ($request->display_method === 'simple' && $content->contentLists()->count() > 0) {
            $content->contentLists()->each(function ($item) use ($request) {
                $item->delete();
            });
        }

        $templateRules = [
            'normal_image' => [
                'normal_main_image' => 'nullable|max:2048',
                'normal_mobile_image' => 'nullable|max:2048',
                'normal_content_image' => 'nullable|max:2048',
            ],
            'video' => [
                'video_main_image' => 'nullable|max:2048',
                'video_mobile_image' => 'nullable|max:2048',
                'video_content_image' => 'nullable|max:2048',
                'video_file' => 'nullable|max:200480',
            ],
            'podcast' => [
                'podcast_main_image' => 'nullable|max:2048',
                'podcast_content_image' => 'nullable|max:2048',
                'podcast_mobile_image' => 'nullable|max:2048',
                'podcast_file' => 'nullable|max:20480',
            ],
            'album' => [
                'album_main_image' => 'nullable|max:2048',
                'album_content_image' => 'nullable|max:2048',
                'album_mobile_image' => 'nullable|max:2048',
            ],
            'no_image' => [
                'no_image_main_image' => 'nullable|max:2048',
                'no_image_mobile_image' => 'nullable|max:2048',
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
        $request->validate($templateRules[$request->template] ?? []);

        // --- Album validation ---
        if ($request->template == 'album' && empty($albumImages)) {
            return back()->withErrors(['album_images' => 'You must provide at least one album image (file or URL).'])->withInput();
        }

        // ✅ Update basic content data
        $content->update([
            ...$validated,
            "is_latest" => $request->has('is_latest') ? (bool)$request->is_latest : false,
            'importance' => $request->input('importance'),
            'user_id' => Auth::id(),
        ]);

        // ✅ Handle template change
        if ($request->template !== $content->getOriginal('template')) {
            // Detach old media
            $content->media()->detach();

            // Reattach new media (like in store)
            $this->attachMedia($request, $content, $templateMediaMap[$request->template] ?? [], $albumImages);
        } else {
            // Same template → only update where new files exist
            $this->updateMedia($request, $content, $templateMediaMap[$request->template] ?? [], $albumImages);
        }

        // dd($validated['items'] ?? null);
        if (isset($validated['items'])) {
            $content->contentLists()->delete();
            foreach ($validated['items'] as $item) {
                $imagePath = null;
                // image must be file
                if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $imagePath = $item['image']->store('content_list_images', 'public');
                    $imagePath = asset('storage/' . $imagePath);
                } elseif (isset($item['image']) && is_string($item['image'])) {
                    $imagePath = $item['image'];
                }
                $content->contentLists()->create([
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'url' => $item['url'] ?? null,
                    'image' => $imagePath,
                    'index' => $item['index'],
                ]);
            }
        }

        // ✅ Update tags
        $content->tags()->sync($request->tags_id);

        ContentAction::create([
            'user_id' => Auth::id(),
            'content_id' => $content->id,
            'action' => 'updated',
        ]);

        return redirect()->back()->with('success', 'Content updated successfully.');
    }

    /**
     * Attach media fresh (when template changes)
     */
    protected function attachMedia(Request $request, Content $content, array $mediaMap, array $albumImages)
    {
        foreach ($mediaMap as $field => $type) {
            if ($field === 'album_images') {
                foreach ($albumImages as $img) {
                    $path = $img instanceof \Illuminate\Http\UploadedFile
                        ? asset('storage/' . $img->store('media', 'public'))
                        : $img;

                    $media = ContentMedia::create([
                        'path' => $path,
                        'media_type' => $img instanceof \Illuminate\Http\UploadedFile
                            ? $img->getClientMimeType()
                            : 'url',
                        'user_id' => Auth::id(),
                        'name' => $img instanceof \Illuminate\Http\UploadedFile
                            ? $img->getClientOriginalName()
                            : 'url_' . bin2hex(random_bytes(10)),
                        'alt' => $content->title,
                    ]);
                    $content->media()->attach($media->id, ['type' => $type]);
                }
            } elseif ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = asset('storage/' . $file->store('media', 'public'));
                $media = ContentMedia::create([
                    'path' => $path,
                    'media_type' => $file->getClientMimeType(),
                    'user_id' => Auth::id(),
                    'name' => $file->getClientOriginalName(),
                    'alt' => $content->title,
                ]);
                $content->media()->attach($media->id, ['type' => $type]);
            } elseif ($request->filled($field)) {
                $media = ContentMedia::firstOrCreate(
                    ['path' => $request->input($field)],
                    [
                        'media_type' => 'url',
                        'user_id' => Auth::id(),
                        'name' => 'url_' . bin2hex(random_bytes(10)),
                        'alt' => $content->title,
                    ]
                );
                $content->media()->attach($media->id, ['type' => $type]);
            }
        }
    }

    /**
     * Update media (same template, only replace where new files are given)
     */
    /**
     * Update media (same template, only replace where new files/urls are given)
     */
    protected function updateMedia(Request $request, Content $content, array $mediaMap, array $albumImages)
    {
        foreach ($mediaMap as $field => $type) {
            // Handle album images (multiple)
            if ($field === 'album_images') {
                if (!empty($albumImages)) {
                    // Remove old album media
                    $content->media()->wherePivot('type', $type)->detach();

                    foreach ($albumImages as $img) {
                        $path = $img instanceof \Illuminate\Http\UploadedFile
                            ? asset('storage/' . $img->store('media', 'public'))
                            : $img;

                        $media = ContentMedia::firstOrCreate(
                            ['path' => $path],
                            [
                                'media_type' => $img instanceof \Illuminate\Http\UploadedFile
                                    ? $img->getClientMimeType()
                                    : 'url',
                                'user_id' => Auth::id(),
                                'name' => $img instanceof \Illuminate\Http\UploadedFile
                                    ? $img->getClientOriginalName()
                                    : 'url_' . bin2hex(random_bytes(10)),
                                'alt' => $content->title,
                            ]
                        );
                        $content->media()->attach($media->id, ['type' => $type]);
                    }
                }
                continue;
            }

            // Handle file upload (single)
            if ($request->hasFile($field)) {
                // Remove old media of this type
                $content->media()->wherePivot('type', $type)->detach();

                $file = $request->file($field);
                $path = asset('storage/' . $file->store('media', 'public'));
                $media = ContentMedia::create([
                    'path' => $path,
                    'media_type' => $file->getClientMimeType(),
                    'user_id' => Auth::id(),
                    'name' => $file->getClientOriginalName(),
                    'alt' => $content->title,
                ]);
                $content->media()->attach($media->id, ['type' => $type]);
                continue;
            }

            // Handle URL input (single)
            if ($request->filled($field)) {
                $url = $request->input($field);

                // Only update if URL is different from current
                $existing = $content->media()->wherePivot('type', $type)->where('path', $url)->first();
                if (!$existing) {
                    // Remove old media of this type
                    $content->media()->wherePivot('type', $type)->detach();

                    $media = ContentMedia::firstOrCreate(
                        ['path' => $url],
                        [
                            'media_type' => 'url',
                            'user_id' => Auth::id(),
                            'name' => 'url_' . bin2hex(random_bytes(10)),
                            'alt' => $content->title,
                        ]
                    );
                    $content->media()->attach($media->id, ['type' => $type]);
                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $content = Content::findOrFail($id);

            // Detach related media and tags
            $content->media()->detach();
            $content->tags()->detach();

            // Delete related content lists
            $content->contentLists()->delete();

            // Delete related reviews
            $content->reviews()->delete();

            // Delete the content itself
            $content->delete();

            // Log the action
            ContentAction::create([
                'user_id' => Auth::id(),
                'content_id' => $id,
                'action' => 'deleted',
            ]);

            return redirect()->route('dashboard.contents.index')
                ->with('success', 'Content deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.contents.index')
                ->with('error', 'Failed to delete content: ' . $e->getMessage());
        }
    }
}
