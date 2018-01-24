<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Models\Permission;
use App\Services\PermissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::topPermissions();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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
            $needs = $this->validator('admin.permission.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        DB::table('permissions')->insert(array_merge($needs, ['created_at' => Carbon::now(), 'guard_name' => 'admin']));
        $this->permissionService->resetBreadCrumbCache();
        return succeed('新增权限菜单成功');
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
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $needs = $this->validator('admin.permission.store');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $permission->update($needs);
        $this->permissionService->resetBreadCrumbCache();
        return succeed('更新权限菜单成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->roles()->detach();
        $permission->delete();
        $this->permissionService->resetBreadCrumbCache();
        return succeed('删除成功');
    }
}
