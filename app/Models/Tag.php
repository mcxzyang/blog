<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title', 'weight'
    ];

    public static $tagColorArr = [
        'default', 'primary', 'success', 'info', 'warning', 'danger'
    ];
}
