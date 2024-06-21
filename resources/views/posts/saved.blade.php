<x-master-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">My Saved Posts</h1>
        @foreach($savedPosts as $post)
            <div class="mb-3 p-4 border border-gray-200 rounded">
                <h2 class="text-xl font-bold">{{ $post->title }}</h2>
                <p class="text-gray-500">{{ $post->created_at->format('F j, Y') }}</p>
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read more</a>
            </div>
        @endforeach
    </div>
</x-master-layout>
