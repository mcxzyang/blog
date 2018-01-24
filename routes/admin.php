<?php
/**
 * User: yff
 * Date: 2017/12/25
 * Time: 下午4:25
 */

Route::name('admin.')->group(function(){
    Route::prefix('auth')->group(function($router){
        $router->get('login', 'AuthController@login')->name('auth.login');
        $router->post('login', 'AuthController@postLogin')->name('auth.post-login');
    });

    Route::middleware('authenticate.admin')->group(function($router){
        $router->get('/', 'IndexController@index')->name('index');

        $router->get('logout', 'AuthController@logout')->name('auth.logout');

        //账号信息
        $router->get('profile', 'AccountController@profile')->name('account.profile');
        $router->get('avatar', 'AccountController@avatar')->name('account.avatar');
        $router->get('password', 'AccountController@password')->name('account.password');
        $router->post('passwordHandle', 'AccountController@passwordHandle')->name('account.passwordHandle');

        //上传图片
        $router->post('uploadPic', 'ToolController@uploadPic')->name('tool.uploadPic');
        $router->post('uploadAvatar', 'ToolController@uploadAvatar')->name('tool.uploadAvatar');
        $router->post('uploadQiniu', 'ToolController@uploadPic')->name('tool.uploadQiniu');

        //权限管理
        $router->resource('permission', 'PermissionController');

        //管理员管理
        $router->resource('admin_user', 'AdminUserController');

        //角色管理
        $router->resource('role', 'RoleController');

        //轮播管理
        $router->resource('ad', 'AdController');

        //专辑管理
        $router->resource('album', 'AlbumController');

        //标签管理
        $router->resource('tag', 'TagController');

        //文章管理
        $router->resource('article', 'ArticleController');
    });
});
