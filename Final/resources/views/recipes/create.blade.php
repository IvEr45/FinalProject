<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('recipes.store') }}">
                @csrf
                <div>
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2">
                </div>
                <div>
                    <label for="ingredients" class="block text-gray-700">Ingredients</label>
                    <textarea name="ingredients" class="w-full border rounded p-2"></textarea>
                </div>
                <div>
                    <label for="instructions" class="block text-gray-700">Instructions</label>
                    <textarea name="instructions" class="w-full border rounded p-2"></textarea>
                </div>
                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
