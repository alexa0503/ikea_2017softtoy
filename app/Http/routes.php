<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'HomeController@index');
Route::get('list', 'HomeController@workList');
Route::get('review', 'HomeController@review');
Route::get('winners', 'HomeController@winners');
Route::get('work/{id}', 'HomeController@work');
Route::get('img', 'MobileController@img');



Route::get('mobile', 'MobileController@index');
Route::get('mobile/index', 'MobileController@index');
Route::get('mobile/review', 'MobileController@review');
Route::get('mobile/list', 'MobileController@workList');
Route::get('mobile/works', 'MobileController@works');
Route::get('mobile/my', 'MobileController@my');
Route::get('mobile/share/{id}', 'MobileController@share');
Route::get('mobile/winners', 'MobileController@winners');
Route::get('mobile/login', 'MobileController@login');
Route::post('mobile/login', 'MobileController@postLogin');
Route::get('mobile/upload', 'MobileController@upload');
Route::post('mobile/upload', 'MobileController@postUpload');
Route::get('mobile/success', 'MobileController@success');
Route::post('mobile/success', 'MobileController@postSuccess');
Route::get('mobile/work/{id}', 'MobileController@work');
Route::get('mobile/vote/{id}', 'MobileController@vote');

Route::get('/wx/share', function(){
    $url = urldecode(Request::get('url'));

    $options = [
      'app_id' => env('WECHAT_APPID'),
      'secret' => env('WECHAT_SECRET'),
      'token' => env('WECHAT_TOKEN')
    ];
    $wx = new EasyWeChat\Foundation\Application($options);
    $js = $wx->js;
    $js->setUrl($url);
    $n = rand(0,1);
    $config = json_decode($js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'), false), true);
    $share = [
      'title' => env('WECHAT_SHARE_TITLE'),
      'desc' => env('WECHAT_SHARE_DESC'),
      'imgUrl' => asset(env('WECHAT_SHARE_IMG')),
    ];
    return json_encode(array_merge($share, $config));
});
Route::get('logout',function(){
    Request::session()->set('wechat.openid',null);
    Request::session()->set('wechat.id',null);
    return redirect('/');
});
Route::get('login',function(){
    $wechat_user = App\WechatUser::find(1);
    Request::session()->set('wechat.openid',$wechat_user->open_id);
    Request::session()->set('wechat.id',$wechat_user->id);
    Request::session()->set('wechat.nickname',json_decode($wechat_user->nick_name));
    return redirect('/');
});

///

Route::get('/admin/login', 'Admin\AuthController@getLogin');
Route::post('/admin/login', 'Admin\AuthController@postLogin');
Route::any('/admin/logout', function(){
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
});

//抽奖部分管理
//wechat auth
Route::any('/wechat/auth', 'WechatController@auth');
Route::any('/wechat/callback', 'WechatController@callback');

Route::group(['middleware' => ['auth:admin','menu']], function () {
    Route::get('admin', 'CmsController@index')->name('admin_dashboard');
    Route::get('admin/users', 'CmsController@users');
    Route::get('admin/account', 'CmsController@account');
    Route::post('admin/account', 'CmsController@accountPost');
    Route::get('admin/wechat', 'CmsController@wechat');
    Route::get('admin/user/logs', 'CmsController@userLogs');
    Route::get('admin/export', 'CmsController@export');
    Route::get('admin/photos', 'CmsController@photos');
    Route::get('admin/photos/export', 'CmsController@photosExport');
    Route::get('admin/sessions', 'CmsController@sessions');
    Route::get('admin/session/{id}', 'CmsController@sessions');
    Route::get('admin/lotteries', 'CmsLotteryController@lotteries');
    Route::get('admin/prizes', 'CmsLotteryController@prizes');
    Route::post('admin/prize/update/{id}', 'CmsLotteryController@prizeUpdate');//
    Route::get('admin/lottery/configs', 'CmsLotteryController@lotteryConfigs');
    Route::post('admin/lottery/config/update/{id}', 'CmsLotteryController@lotteryConfigUpdate');
    Route::post('admin/lottery/config/add', 'CmsLotteryController@lotteryConfigAdd');
    Route::get('admin/prize/configs', 'CmsLotteryController@prizeConfigs');
    Route::get('admin/prize/config/update/{id}', 'CmsLotteryController@prizeConfig');
    Route::post('admin/prize/config/update/{id}', 'CmsLotteryController@prizeConfigUpdate');
    Route::get('admin/prize/config/add', 'CmsLotteryController@prizeConfigAdd');
    Route::post('admin/prize/config/add', 'CmsLotteryController@prizeConfigStore');
    Route::get('admin/prize/codes', 'CmsLotteryController@prizeCodes');
});
//初始化后台帐号
Route::get('admin/install', function () {
    if (0 == \App\Admin::count()) {
        $user = new \App\Admin();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin@2016');
        $user->save();
    }
    return redirect('admin/login');
});
