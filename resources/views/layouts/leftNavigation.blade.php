<nav x-data="{ open: true }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 dark:text-gray-200  mt-1  relative left-0 shadow-sm min-h-screen">
    <!-- Primary Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="block sm:block">
        <!-- Logo and Navigation Links -->
        <!-- Hamburger Menu Icon (Visible on Small Screens) -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex flex-col items-center">



            <div class="flex flex-col items-end gap-4">
                @can('view categories')
                <div class="group shrink-0 flex items-center border-b-2 border-gray-50 
                {{request()->routeIs('categories.index')? 'border-r-4 ' : ''}}">
                    <a href="{{ route('categories.index') }}" class="shrink-0 flex items-center p-4 sm:p-6 lg:p-8 gap-2 ">
                        <i class="fa-solid fa-layer-group" style="font-size: 20px;"></i>
                        <span class="hidden group-hover:inline-block">Categories</span>
                    </a>
                </div>
                @endcan

                @can('view tags')
                <div class="group shrink-0 flex items-center border-b-2 border-gray-50 ">
                    <a href="{{ route('tags.index') }}" class="shrink-0 flex items-center gap-2 p-4 sm:p-6 lg:p-8 {{request()->routeIs('tags.index')? 'border-r-4 border-gray-500' : ''}}">
                        <i class="fa-solid fa-hashtag" style="font-size: 20px;"></i>
                        <span class="hidden group-hover:inline-block">Tags</span>
                    </a>
                </div>
                @endcan

                @can('manage users')
                <div class="group shrink-0 flex items-center border-b-2 border-gray-50 ">
                    <a href="{{ route('users.index') }}" class="shrink-0 flex items-center gap-2 p-4 sm:p-6 lg:p-8 {{request()->routeIs('users.index')? 'border-r-4 border-gray-500' : ''}}">
                        <i class="fa-solid fa-users" style="font-size: 20px;"></i>
                        <span class="hidden group-hover:inline-block">Users</span>
                    </a>
                </div>
                @endcan

                @can('view roles')
                <div class="group shrink-0 flex items-center border-b-2 border-gray-50 ">
                    <a href="{{ route('roles.index') }}" class="shrink-0 flex items-center gap-2 p-4 sm:p-6 lg:p-8 {{request()->routeIs('roles.index')? 'border-r-4 border-gray-500' : ''}}">
                        <i class="fa-solid fa-people-roof" style="font-size: 20px;"></i>
                        <span class="hidden group-hover:inline-block">Roles</span>
                    </a>
                </div>
                @endcan

                @can('view permissions')
                <div class="group shrink-0 flex items-center ">
                    <a href="{{ route('permissions.index') }}" class="shrink-0 flex items-center p-4 sm:p-6 lg:p-8 gap-2 {{request()->routeIs('permissions.index')? 'border-r-4 border-gray-500' : ''}}">
                        <i class="fa-solid fa-check-double" style="font-size: 20px;"></i>
                        <span class="hidden group-hover:inline-block">Permissions</span>
                    </a>
                </div>
                @endcan

                <!-- Navigation Links (Initially Hidden on Small Screens) -->
                <div class="hidden space-y-2 sm:flex sm:flex-col sm:items-start sm:ms-10">
                    <!-- Links -->
                    <!-- Include all your links here as shown in your original code -->
                </div>
            </div>


            <!-- Settings Dropdown and Hamburger Icon -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Include your dropdown and dark mode toggle buttons here -->
            </div>


        </div>

        <!-- Responsive Navigation Menu (Visible on Small Screens) -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <!-- Include your responsive links here as shown in your original code -->
        </div>
    </div>


</nav>