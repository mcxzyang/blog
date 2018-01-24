<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = AdminUser::when($request->username, function($query) use ($request) {
            return $query->where('username', 'like', '%'.$request->username.'%');
        })->when($request->nickname, function($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->nickname.'%');
        })->paginate(config('system.admin.per_page'));
        return view('admin.admin_user.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admin_user.create', compact('roles'));
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
            $needs = $this->validator('admin.user.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        AdminUser::create(array_except($needs, ['roles']))->syncRoles($needs['roles'] ?: []);
        return succeed('新增管理员成功');
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
        $adminUser = AdminUser::where('id', $id)->first();
        $roles = Role::all();
        return view('admin.admin_user.edit', compact('adminUser', 'roles'));
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
            $needs = $this->validator('admin.user.update');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $result = AdminUser::where('id', '<>', $id)->where('username', $needs['username'])->first();
        if($result){
            return failed('此用户名已经被使用');
        }
        $password = $needs['password'];
        unset($needs['password']);
        $adminUser = AdminUser::where('id', $id)->first();
        $adminUser->fill(array_except($needs, ['roles']));
        if($password){
            $adminUser->password = $password;
        }
        $adminUser->save();

        $adminUser->syncRoles($needs['roles'] ?: []);

        return succeed('信息更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AdminUser::find($id);
        $user->roles()->detach();
        $user->delete();
        return succeed('删除成功');
    }
}
