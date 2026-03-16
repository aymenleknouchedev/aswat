<?php

use App\Http\Controllers\JoinTeamController;
use Illuminate\Support\Facades\Route;

require __DIR__ ."/mail.php";
require __DIR__ ."/client.php";
require __DIR__ ."/admin.php";

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return response()->json(['message' => 'Cache cleared successfully']);
});

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

