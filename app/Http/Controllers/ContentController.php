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
use Illuminate\Support\Str;

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


    public function store(Request $request)
    {
        // =========================================
        // 0) Normalisation d'URL (absolutisation)
        // =========================================
        $toAbsoluteUrl = function (?string $v): ?string {
            if (!is_string($v)) return null;
            $v = trim($v);
            if ($v === '') return null;

            if (\Illuminate\Support\Str::startsWith($v, ['http://', 'https://'])) {
                return $v;
            }
            // chemins locaux fréquents -> asset()
            if (\Illuminate\Support\Str::startsWith($v, ['/storage', 'storage/', '/uploads', 'uploads/', 'public/'])) {
                $v = ltrim($v, '/'); // évite //storage
                return asset($v);
            }
            // autre relatif -> url()
            return url($v);
        };

        // share_image (si fourni)
        if ($request->filled('share_image')) {
            $request->merge(['share_image' => $toAbsoluteUrl($request->input('share_image'))]);
        }

        // =========================================
        // 0bis) Normaliser items[*]  (media_url -> image)
        // =========================================
        if (is_array($request->input('items'))) {
            $items = $request->input('items');
            foreach ($items as $i => $item) {
                // si media_url présent mais pas image -> bascule
                if (!isset($item['image']) && !empty($item['media_url'])) {
                    $item['image'] = $item['media_url'];
                }
                // normaliser image/url
                $item['image'] = isset($item['image']) && $item['image'] !== '' ? $toAbsoluteUrl($item['image']) : null;
                $item['url']   = isset($item['url'])   && $item['url']   !== '' ? $toAbsoluteUrl($item['url'])   : null;

                $items[$i] = $item;
            }
            $request->merge(['items' => $items]);
        }

        // =========================================
        // 0ter) Normaliser les champs template (tous en URL)
        // =========================================
        $templateUrlFields = [
            // normal_image
            'normal_main_image',
            'normal_mobile_image',
            'normal_content_image',
            // video
            'video_main_image',
            'video_mobile_image',
            'video_content_image',
            'video_file',
            // podcast
            'podcast_main_image',
            'podcast_mobile_image',
            'podcast_content_image',
            'podcast_file',
            // album
            'album_main_image',
            'album_mobile_image',
            'album_content_image',
            // no_image
            'no_image_main_image',
            'no_image_mobile_image',
        ];
        foreach ($templateUrlFields as $f) {
            if ($request->filled($f)) {
                $request->merge([$f => $toAbsoluteUrl($request->input($f))]);
            }
        }

        // album_assets normalisés
        $albumImages = [];
        if ($request->album_assets && is_array($request->album_assets)) {
            $norm = [];
            foreach ($request->album_assets as $asset) {
                $url = isset($asset['url']) ? $toAbsoluteUrl($asset['url']) : null;
                if ($url) {
                    $norm[] = [
                        'url'   => $url,
                        'title' => $asset['title'] ?? null,
                        'alt'   => $asset['alt'] ?? null,
                    ];
                    $albumImages[] = $url;
                }
            }
            $request->merge(['album_assets' => $norm]);
        }

        // =========================================
        // 0quater) Gestion du mode PREVIEW (avant validation)
        // =========================================


        // =========================================
        // 1) Règles de validation
        // =========================================
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
            'status'              => 'nullable|in:published,draft,scheduled,preview', // preview déjà neutralisé
            'is_latest'           => 'nullable|boolean',
            'importance'          => 'nullable|integer|min:0|max:10',
        ];

        // Si list/file -> items requis
        if (in_array($request->input('display_method'), ['list', 'file'], true)) {
            $rules['items']               = 'required|array|min:1';
            $rules['items.*.title']       = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.image']       = 'required|url|max:2048';
            $rules['items.*.index']       = 'required|integer|min:1';
            $rules['items.*.url']         = $request->input('display_method') === 'list'
                ? 'required|url|max:2048'
                : 'nullable|url|max:2048';
        }

        // Règles par template
        $templateRules = [
            'normal_image' => [
                'normal_main_image'    => 'required|url|max:2048',
                'normal_mobile_image'  => 'required|url|max:2048',
                'normal_content_image' => 'required|url|max:2048',
            ],
            'video' => [
                'video_main_image'    => 'required|url|max:2048',
                'video_mobile_image'  => 'required|url|max:2048',
                'video_content_image' => 'required|url|max:2048',
                'video_file'          => 'required|url|max:2048',
            ],
            'podcast' => [
                'podcast_main_image'    => 'required|url|max:2048',
                'podcast_mobile_image'  => 'required|url|max:2048',
                'podcast_content_image' => 'required|url|max:2048',
                'podcast_file'          => 'required|url|max:2048',
            ],
            'album' => [
                'album_main_image'    => 'required|url|max:2048',
                'album_mobile_image'  => 'required|url|max:2048',
                'album_content_image' => 'required|url|max:2048',
            ],
            'no_image' => [
                'no_image_main_image'   => 'required|url|max:2048',
                'no_image_mobile_image' => 'required|url|max:2048',
            ],
        ];

        $isPreview = false;
        if ($request->input('status') === 'preview') {
            $request->merge(['status' => 'draft']);
            $isPreview = true;
        }
        // =========================================
        // 2) Validation
        // =========================================
        $validated = $request->validate($rules);
        $request->validate($templateRules[$request->template] ?? []);

        // album -> au moins 1 asset
        if ($request->template === 'album' && empty($albumImages)) {
            return back()
                ->withErrors(['album_assets' => 'You must provide at least one album asset URL.'])
                ->withInput();
        }



        // =========================================
        // 3) Création du contenu
        // =========================================
        $content = Content::create([
            ...$validated,
            'is_latest'  => $request->boolean('is_latest'),
            'importance' => $request->input('importance'),
            'user_id'    => \Illuminate\Support\Facades\Auth::id(),
        ]);

        if ($request->filled('review_description')) {
            \App\Models\ContentReview::create([
                'reviewer_id' => \Illuminate\Support\Facades\Auth::id(),
                'content_id'  => $content->id,
                'message'     => $request->review_description,
            ]);
        }

        // =========================================
        // 4) Items (list/file)
        // =========================================
        if (in_array($request->input('display_method'), ['list', 'file'], true) && !empty($validated['items'])) {
            foreach ($validated['items'] as $item) {
                $content->contentLists()->create([
                    'title'       => $item['title'],
                    'description' => $item['description'],
                    'url'         => $item['url'] ?? null,
                    'image'       => $item['image'] ?? null,
                    'index'       => $item['index'],
                ]);
            }
        }

        // =========================================
        // 5) Médias liés (détection type simple)
        // =========================================
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
                'album_images'        => 'album',
            ],
            'no_image' => [
                'no_image_main_image'   => 'main',
                'no_image_mobile_image' => 'mobile',
            ],
        ];

        $detectTypeFromUrl = function (string $url): string {
            $u = strtolower(parse_url($url, PHP_URL_PATH) ?? '');
            if (preg_match('/\.(jpe?g|png|gif|webp|bmp|svg)$/', $u)) return 'image';
            if (preg_match('/\.(mp4|mov|wmv|webm|m4v|m3u8)$/', $u)) return 'video';
            if (preg_match('/\.(mp3|wav|ogg|m4a|aac|flac)$/', $u)) return 'audio';
            if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) return 'youtube';
            return 'url';
        };

        $mediaMap = $templateMediaMap[$request->template] ?? null;
        if ($mediaMap) {
            foreach ($mediaMap as $field => $type) {
                if ($field !== 'album_images' && $request->filled($field)) {
                    $url       = $request->input($field);
                    $mediaType = $detectTypeFromUrl($url);

                    $existing = \App\Models\ContentMedia::where('path', $url)->first();
                    if ($existing) {
                        $content->media()->attach($existing->id, ['type' => $type]);
                    } else {
                        $media = \App\Models\ContentMedia::create([
                            'path'       => $url,
                            'media_type' => $mediaType,
                            'user_id'    => \Illuminate\Support\Facades\Auth::id(),
                            'name'       => basename(parse_url($url, PHP_URL_PATH) ?? ('url_' . \Illuminate\Support\Str::random(8))),
                            'alt'        => $content->title,
                        ]);
                        $content->media()->attach($media->id, ['type' => $type]);
                    }
                    continue;
                }

                if ($field === 'album_images' && !empty($albumImages)) {
                    foreach ($albumImages as $url) {
                        $mediaType = $detectTypeFromUrl($url);
                        $existing  = \App\Models\ContentMedia::where('path', $url)->first();

                        if ($existing) {
                            $content->media()->attach($existing->id, ['type' => $type]);
                        } else {
                            $media = \App\Models\ContentMedia::create([
                                'path'       => $url,
                                'media_type' => $mediaType,
                                'user_id'    => \Illuminate\Support\Facades\Auth::id(),
                                'name'       => basename(parse_url($url, PHP_URL_PATH) ?? ('url_' . \Illuminate\Support\Str::random(8))),
                                'alt'        => $content->title,
                            ]);
                            $content->media()->attach($media->id, ['type' => $type]);
                        }
                    }
                }
            }
        }

        // =========================================
        // 6) Tags
        // =========================================
        $content->tags()->sync($request->tags_id);

        // =========================================
        // 7) Publication / Programmation
        // =========================================
        if ($request->filled('published_at')) {
            $scheduledTime = \Carbon\Carbon::parse($request->published_at, 'Africa/Algiers');

            if ($scheduledTime->gt(now('Africa/Algiers'))) {
                $content->status       = 'scheduled';
                $content->published_at = $scheduledTime;
                $content->save();

                $delayInSeconds = now('Africa/Algiers')->diffInSeconds($scheduledTime, false);
                if ($delayInSeconds < 0) $delayInSeconds = 0;

                \App\Jobs\PublishContent::dispatch($content->id)->delay(now()->addSeconds($delayInSeconds));
            } else {
                $content->status       = 'published';
                $content->published_at = $scheduledTime;
                $content->save();
            }
        } elseif ($isPreview) {
            // On a inséré 'draft' mais on reste en parcours preview (non publié)
            $content->published_at = null;
            $content->save();

            return redirect()
                ->route('dashboard.content.edit', $content->id)
                ->with('success', 'Content created successfully in preview mode.')
                ->with('clear_local_storage', true);
        } elseif ($request->input('status') === 'draft') {
            $content->status = 'draft';
            $content->published_at = null;
            $content->save();

            return redirect()
                ->route('dashboard.contents.index')
                ->with('success', 'Content created successfully.')
                ->with('clear_local_storage', true);
        } elseif ($request->input('status') === 'published') {
            $content->status = 'published';
            $content->published_at = now('Africa/Algiers');
            $content->save();

            return redirect()
                ->route('dashboard.contents.index')
                ->with('success', 'Content created successfully.')
                ->with('clear_local_storage', true);
        }

        // fallback
        return redirect()
            ->back()
            ->with('success', 'Content created successfully.')
            ->with('clear_local_storage', true);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id) {}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $content = Content::with([
            'section',
            'category',
            'country',
            'continent',
            'trend',
            'window',
            'writer',
            'city',
            'tags',
            'contentLists',
            'media'
        ])->findOrFail($id);

        // Get all relationships for dropdowns
        $sections = Section::all();
        $categories = Category::all();
        $countries = Location::where('type', 'country')->get();
        $continents = Location::where('type', 'continent')->get();
        $cities = Location::where('type', 'city')->get();
        $trends = Trend::all();
        $windows = Window::all();
        $writers = Writer::all();
        $tags = Tag::all();

        // Get selected tag IDs for the multi-select
        $selectedTagIds = $content->tags->pluck('id')->toArray();

        // Get existing media for the media tab - convert to array if needed
        $existing_images = $content->media()->whereIn('media_type', ['image'])->get()->toArray();
        $existing_videos = $content->media()->whereIn('media_type', ['video', 'youtube'])->get()->toArray();
        $existing_podcasts = $content->media()->whereIn('media_type', ['audio'])->get()->toArray();
        $existing_albums = $content->media()->where('type', 'album')->get()->toArray();

        // Get content lists items if display_method is list/file
        $contentItems = [];
        if (in_array($content->display_method, ['list', 'file'])) {
            $contentItems = $content->contentLists()->orderBy('index')->get()->toArray();
        }


        // Get review description if exists
        $reviewDescription = '';
        $review = \App\Models\ContentReview::where('content_id', $content->id)->first();
        if ($review) {
            $reviewDescription = $review->message;
        }

        // Get template-specific media URLs
        $templateMedia = [];
        $mediaTypes = ['main', 'mobile', 'detail', 'video', 'podcast', 'album'];

        foreach ($mediaTypes as $type) {
            $media = $content->media()->wherePivot('type', $type)->first();
            if ($media) {
                $templateMedia[$type] = $media->path;
            }
        }

        // Map template fields based on current template
        $templateFields = [];
        switch ($content->template) {
            case 'normal_image':
                $templateFields = [
                    'normal_main_image' => $templateMedia['main'] ?? '',
                    'normal_mobile_image' => $templateMedia['mobile'] ?? '',
                    'normal_content_image' => $templateMedia['detail'] ?? '',
                ];
                break;
            case 'video':
                $templateFields = [
                    'video_main_image' => $templateMedia['main'] ?? '',
                    'video_mobile_image' => $templateMedia['mobile'] ?? '',
                    'video_content_image' => $templateMedia['detail'] ?? '',
                    'video_file' => $templateMedia['video'] ?? '',
                ];
                break;
            case 'podcast':
                $templateFields = [
                    'podcast_main_image' => $templateMedia['main'] ?? '',
                    'podcast_mobile_image' => $templateMedia['mobile'] ?? '',
                    'podcast_content_image' => $templateMedia['detail'] ?? '',
                    'podcast_file' => $templateMedia['podcast'] ?? '',
                ];
                break;
            case 'album':
                // Convert album assets collection to array
                $albumAssets = $content->media()->wherePivot('type', 'album')->get();
                $albumAssetsArray = [];
                foreach ($albumAssets as $media) {
                    $albumAssetsArray[] = [
                        'url' => $media->path,
                        'title' => $media->name,
                        'alt' => $media->alt
                    ];
                }

                $templateFields = [
                    'album_main_image' => $templateMedia['main'] ?? '',
                    'album_mobile_image' => $templateMedia['mobile'] ?? '',
                    'album_content_image' => $templateMedia['detail'] ?? '',
                    'album_assets' => $albumAssetsArray,
                ];
                break;
            case 'no_image':
                $templateFields = [
                    'no_image_main_image' => $templateMedia['main'] ?? '',
                    'no_image_mobile_image' => $templateMedia['mobile'] ?? '',
                ];
                break;
        }

        return view('dashboard.editcontent', compact(
            'content',
            'sections',
            'categories',
            'countries',
            'continents',
            'cities',
            'trends',
            'windows',
            'writers',
            'tags',
            'selectedTagIds',
            'existing_images',
            'existing_videos',
            'existing_podcasts',
            'existing_albums',
            'contentItems',
            'reviewDescription',
            'templateFields'
        ));
    }



    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Find the content to update
        $content = \App\Models\Content::findOrFail($id);

        // ========= 0) Normalisation des URLs AVANT la validation =========
        $toAbsoluteUrl = function (?string $v): ?string {
            if (!is_string($v)) return null;
            $v = trim($v);
            if ($v === '') return null;

            if (\Illuminate\Support\Str::startsWith($v, ['http://', 'https://'])) {
                return $v;
            }

            // Chemins locaux fréquents -> asset()
            if (\Illuminate\Support\Str::startsWith($v, ['/storage', 'storage/', '/uploads', 'uploads/', 'public/'])) {
                $v = ltrim($v, '/'); // éviter //storage
                return asset($v);
            }

            // Autres relatifs -> url()
            return url($v);
        };

        // Normaliser share_image
        if ($request->filled('share_image')) {
            $request->merge([
                'share_image' => $toAbsoluteUrl($request->input('share_image')),
            ]);
        }

        // ========= 0bis) Harmoniser items[*] (supporte media_url -> image) =========
        $albumImages = [];
        if (is_array($request->input('items'))) {
            $items = $request->input('items');

            foreach ($items as $i => $item) {
                // 1) Si le front a envoyé media_url mais pas image -> on bascule vers image pour la validation
                if (!isset($item['image']) && !empty($item['media_url'])) {
                    $item['image'] = $item['media_url'];
                }

                // 2) Normaliser image
                if (isset($item['image']) && $item['image'] !== '') {
                    $item['image'] = $toAbsoluteUrl($item['image']);
                }

                // 3) Normaliser url (facultatif en "file", requis en "list")
                if (isset($item['url']) && $item['url'] !== '') {
                    $item['url'] = $toAbsoluteUrl($item['url']);
                } else {
                    $item['url'] = null;
                }

                $items[$i] = $item;
            }

            $request->merge(['items' => $items]);
        }

        // ========= 0ter) Normaliser les champs template potentiels (tous en URL) =========
        $templateUrlFields = [
            // normal_image
            'normal_main_image',
            'normal_mobile_image',
            'normal_content_image',
            // video
            'video_main_image',
            'video_mobile_image',
            'video_content_image',
            'video_file',
            // podcast
            'podcast_main_image',
            'podcast_mobile_image',
            'podcast_content_image',
            'podcast_file',
            // album
            'album_main_image',
            'album_mobile_image',
            'album_content_image',
            // no_image
            'no_image_main_image',
            'no_image_mobile_image',
        ];
        foreach ($templateUrlFields as $f) {
            if ($request->filled($f)) {
                $request->merge([$f => $toAbsoluteUrl($request->input($f))]);
            }
        }

        // Normaliser album_assets[].url si présent
        if ($request->album_assets && is_array($request->album_assets)) {
            $norm = [];
            foreach ($request->album_assets as $asset) {
                $url = isset($asset['url']) ? $toAbsoluteUrl($asset['url']) : null;
                if ($url) {
                    $norm[] = [
                        'url'   => $url,
                        'title' => $asset['title'] ?? null,
                        'alt'   => $asset['alt'] ?? null
                    ];
                    $albumImages[] = $url;
                }
            }
            $request->merge(['album_assets' => $norm]);
        }

        // ========= 0quater) Rétrograder display_method si items manquants =========
        $incomingDisplay = $request->input('display_method');
        if (in_array($incomingDisplay, ['list', 'file'], true)) {
            $incomingItems = $request->input('items');
            if (empty($incomingItems) || !is_array($incomingItems)) {
                $request->merge(['display_method' => 'simple']);
            }
        }

        // ========= 1) Règles de validation =========
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
            'status'              => 'nullable|in:published,draft,scheduled,preview',
            'is_latest'           => 'nullable|boolean',
            'importance'          => 'nullable|integer|min:0|max:10',
        ];

        // Mode preview spécial 
        $preview = false;
        if ($request->input('status') === 'preview') {
            $request->merge(['status' => 'draft']);
            $preview = true;
        }

        // items pour display_method list/file (URLs, pas fichiers)
        if (in_array($request->input('display_method'), ['list', 'file'], true)) {
            $rules['items']               = 'required|array|min:1';
            $rules['items.*.title']       = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.image']       = 'required|url|max:2048';
            $rules['items.*.index']       = 'required|integer';
            $rules['items.*.url']         = $request->input('display_method') === 'list'
                ? 'required|url|max:2048'
                : 'nullable|url|max:2048';
        }

        // Règles par template
        $templateRules = [
            'normal_image' => [
                'normal_main_image'    => 'required|url|max:2048',
                'normal_mobile_image'  => 'required|url|max:2048',
                'normal_content_image' => 'required|url|max:2048',
            ],
            'video' => [
                'video_main_image'    => 'required|url|max:2048',
                'video_mobile_image'  => 'required|url|max:2048',
                'video_content_image' => 'required|url|max:2048',
                'video_file'          => 'required|url|max:2048',
            ],
            'podcast' => [
                'podcast_main_image'    => 'required|url|max:2048',
                'podcast_content_image' => 'required|url|max:2048',
                'podcast_mobile_image'  => 'required|url|max:2048',
                'podcast_file'          => 'required|url|max:2048',
            ],
            'album' => [
                'album_main_image'    => 'required|url|max:2048',
                'album_content_image' => 'required|url|max:2048',
                'album_mobile_image'  => 'required|url|max:2048',
            ],
            'no_image' => [
                'no_image_main_image'   => 'required|url|max:2048',
                'no_image_mobile_image' => 'required|url|max:2048',
            ],
        ];

        // ========= 2) Validation =========
        $validated = $request->validate($rules);
        $request->validate($templateRules[$request->template] ?? []);

        // album: au moins un asset
        if ($request->template === 'album' && empty($albumImages)) {
            return back()
                ->withErrors(['album_assets' => 'You must provide at least one album asset URL.'])
                ->withInput();
        }

        // ========= 3) Mise à jour du contenu =========
        $content->update([
            ...$validated,
            'is_latest'  => $request->boolean('is_latest'),
            'importance' => $request->input('importance'),
            // Note: user_id n'est pas mis à jour lors de l'édition
        ]);

        // ========= 4) Gestion de la revue =========
        if ($request->filled('review_description')) {
            // Mettre à jour ou créer la revue
            $review = \App\Models\ContentReview::where('content_id', $content->id)->first();
            if ($review) {
                $review->update([
                    'reviewer_id' => \Illuminate\Support\Facades\Auth::id(),
                    'message'     => $request->review_description,
                ]);
            } else {
                \App\Models\ContentReview::create([
                    'reviewer_id' => \Illuminate\Support\Facades\Auth::id(),
                    'content_id'  => $content->id,
                    'message'     => $request->review_description,
                ]);
            }
        } else {
            // Supprimer la revue si elle existe et que le champ est vide
            \App\Models\ContentReview::where('content_id', $content->id)->delete();
        }

        // ========= 5) Items (list/file) - Sync au lieu de create =========
        if (in_array($request->input('display_method'), ['list', 'file'], true) && !empty($validated['items'])) {
            // Supprimer les anciens items
            $content->contentLists()->delete();

            // Créer les nouveaux items
            foreach ($validated['items'] as $item) {
                $content->contentLists()->create([
                    'title'       => $item['title'],
                    'description' => $item['description'],
                    'url'         => $item['url'] ?? null,
                    'image'       => $item['image'] ?? null,
                    'index'       => $item['index'],
                ]);
            }
        } else {
            // Si on passe de list/file à simple, supprimer les items
            $content->contentLists()->delete();
        }

        // ========= 6) Sync des tags =========
        $content->tags()->sync($request->tags_id);

        // ========= 7) Gestion des médias liés =========
        $detectTypeFromUrl = function (string $url): string {
            $u = strtolower(parse_url($url, PHP_URL_PATH) ?? '');
            if (preg_match('/\.(jpe?g|png|gif|webp|bmp|svg)$/', $u)) return 'image';
            if (preg_match('/\.(mp4|mov|wmv|webm|m4v|m3u8)$/', $u)) return 'video';
            if (preg_match('/\.(mp3|wav|ogg|m4a|aac|flac)$/', $u)) return 'audio';
            if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) return 'youtube';
            return 'url';
        };

        // Template media mapping
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
                'album_images'        => 'album',
            ],
            'no_image' => [
                'no_image_main_image'   => 'main',
                'no_image_mobile_image' => 'mobile',
            ],
        ];

        // Détacher tous les médias existants pour ce contenu
        $content->media()->detach();

        // Attacher les nouveaux médias
        $mediaMap = $templateMediaMap[$request->template] ?? null;
        if ($mediaMap) {
            foreach ($mediaMap as $field => $type) {
                if ($field !== 'album_images' && $request->filled($field)) {
                    $url       = $request->input($field);
                    $mediaType = $detectTypeFromUrl($url);

                    $existing = \App\Models\ContentMedia::where('path', $url)->first();
                    if ($existing) {
                        $content->media()->attach($existing->id, ['type' => $type]);
                    } else {
                        $media = \App\Models\ContentMedia::create([
                            'path'       => $url,
                            'media_type' => $mediaType,
                            'user_id'    => \Illuminate\Support\Facades\Auth::id(),
                            'name'       => basename(parse_url($url, PHP_URL_PATH) ?? ('url_' . \Illuminate\Support\Str::random(8))),
                            'alt'        => $content->title,
                        ]);
                        $content->media()->attach($media->id, ['type' => $type]);
                    }
                    continue;
                }

                if ($field === 'album_images' && !empty($albumImages)) {
                    foreach ($albumImages as $url) {
                        $mediaType = $detectTypeFromUrl($url);
                        $existing  = \App\Models\ContentMedia::where('path', $url)->first();

                        if ($existing) {
                            $content->media()->attach($existing->id, ['type' => $type]);
                        } else {
                            $media = \App\Models\ContentMedia::create([
                                'path'       => $url,
                                'media_type' => $mediaType,
                                'user_id'    => \Illuminate\Support\Facades\Auth::id(),
                                'name'       => basename(parse_url($url, PHP_URL_PATH) ?? ('url_' . \Illuminate\Support\Str::random(8))),
                                'alt'        => $content->title,
                            ]);
                            $content->media()->attach($media->id, ['type' => $type]);
                        }
                    }
                }
            }
        }

        // ========= 8) Publication / Programmation =========
        if ($request->filled('published_at')) {
            $scheduledTime = \Carbon\Carbon::parse($request->published_at, 'Africa/Algiers');

            if ($scheduledTime->gt(now('Africa/Algiers'))) {
                $content->status       = 'scheduled';
                $content->published_at = $scheduledTime;
                $content->save();

                $delayInSeconds = now('Africa/Algiers')->diffInSeconds($scheduledTime, false);
                if ($delayInSeconds < 0) $delayInSeconds = 0;

                \App\Jobs\PublishContent::dispatch($content->id)->delay(now()->addSeconds($delayInSeconds));
            } else {
                $content->status       = 'published';
                $content->published_at = $scheduledTime;
                $content->save();
            }
        } elseif ($request->filled('status') && $request->status === 'draft' && $preview === false) {
            $content->status = 'draft';
            $content->published_at = null;
            $content->save();
            return redirect()
                ->route('dashboard.contents.index')
                ->with('success', 'Content updated successfully.')
                ->with('clear_local_storage', true);
        } elseif ($request->filled('status') && $request->status === 'published') {
            $content->status = 'published';
            $content->published_at = now();
            $content->save();
            return redirect()
                ->route('dashboard.contents.index')
                ->with('success', 'Content updated successfully.')
                ->with('clear_local_storage', true);
        } elseif ($request->filled('status') && $preview === true) {
            $content->published_at = null;
            $content->save();

            return redirect()
                ->route('dashboard.content.edit', $content->id)
                ->with('success', 'Content updated successfully in preview mode.')
                ->with('clear_local_storage', true);
        }

        return redirect()
            ->route('dashboard.content.edit', $content->id)
            ->with('success', 'Content updated successfully.')
            ->with('clear_local_storage', true);
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
