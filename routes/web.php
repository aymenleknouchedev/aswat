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


    Route::prefix('dashboard')->group(function () {

        $entities = [
            'user' => AuthController::class,
            'content' => ContentController::class,
            'writer' => WritterController::class,
            'tag' => TagController::class,
            'section' => SectionController::class,
            'categorie' => CategoryController::class,
            'page' => PagesController::class,
            'breakingnew' => BreakingNewsController::class,

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

        // Dashboard
        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');


       
    });


    // // Dashboard
    // Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('dashboard.index');

    // // Authentication routes and user management
    // Route::get('/dashboard/auth', [AuthController::class, 'auth'])->name('dashboard.user.auth');
    // Route::get('/dashboard/users', [AuthController::class, 'index'])->name('dashboard.users.index');

    // Route::get('/dashboard/user-create', [AuthController::class, 'create'])->name('dashboard.user.create');
    // Route::post('/dashboard/user-store', [AuthController::class, 'store'])->name('dashboard.user.store');

    // Route::get('/dashboard/user-{id}', [AuthController::class, 'show'])->name('dashboard.user.show');
    // Route::get('/dashboard/user-{id}-edit', [AuthController::class, 'edit'])->name('dashboard.user.edit');
    // Route::put('/dashboard/user-{id}', [AuthController::class, 'update'])->name('dashboard.user.update');
    // Route::delete('/dashboard/user-{id}', [AuthController::class, 'destroy'])->name('dashboard.user.destroy');

    // Route::get('/dashboard/login', [AuthController::class, 'login'])->name('dashboard.login');
    // Route::get('/dashboard/logout', [AuthController::class, 'logout'])->name('dashboard.logout');




    // // Writers management
    // Route::get('/dashboard/writers', [WritterController::class, 'index'])->name('dashboard.writers.index');
    // Route::get('/dashboard/writer-create', [WritterController::class, 'create'])->name('dashboard.writer.create');
    // Route::post('/dashboard/writer-store', [WritterController::class, 'store'])->name('dashboard.writer.store');
    // Route::get('/dashboard/writer-{id}', [WritterController::class, 'show'])->name('dashboard.writer.show');
    // Route::get('/dashboard/writer-{id}-edit', [WritterController::class, 'edit'])->name('dashboard.writer.edit');
    // Route::put('/dashboard/writer-{id}', [WritterController::class, 'update'])->name('dashboard.writer.update');
    // Route::delete('/dashboard/writer-{id}', [WritterController::class, 'destroy'])->name('dashboard.writer.destroy');


    // //tag management
    // Route::get('/dashboard/tags', [TagController::class, 'index'])->name('dashboard.tags.index');
    // Route::get('/dashboard/tag-create', [TagController::class, 'create'])->name('dashboard.tag.create');
    // Route::post('/dashboard/tag-store', [TagController::class, 'store'])->name('dashboard.tag.store');
    // Route::get('/dashboard/tag-{id}', [TagController::class, 'show'])->name('dashboard.tag.show');
    // Route::get('/dashboard/tag-{id}-edit', [TagController::class, 'edit'])->name('dashboard.tag.edit');
    // Route::put('/dashboard/tag-{id}', [TagController::class, 'update'])->name('dashboard.tag.update');
    // Route::delete('/dashboard/tag-{id}', [TagController::class, 'destroy'])->name('dashboard.tag.destroy');

    // //sections management
    // Route::get('/dashboard/sections', [DashboardController::class, 'index'])->name('dashboard.sections.index');
    // Route::get('/dashboard/section-create', [DashboardController::class, 'create'])->name('dashboard.section.create');
    // Route::post('/dashboard/section-store', [DashboardController::class, 'store'])->name('dashboard.section.store');
    // Route::get('/dashboard/section-{id}', [DashboardController::class, 'show'])->name('dashboard.section.show');
    // Route::get('/dashboard/section-{id}-edit', [DashboardController::class, 'edit'])->name('dashboard.section.edit');
    // Route::put('/dashboard/section-{id}', [DashboardController::class, 'update'])->name('dashboard.section.update');
    // Route::delete('/dashboard/section-{id}', [DashboardController::class, 'destroy'])->name('dashboard.section.destroy');

}
