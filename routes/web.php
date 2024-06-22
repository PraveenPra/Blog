<?php

use App\Http\Controllers\{
    
    ProfileController,

    PostController,
    CommentController,

    CategoryController,
    InfoController,
    MyArtisanController,
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



Route::post('users/{user}/follow', [UserController::class, 'follow'])->name('follow.user');
Route::post('posts/{post}/save', [PostController::class, 'savePost'])->name('posts.save');
Route::post('posts/{post}/unsave', [PostController::class, 'unsavePost'])->name('posts.unsave');
Route::get('posts/saved', [PostController::class, 'mySavedPosts'])->name('posts.saved');
Route::get('posts/followed', [PostController::class, 'followedUsersPosts'])->name('posts.followed');
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

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


// Route::get('/privacy-policy', [InfoController::class, 'privacyPolicy'])->name('privacy-policy');
// Route::get('/terms-of-service', [InfoController::class, 'termsOfService'])->name('terms-of-service');

Route::get('/about', [InfoController::class, 'about'])->name('about');
Route::get('/contact', [InfoController::class, 'contactForm'])->name('contact.form');
Route::post('/contact', [InfoController::class, 'submitContact'])->name('contact.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/contact-submissions', [InfoController::class, 'show_contact_submissions'])->name('show.contact-submissions');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/artisan', [MyArtisanController::class, 'index'])->name('artisan.index');
    Route::post('/artisan/run', [MyArtisanController::class, 'run'])->name('artisan.run');
});