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
use Illuminate\Http\JsonResponse;


class ContentController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check:content_access']);
    }

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
            // REMOVED: 'writer_id'           => 'nullable|exists:writers,id',
            'city_id'             => 'nullable|exists:locations,id',
            'summary'             => 'nullable|string',
            'content'             => 'nullable|string',
            'seo_keyword'         => 'nullable|string|max:255',
            'template'            => 'required|string|in:normal_image,video,podcast,album,no_image',
            'tags_id'             => 'required|array',
            'tags_id.*'           => 'integer|exists:tags,id',
            'writers'             => 'nullable|array', // NEW: for many-to-many writers
            'writers.*.id'        => 'nullable|integer|exists:writers,id', // NEW
            'writers.*.role'      => 'nullable|string|max:255', // NEW
            'share_image'         => 'nullable|url|max:2048',
            'share_title'         => 'nullable|string',
            'share_description'   => 'nullable|string',
            'review_description'  => 'nullable|string',
            'created_at'          => 'nullable|date',
            'caption'             => 'required|string|max:255',

            // Programmation
            'published_at'        => 'nullable|date',
            'status'              => 'nullable|in:published,draft,scheduled,preview',
            'is_latest'           => 'nullable|boolean',
            'importance'          => 'nullable|integer|min:0|max:10',
        ];

        // Si list/file -> items requis
        if (in_array($request->input('display_method'), ['list', 'file'], true)) {
            $rules['items']               = 'required|array|min:1';
            $rules['items.*.title']       = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.writer']      = 'nullable|string|max:255';
            $rules['items.*.image']       = 'required|url|max:2048';
            $rules['items.*.index']       = 'required|integer|min:1';
            $rules['items.*.url']         = $request->input('display_method') === 'list'
                ? 'nullable|url|max:2048'
                : 'required|url|max:2048';
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
            'user_id'    => Auth::id(),
        ]);

        if ($request->filled('review_description')) {
            \App\Models\ContentReview::create([
                'reviewer_id' => Auth::id(),
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
                    'writer'      => $item['writer'] ?? null,
                    'url'         => $item['url'] ?? null,
                    'image'       => $item['image'] ?? null,
                    'index'       => $item['index'],
                ]);
            }
        }

        // =========================================
        // 5) Writers (many-to-many relationship) - NEW SECTION
        // =========================================
        if ($request->filled('writers') && is_array($request->writers)) {
            $writersData = [];
            foreach ($request->writers as $writer) {
                if (!empty($writer['id'])) {
                    $writersData[$writer['id']] = ['role' => $writer['role'] ?? null];
                }
            }
            $content->writers()->sync($writersData);
        }

        // =========================================
        // 6) Médias liés (détection type simple)
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
        // 7) Tags
        // =========================================
        $content->tags()->sync($request->tags_id);

        // =========================================
        // 8) Publication / Programmation
        // =========================================

        if ($isPreview === true) {
            $content->status = 'draft';
            $content->published_at = null;
            $content->save();
            return redirect()
                ->route('dashboard.content.edit', ['id' => $content->id])
                ->with('success');
        } elseif ($request->input('status') === 'draft') {
            // Draft: no publication, clear published_at
            $content->status = 'draft';
            $content->published_at = null;
            $content->save();
        } elseif ($request->input('status') === 'published') {
            // Check if scheduled publish time is provided
            if ($request->filled('published_at')) {
                $scheduledTime = \Carbon\Carbon::parse($request->published_at, 'Africa/Algiers');

                if ($scheduledTime->gt(now('Africa/Algiers'))) {
                    // Future time: schedule for later
                    $content->status       = 'scheduled';
                    $content->published_at = $scheduledTime;
                    $content->save();

                    $delayInSeconds = now('Africa/Algiers')->diffInSeconds($scheduledTime, false);
                    if ($delayInSeconds < 0) $delayInSeconds = 0;

                    \App\Jobs\PublishContent::dispatch($content->id)->delay(now()->addSeconds($delayInSeconds));
                } else {
                    // Past time: publish immediately with that timestamp
                    $content->status       = 'published';
                    $content->published_at = $scheduledTime;
                    $content->save();
                }
            } else {
                // No scheduled time: publish immediately with current time
                $content->status       = 'published';
                $content->published_at = now('Africa/Algiers');
                $content->save();
            }
        }

        return redirect()
            ->route('dashboard.contents.index')
            ->with('success', 'Content created successfully.')
            ->with('clear_local_storage', true);
    }

    public function edit(string $id)
    {
        // ===== 1) Chargement du contenu + relations nécessaires =====
        $content = Content::with([
            'section:id,name',
            'category:id,name',
            'country:id,name',
            'continent:id,name',
            'trend:id,title',
            'window:id,name',
            'writer:id,name',
            'city:id,name',
            'tags:id,name',
            'contentLists' => function ($q) {
                $q->orderBy('index')->with('writer:id,name'); // Added writer relationship
            },
        ])->findOrFail($id);

        // ===== 2) Données pour les <select> (objets avec id/name|title) =====
        $sections   = Section::orderBy('name')->get(['id', 'name']);
        $categories = Category::orderBy('name')->get(['id', 'name']);
        $countries  = Location::where('type', 'country')->orderBy('name')->get(['id', 'name']);
        $continents = Location::where('type', 'continent')->orderBy('name')->get(['id', 'name']);
        $cities     = Location::where('type', 'city')->orderBy('name')->get(['id', 'name']);
        $trends     = Trend::orderBy('title')->get(['id', 'title']); // title ici
        $windows    = Window::orderBy('name')->get(['id', 'name']);  // name ici
        $writers    = Writer::orderBy('name')->get(['id', 'name']);
        $tags       = Tag::orderBy('name')->get(['id', 'name']);

        // Tags sélectionnés
        $selectedTagIds = $content->tags->pluck('id')->all();

        // ===== 3) Médias existants (préfixés avec la vraie table) =====
        $mediaTable = $content->media()->getRelated()->getTable(); // ex. 'content_media'

        $existing_images = $content->media()
            ->where($mediaTable . '.media_type', 'image')
            ->get([
                $mediaTable . '.id',
                $mediaTable . '.name',
                $mediaTable . '.alt',
                $mediaTable . '.path',
                $mediaTable . '.media_type',
            ])->toArray();

        $existing_videos = $content->media()
            ->whereIn($mediaTable . '.media_type', ['video', 'youtube'])
            ->get([
                $mediaTable . '.id',
                $mediaTable . '.name',
                $mediaTable . '.alt',
                $mediaTable . '.path',
                $mediaTable . '.media_type',
            ])->toArray();

        $existing_podcasts = $content->media()
            ->where($mediaTable . '.media_type', 'audio')
            ->get([
                $mediaTable . '.id',
                $mediaTable . '.name',
                $mediaTable . '.alt',
                $mediaTable . '.path',
                $mediaTable . '.media_type',
            ])->toArray();

        $existing_albums = $content->media()
            ->wherePivot('type', 'album')
            ->get([
                $mediaTable . '.id',
                $mediaTable . '.name',
                $mediaTable . '.alt',
                $mediaTable . '.path',
                $mediaTable . '.media_type',
            ])->toArray();

        // ===== 4) Items (list/file) - FIXED: Include writer name =====
        $contentItems = [];
        if (in_array($content->display_method, ['list', 'file'], true)) {
            $contentItems = $content->contentLists->map(function ($item) {
                return [
                    'title' => $item->title,
                    'description' => $item->description,
                    'image' => $item->image,
                    'url' => $item->url,
                    'media_id' => $item->media_id,
                    'media_title' => $item->media_title,
                    'media_alt' => $item->media_alt,
                    'writer_name' => $item->writer ?? '', // Added writer name
                ];
            })->toArray();
        }

        // ===== 5) Review existant =====
        $reviewDescription = optional(
            \App\Models\ContentReview::where('content_id', $content->id)->first()
        )->message ?? '';

        // ===== 6) Médias "template" via le pivot =====
        $pivotMedias = $content->media()
            ->withPivot('type') // {main, mobile, detail, video, podcast, album}
            ->get([
                $mediaTable . '.id',
                $mediaTable . '.name',
                $mediaTable . '.alt',
                $mediaTable . '.path',
            ])->groupBy(fn($m) => $m->pivot->type);

        $getPath = function (string $type) use ($pivotMedias): string {
            $m = $pivotMedias->get($type)?->first();
            return $m?->path ?? '';
        };

        $albumAssetsArray = [];
        if ($pivotMedias->has('album')) {
            foreach ($pivotMedias->get('album') as $m) {
                $albumAssetsArray[] = [
                    'url'   => $m->path,
                    'title' => $m->name,
                    'alt'   => $m->alt,
                ];
            }
        }

        // ===== 7) Champs mappés par template =====
        $templateFields = [];
        switch ($content->template) {
            case 'normal_image':
                $templateFields = [
                    'normal_main_image'    => $getPath('main'),
                    'normal_mobile_image'  => $getPath('mobile'),
                    'normal_content_image' => $getPath('detail'),
                ];
                break;

            case 'video':
                $templateFields = [
                    'video_main_image'    => $getPath('main'),
                    'video_mobile_image'  => $getPath('mobile'),
                    'video_content_image' => $getPath('detail'),
                    'video_file'          => $getPath('video'),
                ];
                break;

            case 'podcast':
                $templateFields = [
                    'podcast_main_image'    => $getPath('main'),
                    'podcast_mobile_image'  => $getPath('mobile'),
                    'podcast_content_image' => $getPath('detail'),
                    'podcast_file'          => $getPath('podcast'),
                ];
                break;

            case 'album':
                $templateFields = [
                    'album_main_image'    => $getPath('main'),
                    'album_mobile_image'  => $getPath('mobile'),
                    'album_content_image' => $getPath('detail'),
                    'album_assets'        => $albumAssetsArray,
                ];
                break;

            case 'no_image':
                $templateFields = [
                    'no_image_main_image'   => $getPath('main'),
                    'no_image_mobile_image' => $getPath('mobile'),
                ];
                break;

            default:
                $templateFields = [];
        }

        // ===== 8) Vue =====
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

    public function update(Request $request, $id)
    {
        // Find the content to update
        $content = \App\Models\Content::findOrFail($id);

        // ========= 0) Normalisation helpers =========
        $toAbsoluteUrl = function (?string $v): ?string {
            if (!is_string($v)) return null;
            $v = trim($v);
            if ($v === '') return null;

            // Keep absolute as-is
            if (\Illuminate\Support\Str::startsWith($v, ['http://', 'https://'])) {
                return $v;
            }

            // Common local paths -> asset()
            if (\Illuminate\Support\Str::startsWith($v, ['/storage', 'storage/', '/uploads', 'uploads/', 'public/'])) {
                $v = ltrim($v, '/'); // avoid //storage
                return asset($v);
            }

            // Fallback for other relatives
            return url($v);
        };

        // ========= 0.a) Social Media bridge (accept both share_image_url & share_image) =========
        $incomingShare = $request->input('share_image') ?: $request->input('share_image_url');
        if ($incomingShare !== null && $incomingShare !== '') {
            $request->merge([
                'share_image' => $toAbsoluteUrl($incomingShare),
            ]);
        } else {
            $request->merge(['share_image' => null]);
        }

        // ========= 0.b) Harmoniser items[*] (support media_url -> image) =========
        $albumImages = [];

        // FIXED: Handle items data properly - check both JSON string and array formats
        $itemsData = $request->input('items');

        if (is_string($itemsData)) {
            // If items is a JSON string, decode it
            $decodedItems = json_decode($itemsData, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedItems)) {
                $itemsData = $decodedItems;
            }
        }

        if (is_array($itemsData)) {
            $items = $itemsData;

            foreach ($items as $i => $item) {
                // 1) media_url -> image (front compatibility)
                if (!isset($item['image']) && !empty($item['media_url'])) {
                    $item['image'] = $item['media_url'];
                }

                // 2) Normaliser image
                if (isset($item['image']) && $item['image'] !== '') {
                    $item['image'] = $toAbsoluteUrl($item['image']);
                }

                // 3) Normaliser url (optional for "file", required for "list")
                if (isset($item['url']) && $item['url'] !== '') {
                    $item['url'] = $toAbsoluteUrl($item['url']);
                } else {
                    $item['url'] = null;
                }

                // 4) Ensure index is set
                if (!isset($item['index'])) {
                    $item['index'] = $i;
                }

                // 5) FIXED: Handle writer_name -> writer (frontend sends writer_name)
                if (isset($item['writer_name'])) {
                    $item['writer'] = $item['writer_name'];
                } elseif (isset($item['writer'])) {
                    $item['writer'] = $item['writer'];
                } else {
                    $item['writer'] = null;
                }

                $items[$i] = $item;
            }

            $request->merge(['items' => $items]);
        } else {
            // If no valid items data, set empty array
            $request->merge(['items' => []]);
        }

        // ========= 0.c) Normaliser les champs template potentiels (tous en URL) =========
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

        // ========= 0.d) Rétrograder display_method si items manquants =========
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
            // REMOVED: 'writer_id'           => 'nullable|exists:writers,id',
            'city_id'             => 'nullable|exists:locations,id',
            'summary'             => 'nullable|string',
            'content'             => 'nullable|string',
            'seo_keyword'         => 'nullable|string|max:255',
            'template'            => 'required|string|in:normal_image,video,podcast,album,no_image',
            'caption'             => 'required|string|max:255',

            // Tags (allow empty array -> sync([]))
            'tags_id'   => 'nullable|array',
            'tags_id.*' => 'integer|exists:tags,id',

            // Writers (many-to-many relationship) - NEW
            'writers'             => 'nullable|array',
            'writers.*.id'        => 'nullable|integer|exists:writers,id',
            'writers.*.role'      => 'nullable|string|max:255',

            // ---- Social Media fields ----
            'share_image'        => 'nullable|url|max:2048',
            'share_title'        => 'nullable|string|max:100',
            'share_description'  => 'nullable|string|max:260',

            'review_description'  => 'nullable|string',
            'created_at'          => 'nullable|date',

            // Programmation
            'published_at'        => 'nullable|date',
            'status'              => 'nullable|in:published,draft,scheduled',
            'is_latest'           => 'nullable|boolean',
            'importance'          => 'nullable|integer|min:0|max:10',
        ];

        // items pour display_method list/file (URLs, pas fichiers)
        if (in_array($request->input('display_method'), ['list', 'file'], true)) {
            $rules['items']               = 'required|array|min:1';
            $rules['items.*.title']       = 'required|string|max:255';
            $rules['items.*.description'] = 'required|string';
            $rules['items.*.image']       = 'required|url|max:2048';
            // FIXED: Update validation rule for writer
            $rules['items.*.writer']      = 'nullable|string|max:255';
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

        // ========= 3) Transaction pour cohérence (update + lists + media + tags) =========
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // Mise à jour du contenu (inclut les champs Social Media)
            $content->update([
                ...$validated,
                'is_latest'  => $request->boolean('is_latest'),
                'importance' => $request->input('importance'),
                // user_id not updated on edit
            ]);

            // ========= 4) Gestion de la revue =========
            if ($request->filled('review_description')) {
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
                \App\Models\ContentReview::where('content_id', $content->id)->delete();
            }

            // ========= 5) Writers (many-to-many relationship) - NEW SECTION =========
            if ($request->filled('writers') && is_array($request->writers)) {
                $writersData = [];
                foreach ($request->writers as $writer) {
                    if (!empty($writer['id'])) {
                        $writersData[$writer['id']] = ['role' => $writer['role'] ?? null];
                    }
                }
                $content->writers()->sync($writersData);
            } else {
                // If no writers provided, detach all
                $content->writers()->sync([]);
            }

            // ========= 6) Items (list/file) - Sync au lieu de create =========
            if (in_array($request->input('display_method'), ['list', 'file'], true) && !empty($validated['items'])) {
                $content->contentLists()->delete();
                foreach ($validated['items'] as $item) {
                    $content->contentLists()->create([
                        'title'       => $item['title'],
                        'description' => $item['description'],
                        'url'         => $item['url'] ?? null,
                        // FIXED: Use writer field (already mapped from writer_name in normalization step)
                        'writer'      => $item['writer'] ?? null,
                        'image'       => $item['image'] ?? null,
                        'index'       => $item['index'],
                    ]);
                }
            } else {
                // Si on passe de list/file à simple, supprimer les items
                $content->contentLists()->delete();
            }

            // ========= 7) Sync des tags (supporter null -> vider) =========
            $content->tags()->sync($request->input('tags_id', []));

            // ========= 8) Gestion des médias liés =========
            $detectTypeFromUrl = function (string $url): string {
                $u = strtolower(parse_url($url, PHP_URL_PATH) ?? '');
                if (preg_match('/\.(jpe?g|png|gif|webp|bmp|svg)$/', $u)) return 'image';
                if (preg_match('/\.(mp4|mov|wmv|webm|m4v|m3u8)$/', $u)) return 'video';
                if (preg_match('/\.(mp3|wav|ogg|m4a|aac|flac)$/', $u)) return 'audio';
                if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) return 'youtube';
                return 'url';
            };

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

            // Détacher tous les médias existants
            $content->media()->detach();

            // Attacher les nouveaux
            $mediaMap = $templateMediaMap[$request->template] ?? null;
            if ($mediaMap) {
                foreach ($mediaMap as $field => $type) {
                    // Champs unitaires
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

                    // Album assets
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

            if ($request->input('status') === 'draft') {
                // Draft: no publication, clear published_at
                // Also delete any pending scheduled jobs
                \Illuminate\Support\Facades\DB::table('jobs')
                    ->where('payload', 'LIKE', '%"contentId":' . $content->id . '%')
                    ->delete();

                $content->status = 'draft';
                $content->published_at = null;
                $content->update();
            } elseif (in_array($request->input('status'), ['published', 'scheduled'], true)) {
                // ========= 9) Publication / Re-Scheduling Logic =========
                // Always re-evaluate the desired published_at when user submits publish/schedule.
                $newPublishedAtProvided = $request->filled('published_at');
                $prevPublishedAt        = $content->published_at ? \Carbon\Carbon::parse($content->published_at, 'Africa/Algiers') : null;

                if ($newPublishedAtProvided) {
                    $scheduledTime = \Carbon\Carbon::parse($request->published_at, 'Africa/Algiers');
                    if ($scheduledTime->gt(now('Africa/Algiers'))) {
                        // Future time -> schedule (or reschedule) job
                        // Delete any existing scheduled job for this content
                        \Illuminate\Support\Facades\DB::table('jobs')
                            ->where('payload', 'LIKE', '%"contentId":' . $content->id . '%')
                            ->delete();

                        // If date changed OR status changed, we re-dispatch
                        $content->status       = 'scheduled';
                        $content->published_at = $scheduledTime;
                        $content->update();

                        $delayInSeconds = now('Africa/Algiers')->diffInSeconds($scheduledTime, false);
                        if ($delayInSeconds < 0) $delayInSeconds = 0;

                        \App\Jobs\PublishContent::dispatch($content->id)->delay(now()->addSeconds($delayInSeconds));
                    } else {
                        // Past or present -> publish immediately with provided timestamp
                        \Illuminate\Support\Facades\DB::table('jobs')
                            ->where('payload', 'LIKE', '%"contentId":' . $content->id . '%')
                            ->delete();

                        $content->status       = 'published';
                        $content->published_at = $scheduledTime; // keep chosen past datetime
                        $content->update();
                    }
                } else {
                    // No date provided -> immediate publish now (even if user clicked schedule)
                    \Illuminate\Support\Facades\DB::table('jobs')
                        ->where('payload', 'LIKE', '%"contentId":' . $content->id . '%')
                        ->delete();

                    $content->status       = 'published';
                    $content->published_at = now('Africa/Algiers');
                    $content->update();
                }
            } else {
                // Preserve status and published_at if already set
                $content->update();
            }



            \Illuminate\Support\Facades\DB::commit();

            return redirect()
                ->route('dashboard.content.edit', $content->id)
                ->with('success');
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            report($e);

            return back()
                ->withErrors(['general' => 'An unexpected error occurred while updating the content.'])
                ->withInput();
        }
    }

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

    public function readmore(Request $request): JsonResponse
    {
        try {
            $search = $request->get('search', '');

            // Query published content with media relationship eager loaded
            $query = Content::where('status', 'published')
                ->with(['media' => function ($q) {
                    $q->wherePivot('type', 'main');
                }]);

            // Select only needed columns
            $query->select([
                'id',
                'title',
                'summary',
                'created_at'
            ]);

            // Add search filter if provided
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('summary', 'LIKE', '%' . $search . '%');
                });
            }

            // Get results
            $results = $query->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();

            // Map to expected format
            $content = $results->map(function ($item) {
                // Get main image from media relationship
                $mainImage = $item->media()
                    ->wherePivot('type', 'main')
                    ->first();

                // Build content URL
                $contentUrl = url('/content/' . $item->id);

                return [
                    'id' => $item->id,
                    'title' => $item->title ?? 'Untitled',
                    'image_url' => $mainImage ? $this->getFullImageUrl($mainImage->path) : null,
                    'summary' => $this->truncateSummary($item->summary),
                    'link' => $contentUrl,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            })->toArray();

            return response()->json([
                'success' => true,
                'data' => $content,
                'message' => 'Content fetched successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Failed to fetch content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate full URL for images
     * Handles both absolute URLs and relative storage paths
     */
    private function getFullImageUrl(?string $imageUrl): ?string
    {
        if (!$imageUrl) {
            return null;
        }

        // Already a full URL - return as is
        if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            return $imageUrl;
        }

        // Storage path starting with 'storage/'
        if (strpos($imageUrl, 'storage/') === 0) {
            return asset($imageUrl);
        }

        // Storage path starting with '/storage/'
        if (strpos($imageUrl, '/storage/') === 0) {
            return asset(ltrim($imageUrl, '/'));
        }

        // Fallback - prepend storage path
        return asset('storage/' . ltrim($imageUrl, '/'));
    }

    /**
     * Truncate summary to reasonable length
     */
    private function truncateSummary(?string $summary): string
    {
        if (!$summary) {
            return 'No summary available';
        }

        if (strlen($summary) > 150) {
            return substr($summary, 0, 147) . '...';
        }

        return $summary;
    }
}
