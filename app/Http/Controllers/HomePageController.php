<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Section;
use App\Models\BreakingContent;
use App\Models\TopContent;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    public function index()
    {

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
                ->latest()
                ->take($count)
                ->get();
        }

        $topViewed = Content::where('section_id', $sections['منوعات'] ?? null)
            ->orderByDesc('read_count')
            ->take(5)
            ->get();


        return view('user.home', compact('topContents', 'algeria', 'world', 'economy', 'sports', 'people', 'arts', 'reviews', 'videos', 'files', 'technology', 'health', 'environment', 'media', 'cheeck', 'podcasts', 'variety', 'photos', 'topViewed'));
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
        $tenMinutesAgo = now()->subMinutes(10);

        $breakingContent = BreakingContent::where('created_at', '>=', $tenMinutesAgo)
            ->latest()
            ->get();

        $breakingNews = $breakingContent->pluck('text');

        return response()->json($breakingNews);
    }

    public function latestNewsApi()
    {
        $latestContents = Content::latest()
            ->take(5)
            ->pluck('title');

        return response()->json($latestContents);
    }

    public function reviews()
    {
        return view('user.reviews');
    }

    public function photos()
    {
        return view('user.photos');
    }

    public function podcasts()
    {
        return view('user.podcasts');
    }

    public function arts()
    {
        return view('user.arts');
    }

    public function newSection(Request $request, $section)
    {
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
            'suggestions'
        ));
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

    public function showNews($id)
    {
        $news = Content::findOrFail($id);
        return view('user.news', compact('news'));
    }
}
