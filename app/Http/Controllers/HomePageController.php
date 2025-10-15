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
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = collect();

        if ($query) {
            $results = Content::where('title', 'like', '%' . $query . '%')
                ->orWhere('summary', 'like', '%' . $query . '%')
                ->latest()
                ->take(20)
                ->get();
        }

        return view('user.search', compact('query', 'results'));
    }

    public function index()
    {

        $principalTrend = PrincipalTrend::latest()->first();

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
            'reviews' => ['آراء', 3],
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

        foreach ($sectionNames as $var => [$name, $count]) {
            $$var = Content::where('section_id', $sections[$name] ?? null)
                ->whereNotIn('id', $topContentIds)
                ->where('importance', 1)
                ->latest()
                ->take($count)
                ->get();
        }

        $algeriaLatestImportant = Content::where('section_id', $sections['الجزائر'] ?? null)
            ->where('importance', 2)
            ->latest()
            ->take(4)
            ->get();

        $topViewed = Content::where('section_id', $sections['منوعات'] ?? null)
            ->orderByDesc('read_count')
            ->take(5)
            ->get();

        return view('user.home', compact('topContents', 'algeria', 'world', 'economy', 'sports', 'people', 'arts', 'reviews', 'videos', 'files', 'technology', 'health', 'environment', 'media', 'cheeck', 'podcasts', 'variety', 'photos', 'topViewed', 'algeriaLatestImportant', 'principalTrend'));
    }

    public function latestNews()
    {
        $latestContents = Content::where('is_latest', 1)
            ->latest()
            ->take(20)
            ->get();

        return view('user.latest-news', compact('latestContents'));
    }

    public function photosApi()
    {
        $photos = Content::where('section_id', Section::where('name', 'صور')->value('id'))
            ->latest()
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
        return Cache::remember('breaking-news', 5, function () {
            $tenMinutesAgo = now()->subMinutes(10);

            $breakingContent = BreakingContent::where('created_at', '>=', $tenMinutesAgo)
                ->latest()
                ->get();

            return $breakingContent->pluck('text');
        });
    }


    public function latestNewsApi()
    {
        $latestContents = Content::where('is_latest', 1)
            ->latest()
            ->take(5)
            ->pluck('title');

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
            ->latest()
            ->first();

        // باقي المقالات
        $perPage = 5;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherReviews = Content::where('section_id', $sectionId)
            ->latest()
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

        $windows = Window::latest()
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
            ->latest()
            ->first();

        // باقي الملفات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherFiles = Content::where('section_id', $sectionId)
            ->latest()
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
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
            ->latest()
            ->first();

        // باقي التحقيقات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherInvestigations = Content::where('section_id', $sectionId)
            ->latest()
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
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
            ->latest()
            ->first();

        // باقي الفيديوهات
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherVideos = Content::where('section_id', $otherVideos)
            ->latest()
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
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
            ->latest()
            ->first();

        // باقي البودكاست
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherPodcasts = Content::where('section_id', $otherPodcasts)
            ->latest()
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
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
            ->latest()
            ->first();

        // باقي الصور
        $perPage = 9;
        $page = $request->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $otherPhotos = Content::where('section_id', $sectionId)
            ->latest()
            ->skip(1 + $skip) // نتجاوز الـ featured
            ->take($perPage)
            ->get();

        if ($request->ajax()) {
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
            ->latest()
            ->take($count)
            ->get();

        // === باقي المقالات بالـ AJAX ===
        $perPage = 10;
        $page = $request->get('page', 1);
        $skip = $count + (($page - 1) * $perPage);

        $moreContents = \App\Models\Content::where('section_id', $sectionId)
            ->latest()
            ->skip($skip)
            ->take($perPage)
            ->get();

        // Top viewed + suggestions
        $topViewed = Content::where('section_id', $sectionId)
            ->orderByDesc('read_count')
            ->take(5)
            ->get();

        $suggestions = Content::where('section_id', $sectionId)
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
        $news = Content::where('title', $title)->latest()->firstOrFail();
        return view('user.news', compact('news'));
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
            ->latest()
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
        $articles = Content::where($column, $id)->latest()->take($perPage)->get();

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

        $articles = Content::where('writer_id', $id)
            ->latest()
            ->paginate($perPage);

        // If it's an AJAX request, return only the articles list partial
        if ($request->ajax()) {
            return view('user.partials.writer-items', compact('articles'))->render();
        }

        // Otherwise return full page
        return view('user.writer', compact('writer', 'articles'));
    }
}
