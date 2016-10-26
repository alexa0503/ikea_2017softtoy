<?php

namespace App\Http\Middleware;

use Closure;

class WechatAuthMiddleware
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
        $request->session()->set('wechat.redirect_uri', $request->getUri());
        if( null == $request->session()->get('wechat.id') && $request->getClientIp() != '127.0.0.1'){
            return redirect('/wechat/auth');
        }
        elseif($request->getClientIp() == '127.0.0.1'){
            \Session::set('wechat.id', 1);
        }
        return $next($request);
    }
}
