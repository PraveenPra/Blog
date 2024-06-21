<?php

use App\Http\Controllers\{
    ProfileController,

    PostController,
    CommentController,

    CategoryController,
    TagController,
    UserController,

    RoleController,
    PermissionController,
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // Route for searching posts
    Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');

    // Route for filtering posts by category
    Route::get('posts/category/{category}', [PostController::class, 'category'])->name('posts.category');

    // Route for filtering posts by tag
    Route::get('posts/tag/{tag}', [PostController::class, 'indexByTag'])->name('posts.tag');

    Route::resource('posts', PostController::class)->except(['index', 'show']);;
    Route::resource('posts.comments', CommentController::class)->shallow()->except(['index', 'show']);

    Route::resource('categories', CategoryController::class)->middleware('role:admin');
    Route::resource('tags', TagController::class)->middleware('role:admin');
    Route::resource('users', UserController::class);
});



// Public routes accessible to guests
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::middleware('auth')->group(function () {
    
    Route::get('/roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assign.permissions');
    Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('roles', RoleController::class);

    // Permissions CRUD routes
    Route::resource('permissions', PermissionController::class);


});