<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::get('/news/category/{category}', [NewsController::class, 'filterByCategory']);
Route::get('/news/offline', [NewsController::class, 'offlineArticles']);
Route::post('/news/{id}/save-offline', [NewsController::class, 'saveForOffline']);
Route::get('/fetch-news', [NewsController::class, 'fetchLatestNews'])->name('latest-news');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth',])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/news/{articleId}/favorite', [NewsController::class, 'addToFavorites'])->name('news.favorite');
    Route::post('/news/{articleId}/unfavorite', [NewsController::class, 'removeFromFavorites'])->name('news.unfavorite');
});

require __DIR__.'/auth.php';
