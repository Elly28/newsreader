<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Models\SoccerNews;
use jcobhams\NewsApi\NewsApi;
use Carbon\Carbon;

class NewsController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index() {
                
        $latestSoccerNews = SoccerNews::latest()->paginate(10);
        $news = NewsArticle::latest()->paginate(10);//get latest news articles from the database & paginate with 10 articles per page
        $latestArticles = NewsArticle::orderBy('created_at', 'desc')->take(3)->get();
        $latestArticle = NewsArticle::latest()->first(['title', 'content', 'category', 'published_at']);
        $categories = ["General", "Sport", "Lifestyle", "Travel", "Technology"];
        $weeklyTopNews = NewsArticle::where('published_at', '>=', now()->subDays(7))->take(5)->get();

        $trendingNews = [
            [
            "title" =>"This is an example of what will be displayed, this is first slide",
            "link" =>"https://www.google.com",
            ],
            [
            "title" =>"This is an example of what will be displayed, this is second slide",
            "link" =>"https://www.google.com",
            ],
            [
            "title" =>"This is an example of what will be displayed, this is third slide",
            "link" =>"https://www.google.com",
            ]
        ];

        return view('welcome', compact('news', 'latestArticles', 'latestArticle', 'weeklyTopNews', 'categories', 'trendingNews', 'latestSoccerNews'));
    }

        
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id) {
        $article = NewsArticle::findOrFail($id);
        return view('news.show', compact('article'));
    }
    
    /**
     * filterByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function filterByCategory($category) {
        $news = NewsArticle::where('category', $category)->latest()->paginate(10);
        return view('news.index', compact('news'));
    }
    
    /**
     * fetchLatestNews
     *
     * @return void
     */
    public function fetchLatestNews() {
        $country = 'us';
        $newsapi = new NewsApi(env('NEWS_API_KEY'));
        $top_headlines = $newsapi->getTopHeadlines($country);

        $articles = $top_headlines->articles ?? [];

        foreach ($articles as $article) {
            $timestamp = Carbon::parse($article->publishedAt)->timestamp;
            $published_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString() ?? now();

            NewsArticle::updateOrCreate(
                ['title' => trim($article->title)],
                [
                    'content' => trim($article->content) ?? 'No content available',
                    'category' => $article->category ?? 'General',
                    'source' => $article->source->name ?? 'Unknown',
                    'published_at' => $published_at,
                ]
            );
        }
    }
    
    /**
     * saveForOffline
     *
     * @param  mixed $id
     * @return void
     */
    public function saveForOffline($id) {
        $article = NewsArticle::findOrFail($id);
        $article->update(['offline_available' => true]);
        return back()->with('success', 'Article saved for offline reading.');
    }
    
    /**
     * offlineArticles
     *
     * @return void
     */
    public function offlineArticles() {
        $news = NewsArticle::where('offline_available', true)->get();
        return view('news.offline', compact('news'));
    }

    /*
    public function addToFavorites($articleId)
    {
        // Get the current authenticated user
        $user = auth()->user();

        // Find the article by its ID
        $article = NewsArticle::findOrFail($articleId);

        // Add the article to the user's favorites
        $user->favoriteArticles()->attach($article);

        // Redirect back with a success message
        return back()->with('message', 'Article added to favorites!');
    }

    // app/Http/Controllers/NewsController.php

    public function removeFromFavorites($articleId)
    {
        // Get the current authenticated user
        $user = auth()->user();

        // Find the article by its ID
        $article = NewsArticle::findOrFail($articleId);

        // Remove the article from the user's favorites
        $user->favoriteArticles()->detach($article);

        // Redirect back with a success message
        return back()->with('message', 'Article removed from favorites.');
    }

    public function showFavorites()
    {
        // Get the current authenticated user's favorite articles
        $favorites = auth()->user()->favoriteArticles;

        // Return the view and pass the favorite articles
        return view('favorites', compact('favorites'));
    }

    */

}
