<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'image', 'album_id', 'is_hight_product', 'weight', 'content', 'content_raw'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }
}
