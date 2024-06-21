<x-master-layout  :bgClass="'bg-white'">
<div class="mt-4 sticky left-0 top-0">
                    <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Posts</a>
                </div>
    <div class="container mx-auto p-4 ">
        <div class="   mb-3 p-4">
            <div class="">
                
            <img src="{{ asset('images/'  . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover ">

                <h2 class="text-4xl text-center font-bold">{{ $post->title }}</h2>

                <p class="text-gray-500 mt-2">
                    @foreach($post->tags as $tag)
                        <span class="badge bg-gray-200 text-gray-800 px-2 py-1 rounded"># {{ $tag->name }}</span>
                    @endforeach
                </p>


                <p class="text-gray-700 mt-4">{!! $post->body !!}</p>
                <p class="text-gray-500 mt-2">Category: {{ $post->category->name }}</p>
              
                 <!-- Comments Section -->
        <div id="comments-section-{{ $post->id }}" class=" mt-4">
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
                <div class="border-t border-gray-200 pt-2 pb-4">
                    <div class="flex items-center space-x-2">
                        <img src="{{ $comment->user->photo ?? 'https://images.unsplash.com/photo-1504194104404-433180773017?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fGZyZWV8ZW58MHx8MHx8fDA%3D'  }}" class="w-10 h-10 rounded-full" alt="Profile Picture">
                        <p class="text-gray-700"><strong>{{ $comment->user->name }}</strong></p>
                        <p><small class="text-gray-600">@shortTime($comment->created_at)</small></p>
                        <br>
                        <p class="text-gray-600">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
            </div>
        </div>
    </div>
    <!-- <script>
        function toggleComments(postId) {
            const commentsSection = document.getElementById(`comments-section-${postId}`);
            commentsSection.classList.toggle('hidden');
        }
    </script> -->
</x-master-layout>