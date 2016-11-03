<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Menu;
class MenuMiddleware
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
        Menu::make('adminNavbar', function($menu){
            $menu->add('控制面板',['route'=>'admin_dashboard']);
            $menu->add('照片管理',['url'=>'admin/works']);
            //$menu->add('查看奖品',['url'=>'admin/prizes']);
            //$menu->add('奖品配置',['url'=>'admin/prize/configs']);
            //$menu->add('抽奖配置',['url'=>'admin/lottery/configs']);
            //$menu->add('信息查看',['url'=>'admin/infos']);
            //$page->add('查看', 'page/view')->divide();
            //$menu->add('账户',['route'=>'admin_account']);
        });
        return $next($request);
    }
}
