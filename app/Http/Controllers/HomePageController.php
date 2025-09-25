<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Section;
use App\Models\BreakingContent;

class HomePageController extends Controller
{
    public function index()
    {


        $sectionNames = [
            'algeria' => ['الجزائر', 4],
            'world' => ['عالم', 5],
            'economy' => ['اقتصاد', 4],
            'sport' => ['رياضة', 6],
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
        foreach ($sectionNames as $var => [$name, $count]) {
            $$var = Content::where('section_id', $sections[$name] ?? null)
                ->latest()
                ->take($count)
                ->get();
        }


        $topViewed = Content::where('section_id', $sections['منوعات'] ?? null)
            ->orderByDesc('read_count')
            ->take(5)
            ->get();

        return view('user.home', compact('algeria', 'world', 'economy', 'sport', 'people', 'arts', 'reviews', 'videos', 'files', 'technology', 'health', 'environment', 'media', 'cheeck', 'podcasts', 'variety', 'photos', 'topViewed'));
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

    public function photos() {}

    public function podcasts()
    {
        return view('user.podcasts');
    }

    public function arts()
    {
        return view('user.arts');
    }

    public function newCategory()
    {
        return view('user.newCategory');
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
}
