<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use jcobhams\NewsApi\NewsApi;
use Carbon\Carbon;
use GuzzleHttp\Client;

class NewsController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index() {

        $news = NewsArticle::latest()->paginate(10);//get latest news articles from the database & paginate with 10 articles per page
        $latestArticles = NewsArticle::orderBy('created_at', 'desc')->take(3)->get();
        $latestArticle = NewsArticle::latest()->first(['title', 'content', 'category', 'published_at']);

        // $topNews = NewsArticle::where('published_at', '>=', now()->subDays(7))
        // ->orderBy('views', 'desc') // Order by most viewed articles
        // ->take(5) // Limit to top 5 articles
        // ->get();
        $weeklyTopNews = NewsArticle::where('published_at', '>=', now()->subDays(7))->take(5)->get();

        return view('welcome', compact('news', 'latestArticles', 'latestArticle', 'weeklyTopNews'));
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

        $this->fetchLatestSoccerNews();

        return redirect('/')->with('success', 'News updated successfully!');
    }

    public function fetchLatestSoccerNews(){
        $client = new Client();

        $response = $client->request('GET', 'https://real-time-sports-news-api.p.rapidapi.com/live-articles', [
            'headers' => [
                'x-rapidapi-host' => 'real-time-sports-news-api.p.rapidapi.com',
                'x-rapidapi-key' => '4d1a3aae23msh6ec3258aedc6030p1bc537jsn8d62e6d76cb4',
            ],
        ]);

        $articles = $response->getBody() ?? [];

        if (!$articles) {
            foreach (json_decode($response->getBody(), true) as $article) {
                $dateString = $article['pubDate'];
                $published_at = Carbon::createFromFormat('D, d M Y H:i:s', $dateString)->format('Y-m-d H:i:s') ?? now();

                NewsArticle::updateOrCreate(
                    ['title' => trim($article->title)],
                    [
                        'content' => trim($article->content) ?? 'No content available',
                        'category' => 'Sport',
                        'source' => $article['provider'] ?? 'Unknown',
                        'published_at' => $published_at,
                    ]
                );
            }
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
