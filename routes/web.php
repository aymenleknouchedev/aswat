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
    TrendController,
    WindowController
};

Route::prefix('artisan')->middleware('auth')->group(function () {
    Route::get('/clear-cache', fn() => Artisan::call('cache:clear') ?: 'Cache cleared');
    Route::get('/migrate-fresh', fn() => Artisan::call('migrate:fresh', ['--force' => true]) ?: 'Migrated fresh');
    Route::get('/storage-link', fn() => Artisan::call('storage:link') ?: 'Storage linked');
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
    Route::middleware(['autho'])->group(function () {

        // Dashboard
        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');

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
            Route::get("/{$entity}-{id}-edit", [$controller, 'edit'])->name("dashboard.{$entity}.edit");
            Route::put("/{$entity}-{id}", [$controller, 'update'])->name("dashboard.{$entity}.update");
            Route::delete("/{$entity}-{id}", [$controller, 'destroy'])->name("dashboard.{$entity}.destroy");
        }

        // Logout
        Route::get('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
    });
});
