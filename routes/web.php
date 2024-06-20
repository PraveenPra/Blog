<?php

use App\Http\Controllers\{ProfileController,

    PostController,CommentController,

    CategoryController,TagController,UserController,
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
  // Route for searching posts
  Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');

  // Route for filtering posts by category
  Route::get('posts/category/{category}', [PostController::class, 'indexByCategory'])->name('posts.category');

  // Route for filtering posts by tag
  Route::get('posts/tag/{tag}', [PostController::class, 'indexByTag'])->name('posts.tag');

     Route::resource('posts', PostController::class);
    Route::resource('posts.comments', CommentController::class)->shallow();
});

Route::resource('categories', CategoryController::class)->middleware('role:admin');
Route::resource('tags', TagController::class)->middleware('role:admin');
Route::resource('users', UserController::class);