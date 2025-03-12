<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Http\Controllers\SoccerNewsController;
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

        $articlesCount = NewsArticle::count();
        $soccerArticlesCount = SoccerNews::count();

        if ($articlesCount === 0) {
            $this->fetchLatestNews();
        }

        if ($soccerArticlesCount === 0) {
            $soccer = new SoccerNewsController();
            $soccer->fetchLatestSoccerNews();
        }
                
        $latestSoccerNews = SoccerNews::latest()->paginate(10);
        $latestArticles = NewsArticle::orderBy('created_at', 'desc')->get();

        $mostReadNews = NewsArticle::where('read_count', '>', 0)->orderBy('read_count', 'desc')->take(4)->get();
        $mostReadSoccerNews = SoccerNews::where('read_count', '>', 0)->orderBy('read_count', 'desc')->take(4)->get();
        
        $categories = ["General", "Sport", "Lifestyle", "Travel", "Technology"];
        $weeklyTopNews = NewsArticle::where('published_at', '>=', now()->subDays(7))->take(5)->get();

        return view('welcome', 
            compact('latestArticles', 'weeklyTopNews', 'categories', 'latestSoccerNews', 'mostReadNews', 'mostReadSoccerNews')
        );
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id) {
        $article = NewsArticle::findOrFail($id);
        $article->increment('read_count');
        $categories = ["General", "Sport", "Lifestyle", "Travel", "Technology"];
        return view('news.show', compact('article', 'categories'));
    }
    
    /**
     * filterByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function filterByCategory($category) {
        
        switch ($category) {
            case 'all':
                //General
                $articles = NewsArticle::latest()->take(4)->get();
                return response()->json(['bool' => true, 'data' => $articles], 200);
                break;
            case 'sports':
                $articles = SoccerNews::latest()->take(4)->get();
                return response()->json(['bool' => true, 'data' => $articles], 200);
                break;
            
            default:
                # code...
                break;
        }
        
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
