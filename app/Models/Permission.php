<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'icon', 'display_name', 'guard_name', 'active', 'weight', 'fid', 'is_menu'
    ];

    public function scopeTops($query, $parent = 0)
    {
        return $query->where('fid', $parent)->where('is_menu', 1);
    }

    public function childmenus()
    {
        return $this->hasMany(self::class, 'fid')->where('is_menu', 1)->orderBy('weight', 'asc');
    }

    public function childers()
    {
        return $this->hasMany(self::class, 'fid')->orderBy('weight', 'asc');
    }

    public static function topPermissions() {
        return static::where('fid', 0)->orderBy('weight', 'asc')->orderBy('id', 'desc')->get();
    }

    public function getSubPermissionAttribute() {
        return $this->where('fid', $this->attributes['id'])->orderBy('weight', 'asc')->get();
    }

    public function getParentPermissionAttribute() {
        return $this->where('id', $this->attributes['fid'])->first();
    }
}
