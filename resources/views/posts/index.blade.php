<x-master-layout>
    <style>

.card {
    position: relative;
    width: 320px;
    height: 400px;
    background: transparent;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.imgBx {
    position: relative;
    width: 100%;
    height: 240px;
    background: #f00;
    border-radius: 15px;
    object-fit: contain;
    /* background-size: cover; */
    /* background-position: center; */
    overflow: hidden;   
}

.content {
    position: relative;
    width: 100%;
    /* height: 150px; */
    background: #fff;
    border-radius: 15px;
    border-top-left-radius: 0;
}

.head {
    position: absolute;
    top: -50px;
    height: 50px;
    /* width: 50%; */
    background: #fff;
    /* color: #fff; */
    border-top: 10px solid #f3f4f6;
    border-right: 10px solid #f3f4f6;
    border-top-right-radius: 25px;
}

.head::before {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    background: transparent;
    border-radius: 50%;
    box-shadow: -10px -10px 0 #f3f4f6;
}

.head::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: -25px;
    width: 25px;
    height: 25px;
    background: transparent;
    border-radius: 50%;
    box-shadow: -10px 10px 0 #fff;
}

        
    </style>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Success and Error Alerts -->
        @include('partials.alerts')

        <!-- <h1 class="text-2xl font-bold mb-4">Posts</h1> -->

        <div class="flex justify-between items-center mb-4">
            @can('create posts')
                <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Post</a>
            @endcan
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
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
