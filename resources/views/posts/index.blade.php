<x-master-layout>
    <style>
        .card {
            position: relative;
            min-width: 320px;
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
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-400 ">
                {{ __('Posts') }}
            </h2>

            <!-- Search Form -->
            <form action="{{ route('posts.search') }}" method="GET" class="mt-4">
                <div class="flex items-center">
                    <input type="text" name="search" class="w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm 
        dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200" placeholder="Search posts...">
                    <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors duration-300 
        dark:bg-gray-700 dark:hover:bg-gray-600">Search</button>
                </div>
            </form>



        </div>

    </x-slot>



    <!-- Categories Filter Section -->
    <div class="my-4 " style="display: flex;flex-wrap: wrap; gap: 10px;">
        <a href="{{ route('posts.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2"> All</a>

        @foreach ($categories as $category)
        <a href="{{ route('posts.category', $category) }}" class=" px-4 py-2  rounded  
                 {{ request()->is('posts/category/'.$category->id) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">{{ $category->name }}</a>
        @endforeach
    </div>



    <!-- Categories Filter Section using the component -->
    <!-- <div class="my-4">
  <a href="{{ route('posts.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2"> All</a>
        <x-item-slider :items="$categories"/>
    </div> -->
    <!-- Tags Filter Section -->
    <div class="my-4  " style="display: flex;flex-wrap: wrap; gap: 10px;">


        <a href="{{ route('posts.index') }}" class="border-2  text-gray-700 px-4 py-2 rounded font-thin text-xs"> All</a>

        @foreach($tags as $tag)
        <a href="{{ route('posts.tag', $tag) }}" class="border-2  px-4 py-2 rounded font-thin text-xs
             {{ request()->is('posts/tag/'.$tag->id) ? 'border-gray-300 text-blue-500' : ' text-gray-600' }}">#{{ $tag->name }}</a>
        @endforeach

    </div>

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
        document.addEventListener("DOMContentLoaded", function() {
            const slider = document.querySelector('.categories-slider');
            const container = document.querySelector('.categories-container');
            const prevButton = document.querySelector('.prev');
            const nextButton = document.querySelector('.next');

            prevButton.addEventListener('click', function() {
                container.scrollBy({
                    left: -slider.offsetWidth,
                    behavior: 'smooth'
                });
            });

            nextButton.addEventListener('click', function() {
                container.scrollBy({
                    left: slider.offsetWidth,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</x-master-layout>