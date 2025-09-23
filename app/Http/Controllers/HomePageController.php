<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Section;

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
            'check' => ['فحص', 2],
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

        return view('user.home', compact('algeria', 'world', 'economy', 'sport', 'people', 'arts', 'reviews', 'videos', 'files', 'technology', 'health', 'environment', 'media', 'check', 'podcasts', 'variety', 'photos', 'topViewed'));
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
