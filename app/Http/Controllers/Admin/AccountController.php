<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function profile()
    {
        return view('admin.account.profile');
    }

    public function avatar()
    {
        return view('admin.account.avatar');
    }

    public function password()
    {
        return view('admin.account.password');
    }

    public function passwordHandle(Request $request)
    {
        try {
            $needs = $this->validator('admin.account.password');
        } catch (ValidatorException $e) {
            return failed($e->getMessage());
        }
        $user = \Auth::guard('admin')->user();
        if(!\Hash::check($needs['old_password'], $user->password)){
            return failed('原始密码不正确');
        }
        $user->password = $needs['password'];
        $user->save();

        return succeed('密码修改成功');
    }
}
