<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albums = Album::when($request->title, function($query) use ($request) {
            return $query->where('title', 'like', '%'.$request->title.'%');
        })->orderBy('id', 'desc')->paginate(config('system.admin.per_page'));
        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
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
            $needs = $this->validator('admin.album.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        Album::create($needs);
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
        $album = Album::where('id', $id)->first();
        return view('admin.album.edit', compact('album'));
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
            $needs = $this->validator('admin.album.update');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $album = Album::where('id', $id)->first();
        $album->update($needs);

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

            DB::table('articles')->where('album_id', $id)->update([
                'album_id' => 0
            ]);

            DB::table('albums')->where('id', $id)->delete();

            DB::commit();
            return succeed('删除成功');
        } catch (\PDOException $e) {
            DB::rollBack();
            return failed($e->getMessage());
        }
    }
}
