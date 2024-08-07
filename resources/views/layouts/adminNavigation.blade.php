<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 dark:text-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <!-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> -->
                        <i class="fa-solid fa-blog" style="font-size: 30px;"></i>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <strong class="text-xl font-bold text-black dark:text-white"> {{ __('BlogHub') }} </strong>
                    </x-nav-link>



                    <!-- Posts Link -->
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        {{ __('Posts') }}
                    </x-nav-link>



                    <x-nav-link :href="route('posts.my')" :active="request()->routeIs('posts.my')">
                        {{ __('My posts') }}
                    </x-nav-link>

                    <x-nav-link :href="route('posts.followed')" :active="request()->routeIs('posts.followed')">
                        {{ __('Following') }}
                    </x-nav-link>

                    <x-nav-link :href="route('posts.saved')" :active="request()->routeIs('posts.saved')">
                        {{ __('Saved') }}
                    </x-nav-link>

                    @can('manage contact submissions')
                    <x-nav-link :href="route('show.contact-submissions')" :active="request()->routeIs('show.contact-submissions')">
                        {{ __('Contacted me') }}
                    </x-nav-link>
                    @endcan

                    @role('admin')
                    <x-nav-link :href="route('artisan.index')" :active="request()->routeIs('artisan.index')">
                        {{ __('Artisan Commands') }}
                    </x-nav-link>
                    @endrole

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <!-- If user is not authenticated -->
                <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    {{ __('Log In') }}
                </a>
                @endauth

                <!-- <button id="darkModeToggle" class="w-10 h-10 ml-2 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none transition-colors duration-300">
                    <i id="darkModeIcon" class="fas fa-sun"></i>
                </button> -->
                <button class="darkModeToggle w-10 h-10 ml-2 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none transition-colors duration-300">
                    <i class="darkModeIcon fas fa-sun"></i>
                </button>

            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('BlogHub') }}
            </x-responsive-nav-link>

            <!-- Categories Responsive Link -->
            @can('view categories')
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('Categories') }}
            </x-responsive-nav-link>
            @endcan

            <!-- Tags Responsive Link -->
            @can('view tags')
            <x-responsive-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                {{ __('Tags') }}
            </x-responsive-nav-link>
            @endcan

            <!-- Posts Responsive Link -->
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                {{ __('Posts') }}
            </x-responsive-nav-link>

            <!-- Users Responsive Link -->
            @can('view users')
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            @endcan


            <!-- Roles Responsive Link -->
            @can('view roles')
            <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                {{ __('Roles') }}
            </x-responsive-nav-link>
            @endcan

            <!-- Permissions Responsive Link -->
            @can('view permissions')
            <x-responsive-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
                {{ __('Permissions') }}
            </x-responsive-nav-link>
            @endcan


            <x-responsive-nav-link :href="route('posts.my')" :active="request()->routeIs('posts.my')">
                {{ __('My posts') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('posts.followed')" :active="request()->routeIs('posts.followed')">
                {{ __('Following') }}
            </x-responsive-nav-link>



            <x-responsive-nav-link :href="route('posts.saved')" :active="request()->routeIs('posts.saved')">
                {{ __('Saved') }}
            </x-responsive-nav-link>

            @can('manage contact submissions')
            <x-responsive-nav-link :href="route('show.contact-submissions')" :active="request()->routeIs('show.contact-submissions')">
                {{ __('Contacted me') }}
            </x-responsive-nav-link>
            @endcan

            @role('admin')

            <x-responsive-nav-link :href="route('artisan.index')" :active="request()->routeIs('artisan.index')">
                {{ __('Artisan Commands') }}
            </x-responsive-nav-link>
            @endrole



            <!-- <button id="darkModeToggle" class="w-10 h-10 ml-2 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none transition-colors duration-300">
                <i id="darkModeIcon" class="fas fa-sun"></i>
            </button> -->

            <button class="darkModeToggle w-10 h-10 ml-2 rounded-full bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none transition-colors duration-300">
                <i class="darkModeIcon fas fa-sun"></i>
            </button>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @else
            <!-- If user is not authenticated -->
            <a href="{{ route('login') }}" class="block px-4 py-2 text-base text-gray-500 dark:text-gray-400">
                {{ __('Log In') }}
            </a>
            @endauth
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



</nav>