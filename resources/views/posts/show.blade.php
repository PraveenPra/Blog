<x-master-layout>
    <div class="container mx-auto p-4">
        <div class="card bg-white shadow-md rounded-lg mb-3 p-4">
            <div class="card-body">
                <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                <p class="text-gray-700 mt-4">{{ $post->body }}</p>
                <p class="text-gray-500 mt-2">Category: {{ $post->category->name }}</p>
                <p class="text-gray-500 mt-2">Tags:
                    @foreach($post->tags as $tag)
                        <span class="badge bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $tag->name }}</span>
                    @endforeach
                </p>
                <div class="mt-4">
                    <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Posts</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>