<div class="card bg-transparent shadow-md rounded-lg mb-3">
    <div class="imgBx">
        @if($post->image)
            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @else
            <div class="h-64 bg-gray-200"></div>
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
            @if(strlen($post->title) <= 50)
                <!-- <p class="text-gray-700 my-2">@truncateText($post->body, 50)</p> -->
            @endif
            <p class="text-gray-500">
                @foreach($post->tags as $tag)
                    <span class="badge bg-gray-200 text-xs text-gray-800 px-2 py-1 rounded">#{{ $tag->name }}</span>
                @endforeach
            </p>
            <div class="flex items-center mt-4 space-x-4">
                <a href="{{ route('posts.show', $post) }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">View</a>
                @can('edit own posts', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                @endcan
                @can('delete own posts', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                @endcan
                <span class="flex items-center space-x-1 cursor-pointer" onclick="toggleComments({{ $post->id }})">
                    <i class="fa-regular fa-comment-dots"></i>
                    <span class="text-gray-500 ml-2">{{ $post->comments->count() }}</span>
                </span>
            </div>
        </div>
        <!-- Comments Section -->
        <div id="comments-section-{{ $post->id }}" class="hidden mt-4">
            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="flex items-center space-x-2">
                        <textarea name="body" class="w-full p-2 border border-gray-300 rounded" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Comment</button>
                    </div>
                </form>
            @endauth
            @foreach($post->comments as $comment)
                <div class="border-t border-gray-200 pt-2">
                    <div class="flex items-center space-x-2">
                        <img src="{{ $comment->user->photo ?? asset('default-profile.png') }}" class="w-10 h-10 rounded-full" alt="Profile Picture">
                        <p class="text-gray-700"><strong>{{ $comment->user->name }}</strong></p>
                        <small class="text-gray-600">@shortTime($comment->created_at)</small>
                        <p class="text-gray-600">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
