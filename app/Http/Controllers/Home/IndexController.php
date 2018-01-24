<?php

namespace App\Http\Controllers\Home;

use App\Models\Ad;
use App\Models\Album;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $ads = Ad::orderBy('weight', 'asc')->orderBy('id', 'desc')->limit(5)->get();

        $albums = Album::where('is_high', 1)->orderBy('weight', 'asc')->orderBy('id', 'desc')->limit(2)->get();

        $tags = Tag::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();

        $articles = Article::orderBy('weight', 'asc')->orderBy('id', 'desc')->paginate(9);
        return view('home.index.index', compact('ads', 'albums', 'tags', 'articles'));
    }
}
