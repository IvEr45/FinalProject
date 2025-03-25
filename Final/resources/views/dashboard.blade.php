<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- AI Recipe Suggestion Form --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold">Get AI Recipe Suggestions</h3>
                <form method="POST" action="{{ route('suggest.recipe') }}">
                    @csrf
                    <div>
                        <label for="ingredients" class="block text-gray-700">Enter Ingredients</label>
                        <textarea name="ingredients" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Get Suggestion</button>
                </form>
            </div>

            {{-- Display AI Response --}}
            @if(session('ai_recipe_raw'))
                <div class="bg-gray-100 p-4 border rounded shadow-md">
                    <h4 class="text-lg font-semibold">AI-Generated Recipe:</h4>
                    <pre class="whitespace-pre-wrap">{{ session('ai_recipe_raw') }}</pre>

                    {{-- Save Recipe Form --}}
                    <form method="POST" action="{{ route('recipes.prefill') }}">
                        @csrf
                        <input type="hidden" name="ai_recipe_raw" value="{{ session('ai_recipe_raw') }}">
                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Save Recipe</button>
                    </form>
                </div>
            @endif

            {{-- User's Recipes --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold">Your Recipes</h3>
                <a href="{{ route('recipes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Recipe</a>
                
                @foreach (auth()->user()->recipes as $recipe)
                    <div class="mt-4 border-b pb-2">
                        <h3 class="text-lg font-semibold">{{ $recipe->title }}</h3>
                        <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
                        <p><strong>Instructions:</strong> {{ $recipe->instructions }}</p>
                        <div class="mt-2">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
