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
        session()->flash('ingredients', $request->input('ingredients'));
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
        Step one:
        Step two:
        Step three:
        
        Do not include unnecessary text. Respond only to queries related to recipes or those that mention food which you are then going to use to come up with a recipe. For any other request, reply with exactly: 'Please ask me about a recipe!'";

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



