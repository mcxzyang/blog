<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::when($request->alias, function($query) use ($request) {
            return $query->where('alias', 'like', '%'.$request->alias.'%');
        })->paginate(config('system.admin.per_page'));
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::tops()->with('childers')->orderBy('weight', 'asc')->get();
        return view('admin.role.create', compact('permissions'));
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
            $needs = $this->validator('admin.role.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }

        Role::create(array_merge(array_only($needs, ['name', 'alias', 'description']), ['guard_name' => 'admin']))->syncPermissions($needs['permissions'] ?: []);
        return succeed('添加角色成功');
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
        $role = Role::where('id', $id)->first();
        $permissions = Permission::tops()->with('childers')->orderBy('weight', 'asc')->get();
        return view('admin.role.edit', compact('role', 'permissions'));
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
            $needs = $this->validator('admin.role.update');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $role = Role::find($id);
        $role->update(array_except($needs, ['permissions']));
        $role->syncPermissions($needs['permissions'] ?: []);

        return succeed('更新角色成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        return succeed('角色删除成功');
    }
}
