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
        if(env('APP_ENV') == 'local'){
            $wechat_user = \App\WechatUser::first();
            \Session::set('wechat.openid',$wechat_user->open_id);
            \Session::set('wechat.id',$wechat_user->id);
            \Session::set('wechat.mobile', $wechat_user->mobile);
            \Session::set('wechat.nickname', $wechat_user->nick_name);
            \Session::set('wechat.headimg', $wechat_user->head_img);
        }
        if( null == $request->session()->get('wechat.id') ){
            return redirect('wechat/auth');
        }
        return $next($request);
    }
}
