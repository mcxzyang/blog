<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth('admin')->check()){
            if(auth('admin')->user()->can($request->route()->getName())){
                return $next($request);
            } else {
                if($request->ajax()){
                    return failed('无权进行此操作');
                } else {
                    return response()->view('admin.errors.unauthentication');
                }
            }
        }
        return redirect()->route('admin.auth.login');
    }
}
