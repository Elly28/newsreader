<?php

namespace App\Http\Controllers;

use App\Models\SoccerNews;

class SoccerNewsController extends Controller
{
    /**
     * fetchLatestSoccerNews
     *
     * @return void
     */
    public function fetchLatestSoccerNews(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://real-time-sports-news-api.p.rapidapi.com/live-articles",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: real-time-sports-news-api.p.rapidapi.com",
                "x-rapidapi-key: 4d1a3aae23msh6ec3258aedc6030p1bc537jsn8d62e6d76cb4"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $articles = $response ?? [];

        if ($articles) {
            foreach (json_decode($articles, true) as $article) {
                
                SoccerNews::updateOrCreate(
                    ['title' => trim($article['title'])],
                    [
                        'content' => trim($article['content']) ?? 'No content available',
                        'link' => trim($article['link']) ?? '',
                        'category' => 'Sport',
                        'source' => $article['provider'] ?? 'Unknown',
                        'published_at' => trim($article['pubDate']),
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = SoccerNews::findOrFail($id);
        $article->increment('read_count');
        $categories = ["General", "Sport", "Lifestyle", "Travel", "Technology"];
        return view('news.show', compact('article', 'categories'));
    }
}
