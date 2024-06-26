<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Quill CSS -->
    <!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

         <!-- Quill JavaScript -->
    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.min.js" defer></script> -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">


     <!-- Google Fonts -->
     <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans&display=swap" rel="stylesheet"> -->


    <!-- <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}"> -->
     <!-- download fontawesome 6 version and put it in public folder,then u can uncomment this link to use it -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">

    <!-- meta seo tags -->
    <meta name="description" content="{{ $metaDescription ?? 'Explore insightful posts on various topics.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'technology, laravel, php, web development' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'Manikanta' }}">


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- ?? 'bg-gray-100 dark:bg-gray-900' -->
            @include('layouts.adminNavigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="container mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                {{ $slot ?? ''}}
            </main>
        </div>
        <!-- Footer -->
<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto text-center">
        <div class="mb-4 flex gap-4 justify-center items-center">
            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white mx-2">Home</a>
             <a href="{{ route('about') }}" class="text-gray-300 hover:text-white mx-2">About</a>
            <a href="{{ route('contact.form') }}" class="text-gray-300 hover:text-white mx-2">Contact</a>
          {{--  <a href="{{ route('privacy-policy') }}" class="text-gray-300 hover:text-white mx-2">Privacy Policy</a>
            <a href="{{ route('terms-of-service') }}" class="text-gray-300 hover:text-white mx-2">Terms of Service</a>--}}
        </div>
        <div class="mb-4 flex justify-center items-center gap-4">
          
            <a href="https://www.linkedin.com/in/manikanta-l-728811146/" target="_blank" class="text-gray-300 hover:text-white mx-2"> <i class="fa-brands fa-linkedin"></i> LinkedIn</a>
            <a href="https://github.com/PraveenPra" target="_blank" class="text-gray-300 hover:text-white mx-2"> <i class="fa-brands fa-github"></i> GitHub</a>
        </div>
        <div class="text-gray-400">
            &copy; {{ date('Y') }} Manikanta. All rights reserved.
        </div>
    </div>
</footer>

    </body>
</html>
