<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Recipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('recipes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Recipe</a>
            <div class="mt-4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @foreach ($recipes as $recipe)
                    <div class="mb-4 border-b pb-2">
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
