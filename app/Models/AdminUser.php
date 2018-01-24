<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use HasRoles;

    protected $guard_name = 'admin';

    protected $fillable = [
        'username', 'name', 'avatar', 'is_super', 'password', 'openid', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAvatarAttribute($value)
    {
        return $value ? $value : config('system.admin.default_avatar');
    }
}
