<?php

use App\Http\Controllers\JoinTeamController;
use Illuminate\Support\Facades\Route;

require __DIR__ ."/mail.php";
require __DIR__ ."/client.php";
require __DIR__ ."/admin.php";

// Coming soon
Route::post('/store-join-team', [JoinTeamController::class, 'store_join_team'])->name('dashboard.store-join-team');



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

