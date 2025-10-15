<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

use App\Models\Content;
use App\Models\Writer;
use App\Models\ContentDailyView;
use Illuminate\Support\Carbon;
use Exception;

class DashboardController extends Controller
{

    protected $last_10_cache_ttl = 1000;

    public function __construct()
    {
        // $this->middleware(['auth', 'check:dashboard_access']);
    }

    public function index()
    {
        try {

            $count_cache_ttl = config('cache_ttl.hour', 3600);
            $last_10_cache_ttl = config('cache_ttl.minute', 60);
            $today = Carbon::today();

            $contentCount = Cache::remember('content_count', $count_cache_ttl, function () {
                return Content::where('status', '!=', 'draft')->count();
            });

            $publishedTodayCount = Cache::remember('published_today_count', $count_cache_ttl, function () use ($today) {
                return Content::whereDate('created_at', $today)
                    ->where('status', 'published')
                    ->count();
            });

            $waitingValidationCount = Cache::remember('waiting_validation_count', $count_cache_ttl, function () {
                return Content::where('status', 'draft')->count();
            });

            $writersCount = Cache::remember('writers_count', $count_cache_ttl, function () {
                return Writer::count();
            });

            $lastTenContents = Cache::remember('last_ten_contents', $last_10_cache_ttl, function () {
                return Content::latest()->take(10)->get();
            });


            // عدد المشاهدات في آخر يوم
            $viewsLastDay = ContentDailyView::where('date', '>=', Carbon::now()->subDay()->toDateString())
                ->sum('views');

            // عدد المشاهدات في آخر 3 أيام
            $viewsLast3Days = ContentDailyView::where('date', '>=', Carbon::now()->subDays(3)->toDateString())
                ->sum('views');

            // عدد المشاهدات في آخر 7 أيام
            $viewsLast7Days = ContentDailyView::where('date', '>=', Carbon::now()->subDays(7)->toDateString())
                ->sum('views');

            // عدد المشاهدات في آخر شهر
            $viewsLastMonth = ContentDailyView::where('date', '>=', Carbon::now()->subMonth()->toDateString())
                ->sum('views');

            return view('dashboard.index', [
                'contentCount'           => $contentCount,
                'publishedTodayCount'    => $publishedTodayCount,
                'waitingValidationCount' => $waitingValidationCount,
                'writersCount'           => $writersCount,
                'lastTenContents'        => $lastTenContents,
                'viewsLastDay'          => $viewsLastDay,
                'viewsLast3Days'        => $viewsLast3Days,
                'viewsLast7Days'        => $viewsLast7Days,
                'viewsLastMonth'        => $viewsLastMonth,
            ]);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Unable to load dashboard data. Please try again later.');
        }
    }
}
