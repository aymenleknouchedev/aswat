<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WritterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\WindowController;

// artisan commands
use Illuminate\Support\Facades\Artisan;

// Clear cache, config, routes, views
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Cache, config, routes, and views cleared successfully.';
});


if (env('COMING_SOON', true)) {
    Route::get('/{any}', function () {
        return view('coming-soon');
    })->where('any', '.*');
} else {
    // client
    Route::get('/', [HomePageController::class, 'index'])->name('index');
    Route::get('/photos', [HomePageController::class, 'photos'])->name('photos');
    Route::get('/reviews', [HomePageController::class, 'reviews'])->name('reviews');
    Route::get('/podcasts', [HomePageController::class, 'podcasts'])->name('podcasts');
    Route::get('/arts', [HomePageController::class, 'arts'])->name('arts');
    Route::get('/newCategory', [HomePageController::class, 'newCategory'])->name('newCategory');
}

Route::prefix('dashboard')->group(function () {

     // Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');

    $entities = [
        'user' => AuthController::class,
        'content' => ContentController::class,
        'writer' => WritterController::class,
        'tag' => TagController::class,
        'section' => SectionController::class,
        'categorie' => CategoryController::class,
        'page' => PagesController::class,
        'breakingnew' => BreakingNewsController::class,
        'media' => MediaController::class,
        'trend' => TrendController::class,
        'window' => WindowController::class,
        'location' => LocationController::class,
    ];

    foreach ($entities as $entity => $controller) {
        $plural = $entity . 's'; // مثل: user => users
        Route::get("/{$plural}", [$controller, 'index'])->name("dashboard.{$plural}.index");
        Route::get("/{$entity}-create", [$controller, 'create'])->name("dashboard.{$entity}.create");
        Route::post("/{$entity}-store", [$controller, 'store'])->name("dashboard.{$entity}.store");
        Route::get("/{$entity}-{id}", [$controller, 'show'])->name("dashboard.{$entity}.show");
        Route::get("/{$entity}-{id}-edit", [$controller, 'edit'])->name("dashboard.{$entity}.edit");
        Route::put("/{$entity}-{id}", [$controller, 'update'])->name("dashboard.{$entity}.update");
        Route::delete("/{$entity}-{id}", [$controller, 'destroy'])->name("dashboard.{$entity}.destroy");
    }

    // Authentication specific routes
    Route::get('/auth', [AuthController::class, 'auth'])->name('dashboard.user.auth');
    Route::get('/login', [AuthController::class, 'login'])->name('dashboard.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
