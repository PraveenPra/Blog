<x-master-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Tags</h1>
        <a href="{{ route('tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create Tag</a>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="py-3 px-6">{{ $tag->id }}</td>
                            <td class="py-3 px-6">{{ $tag->name }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ route('tags.edit', $tag) }}" class="bg-yellow-500 text-white px-4 py-2 rounded inline-block">Edit</a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded inline-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $tags->links() }}
        </div>
    </div>
</x-master-layout>
