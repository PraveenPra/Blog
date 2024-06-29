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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 border ">




        <div>
            <a href="/">
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
                <i class="fa-solid fa-blog dark:text-gray-100" style="font-size: 60px;"></i>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg ">

            <div class="flex justify-end">
                <button class="darkModeToggle w-10 h-10 ml-2 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none transition-colors duration-300 ">
                    <i class="darkModeIcon fas fa-sun"></i>
                </button>
            </div>
            {{ $slot }}
        </div>


    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.darkModeToggle');
            const darkModeIcons = document.querySelectorAll('.darkModeIcon');
            const body = document.body;

            // Function to apply the saved theme or system preference
            function applyTheme(theme) {
                if (theme === 'dark') {
                    body.classList.add('dark');
                    darkModeIcons.forEach(icon => {
                        icon.classList.remove('fa-sun');
                        icon.classList.add('fa-moon');
                    });
                } else {
                    body.classList.remove('dark');
                    darkModeIcons.forEach(icon => {
                        icon.classList.remove('fa-moon');
                        icon.classList.add('fa-sun');
                    });
                }
            }

            // Add event listeners to the buttons
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    body.classList.toggle('dark');
                    if (newTheme === 'dark') {
                        darkModeIcons.forEach(icon => {
                            icon.classList.remove('fa-sun');
                            icon.classList.add('fa-moon');
                        });
                    } else {
                        darkModeIcons.forEach(icon => {
                            icon.classList.remove('fa-moon');
                            icon.classList.add('fa-sun');
                        });
                    }
                    localStorage.setItem('theme', newTheme);
                });
            });

            // Check localStorage for saved theme
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                applyTheme(savedTheme);
            } else {
                // Default to system preference if no saved theme
                const systemPreference = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                applyTheme(systemPreference);
            }
        });
    </script>
</body>

</html>