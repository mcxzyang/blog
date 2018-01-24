<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title', 'description', 'author_id', 'image', 'is_high', 'weight', 'view_number', 'like_number'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
