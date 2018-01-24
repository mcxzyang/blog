<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Models\Album;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MarkdownEditor;
use DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::when($request->title, function($query) use ($request) {
            return $query->where('title', 'like', '%'.$request->title.'%');
        })->orderBy('id', 'desc')->paginate(config('system.admin.per_page'));
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        $albums = Album::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.article.create', compact('tags', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $needs = $this->validator('admin.article.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $content = MarkdownEditor::parse($needs['content_raw']);
        $tagArr = $needs['tag_id'];

        $article = Article::create(array_merge(array_except($needs, 'tag_id'), ['content' => $content]));

        $article->tags()->attach($tagArr);

        return succeed('新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        $tags = Tag::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        $albums = Album::orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.article.edit', compact('article', 'tags', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $needs = $this->validator('admin.article.update');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $article = Article::where('id', $id)->first();
        $content = MarkdownEditor::parse($needs['content_raw']);
        $tagArr = $needs['tag_id'];

        $article->update(array_merge(array_except($needs, 'tag_id'), ['content' => $content]));

        $article->tags()->sync($tagArr);

        return succeed('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            DB::table('article_tags')->where('article_id', $id)->delete();
            DB::table('articles')->where('id', $id)->delete();

            DB::commit();
            return succeed('删除成功');
        } catch (\PDOException $e) {
            DB::rollBack();
            return failed($e->getMessage());
        }
    }
}
