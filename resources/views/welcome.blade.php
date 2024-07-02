<x-master-layout>
    <!-- Hero Section -->
    <section class="hero min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="container text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-800 dark:text-gray-200 mb-4">Welcome to BlogHub</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">Your ultimate source for insightful articles and discussions.</p>

            <!-- <a href="{{ route('posts.index') }}" class="relative inline-block btn btn-primary dark:text-white hover:underline">
                Explore Posts
                <span class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-400 to-blue-200 opacity-0 rounded-lg transform scale-0 transition-all duration-300"></span>
            </a> -->



            <a href="{{ route('posts.index') }}">
                <span class="'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">
                    Explore Posts
                </span>
            </a>



        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-12 bg-white dark:bg-gray-800">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1: Number of Posts -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Total Posts</h2>
                    <p class="text-gray-600 dark:text-gray-300">200+</p>
                </div>
                <!-- Feature 2: Number of Users -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Total Users</h2>
                    <p class="text-gray-600 dark:text-gray-300">500+</p>
                </div>
                <!-- Feature 3: Number of Topics -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Total Topics</h2>
                    <p class="text-gray-600 dark:text-gray-300">50+</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section 2: Additional Features -->
    <section class="features py-12 bg-white dark:bg-gray-800">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 4: Featured Content -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Featured Content</h2>
                    <p class="text-gray-600 dark:text-gray-300">Highlighting top-rated posts and popular topics.</p>
                </div>
                <!-- Feature 5: Search Functionality -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Search Functionality</h2>
                    <p class="text-gray-600 dark:text-gray-300">Easily find posts and topics of interest.</p>
                </div>
                <!-- Feature 6: Responsive Design -->
                <div class="feature text-center px-4">
                    <div class="icon text-gray-600 dark:text-gray-400 rounded-full p-3 mb-4">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Responsive Design</h2>
                    <p class="text-gray-600 dark:text-gray-300">Enjoy a seamless experience on any device.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta py-20 bg-gray-800 dark:bg-gray-900">
        <div class="container mx-auto text-center text-white">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">Start your blogging journey today!</h2>
            <p class="text-lg mb-8">Join our community and start sharing your stories and knowledge.</p>
            <a href="{{ route('register') }}" class="btn btn-primary hover:underline">Sign Up Now</a>
        </div>
    </section>
</x-master-layout>