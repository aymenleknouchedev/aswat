<?php


use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ReadMoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['coming.soon'])->group(function () {
    // client
    Route::get('/', [HomePageController::class, 'index'])->name('index');
    Route::get('/latestNews', [HomePageController::class, 'latestNews'])->name('latestNews');
    Route::get('/api/photos', [HomePageController::class, 'photosApi'])->name('api.photos');
    Route::get('/api/breaking-news', [HomePageController::class, 'breakingNewsApi'])->name('api.breaking.news');
    Route::get('/api/latest-news', [HomePageController::class, 'latestNewsApi'])->name('api.latest.news');
    Route::get('/api/section/{section}', [HomePageController::class, 'sectionLoadMore'])->name('api.section.load-more');

    // ReadMore API endpoints
    Route::get('/api/readmore/{id}', [ReadMoreController::class, 'getContentById'])->name('api.readmore.content');
    Route::post('/api/readmore-batch', [ReadMoreController::class, 'getContentBatch'])->name('api.readmore.batch');
    Route::get('/api/readmore-list', [ReadMoreController::class, 'getContentBySection'])->name('api.readmore.list');
    Route::get('/search', [HomePageController::class, 'search'])->name('search');
    Route::get('/reviews', [HomePageController::class, 'reviews'])->name('reviews');
    Route::get('/list', [HomePageController::class, 'list'])->name('list');
    Route::get('/windows', [HomePageController::class, 'windows'])->name('windows');
    Route::get('/files', [HomePageController::class, 'files'])->name('files');
    Route::get('/investigation', [HomePageController::class, 'investigation'])->name('investigation');
    Route::get('/videos', [HomePageController::class, 'videos'])->name('videos');
    Route::get('/podcasts', [HomePageController::class, 'podcasts'])->name('podcasts');
    Route::get('/photos', [HomePageController::class, 'photos'])->name('photos');
    Route::get('/windows', [HomePageController::class, 'windows'])->name('windows');
    Route::get('/writer/{id}', [HomePageController::class, 'writer'])->name('writer.show');
    Route::get('/category/{id}/{type}', [HomePageController::class, 'category'])->name('category.show');
    Route::get('/{section}', [HomePageController::class, 'newSection'])->name('newSection');
    Route::get('/article/{news}', [HomePageController::class, 'showNews'])->name('news.show');
    Route::get('/tag/{tag}', [HomePageController::class, 'showTag'])->name('tag.show');
});
