<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Section;
use App\Models\BreakingContent;
use App\Models\PrincipalTrend;
use App\Models\TopContent;
use App\Models\Window;
use App\Models\WindowManagement;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\Writer;
use App\Models\Tag;
use App\Models\Trend;
use Illuminate\Support\Facades\Cache;
use App\Services\ContentService;

class HomePageController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = collect();

        if ($query) {
            $results = Content::where('status', 'published')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                      ->orWhere('summary', 'like', '%' . $query . '%');
                })
                ->orderByDesc('published_date')
                ->take(20)
                ->get();
        }

        return view('user.search', compact('query', 'results'));
    }

    public function index()
    {
        $principalTrend = PrincipalTrend::latest()->first();
        $trends = $principalTrend->trend->contents->sortByDesc('published_date');
        $topContentIds = TopContent::orderByDesc('order')->take(7)->pluck('content_id')->toArray();
        $trends = $trends->filter(function ($trend) use ($topContentIds) {
            return !in_array($trend->id, $topContentIds);
        })->values()->take(4);

        $topContents = TopContent::orderByDesc('order')
            ->take(7)
            ->get();

        $sectionNames = [
            'algeria' => ['الجزائر', 4],
            'world' => ['عالم', 5],
            'economy' => ['اقتصاد', 4],
            'sports' => ['رياضة', 6],
            'people' => ['ناس', 3],
            'arts' => ['ثقافة وفنون', 8],
            'reviews' => ['آراء', 100],  // Request all available reviews
            'videos' => ['فيديو', 4],
            'files' => ['ملفات', 3],
            'technology' => ['تكنولوجيا', 3],
            'health' => ['صحة', 3],
            'environment' => ['بيئة', 3],
            'media' => ['ميديا', 4],
            'cheeck' => ['فحص', 2],
            'podcasts' => ['بودكاست', 4],
            'variety' => ['منوعات', 5],
            'photos' => ['صور', 5],
        ];

        $sections = Section::pluck('id', 'name');
        $topContentIds = $topContents->pluck('content_id')->toArray();
        $hidetrends = $trends->pluck('id')->toArray();
        $hidetrends = $trends->pluck('id')->toArray();
        $hidetrendsfromsection = $trends->sortByDesc('published_date')->take(4);
        
        foreach ($sectionNames as $var => [$name, $count]) {
            $$var = Content::where('section_id', $sections[$name] ?? null)
                ->whereNotIn('id', $topContentIds)
                ->whereNotIn('id', $hidetrends)
                ->where('importance', 1)
                ->orderByDesc('published_date')
                ->where('status', 'published')
                ->take($count)
                ->get();
        }

        $algeriaLatestImportant = Content::where('section_id', $sections['الجزائر'] ?? null)
            ->where('importance', 2)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take(4)
            ->get();

        $topViewed = Content::where('status', 'published')
            ->orderByDesc('read_count')
            ->take(5)
            ->get();


        $sectionstitles = [
            'الجزائر',
            'عالم',
            'اقتصاد',
            'رياضة',
            'ناس',
            'ثقافة وفنون',
            'آراء',
            'فيديو',
            'ملفات',
            'تكنولوجيا',
            'صحة',
            'بيئة',
            'ميديا',
            'فحص',
            'بودكاست',
            'منوعات',
            'صور',
        ];

        $sectionscontents = [];
        foreach ($sectionstitles as $name) {
            $sectionId = Section::where('name', $name)->value('id');
            $sectionscontents[$name] = Content::where('section_id', $sectionId)
                ->where('status', 'published')
                ->orderByDesc('published_date')
                ->whereNotIn('id', $topContentIds)
                ->whereNotIn('id', $hidetrends)
                ->take(5)
                ->get();
        }
        
        return view('user.home', compact('sectionscontents', 'topContents', 'algeria', 'world', 'economy', 'sports', 'people', 'arts', 'reviews', 'videos', 'files', 'technology', 'health', 'environment', 'media', 'cheeck', 'podcasts', 'variety', 'photos', 'topViewed', 'algeriaLatestImportant', 'principalTrend', 'trends'));
    }



    public function latestNews()
    {
        $latestContents = Content::where('is_latest', 1)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take(20)
            ->get();

        return view('user.latest-news', compact('latestContents'));
    }

    public function photosApi()
    {
        $photos = Content::where('section_id', Section::where('name', 'صور')->value('id'))
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take(3)
            ->get();

        $photos = $photos->map(function ($photo) {
            return [
                'id' => $photo->id,
                'title' => $photo->title,
                'category' => $photo->section ? $photo->section->name : null,
                'summary' => $photo->summary,
                'image' => optional($photo->media()->wherePivot('type', 'main')->first())->path,
            ];
        });


        return response()->json($photos);
    }



    public function breakingNewsApi()
    {
        $tenMinutesAgo = now()->subMinutes(10);

        // Always fetch fresh data if cache is missing or expired
        $breakingNews = Cache::remember('breaking-news', 5, function () use ($tenMinutesAgo) {
            $breakingContent = BreakingContent::where('created_at', '>=', $tenMinutesAgo)
                ->where('status', 'published')
                ->orderByDesc('created_at')
                ->get();

            return $breakingContent->pluck('text')->map(function($text) {
                // Replace straight quotes with guillemets (« and »)
                return preg_replace_callback('/"([^"]*)"/', function($matches) {
                    return '«' . $matches[1] . '»';
                }, $text);
            });
        });

        // ✅ Always return consistent JSON structure
        return response()->json([
            'data' => $breakingNews,
            'updated_at' => now()->timestamp, // helps frontend detect change
        ]);
    }


    public function latestNewsApi()
    {
        $latestContents = Content::where('is_latest', 1)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take(5)
            ->get(['title', 'shortlink'])
            ->map(function($content) {
                $title = $content->title;
                // Replace straight quotes with guillemets (« and »)
                $title = preg_replace_callback('/"([^"]*)"/', function($matches) {
                    return '«' . $matches[1] . '»';
                }, $title);
                
                return [
                    'title' => $title,
                    'shortlink' => $content->shortlink
                ];
            });

        return response()->json($latestContents);
    }

    public function reviews(Request $request)
    {
        $sectionId = Section::where('name', 'آراء')->value('id');

        if (!$sectionId) {
            abort(404);
        }

        // المقالة الأولى فقط للـ reviews
        $reviews = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي المقالات
        $perPage = 5;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherReviews = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز المقالة الأولى
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            return view('user.partials.review-items', compact('otherReviews', 'reviews'))->render();
        }

        return view('user.reviews', [
            'reviews' => [$reviews],
            'otherReviews' => $otherReviews
        ]);
    }

    public function windows(Request $request)
    {
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $windows = Window::orderByDesc('created_at')
            ->skip($skip)
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            return view('user.partials.window-items', compact('windows'))->render();
        }

        return view('user.window', compact('windows'));
    }

    public function files(Request $request)
    {
        $sectionId = Section::where('name', 'ملفات')->value('id');

        if (!$sectionId) {
            abort(404);
        }

        // المقالة الأولى كـ Featured
        $featured = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي الملفات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherFiles = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            if ($request->query('view') === 'mobile') {
                $html = '';
                foreach ($otherFiles as $item) {
                    $html .= view('user.mobile.item', compact('item'))->render();
                }

                return $html;
            }

            return view('user.partials.file-items', compact('otherFiles'))->render();
        }

        return view('user.files', [
            'featured' => $featured,
            'otherFiles' => $otherFiles
        ]);
    }

    public function investigation(Request $request)
    {
        $sectionId = Section::where('name', 'فحص')->value('id');
        if (!$sectionId) {
            abort(404);
        }

        // المقالة الأولى كـ Featured
        $featured = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي التحقيقات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherInvestigations = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            if ($request->query('view') === 'mobile') {
                $html = '';
                foreach ($otherInvestigations as $item) {
                    $html .= view('user.mobile.item', compact('item'))->render();
                }

                return $html;
            }

            return view('user.partials.investigation-items', compact('otherInvestigations'))->render();
        }

        return view('user.investigation', [
            'featured' => $featured,
            'otherInvestigations' => $otherInvestigations
        ]);
    }

    public function videos(Request $request)
    {
        $otherVideos = Section::where('name', 'فيديو')->value('id');
        if (!$otherVideos) {
            abort(404);
        }

        // المقالة الأولى كـ Featured
        $featured = Content::where('section_id', $otherVideos)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي الفيديوهات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherVideos = Content::where('section_id', $otherVideos)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            if ($request->query('view') === 'mobile') {
                $html = '';
                foreach ($otherVideos as $item) {
                    $html .= view('user.mobile.item', compact('item'))->render();
                }

                return $html;
            }

            return view('user.partials.video-items', compact('otherVideos'))->render();
        }

        return view('user.videos', [
            'featured' => $featured,
            'otherVideos' => $otherVideos
        ]);
    }


    public function podcasts(Request $request)
    {
        $otherPodcasts = Section::where('name', 'بودكاست')->value('id');

        if (!$otherPodcasts) {
            abort(404);
        }

        // المقالة الأولى كـ Featured
        $featured = Content::where('section_id', $otherPodcasts)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي البودكاست
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherPodcasts = Content::where('section_id', $otherPodcasts)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            if ($request->query('view') === 'mobile') {
                $html = '';
                foreach ($otherPodcasts as $item) {
                    $html .= view('user.mobile.item', compact('item'))->render();
                }

                return $html;
            }

            return view('user.partials.podcast-items', compact('otherPodcasts'))->render();
        }

        return view('user.podcasts', [
            'featured' => $featured,
            'otherPodcasts' => $otherPodcasts
        ]);
    }


    public function photos(Request $request)
    {
        $sectionId = Section::where('name', 'صور')->value('id');

        if (!$sectionId) {
            abort(404);
        }

        // المقالة الأولى كـ Featured
        $featured = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->first();

        // باقي الصور
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherPhotos = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            // When explicitly requested from mobile, render mobile items
            if ($request->query('view') === 'mobile') {
                // Render each item with the existing mobile partial to preserve summary and date formatting
                $html = '';
                foreach ($otherPhotos as $item) {
                    $html .= view('user.mobile.item', compact('item'))->render();
                }

                return $html;
            }

            // Default desktop behaviour
            return view('user.partials.photo-items', compact('otherPhotos'))->render();
        }

        return view('user.photos', [
            'featured' => $featured,
            'otherPhotos' => $otherPhotos
        ]);
    }

    public function arts()
    {
        return view('user.arts');
    }

    public function newSection(Request $request, $section)
    {
        // Find the Arabic name for the given English section
        $sectionTopArabic = [
            'algeria' => 'الجزائر',
            'world' => 'عالم',
            'economy' => 'اقتصاد',
            'sports' => 'رياضة',
            'people' => 'ناس',
            'technology' => 'تكنولوجيا',
            'health' => 'صحة',
            'environment' => 'بيئة',
            'media' => 'ميديا',
            'variety' => 'منوعات',
            'culture' => 'ثقافة وفنون',
        ];

        $arabicName = $sectionTopArabic[$section] ?? null;
        if (!$arabicName) {
            abort(404);
        }

        $sectionId = Section::where('name', $arabicName)->value('id');
        $windowmanagement = WindowManagement::where('section_id', $sectionId)->first();
        if (!$windowmanagement) {
            abort(404);
        }

        $window = Window::where('id', $windowmanagement->window_id)
            ->first();

        $sectionNames = [
            'algeria' => ['الجزائر', 4],
            'world' => ['عالم', 4],
            'economy' => ['اقتصاد', 4],
            'sports' => ['رياضة', 4],
            'people' => ['ناس', 4],
            'technology' => ['تكنولوجيا', 4],
            'health' => ['صحة', 4],
            'environment' => ['بيئة', 4],
            'media' => ['ميديا', 4],
            'variety' => ['منوعات', 4],
            'culture' => ['ثقافة وفنون', 4],
        ];

        if (!array_key_exists($section, $sectionNames)) {
            abort(404);
        }

        [$arabicName, $count] = $sectionNames[$section];
        $sectionId = \App\Models\Section::where('name', $arabicName)->value('id');

        if (!$sectionId) {
            abort(404);
        }

        // === أول 4 مقالات ثابتة ===
        $contents = \App\Models\Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take($count)
            ->get();

        // === باقي المقالات بالـ AJAX ===
        $perPage = 10;
        $page = $request->get('page', 1);
        $skip = $count + (($page - 1) * $perPage);

        $moreContents = \App\Models\Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip($skip)
            ->take($perPage)
            ->get();

        // Top viewed + suggestions
        $topViewed = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('read_count')
            ->take(5)
            ->get();

        $suggestions = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->where('created_at', '>=', now()->subMonth())
            ->inRandomOrder()
            ->take(5)
            ->get();

        if ($request->ajax()) {
            return view('user.partials.section-items', compact('moreContents'))->render();
        }

        return view('user.section', compact(
            'section',
            'arabicName',
            'contents',
            'moreContents',
            'topViewed',
            'suggestions',
            'window',
            'windowmanagement'
        ));
    }

    public function sectionLoadMore(Request $request, $section)
    {
        // Find the Arabic name for the given English section
        $sectionTopArabic = [
            'algeria' => 'الجزائر',
            'world' => 'عالم',
            'economy' => 'اقتصاد',
            'sports' => 'رياضة',
            'people' => 'ناس',
            'technology' => 'تكنولوجيا',
            'health' => 'صحة',
            'environment' => 'بيئة',
            'media' => 'ميديا',
            'variety' => 'منوعات',
            'culture' => 'ثقافة وفنون',
        ];

        $arabicName = $sectionTopArabic[$section] ?? null;
        if (!$arabicName) {
            return response('', 404);
        }

        $sectionId = Section::where('name', $arabicName)->value('id');
        if (!$sectionId) {
            return response('', 404);
        }

        $count = 4;
        $perPage = 10;
        $page = $request->get('page', 1);
        $skip = $count + (($page - 1) * $perPage);

        $moreContents = Content::where('section_id', $sectionId)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip($skip)
            ->take($perPage)
            ->get();

        return view('user.partials.section-items', compact('moreContents'))->render();
    }

    public function reviewSection(Request $request, $section)
    {
        return view('user.reviews', compact('section'));
    }


    public function openArticle($id)
    {
        $article = Content::findOrFail($id);
        $articleKey = 'article_' . $id . '_read';

        if (!session()->has($articleKey)) {
            $article->increment('view_reads');
            session()->put($articleKey, true);
        }

        return view('user.article', compact('article'));
    }

    public function showNews($title)
    {
        $news = Content::where('shortlink', $title)->orderByDesc('published_date')->firstOrFail();

        // Get latest news from same category
        $lastNews = $this->contentService->getLatestFromCategory($news, $news->category_id);

        // Get most viewed news from last week (same section)
        $lastWeekNews = $this->contentService->getLastWeekMostViewed($news, $news->section_id);

        // Get related news using multiple strategies
        $relatedNews = $this->contentService->getRelatedNews($news);

        // Record the view
        $this->contentService->recordView($news);

        if ($news->contentLists()->exists()) {
            return view('user.list', compact('news') );
        }

        return view('user.news', compact('news', 'lastNews', 'lastWeekNews', 'relatedNews'));
    }

    public function category(Request $request, $id, $type)
    {
        $current_id = $id;

        // ✅ التحقق من النوع
        switch ($type) {
            case 'Category':
                $theme = Category::findOrFail($id);
                $column = 'category_id';
                break;
            case 'Continent':
                $theme = Location::findOrFail($id);
                $column = 'continent_id';
                break;
            case 'Country':
                $theme = Location::findOrFail($id);
                $column = 'country_id';
                break;
            default:
                abort(404, 'نوع القسم غير صالح.');
        }

        $perPage = 10;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        // ✅ جلب المقالات حسب النوع
        $articles = Content::where($column, $id)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip($skip)
            ->take($perPage)
            ->get();

        // ✅ إذا الطلب AJAX → نرجع جزء المقالات فقط
        if ($request->ajax()) {
            return view('user.partials.category-items', [
                'articles' => $articles,
            ])->render();
        }

        // ✅ إذا الطلب عادي → نعرض الصفحة الكاملة
        $articles = Content::where($column, $id)->where('status', 'published')->orderByDesc('published_date')->take($perPage)->get();

        return view('user.category', [
            'theme' => $theme,
            'articles' => $articles,
            'type' => $type,
            'current_id' => $current_id,
        ]);
    }


    public function writer(Request $request, $id)
    {
        $writer = Writer::findOrFail($id);
        $perPage = 10;

        // Get articles where this writer is associated through the many-to-many relationship
        $articles = $writer->contents()
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->paginate($perPage);

        // If it's an AJAX request, return only the articles list partial
        if ($request->ajax()) {
            return view('user.partials.writer-items', compact('articles'))->render();
        }

        // Otherwise return full page
        return view('user.writer', compact('writer', 'articles'));
    }

    public function showTag(Request $request, $tag)
    {
        // Find the tag by ID
        $theme = Tag::findOrFail($tag);
        $current_id = $tag;
        $type = 'Tag';

        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        // Get articles for AJAX requests (pagination)
        $articles = Content::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag);
        })
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip($skip)
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            return view('user.partials.tag-items', compact('articles'))->render();
        }

        // For initial page load, get the first page
        $articles = Content::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag);
        })
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take($perPage)
            ->get();

        return view('user.tags', compact('theme', 'articles', 'type', 'current_id'));
    }

    public function showTrend(Request $request, $trend)
    {
        // Find the trend by ID
        $theme = Trend::findOrFail($trend);
        $current_id = $trend;
        $type = 'Trend';

        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        // Get articles for AJAX requests (pagination)
        $articles = Content::where('trend_id', $trend)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->skip($skip)
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
            return view('user.partials.tag-items', compact('articles'))->render();
        }

        // For initial page load, get the first page
        $articles = Content::where('trend_id', $trend)
            ->where('status', 'published')
            ->orderByDesc('published_date')
            ->take($perPage)
            ->get();

        return view('user.trends', compact('theme', 'articles', 'type', 'current_id'));
    }

    public function aboutUs()
    {
        return view('user.about-us');
    }

    public function privacyAndStatements()
    {
        return view('user.privacy-and-statements');
    }
}
