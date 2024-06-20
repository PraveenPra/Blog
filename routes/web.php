<?php

use App\Http\Controllers\{ProfileController,

    PostController,CommentController,

    CategoryController,TagController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', CommentController::class)->shallow();
});

Route::resource('categories', CategoryController::class)->middleware('role:admin');
Route::resource('tags', TagController::class)->middleware('role:admin');