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

        // 🟢 1. Find by seo_keyword
        if (!empty($content->seo_keyword)) {
            $relatedNews = Content::where('id', '!=', $content->id)
                ->where('status', 'published')
                ->where('seo_keyword', $content->seo_keyword)
                ->take($limit)
                ->get();
        }

        // 🟡 2. Find by tags if not enough results
        if ($relatedNews->count() < $limit && $content->tags->isNotEmpty()) {
            $tagIds = $content->tags->pluck('id');

            $tagBased = Content::where('id', '!=', $content->id)
                ->where('status', 'published')
                ->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                })
                ->inRandomOrder()
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($tagBased);
        }

        // 🔵 3. Find by text similarity if no seo_keyword and no tags
        if ($relatedNews->count() < $limit && empty($content->seo_keyword) && $content->tags->isEmpty()) {
            $text = strtolower(strip_tags($content->title . ' ' . $content->summary . ' ' . $content->content));

            $keywords = collect(explode(' ', $text))
                ->filter(fn($word) => strlen($word) > 4)
                ->unique()
                ->take(8)
                ->values();

            $relatedByText = Content::where('id', '!=', $content->id)
                ->where('status', 'published')
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $word) {
                        $query->orWhere('title', 'like', "%{$word}%")
                            ->orWhere('summary', 'like', "%{$word}%")
                            ->orWhere('content', 'like', "%{$word}%");
                    }
                })
                ->inRandomOrder()
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($relatedByText);
        }

        // ⚪️ 4. Fallback: random from same section
        if ($relatedNews->count() < $limit) {
            $fallback = Content::where('id', '!=', $content->id)
                ->where('status', 'published')
                ->where('section_id', $content->section_id)
                ->inRandomOrder()
                ->take($limit - $relatedNews->count())
                ->get();

            $relatedNews = $relatedNews->merge($fallback);
        }

        return $relatedNews;
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
    public function getLastWeekMostViewed(Content $excludeContent, int $sectionId, int $limit = 5): Collection
    {
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
    public function getLatestFromCategory(Content $excludeContent, int $categoryId, int $limit = 5): Collection
    {
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
