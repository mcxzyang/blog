<?php
/**
 * 专辑
 */

namespace App\Http\Controllers\Home;

use App\Models\Album;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        return view('home.album.index', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::where('id', $id)->first();
        $articles = Article::where('album_id', $id)->orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        return view('home.album.show', compact('album', 'articles'));
    }
}
