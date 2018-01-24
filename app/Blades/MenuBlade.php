<?php

namespace App\Blades;

use App\Models\Permission;
use Route;

class MenuBlade
{
    public static function boot()
    {
        \Illuminate\Support\Facades\Blade::if ('menu',
            function(Permission $menu) : bool {
                return Route::has($menu->name)
                    ? \Auth::guard('admin')->user()->can($menu->name)
                    : (($menu->childmenus->count()
                        ? (boolean) $menu->childmenus->first(function($childer) {
                            return \Auth::guard('admin')->user()->can($childer->name);
                        })
                        : false));
            }
        );
    }
}

