<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{


    public static function middleware(): array
    {
        return [
            'permission:create posts' => ['only' => ['create', 'store']],
            'permission:edit own posts|edit posts' => ['only' => ['edit', 'update']],
            'permission:delete own posts|delete posts' => ['only' => ['destroy']],
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with(['category', 'tags', 'user'])->latest()->paginate(12);
        $categories = Category::all(); // Fetch categories
        $tags = Tag::all();
        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $searchQuery . '%')
            ->orWhere('body', 'like', '%' . $searchQuery . '%')
            ->with(['category', 'tags', 'user'])
            ->latest()
            ->paginate(10);

        $categories = Category::all(); // Retrieve categories
        $tags = Tag::all();
        return view('posts.index', compact('posts', 'categories', 'tags'));

        // return view('posts.index', compact('posts'));
    }

    // public function indexByCategory(Category $category)
    // {
    //     $posts = $category->posts()->paginate(10);
    //     return view('posts.index', compact('posts'));
    // }

    public function indexByTag(Tag $tag)
    {
        $posts = $tag->posts()->with(['category', 'tags', 'user'])->latest()->paginate(12);
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.index', compact('posts', 'tags', 'categories'));
    }


    //filter only by category
    public function category(Category $category)
    {
        $posts = $category->posts()->with(['category', 'tags', 'user'])->latest()->paginate(12);
        $categories = Category::all(); // Retrieve categories
        $tags = Tag::all();
        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'image_url' => 'nullable|url',
        ]);

        $imageName = null;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        // If image URL is provided and image was not uploaded, use the URL
        if ($request->filled('image_url') && !$imageName) {
            $imageName = $request->image_url; // Store URL directly
        }

        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'image' => $imageName,
        ]);

        if (!$post) {
            // Handle failure scenario
            Log::error('Failed to create post.');
            return back()->withInput()->withErrors(['error' => 'Failed to create post. Please try again.']);
        }

        if (isset($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->increment('views');
        $post->load(['category', 'tags', 'user', 'comments.user']);
        return view('posts.show', compact('post'));
    }


    // Handle likes
    public function like(Post $post)
    {
        $post->increment('likes');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'image_url' => 'nullable|url',
        ]);

        // $imageName = $post->image; // Retain the old image by default

        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        // }

        // Handle image upload or URL
        if ($request->hasFile('image')) {
            // Handle uploaded image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
            // $imagePath = $request->file('image')->store('public/images');
            // $post->image = basename($imagePath); // Save only the filename
        } elseif ($request->filled('image_url')) {
            // Handle image URL
            $post->image = $request->image_url; // Store URL directly in image field
        }


        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->category_id = $validated['category_id'];
        // $post->image = $imageName;

        $updated = $post->save();

        if (!$updated) {
            Log::error('Failed to update post.');
            return back()->withInput()->withErrors(['error' => 'Failed to update post. Please try again.']);
        }

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function savePost(Post $post)
    {
        Auth::user()->savedPosts()->attach($post);
        return back()->with('success', 'Post saved successfully.');
    }

    public function unsavePost(Post $post)
    {
        Auth::user()->savedPosts()->detach($post);
        return back()->with('success', 'Post unsaved successfully.');
    }


    public function mySavedPosts()
    {
        $savedPosts = Auth::user()->savedPosts;
        return view('posts.saved', compact('savedPosts'));
    }

    public function followedUsersPosts()
    {
        $followedUsers = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::whereIn('user_id', $followedUsers)->get();
        return view('posts.followed', compact('posts'));
    }
}
