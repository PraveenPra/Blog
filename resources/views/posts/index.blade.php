<x-master-layout>
    <div class="container mx-auto p-4">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="bg-green-200 border-green-600 border-l-4 text-green-900 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Alert -->
        @if($errors->any())
            <div class="bg-red-200 border-red-600 border-l-4 text-red-900 p-4 mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($posts as $post)
                <div class="card bg-white shadow-md rounded-lg mb-3">
                    <div class="relative overflow-hidden">
                        @if($post->image)
                            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                        @else
                            <div class="h-64 bg-gray-200"></div>
                        @endif
                        <div class="absolute bottom-0 left-0 p-4 bg-white bg-opacity-75 w-full">
                            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                            <small class="text-gray-600 block">@shortTime($post->created_at)</small>
                            <p class="text-gray-700 my-4">@truncateText($post->body, 250)</p>
                            <p class="text-gray-500">Category: {{ $post->category->name }}</p>
                            <p class="text-gray-500">Tags:
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $tag->name }}</span>
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
                </div>
            @endforeach
        </div>
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
