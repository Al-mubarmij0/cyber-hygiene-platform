<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Your Learning Companion</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Optional: Add some custom styling if needed for specific sections */
            .hero-section {
                background-image: url('/images/hero-bg.jpg'); /* Make sure you have an image at public/images/hero-bg.jpg if you use this */
                background-size: cover;
                background-position: center;
                color: white;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </a>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-nav-link>
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-nav-link>
                        </div>

                        <div x-data="{ open: false }" class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            </nav>

            <header class="hero-section flex items-center justify-center text-center py-20 px-4 sm:px-6 lg:px-8 bg-indigo-700">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight text-white mb-6">
                        Unlock Your Potential with Our Interactive Learning Platform
                    </h1>
                    <p class="text-lg sm:text-xl text-indigo-100 mb-10">
                        Dive into engaging courses, track your progress, and master new skills at your own pace. Join a community built for growth.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-md shadow-lg text-indigo-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white dark:focus:ring-offset-indigo-700 transition ease-in-out duration-150">
                            Start Your Journey Today
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 border border-white text-lg font-medium rounded-md shadow-sm text-white hover:bg-white hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white dark:focus:ring-offset-indigo-700 transition ease-in-out duration-150">
                            Already a Member? Log In
                        </a>
                    </div>
                </div>
            </header>

            <section class="py-16 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl mb-12">
                        What You'll Gain
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
                            <svg class="h-12 w-12 text-indigo-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18c-1.657 0-3-.895-3-2s1.343-2 3-2 3 .895 3 2-1.343 2-3 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22c-1.657 0-3-.895-3-2s1.343-2 3-2 3 .895 3 2-1.343 2-3 2zM12 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12c-1.657 0-3-.895-3-2s1.343-2 3-2 3 .895 3 2-1.343 2-3 2zM20 12c-1.657 0-3-.895-3-2s1.343-2 3-2 3 .895 3 2-1.343 2-3 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4c1.657 0 3-.895 3-2s-1.343-2-3-2-3-.895-3-2 1.343-2 3-2zM12 20c-1.657 0-3-.895-3-2s1.343-2 3-2 3 .895 3 2-1.343 2-3 2z"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Personalized Learning</h3>
                            <p class="text-gray-600 dark:text-gray-300">Tailored content and paths that adapt to your unique learning style and goals.</p>
                        </div>
                        <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
                            <svg class="h-12 w-12 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Progress Tracking</h3>
                            <p class="text-gray-600 dark:text-gray-300">Monitor your achievements and see how far you've come with detailed insights.</p>
                        </div>
                        <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-lg shadow-md">
                            <svg class="h-12 w-12 text-purple-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5m-1.5-1.5L9 14m-1-5l6-6m-4 12l5-5L9 7l4-4m-1 12l4-4m-12 5l-5-5-2 2-2 2L4 12"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Engaging Content</h3>
                            <p class="text-gray-600 dark:text-gray-300">Interactive lessons, quizzes, and resources to keep you motivated and learning.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16 bg-gray-100 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl mb-12">
                        How It Works
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="step-card p-6 rounded-lg">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-indigo-500 text-white rounded-full text-2xl font-bold mb-4">1</div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Sign Up</h3>
                            <p class="text-gray-600 dark:text-gray-300">Create your free account in minutes to get started on your learning journey.</p>
                        </div>
                        <div class="step-card p-6 rounded-lg">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-indigo-500 text-white rounded-full text-2xl font-bold mb-4">2</div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Explore Courses</h3>
                            <p class="text-gray-600 dark:text-gray-300">Browse our extensive library of courses across various topics and skill levels.</p>
                        </div>
                        <div class="step-card p-6 rounded-lg">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto bg-indigo-500 text-white rounded-full text-2xl font-bold mb-4">3</div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Start Learning</h3>
                            <p class="text-gray-600 dark:text-gray-300">Dive into interactive lessons, complete challenges, and track your progress.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16 bg-indigo-600 dark:bg-indigo-900 text-white text-center">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-extrabold mb-4">Ready to Transform Your Skills?</h2>
                    <p class="text-lg mb-8">Join thousands of learners achieving their goals with us.</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-4 border border-transparent text-lg font-bold rounded-md shadow-lg text-indigo-700 bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white dark:focus:ring-offset-indigo-900 transition ease-in-out duration-150">
                        Register for Free
                    </a>
                </div>
            </section>

            <footer class="py-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </footer>
        </div>
    </body>
</html>