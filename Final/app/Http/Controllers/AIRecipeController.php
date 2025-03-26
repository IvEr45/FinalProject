<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIRecipeController extends Controller
{
    public function suggestRecipe(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|string',
        ]);

        $userMessage = $request->input('ingredients');
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

        // System instruction to enforce structured recipe response
        $systemInstruction = "You are an AI chef. Always provide recipes in this format:

        Title: [Recipe Title]
        
        Ingredients:
        - Ingredient 1
        - Ingredient 2
        - Ingredient 3
        
        Instructions:
        1. Step one
        2. Step two
        3. Step three
        
        Do not include unnecessary text. From here on, if user ask for a query not related to recipes, say these exact words and nothing else:'Please ask me about a recipe!
'";

        $fullPrompt = $systemInstruction . "\nUser: " . $userMessage;

        $response = Http::post($url, [
            'contents' => [
                ['parts' => [['text' => $fullPrompt]]]
            ]
        ]);

        $data = $response->json();
        $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? "I couldn't generate a recipe for that.";

        // Store the full AI response in session for debugging
        return back()->with('ai_recipe_raw', $aiResponse);
    }
}



