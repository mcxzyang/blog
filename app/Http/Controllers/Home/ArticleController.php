<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::where('id', $id)->first();
        return view('home.article.show', compact('article'));
    }
}
