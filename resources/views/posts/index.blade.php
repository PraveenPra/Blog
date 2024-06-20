<x-master-layout>
<div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Posts</h1>
            @can('create posts')
                <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Post</a>
            @endcan
        </div>
        @foreach($posts as $post)
            <div class="card bg-white shadow-md rounded-lg mb-3 p-4">
                <div class="card-body">
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    <small> <span>@shortTime($post->created_at)</span></small>
                    <p class="text-gray-700 my-4">{!! $post->body !!} <!-- Output post body as HTML --></p>
                    <p class="text-gray-500 my-2">Category: {{ $post->category->name }}</p>
                    <p class="text-gray-500">Tags:
                        @foreach($post->tags as $tag)
                            <span class="badge bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <div class="mt-4">
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
                    </div>

                    
                    <div class="flex items-center mt-4 space-x-4 gap-4">
                        <span class="flex items-center space-x-1">
                            <!-- <x-icons.like class="w-5 h-5 text-gray-500" /> -->
                            <i class="fa-regular fa-heart"></i>
                            <span class="text-gray-500 ml-2">123</span> <!-- Dummy likes count -->
                        </span>
                        <span class="flex items-center space-x-1">
                            <!-- <x-icons.view class="w-5 h-5 text-gray-500" /> -->
                            <i class="fa-regular fa-eye"></i>
                            <span class="text-gray-500 ml-2">456</span> <!-- Dummy views count -->
                        </span>
                        <span class="flex items-center space-x-1 cursor-pointer" onclick="toggleComments({{ $post->id }})">
                            <!-- <x-icons.comment class="w-5 h-5 text-gray-500" /> -->
                            <i class="fa-regular fa-comment-dots"></i>
                            <span class="text-gray-500 ml-2">{{ $post->comments->count() }}</span> <!-- Number of comments -->
                        </span>
                    </div>

                    <!-- Comments Section -->
                    <div id="comments-section-{{ $post->id }}" class="hidden mt-4">
                        <!-- New Comment Form -->
                        @auth
                            <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <textarea name="body" class="w-full p-2 border border-gray-300 rounded" placeholder="Add a comment..."></textarea>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Comment</button>
                                </div>
                            </form>
                        @endauth

                        <!-- Comments List -->
                        @foreach($post->comments as $comment)
                            <div class="border-t border-gray-200 pt-2">
                            <div class="flex items-center space-x-2">
                                  <!-- Profile Picture -->
                                  <img src="{{ $comment->user->photo ?? asset('default-profile.png') }}" class="w-10 h-10 rounded-full" alt="Profile Picture">
                                  
                                <p class="text-gray-700"><strong>{{ $comment->user->name }}</strong>  {{-- $comment->created_at->diffForHumans() --}}:
                                    <small> <span>@shortTime($comment->created_at)</span></small>
                                </p>
                                <p class="text-gray-600">{{ $comment->body }}</p>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
    <script>
        function toggleComments(postId) {
            const commentsSection = document.getElementById(`comments-section-${postId}`);
            commentsSection.classList.toggle('hidden');
        }
    </script>
</x-master-layout>
