<?php


use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;


// Simple route example
Route::prefix('dashboard')->group(function () {
    Route::get('/send-mail', [SendMailController::class, 'index'])->name('dashboard.mail.send-mail');
    Route::post('/send-mail', [SendMailController::class, 'send'])->name('dashboard.mail.send-mail.store');
});