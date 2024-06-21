<div class="card bg-transparent shadow-md rounded-lg mb-3">
    <div class="imgBx">
        <!-- @if($post->image)
        <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @else
        <div class="h-64 bg-gray-200"></div>
        @endif -->

        @if($post->image && filter_var($post->image, FILTER_VALIDATE_URL))
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @elseif($post->image)
        <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @else
        <div class="h-24 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">No Image Available</span>
        </div>
        @endif
    </div>
    <div class="content relative">
        <p class="head ">
            <br>
            <span class="p-4 font-medium font-sans">
                {{ $post->category->name }}</span>
        </p>
        <div class="p-4">
            <h2 class="text-xl font-semibold">{{$post->title}}</h2>
            <small class="text-gray-600 block">@shortTime($post->created_at)</small>
            @if(strlen($post->title) <= 50) <!-- <p class="text-gray-700 my-2">@truncateText($post->body, 50)</p> -->
                @endif
                <p class="text-gray-500">
                    @foreach($post->tags as $tag)
                    <span class="badge bg-gray-200 text-xs text-gray-800 px-2 py-1 rounded">#{{ $tag->name }}</span>
                    @endforeach
                </p>
                <div class="flex items-center mt-4 space-x-4">
                    <a href="{{ route('posts.show', $post) }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">View</a>
                    @can('edit own posts', $post)
                    @if ($post->user_id === Auth::id() || Auth::user()->hasRole('admin'))
                    <a href="{{ route('posts.edit', $post) }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    @endif
                    @endcan
                    @can('delete own posts', $post)
                    @if ($post->user_id === Auth::id() || Auth::user()->hasRole('admin'))
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                    @endif
                    @endcan



                </div>

                <!-- Likes and Views -->
                <div class="flex items-center space-x-4 text-gray-500 border-t-2 border-gray-200 pt-2">

                    <form action="{{ route('posts.like', $post) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center">
                            <i class="far fa-thumbs-up"></i> {{ $post->likes }}
                        </button>
                    </form>
                    <span>
                        <i class="far fa-eye"></i> {{ $post->views }}
                    </span>


                    <span class="flex items-center space-x-1 cursor-pointer">
                        <i class="far fa-comment-dots"></i>
                        <a href="{{ route('posts.show', $post) }}" class="text-gray-500 ml-2">{{ $post->comments->count() }}</a>
                    </span>


                    <div>
                        @auth
                        @if(Auth::user()->savedPosts->contains($post->id))
                        <form action="{{ route('posts.unsave', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500">
                                <i class="fas fa-bookmark"></i> Unsave
                            </button>
                        </form>
                        @else
                        <form action="{{ route('posts.save', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blue-500">
                                <i class="far fa-bookmark"></i> Save
                            </button>
                        </form>
                        @endif
                        @else <!-- Guest user -->
                        <a href="{{ route('login') }}" class="text-blue-500">
                            <i class="far fa-bookmark"></i> Save
                        </a>
                        @endauth
                    </div>

                </div>
        </div>

    </div>
</div>