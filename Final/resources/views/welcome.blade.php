<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark:bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FlavorBot - AI-Powered Recipe Generator</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-white text-gray-800 font-sans dark:bg-gray-900 dark:text-gray-100">
        
    <header class="dark:from-gray-800 dark:to-gray-900">
        <!-- Navigation bar -->
        <nav class="bg-white dark:bg-gray-900 shadow-sm">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center">
                    <!-- Logo placeholder -->
                    <a href="/">
                        <div class="flex flex-col items-center">
                            <!-- Light mode logo -->
                            <img src="{{ asset('images/dark.png') }}" alt="FlavorBot Logo" 
                                 class="h-12 w-12 block dark:hidden">
                            <!-- Dark mode logo -->
                            <img src="{{ asset('images/logo.png') }}" alt="FlavorBot Logo Dark" 
                                 class="h-12 w-12 hidden dark:block">
                        </div>
                    </a>

                    <span class="font-bold text-xl text-gray-800 dark:text-white">FlavorBot</span>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Header content -->
        <div class="text-center bg-gradient-to-r from-gray-600 to-gray-700 text-white py-8 shadow-md dark:from-gray-800 dark:to-gray-900">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl md:text-4xl font-bold">Welcome to FlavorBot</h1>
                <p class="text-base md:text-lg mt-2 max-w-2xl mx-auto">Your AI-powered companion for creating delicious recipes from your imagination!</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto flex flex-col items-center text-center p-8 max-w-4xl">
        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md p-8 mb-8 w-full">
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                Discover new flavors, create personalized recipes, and explore the world of culinary possibilities with FlavorBot.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-indigo-800">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-200 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-300 transition focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 dark:bg-indigo-700 dark:text-indigo-200 dark:hover:bg-indigo-600 dark:focus:ring-indigo-500 dark:focus:ring-offset-indigo-800">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        
        <!-- Feature highlights -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
            <div class="bg-gray-50 p-6 rounded-lg shadow-md dark:bg-gray-800">
                <svg class="w-12 h-12 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <h3 class="text-lg font-semibold mb-2">AI-Powered Recipes</h3>
                <p class="text-gray-600 dark:text-gray-400">Generate unique recipes tailored to your preferences and dietary needs.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md dark:bg-gray-800">
                <svg class="w-12 h-12 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                </svg>
                <h3 class="text-lg font-semibold mb-2">Save & Share</h3>
                <p class="text-gray-600 dark:text-gray-400">Build your personal cookbook and share your favorite recipes with friends.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md dark:bg-gray-800">
                <svg class="w-12 h-12 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <h3 class="text-lg font-semibold mb-2">Community Feedback</h3>
                <p class="text-gray-600 dark:text-gray-400">Get tips, variations, and reviews from our growing community of food enthusiasts.</p>
            </div>
        </div>
    </main>

    <footer class="bg-gray-100 dark:bg-gray-800 py-6 mt-12">
        <div class="container mx-auto px-4 text-center text-gray-600 dark:text-gray-400">
            <p>&copy; 2025 FlavorBot™. All rights reserved.</p>
        </div>
    </footer>

    </body>
</html>
