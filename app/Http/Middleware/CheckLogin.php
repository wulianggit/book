<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 检测用户是否登录,若没有登录,则跳转到登录页面
        if (!$request->session()->get('member', '')) {
            $return_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            return redirect('/member?return_url='.urlencode($return_url));
        }
        return $next($request);
    }
}
