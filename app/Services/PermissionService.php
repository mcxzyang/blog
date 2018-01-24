<?php
/**
 * User: yff
 * Date: 2017/12/26
 * Time: 下午10:41
 */

namespace App\Services;


use App\Models\Permission;

class PermissionService
{
    /**
     * 生成面包屑导航缓存
     * @param $file_path
     * @return string
     */
    public function getBreadCrumbCache($file_path) {
        $str = '<?php
        ';

        $str .= 'Breadcrumbs::register("admin.index", function ($breadcrumbs) {$breadcrumbs->push("首页", route("admin.index"));});';
        $permissions = \App\Models\Permission::orderBy('fid', 'asc')->orderBy('weight', 'desc')->get();
        if($permissions){
            foreach ($permissions as $permission) {
                if($permission->fid != 0 && $permission->name != 'admin.index'){
                    $parentFlag = $this->getParentInfo($permission->fid);
                    if($parentFlag){
                        $parentStr = sprintf('$breadcrumbs->parent("%s");$breadcrumbs->push("%s", "#");', $permission->parent_permission->name, $permission->display_name);
                    } else {
                        $parentStr = sprintf('$breadcrumbs->parent("admin.index");$breadcrumbs->push("%s", route("%s"));', $permission->display_name, $permission->name);
                    }
                    $str .= sprintf('Breadcrumbs::register("%s", function($breadcrumbs){%s});', $permission->name, $parentStr);
                }
            }
        }
        return $str;
    }

    /**
     * 重置面包屑导航缓存
     */
    public function resetBreadCrumbCache() {
        $file_path = storage_path('framework/cache') . '/Breadcrumbs.php';
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $str = $this->getBreadCrumbCache($file_path);
        file_put_contents($file_path,$str);
    }

    /**
     * 获取权限名称，供 网站标题 使用
     * @param $router
     *
     * @return string
     */
    public function getPermissionName($router)
    {
        $permission = Permission::where('name', $router)->first();
        return $permission ? $permission->display_name : '';
    }

    public function getTopPermission($permission)
    {
        if($permission->fid == 0){
            return $permission;
        }
        $permission = Permission::where('id', $permission->fid)->first();
        return $this->getTopPermission($permission);
    }

    /**
     * 获取权限父级信息
     * @param $fid
     * @return bool
     */
    private function getParentInfo($fid){
        $info = \App\Models\Permission::where('id', $fid)->first();
        return $info->fid != 0;
    }
}
