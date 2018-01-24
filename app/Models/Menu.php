<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'description', 'icon', 'slug', 'weight', 'top_id', 'is_show'
    ];

    public function scopeTops($query, $parent = 0)
    {
        return $query->where('top_id', $parent);
    }

    public function childers()
    {
        return $this->hasMany(self::class, 'top_id')->orderBy('weight', 'asc');
    }
}
