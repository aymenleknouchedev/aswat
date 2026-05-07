<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Section;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('sitemap_index_xml', 600, function () {
            $base = url('/');
            $now = now()->toAtomString();
            $items = [
                ['loc' => $base . '/sitemap-static.xml', 'lastmod' => $now],
                ['loc' => $base . '/sitemap-articles.xml', 'lastmod' => $now],
                ['loc' => $base . '/sitemap-news.xml', 'lastmod' => $now],
                ['loc' => $base . '/sitemap-sections.xml', 'lastmod' => $now],
                ['loc' => $base . '/sitemap-tags.xml', 'lastmod' => $now],
            ];

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            foreach ($items as $i) {
                $xml .= "  <sitemap>\n    <loc>{$i['loc']}</loc>\n    <lastmod>{$i['lastmod']}</lastmod>\n  </sitemap>\n";
            }
            $xml .= '</sitemapindex>';
            return $xml;
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function staticPages()
    {
        $xml = Cache::remember('sitemap_static_xml', 3600, function () {
            $urls = [
                ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'hourly'],
                ['loc' => route('about-us'), 'priority' => '0.5', 'changefreq' => 'monthly'],
                ['loc' => route('privacy-and-statements'), 'priority' => '0.3', 'changefreq' => 'yearly'],
                ['loc' => route('contact-us'), 'priority' => '0.4', 'changefreq' => 'yearly'],
                ['loc' => route('reviews'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('files'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('investigation'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('videos'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('podcasts'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('photos'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['loc' => route('windows'), 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['loc' => route('latestNews'), 'priority' => '0.8', 'changefreq' => 'hourly'],
                ['loc' => route('breakingNews'), 'priority' => '0.8', 'changefreq' => 'hourly'],
            ];
            return $this->buildUrlset($urls);
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function articles()
    {
        $xml = Cache::remember('sitemap_articles_xml', 600, function () {
            $articles = Content::where('status', 'published')
                ->orderByDesc('published_date')
                ->limit(50000)
                ->get(['id', 'shortlink', 'updated_at', 'published_date']);

            $urls = $articles->map(function ($a) {
                return [
                    'loc' => route('news.show', $a->shortlink),
                    'lastmod' => optional($a->updated_at ?? $a->published_date)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            })->all();

            return $this->buildUrlset($urls);
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function news()
    {
        // Google News sitemap: only articles from the last 2 days
        $xml = Cache::remember('sitemap_news_xml', 300, function () {
            $articles = Content::where('status', 'published')
                ->where('published_date', '>=', now()->subDays(2))
                ->orderByDesc('published_date')
                ->limit(1000)
                ->get(['id', 'title', 'shortlink', 'published_date']);

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '
                . 'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";
            foreach ($articles as $a) {
                $loc = htmlspecialchars(route('news.show', $a->shortlink), ENT_XML1);
                $pub = optional($a->published_date)->toAtomString();
                $title = htmlspecialchars($a->title ?? '', ENT_XML1);
                $xml .= "  <url>\n";
                $xml .= "    <loc>{$loc}</loc>\n";
                $xml .= "    <news:news>\n";
                $xml .= "      <news:publication>\n";
                $xml .= "        <news:name>أصوات جزائرية</news:name>\n";
                $xml .= "        <news:language>ar</news:language>\n";
                $xml .= "      </news:publication>\n";
                $xml .= "      <news:publication_date>{$pub}</news:publication_date>\n";
                $xml .= "      <news:title>{$title}</news:title>\n";
                $xml .= "    </news:news>\n";
                $xml .= "  </url>\n";
            }
            $xml .= '</urlset>';
            return $xml;
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function sections()
    {
        $xml = Cache::remember('sitemap_sections_xml', 3600, function () {
            $arabicToSlug = [
                'الجزائر' => 'algeria', 'عالم' => 'world', 'اقتصاد' => 'economy',
                'رياضة' => 'sports', 'ناس' => 'people', 'تكنولوجيا' => 'technology',
                'صحة' => 'health', 'بيئة' => 'environment', 'ميديا' => 'media',
                'منوعات' => 'variety', 'ثقافة وفنون' => 'culture',
            ];
            $urls = [];
            foreach ($arabicToSlug as $slug) {
                try {
                    $urls[] = [
                        'loc' => route('newSection', $slug),
                        'changefreq' => 'hourly',
                        'priority' => '0.7',
                    ];
                } catch (\Throwable $e) {}
            }
            return $this->buildUrlset($urls);
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function tags()
    {
        $xml = Cache::remember('sitemap_tags_xml', 3600, function () {
            $tags = Tag::orderBy('id')->limit(20000)->get(['id', 'updated_at']);
            $urls = $tags->map(function ($t) {
                return [
                    'loc' => route('tag.show', $t->id),
                    'lastmod' => optional($t->updated_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.4',
                ];
            })->all();
            return $this->buildUrlset($urls);
        });

        return Response::make($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    private function buildUrlset(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            if (empty($u['loc'])) continue;
            $loc = htmlspecialchars($u['loc'], ENT_XML1);
            $xml .= "  <url>\n    <loc>{$loc}</loc>\n";
            if (!empty($u['lastmod'])) $xml .= "    <lastmod>{$u['lastmod']}</lastmod>\n";
            if (!empty($u['changefreq'])) $xml .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
            if (!empty($u['priority'])) $xml .= "    <priority>{$u['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';
        return $xml;
    }
}
