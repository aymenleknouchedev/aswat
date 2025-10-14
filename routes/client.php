<?php


use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['coming.soon'])->group(function () {
    // client
    Route::get('/', [HomePageController::class, 'index'])->name('index');
    Route::get('/latestNews', [HomePageController::class, 'latestNews'])->name('latestNews');
    Route::get('/api/photos', [HomePageController::class, 'photosApi'])->name('api.photos');
    Route::get('/api/breaking-news', [HomePageController::class, 'breakingNewsApi'])->name('api.breaking.news');
    Route::get('/api/latest-news', [HomePageController::class, 'latestNewsApi'])->name('api.latest.news');
    Route::get('/search', [HomePageController::class, 'search'])->name('search');
    Route::get('/section/reviews', [HomePageController::class, 'reviews'])->name('reviews');
    Route::get('/section/windows', [HomePageController::class, 'windows'])->name('windows');
    Route::get('/section/files', [HomePageController::class, 'files'])->name('files');
    Route::get('/section/investigation', [HomePageController::class, 'investigation'])->name('investigation');
    Route::get('/section/videos', [HomePageController::class, 'videos'])->name('videos');
    Route::get('/section/podcasts', [HomePageController::class, 'podcasts'])->name('podcasts');
    Route::get('/section/photos', [HomePageController::class, 'photos'])->name('photos');
    Route::get('/section/windows', [HomePageController::class, 'windows'])->name('windows');
    Route::get('/category/{id}/{type}', [HomePageController::class, 'category'])->name('category.show');
    Route::get('/section/{section}', [HomePageController::class, 'newSection'])->name('newSection');
    Route::get('/news/{news}', [HomePageController::class, 'showNews'])->name('news.show');
});
