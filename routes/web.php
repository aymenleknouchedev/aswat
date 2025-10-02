<?php

use App\Http\Controllers\JoinTeamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

require __DIR__ ."/mail.php";
require __DIR__ ."/client.php";
require __DIR__ ."/admin.php";

// Coming soon
Route::post('/store-join-team', [JoinTeamController::class, 'store_join_team'])->name('dashboard.store-join-team');

// Clear cache, config, routes, views
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Cache, config, routes, and views cleared successfully.';
});

// Route to run migrate:fresh
Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh', ['--force' => true]);
    return response('Database migrated fresh successfully.', 200);
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return response('The [public/storage] directory has been re-linked.', 200);
});

Route::get('/seed', function () {
    Artisan::call('db:seed', [
        '--force' => true
    ]);
    return 'Database seeded successfully.';
});