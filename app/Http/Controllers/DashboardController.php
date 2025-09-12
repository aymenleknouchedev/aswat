<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Content;
use App\Models\Writer;

class DashboardController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:dashboard_access']);
    }

    public function index()
    {
        $contentCount = Content::where('status', '!=', 'draft')->count();
        $publishedTodayCount = Content::whereDate('created_at', now()->toDateString())
            ->where('status', 'published')
            ->count();
        $waitingValidationCount = Content::where('status', 'draft')->count();
        $writersCount = Writer::count();
        $lastSevenContents = Content::orderBy('created_at', 'desc')->take(7)->get();
        return view('dashboard.index', compact('contentCount', 'publishedTodayCount', 'waitingValidationCount',  'writersCount', 'lastSevenContents'));
    }
}
