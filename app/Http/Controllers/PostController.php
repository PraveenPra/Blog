<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{

    //  function __construct()
    // {
    //     $this->middleware('permission:create posts', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:edit own posts|edit posts',['only'=>['edit', 'update']]);
    //     $this->middleware('permission:delete own posts|delete posts',['only'=>['destroy']]);
    // }

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
       
        $posts = Post::with(['category', 'tags', 'user'])->paginate(10);
        // dd('k', $posts);
        return view('posts.index', compact('posts'));
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
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
        ]);

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
        $post->load(['category', 'tags', 'user', 'comments.user']);
        return view('posts.show', compact('post'));
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
        ]);

        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category_id'],
        ]);

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
}
