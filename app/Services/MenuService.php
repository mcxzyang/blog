<?php

namespace App\Services;

use App\Models\Permission;
use Cache;

class MenuService
{
    /**
     * 顶级菜单
     * @return mixed
     */
    public function getMenu()
    {
        return Permission::tops()->with('childers')->orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
    }

    /**
     * 菜单高亮
     * @param $child
     *
     * @return bool
     */
    public function checkParent($child)
    {
        $current = \Route::currentRouteName();
        $result = Permission::where('name', $current)->first(); //当前权限菜单
        return $result->id == $child->id || $result->fid == $child->id;
    }

    /**
     * 菜单 第一个 menu
     * @param $menu
     *
     * @return bool
     */
    public function checkFirstMenu($menu)
    {
        $current = \Route::currentRouteName();
        $result = Permission::where('name', $current)->first(); //当前权限菜单
        
        $permissionRp = new PermissionService();
        $currentTopPermission = $permissionRp->getTopPermission($result);

        return $currentTopPermission && $currentTopPermission->id == $menu->id;
    }

    /**
     * 菜单 第一个 a 标签的 active
     * @param $menu
     *
     * @return bool
     */
    public function checkActive($menu)
    {
        $current = \Route::currentRouteName();
        return $menu->name == $current;
    }

    /**
     * 格式化所有菜单
     * @param int $fid
     *
     * @return string
     */
    public function topPermissionSelect($fid = 0)
    {
        $tops = Permission::tops()->orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
        $select = '<select class="form-control input-sm" name="fid">';
        $select .= '<option value="0">--顶级权限--</option>';
        if($tops->count()){
            foreach ($tops as $top) {
                if($top->id == $fid){
                    $select .= '<option value="'.$top->id.'" selected>'.$top->display_name.'</option>';
                } else{
                    $select .= '<option value="'.$top->id.'">'.$top->display_name.'</option>';
                }
                if(count($top->childers)){
                    foreach ($top->childers as $child) {
                        if($child->id == $fid){
                            $select .= '<option value="'.$child->id.'" selected>--'.$child->display_name.'</option>';
                        } else{
                            $select .= '<option value="'.$child->id.'">--'.$child->display_name.'</option>';
                        }

                    }
                }
            }
        }
        $select .= '</select>';
        //dd($select);
        return $select;
    }
}
