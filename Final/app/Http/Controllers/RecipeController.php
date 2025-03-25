<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function prefill(Request $request)
    {
        $aiRecipeRaw = $request->input('ai_recipe_raw');

        // Extract title, ingredients, and instructions using regex
        preg_match('/Title:\s*(.*)/i', $aiRecipeRaw, $titleMatch);
        preg_match('/Ingredients:\s*([\s\S]*?)Instructions:/i', $aiRecipeRaw, $ingredientsMatch);
        preg_match('/Instructions:\s*([\s\S]*)/i', $aiRecipeRaw, $instructionsMatch);

        $title = $titleMatch[1] ?? 'Untitled Recipe';
        $ingredients = $ingredientsMatch[1] ?? 'No ingredients found.';
        $instructions = $instructionsMatch[1] ?? 'No instructions found.';

        // Redirect to create page with extracted data
        return redirect()->route('recipes.create')
                         ->with('prefill_title', trim($title))
                         ->with('prefill_ingredients', trim($ingredients))
                         ->with('prefill_instructions', trim($instructions));
    }
    public function index()
    {
        $recipes = Recipe::where('user_id', Auth::id())->get();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        Recipe::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('dashboard')->with('success', 'Recipe created successfully.');
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        $recipe->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $recipe->delete();
        return redirect()->route('dashboard')->with('success', 'Recipe deleted successfully.');
    }
}
