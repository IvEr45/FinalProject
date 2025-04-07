
<x-app-layout>
    
<x-slot name="header">
    
    <a href="/dashboard">
    <div class="flex flex-col items-center">
    <!-- Light mode logo -->
    <img src="{{ asset('images/dark.png') }}" alt="FlavorBot Logo" 
         class="h-12 w-12 block dark:hidden">

    <!-- Dark mode logo -->
    <img src="{{ asset('images/logo.png') }}" alt="FlavorBot Logo Dark" 
         class="h-12 w-12 hidden dark:block">

    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
        FlavorBot
    </h2>
</div>
    </a>
</x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- AI Recipe Suggestion Form --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Get AI Recipe Suggestions</h3>
                <form method="POST" action="{{ route('suggest.recipe') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="ingredients" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Enter Ingredients
                        </label>
                        <textarea 
    name="ingredients" 
    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg p-3 
           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
           dark:bg-gray-700 dark:text-gray-200" 
    rows="4" 
    placeholder="List your ingredients (e.g., chicken, tomatoes, pasta)"
    required
>{{ session('ingredients') }}</textarea>
                    </div>
                    <button 
                        type="submit" 
                        class="w-full bg-gray-100 dark:bg-gray-900 text-gray px-4 py-2 rounded-lg 
                        dark:text-white
                               hover:bg-indigo-700 transition-colors duration-300 
                               hover:text-white
                               font-bold"
                    >
                        Get Suggestion
                    </button>
                </form>
            </div>

            {{-- Display AI Response --}}
            @if(session('ai_recipe_raw'))
                @php
                $aiRecipe = session('ai_recipe_raw');
                $isInvalidResponse = !str_starts_with(trim($aiRecipe), "Title");
                @endphp

                <div class="bg-gray-100 dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">FlavorBot Replies:</h4>
                    <pre class="bg-white dark:bg-gray-900 p-4 rounded-lg text-sm text-gray-800 dark:text-gray-200 
                                overflow-x-auto whitespace-pre-wrap border border-gray-200 dark:border-gray-700">
{{ $aiRecipe }}</pre>

                    @if(!$isInvalidResponse)
                        <form method="POST" action="{{ route('recipes.prefill') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="ai_recipe_raw" value="{{ $aiRecipe }}">
                            <button 
                                type="submit" 
                                class="w-full bg-gray-100 dark:bg-gray-900 text-gray px-4 py-2 rounded-lg 
                        dark:text-white
                               hover:bg-indigo-700 transition-colors duration-300 
                               hover:text-white
                               font-bold"
                            >
                                Save Recipe
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            {{-- Two-Column Layout for Saved Recipes --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Your Recipes</h3>
                    <a 
    href="{{ route('recipes.create') }}" 
    class="bg-gray-100 dark:bg-gray-900 px-4 py-2 rounded-lg 
           hover:bg-indigo-700 transition-colors duration-300 
            hover:text-white

           font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 
           dark:text-white text-gray"
>
    Add Recipe
</a>
                </div>

                @if(auth()->user()->recipes->count() > 0)
                    <div class="grid grid-cols-3 gap-6">
                        {{-- Left: Recipe Titles --}}
                        <div class="col-span-1 bg-gray-50 dark:bg-gray-900 p-4 rounded-lg border">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recipe List</h4>
                            <ul class="space-y-3">
                                @foreach (auth()->user()->recipes as $recipe)
                                    <li>
                                    <button 
    class="w-full text-left bg-white dark:bg-gray-800 border p-3 rounded-lg 
           hover:bg-gray-200 dark:hover:bg-gray-700 transition  text-gray-900 dark:text-white 
           px-4"
    onclick="displayRecipe(`{{ $recipe->id }}`, `{{ addslashes($recipe->title) }}`, 
                            `{{ addslashes($recipe->ingredients) }}`, 
                            `{{ addslashes($recipe->instructions) }}`)">
    {{ $recipe->title }}
</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Right: Recipe Details --}}
                        <div class="col-span-2 bg-gray-100 dark:bg-gray-900 p-6 rounded-lg border" id="recipeDetails">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recipe Details</h4>
                            <div id="recipeContent">
                                <p class="text-gray-500 dark:text-gray-400">Click on a recipe to view details.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">
                        You haven't added any recipes yet.
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- JavaScript to Display Recipe Details --}}
    <script>
        function displayRecipe(id, title, ingredients, instructions) {
            let ingredientsList = ingredients.split("\n").map(item => `<li>${item.trim()}</li>`).join("");
            ingredientsList = `<ul class="list-disc list-inside text-gray-700 dark:text-gray-400">${ingredientsList}</ul>`;

            let instructionsList = instructions.split("\n").map(item => `<li>${item.trim()}</li>`).join("");
            instructionsList = `<ul class="list-decimal list-inside text-gray-700 dark:text-gray-400">${instructionsList}</ul>`;

            document.getElementById('recipeContent').innerHTML = `
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">${title}</h3>
                <p><strong class="text-gray-800 dark:text-gray-300">Ingredients:</strong></p>
                ${ingredientsList}
                <p class="mt-2"><strong class="text-gray-800 dark:text-gray-300">Instructions:</strong></p>
                ${instructionsList}
                <div class="mt-4 flex space-x-4">
    <a href="/recipes/${id}/edit" 
   class="bg-white-200 dark:bg-gray-800 text-gray px-4 py-2 rounded-lg 
          
          font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
          dark:text-white text-gray-900">
    Edit
</a>
    <form action="/recipes/${id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg 
                       hover:bg-indigo-700 transition-colors duration-300 
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Delete
        </button>
    </form>
</div>

            `;
        }
    </script>
</x-app-layout>
