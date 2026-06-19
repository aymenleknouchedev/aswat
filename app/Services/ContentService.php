<?php

namespace App\Services;

use App\Models\Content;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ContentService
{
    /**
     * Get related news for a given content
     *
     * @param Content $content
     * @param int $limit
     * @return Collection
     */
    public function getRelatedNews(Content $content, int $limit = 4): Collection
    {
        $relatedNews = collect();
        $excludeIds = [$content->id];

        // Build keyword list from seo_keyword (الكلمة الرئيسية) and tags (الكلمات المفتاحية)
        $keywords = collect();

        if (!empty($content->seo_keyword)) {
            $keywords = $keywords->merge(
                collect(preg_split('/[,،\s]+/u', $content->seo_keyword))
                    ->map(fn($k) => trim($k))
                    ->filter(fn($k) => mb_strlen($k) > 2)
            );
        }

        if ($content->tags->isNotEmpty()) {
            $keywords = $keywords->merge($content->tags->pluck('name'));
        }

        $keywords = $keywords->map(fn($k) => trim($k))->filter()->unique()->values();

        // 🟢 1. Exact seo_keyword match across ALL sections/categories
        if (!empty($content->seo_keyword)) {
            $bySeo = Content::whereNotIn('id', $excludeIds)
                ->where('status', 'published')
                ->where('seo_keyword', $content->seo_keyword)
                ->latest('published_at')
                ->take($limit)
                ->get();

            $relatedNews = $relatedNews->merge($bySeo);
            $excludeIds = array_merge($excludeIds, $bySeo->pluck('id')->all());
        }

        // 🟡 2. By tags across ALL sections/categories
        if ($relatedNews->count() < $limit && $content->tags->isNotEmpty()) {
            $tagIds = $content->tags->pluck('id');

            $byTags = Content::whereNotIn('id', $excludeIds)
                ->where('status', 'published')
                ->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                })
                ->latest('published_at')
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($byTags);
            $excludeIds = array_merge($excludeIds, $byTags->pluck('id')->all());
        }

        // 🔵 3. By keyword text-match in title/summary/content across ALL sections/categories
        if ($relatedNews->count() < $limit && $keywords->isNotEmpty()) {
            $byKeywords = Content::whereNotIn('id', $excludeIds)
                ->where('status', 'published')
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $word) {
                        $query->orWhere('title', 'like', "%{$word}%")
                            ->orWhere('summary', 'like', "%{$word}%")
                            ->orWhere('seo_keyword', 'like', "%{$word}%")
                            ->orWhere('content', 'like', "%{$word}%");
                    }
                })
                ->latest('published_at')
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($byKeywords);
            $excludeIds = array_merge($excludeIds, $byKeywords->pluck('id')->all());
        }

        // 🟣 4. If still empty (no seo_keyword and no tags), build keywords from the title itself
        if ($relatedNews->count() < $limit && $keywords->isEmpty()) {
            $text = strip_tags($content->title . ' ' . $content->summary);
            $titleWords = collect(preg_split('/\s+/u', $text))
                ->map(fn($w) => trim($w, " \t\n\r\0\x0B،,.؟?!:\"'()[]{}"))
                ->filter(fn($w) => mb_strlen($w) > 3)
                ->unique()
                ->take(8)
                ->values();

            if ($titleWords->isNotEmpty()) {
                $byTitle = Content::whereNotIn('id', $excludeIds)
                    ->where('status', 'published')
                    ->where(function ($query) use ($titleWords) {
                        foreach ($titleWords as $word) {
                            $query->orWhere('title', 'like', "%{$word}%")
                                ->orWhere('summary', 'like', "%{$word}%")
                                ->orWhere('content', 'like', "%{$word}%");
                        }
                    })
                    ->latest('published_at')
                    ->take($limit - $relatedNews->count())
                    ->get();

                $relatedNews = $relatedNews->merge($byTitle);
                $excludeIds = array_merge($excludeIds, $byTitle->pluck('id')->all());
            }
        }

        // ⚪️ 5. Final fallback: latest published across ALL sections/categories
        if ($relatedNews->count() < $limit) {
            $fallback = Content::whereNotIn('id', $excludeIds)
                ->where('status', 'published')
                ->latest('published_at')
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($fallback);
        }

        return $relatedNews->unique('id')->sortByDesc('published_at')->take($limit)->values();
    }

    /**
     * Get most viewed news from last week for a given section
     * Falls back to older news if less than the limit
     *
     * @param Content $excludeContent
     * @param int $sectionId
     * @param int $limit
     * @return Collection
     */
    public function getLastWeekMostViewed(Content $excludeContent, ?int $sectionId, int $limit = 5): Collection
    {
        if ($sectionId === null) {
            return collect();
        }

        $lastWeek = now()->subWeek();

        // First: Get news from last week from same section
        $lastWeekNews = Content::where('title', '!=', $excludeContent->title)
            ->where('status', 'published')
            ->where('section_id', $sectionId)
            ->where('created_at', '>=', $lastWeek)
            ->orderByDesc('read_count')
            ->take($limit)
            ->get();

        // If less than limit, complete with older news from same section
        if ($lastWeekNews->count() < $limit) {
            $remaining = $limit - $lastWeekNews->count();

            $olderNews = Content::where('title', '!=', $excludeContent->title)
                ->where('status', 'published')
                ->where('section_id', $sectionId)
                ->where('created_at', '<', $lastWeek)
                ->orderByDesc('read_count')
                ->take($remaining)
                ->get();

            $lastWeekNews = $lastWeekNews->concat($olderNews);
        }

        return $lastWeekNews;
    }

    /**
     * Get latest news from the same category
     *
     * @param Content $excludeContent
     * @param int $categoryId
     * @param int $limit
     * @return Collection
     */
    public function getLatestFromCategory(Content $excludeContent, ?int $categoryId, int $limit = 5): Collection
    {
        if ($categoryId === null) {
            return collect();
        }

        return Content::where('title', '!=', $excludeContent->title)
            ->where('status', 'published')
            ->where('category_id', $categoryId)
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Record a view for the given content
     * Prevents duplicate views from same IP/User-Agent within 6 hours
     *
     * @param Content $content
     * @return void
     */
    public function recordView(Content $content): void
    {
        $ip = request()->ip();
        $agent = request()->header('User-Agent');
        $key = 'news_view_' . md5($content->id . $ip . $agent);

        // Prevent duplicate views within 6 hours
        if (!Cache::has($key)) {
            Cache::put($key, true, now()->addHours(6));

            // Increment read count in content table
            $content->increment('read_count');

            // Update or insert daily views
            DB::table('content_daily_views')->updateOrInsert(
                [
                    'content_id' => $content->id,
                    'date' => now()->toDateString(),
                ],
                [
                    'views' => DB::raw('views + 1'),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
