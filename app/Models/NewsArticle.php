<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsArticle extends Model
{
    use HasFactory;

    // Add 'content' to the fillable property
    protected $fillable = [
        'title',
        'content',  // <-- Add 'content' here
        'category',
        'source',
        'published_at',
    ];

    public function usersWhoFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
