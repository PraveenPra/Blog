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
                    <p class="text-gray-700">{{ $post->body }}</p>
                    <p class="text-gray-500">Category: {{ $post->category->name }}</p>
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
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
 
</x-master-layout>
