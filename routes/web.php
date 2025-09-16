<?php

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

// Clear cache, config, routes, views
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Cache, config, routes, and views cleared successfully.';
});

Route::get('/test', function () {
    dd("Test");
})->middleware('test');

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh', [
        '--force' => true
    ]);
    return 'Database migrated fresh successfully.';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully.';
});

Route::get('/seed', function () {
    Artisan::call('db:seed', [
        '--force' => true
    ]);
    return 'Database seeded successfully.';
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

    Route::middleware(['guesto'])->group(function () {
        Route::get('/auth', [AuthController::class, 'auth'])->name('dashboard.user.auth');
        Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');
    });

    // Routes dashboard  
    Route::middleware(['auth'])->group(function () {

        // Api for select2 ajax search
        Route::get('/api/search-categories', [ApiController::class, 'search_categories'])->name('api.search.categories');
        Route::get('/api/search-trends', [ApiController::class, 'search_trends'])->name('api.search.trends');
        Route::get('/api/search-windows', [ApiController::class, 'search_windows'])->name('api.search.windows');
        Route::get('/api/search-tags', [ApiController::class, 'search_tags'])->name('api.search.tags');
        Route::get('/api/search-writers', [ApiController::class, 'search_writers'])->name('api.search.writers');
        Route::get('/api/search-cities', [ApiController::class, 'search_cities'])->name('api.search.cities');

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

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
    });
});
