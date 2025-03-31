<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('recipes.store') }}">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Recipe Title') }}
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title"
                                value="{{ old('title', session('prefill_title', '')) }}" 
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                                placeholder="{{ __('Enter recipe title') }}"
                            >
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ingredients" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Ingredients') }}
                            </label>
                            <textarea 
                                name="ingredients" 
                                id="ingredients"
                                rows="5" 
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                                placeholder="{{ __('List ingredients, one per line') }}"
                            >{{ old('ingredients', session('prefill_ingredients', '')) }}</textarea>
                            @error('ingredients')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instructions" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Cooking Instructions') }}
                            </label>
                            <textarea 
                                name="instructions" 
                                id="instructions"
                                rows="7" 
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                                placeholder="{{ __('Provide step-by-step cooking instructions') }}"
                            >{{ old('instructions', session('prefill_instructions', '')) }}</textarea>
                            @error('instructions')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="mr-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200"
                            >
                                {{ __('Cancel') }}
                            </a>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-gray uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 transition dark:text-white "
                            >
                                {{ __('Save Recipe') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>