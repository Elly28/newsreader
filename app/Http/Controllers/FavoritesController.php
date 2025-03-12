<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // Add to favorites
    public function favorite(Request $request, $articleId)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $article = NewsArticle::findOrFail($articleId);

        // Get category_id from the request
        $category = $request->input('category');

        // Check if the user has already favorited the article in this category
        if (!$user->favorites()->where('news_article_id', $articleId)->where('category', $category)->exists()) {
            // Attach the article to the user's favorites for a specific category
            $user->favorites()->attach($articleId, ['category' => $category]);
        }

        return back()->with('success', 'Article added to favorites');
    }

    // Remove from favorites
    public function unfavorite(Request $request, $articleId)
    {
        $user = Auth::user();
        $article = NewsArticle::findOrFail($articleId);

        // Get category_id from the request
        $categoryId = $request->input('category');

        // Detach the article from the user's favorites in this category
        $user->favorites()->detach($articleId, ['category' => $categoryId]);

        return back()->with('success', 'Article removed from favorites');
    }

    // Display all favorites for the logged-in user
    public function showFavorites()
    {
        $favorites = Auth::user()->favorites;

        return view('favorites.index', compact('favorites'));
    }
}
