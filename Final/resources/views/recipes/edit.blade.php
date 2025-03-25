<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ $recipe->title }}" class="w-full border rounded p-2">
                </div>
                <div>
                    <label for="ingredients" class="block text-gray-700">Ingredients</label>
                    <textarea name="ingredients" class="w-full border rounded p-2">{{ $recipe->ingredients }}</textarea>
                </div>
                <div>
                    <label for="instructions" class="block text-gray-700">Instructions</label>
                    <textarea name="instructions" class="w-full border rounded p-2">{{ $recipe->instructions }}</textarea>
                </div>
                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
