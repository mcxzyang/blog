<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auths.login');
    }

    public function postLogin(Request $request)
    {
        try {
            $needs = $this->validator('admin.user.login');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }

        return auth('admin')->attempt($needs, $request->has('remember')) ? succeed('登录成功') : failed('账号或者密码错误');
    }

    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect(route('admin.auth.login'));
    }
}
