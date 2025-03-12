<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoccerNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',  // <-- Add 'content' here
        'link',
        'read_count',
        'category',
        'source',
        'published_at',
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withPivot('category') 
                    ->withTimestamps();
    }
}
