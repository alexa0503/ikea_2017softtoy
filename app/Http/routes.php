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
Route::get('/', function(){
    return redirect('employee');
});
/*
Route::get('/', 'HomeController@index');
Route::get('list', 'HomeController@workList');
Route::get('review', 'HomeController@review');
Route::get('winners', 'HomeController@winners');
Route::get('work/{id}', 'HomeController@work');
Route::get('resize', 'HomeController@resizeImg');



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
Route::post('mobile/image/upload', 'MobileController@uploadImage');
Route::get('mobile/image/upload', 'MobileController@uploadImage');
Route::get('mobile/success', 'MobileController@success');
Route::post('mobile/success', 'MobileController@postSuccess');
Route::get('mobile/work/{id}', 'MobileController@work');
Route::get('mobile/vote/{id}', 'MobileController@vote');
*/
Route::group(['prefix'=>'employee'], function () {
    Route::get('/', function(){
        if( Session::get('employee.id') == null ){
            return redirect(url('employee/login'));
        }
        return view('employee/list');
    });
    Route::get('works', function(){
        $model = App\Work::where('is_active', '1');
        if( null != Request::get('key') ){
            $model->where(function($query) use ($request)
            {
                $query->where('title','LIKE', '%'.urldecode(Request::get('key')).'%')
                      ->orWhere('child_name','LIKE', '%'.urldecode(Request::get('key')).'%')
                      ->orWhere('mobile','LIKE', '%'.urldecode(Request::get('key')).'%');
            });
            //$model->where('title','like', '%'.urlencode(Request::get('key')).'%');
        }
        if( 'time' == Request::get('order') ){
            $model->orderBy('created_at', 'DESC');
        }
        elseif( 'num' == Request::get('order')){
            $model->orderBy('like_num', 'DESC');
        }
        else{
            $n = rand(1,3);
            $sort_type = rand(1,2) == 1 ? 'DESC' : 'ASC';
            if(Request::get('page') == 1 || Request::get('page') == null){
                Session::set('page.sort.field', 'sort'.$n);
                Session::set('page.sort.type', $sort_type);
            }
            if( null != Session::get('page.sort.field') ){
                $sort_field = Session::get('page.sort.field');
                $sort_type = Session::get('page.sort.type');
                $model->orderBy($sort_field, $sort_type);
            }
        }
        $works = $model->paginate(10);
        $works->setPath('list?order='.Request::get('order').'&key='.Request::get('key'));
        return view('employee/works', ['works'=>$works]);
    });
    Route::get('work/{id}', function($id){
        $work = App\Work::find($id);
        $count = App\WorkLike::where('user_id', Session::get('wechat.id'))->count();
        $result = [
            'ret' => 0,
            'data' => [
                'title'=>$work->title,
                'child_name'=>$work->child_name,
                'introduction'=>$work->introduction,
                'has_vote'=> $count == 0 ? 0 : 1,
                'img_url'=>'http://community.ikea.cn/dev/2017softtoy/public/uploads/photo/thumb/'.$work->img_path,
                'vote_url'=>url('employee/vote',['id'=>$work->id]),
                'vote_num'=>$work->like_num,
            ]
        ];
        return $result;
    });
    Route::get('login', function(){
        if( Session::get('employee.id') != null ){
            return redirect(url('employee'));
        }
        return view('employee/login');
    });
    Route::get('logout', function(){
        Session::set('employee.id',null);
        return view('employee/login');
    });
    Route::post('login', function(){
        if( null == Request::input('ikea_id') || !preg_match('/^280\d{5}$/',Request::input('ikea_id'))){
            return ['ret'=>1000,'msg'=>'IKEA帐号不正确'];
        }
        $count = App\Employee::where('ikea_id', Request::input('ikea_id'))->count();
        if( $count == 0){
            $employee = new App\Employee();
        }
        else{
            $employee = App\Employee::where('ikea_id', Request::input('ikea_id'))->first();
        }
        $employee->ikea_id = Request::input('ikea_id');
        $employee->save();
        Session::set('employee.id',$employee->id);
        return ['ret'=>0,'redirect_uri'=>url('employee')];
    });
    Route::get('vote/{id}', function($id){
        $now = Carbon\Carbon::now();
        $today = Carbon\Carbon::today();
        $tomorrow = Carbon\Carbon::tomorrow();
        $count1 = App\EmployeeLike::where('user_id', Session::get('employee.id'))
            ->where('created_at', '>=', $today)
            ->where('created_at', '<', $tomorrow)
            ->count();
        if($count1 >= 10){
            return ['ret'=>1001,'msg'=>'一天只能赞10次嗷'];
        }
        $count2 = App\EmployeeLike::where('user_id', Session::get('employee.id'))
            ->where('created_at', '>=', $today)
            ->where('created_at', '<', $tomorrow)
            ->where('work_id', $id)
            ->count();
        if($count2 > 0){
            return ['ret'=>1002,'msg'=>'您已经赞过啦'];
        }
        $employee_like = new App\EmployeeLike;
        $employee_like->user_id = Session::get('employee.id');
        $employee_like->work_id = $id;
        $employee_like->save();
        $work = App\Work::find($id);
        $work->like_num += 1;
        $work->employees_like_num += 1;
        $work->save();
        return ['ret'=>0];
    });
});

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
      'link' => 'http://community.ikea.cn/dev/2017softtoy_dev/public/employee',
    ];
    return json_encode(array_merge($share, $config));
});
Route::get('logout',function(){
    //Request::session()->set('wechat.openid',null);
    //Request::session()->set('wechat.id',null);
    \Session::set('wechat.openid',null);
    \Session::set('wechat.id',null);
    \Session::set('wechat.mobile', null);
    \Session::set('wechat.nickname', null);
    \Session::set('wechat.headimg', null);
    return redirect('mobile');
});
Route::get('login',function(){
    $wechat_user = \App\WechatUser::first();
    \Session::set('wechat.openid',$wechat_user->open_id);
    \Session::set('wechat.id',$wechat_user->id);
    \Session::set('wechat.mobile', $wechat_user->mobile);
    \Session::set('wechat.nickname', $wechat_user->nick_name);
    \Session::set('wechat.headimg', $wechat_user->head_img);
    //Request::session()->set('wechat.openid',$wechat_user->open_id);
    //Request::session()->set('wechat.id',$wechat_user->id);
    //Request::session()->set('wechat.nickname',json_decode($wechat_user->nick_name));
    return redirect('mobile');
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

Route::group(['middleware' => ['auth:admin','menu'], 'prefix'=>'admin'], function () {
    Route::get('/', 'Admin\IndexController@index')->name('admin_dashboard');
    Route::get('works', 'Admin\IndexController@works');
    Route::get('work/update/{id}', 'Admin\IndexController@workUpdate');
    Route::get('account', 'Admin\IndexController@account');
    Route::post('account', 'Admin\IndexController@accountPost');
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
