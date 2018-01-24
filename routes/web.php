<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Home'], function(){
    Route::get('/', 'IndexController@index');
    Route::get('album', 'AlbumController@index');
    Route::get('album/{id}', 'AlbumController@show');
    Route::get('stat', 'StatController@index');

    Route::get('article/{id}', 'ArticleController@show');
});