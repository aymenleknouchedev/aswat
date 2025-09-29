<?php

use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\ContentReviewController;
use App\Http\Controllers\JoinTeamController;
use App\Http\Controllers\TopContentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\{
    HomePageController,
    AuthController,
    BreakingNewsController,
    DashboardController,
    SectionController,
    TagController,
    WritterController,
    CategoryController,
    PagesController,
    ContentController,
    LocationController,
    MediaController,
    PermissionController,
    RoleController,
    SettingsController,
    TrendController,
    WindowController
};

use App\Http\Controllers\ApiController;

// Coming soon
Route::post('/store-join-team', [JoinTeamController::class,'store_join_team'])->name('dashboard.store-join-team');

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

Route::get('/o-auth', [AuthController::class, 'auth'])->name('dashboard.user.auth');

if (env('COMING_SOON', true)) {
    Route::get('/{any}', function () {
        return view('coming-soon');
    })->where('any', '.*');
} else {
    // client
    Route::get('/', [HomePageController::class, 'index'])->name('index');
    Route::get('/photos', [HomePageController::class, 'photos'])->name('photos');
    Route::get('/api/photos', [HomePageController::class, 'photosApi'])->name('api.photos');
    Route::get('/api/breaking-news', [HomePageController::class, 'breakingNewsApi'])->name('api.breaking.news');
    Route::get('/api/latest-news', [HomePageController::class, 'latestNewsApi'])->name('api.latest.news');
    Route::get('/reviews', [HomePageController::class, 'reviews'])->name('reviews');
    Route::get('/podcasts', [HomePageController::class, 'podcasts'])->name('podcasts');
    Route::get('/arts', [HomePageController::class, 'arts'])->name('arts');
    Route::get('/section/{section}', [HomePageController::class, 'newSection'])->name('newSection');
}

Route::prefix('dashboard')->group(function () {

    Route::middleware(['guesto'])->group(function () {
        Route::get('/auth', [AuthController::class, 'auth'])->name('dashboard.user.auth');
        Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');
    });

    // Routes dashboard  
    Route::middleware(['auth'])->group(function () {

        // Coming soon
        Route::get('/cvs', [ComingSoonController::class,'index'])->name( 'dashboard.join-team');
        Route::post('/cv/{id}/update-status', [ComingSoonController::class, 'update_status'])->name('dashboard.join-team.update_status');
        Route::delete('/delete-cv/{id}', [ComingSoonController::class,'destroy'])->name( 'dashboard.join-team.delete');

        // Api for select2 ajax search
        Route::get('/api/search-contents', [ApiController::class, 'search_contents'])->name('api.search.contents');
        Route::get('/api/search-categories', [ApiController::class, 'search_categories'])->name('api.search.categories');
        Route::post('/api/add-category', [ApiController::class, 'add_category'])->name('api.add.category');
        Route::get('/api/search-trends', [ApiController::class, 'search_trends'])->name('api.search.trends');
        Route::post('/api/add-trend', [ApiController::class, 'add_trend'])->name('api.add.trend');
        Route::get('/api/search-windows', [ApiController::class, 'search_windows'])->name('api.search.windows');
        Route::post('/api/add-window', [ApiController::class, 'add_window'])->name('api.add.window');
        Route::get('/api/search-tags', [ApiController::class, 'search_tags'])->name('api.search.tags');
        Route::post('/api/add-tag', [ApiController::class, 'add_tag'])->name('api.add.tag');
        Route::get('/api/search-writers', [ApiController::class, 'search_writers'])->name('api.search.writers');
        Route::post('/api/add-writer', [ApiController::class, 'add_writer'])->name('api.add.writer');
        Route::get('/api/search-cities', [ApiController::class, 'search_cities'])->name('api.search.cities');

        // Content Reviews
        Route::get('/api/content/{id}/reviews', [ContentReviewController::class, 'getContentReviews'])->name('api.content.reviews');
        Route::post('/api/store/reviews', [ContentReviewController::class, 'store'])->name('api.content.reviews.store');
        Route::put('/api/update/reviews/{id}', [ContentReviewController::class, 'update'])->name('api.content.reviews.update');
        Route::delete('/api/delete/reviews/{id}', [ContentReviewController::class, 'destroy'])->name('api.content.reviews.destroy');

        // List all content reviews
        Route::get('/content-reviews{id}', [ContentReviewController::class, 'index'])->name('content.reviews.index');

        // Dashboard
        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');

        // Settings
        Route::get('/settings', [SettingsController::class, 'settings'])->name('dashboard.settings');

        // get all media paginated (for JS fetch)
        Route::get('/media/getAllMediaPaginated', [MediaController::class, 'getAllMediaPaginated'])
            ->name('dashboard.media.getAllMediaPaginated');

        // Entities
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
            'role' => RoleController::class,
            'permission' => PermissionController::class,
        ];

        foreach ($entities as $entity => $controller) {
            $plural = $entity . 's'; // مثال: user => users
            Route::get("/{$plural}", [$controller, 'index'])->name("dashboard.{$plural}.index");
            Route::get("/{$entity}-create", [$controller, 'create'])->name("dashboard.{$entity}.create");
            Route::post("/{$entity}-store", [$controller, 'store'])->name("dashboard.{$entity}.store");
            Route::get("/{$entity}-{id}", [$controller, 'show'])->name("dashboard.{$entity}.show");
            Route::get("/{$entity}{id}", [$controller, 'edit'])->name("dashboard.{$entity}.edit");
            Route::put("/{$entity}-{id}", [$controller, 'update'])->name("dashboard.{$entity}.update");
            Route::delete("/{$entity}-{id}", [$controller, 'destroy'])->name("dashboard.{$entity}.destroy");
        }

        Route::get('/top-contents', [TopContentController::class,'index'])->name('dashboard.topcontents');
        Route::post('/top-contents/{id}', [TopContentController::class,'store'])->name('dashboard.topcontents.store');
        Route::post('/dashboard/top-contents/update-order', [TopContentController::class, 'updateOrder'])->name('dashboard.topcontents.updateOrder');
        Route::delete('/top-contents/delete/{id}', [TopContentController::class,'destroy'])->name('dashboard.topcontents.destroy');

        Route::post('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
    });


});
