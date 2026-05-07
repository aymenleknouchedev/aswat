<?php

use App\Http\Controllers\JoinTeamController;
use App\Http\Controllers\ImageResizeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

require __DIR__ ."/mail.php";
require __DIR__ ."/client.php";
require __DIR__ ."/admin.php";

// On-the-fly responsive image resize endpoint (cached as static files)
Route::get('/img/w-{width}/{path}', [ImageResizeController::class, 'show'])
    ->where('width', '[0-9]+')
    ->where('path', '.*')
    ->name('img.resize');

// SEO: XML sitemaps
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-static.xml', [SitemapController::class, 'staticPages'])->name('sitemap.static');
Route::get('/sitemap-articles.xml', [SitemapController::class, 'articles'])->name('sitemap.articles');
Route::get('/sitemap-news.xml', [SitemapController::class, 'news'])->name('sitemap.news');
Route::get('/sitemap-sections.xml', [SitemapController::class, 'sections'])->name('sitemap.sections');
Route::get('/sitemap-tags.xml', [SitemapController::class, 'tags'])->name('sitemap.tags');



// Coming soon
Route::post('/store-join-team', [JoinTeamController::class, 'store_join_team'])->name('dashboard.store-join-team');

// Weather API endpoint
Route::get('/api/weather', function () {
    $city = request('city', 'Algiers,DZ');
    $weatherService = app(\App\Services\WeatherService::class);
    $weather = $weatherService->current($city);
    
    if (!$weather) {
        return response()->json(['error' => 'Unable to fetch weather'], 500);
    }
    
    return response()->json($weather);
});

// Debug weather detection
Route::get('/debug/weather', function () {
    if (!config('app.debug')) {
        return response('Debug mode is disabled.', 403);
    }
    
    $weatherService = app(\App\Services\WeatherService::class);
    
    // Test with Cairo, Egypt IP
    $weather = $weatherService->testWithIP('197.0.32.1');
    
    return response()->json([
        'weather' => $weather,
        'message' => 'Weather data with geolocation detection (Testing with Egypt IP)',
        'tested_ip' => '197.0.32.1'
    ]);
});

