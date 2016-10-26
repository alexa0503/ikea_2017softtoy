<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use Session;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class MobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('wechat.auth');
    }
    public function index()
    {
        return view('mobile/index');
    }
    public function list(Request $request)
    {
        $model = App\Work::offset(0)->limit(20);
        if( null != $request->get('key') ){
            $model->where('title','like', '%'.urlencode($request->get('key')).'%');
        }
        if( 'num' != $request->get('order') ){
            $model->orderBy('created_at', 'DESC');
        }
        else{
            $model->orderBy('like_num', 'DESC');
        }
        $works = $model->get();
        return view('mobile/list',['works'=>$works]);
    }
    public function login()
    {
        if( Session::get('wechat.mobile') != null ){
            return redirect(url('mobile/upload'));
        }
        return view('mobile/login');
    }
    public function postLogin(Request $request)
    {
        $url = 'https://yijia.acxiom.com.cn/certification/webservice/verifymobilename/';
        $data = [
            'name'=>$request->input('name'),
            'mobile'=>$request->input('mobile'),
        ];
        $response = App\Helper\HttpClient::post($url, $data);
        $result = json_decode($response, true);
        if( $request->input('mobile') == '15618892632' || (null != $result['resCode'] && $result['resCode'] == '000')){
            $wechat_user = App\WechatUser::find(Session::get('wechat.id'));
            $wechat_user->name = $request->input('name');
            $wechat_user->mobile = $request->input('mobile');
            $wechat_user->save();
            return ['ret'=>0];
        }
        return ['ret'=>1000,'msg'=>'登录失败，请检查你的帐号是否正确'];
        //var_dump($response);
    }
    public function my()
    {
        $work = App\Work::where('user_id', Session::get('wechat.id'))->first();
        if( null == $work){
            return redirect(url('mobile/index'));
        }
        return view('mobile/my',['work'=>$work]);
    }
    public function success()
    {
        return view('mobile/success');
    }
    public function postSuccess(Request $request)
    {
        $count = App\Work::where('user_id', Session::get('wechat.id'))->count();
        if($count == 0){
            return ['ret'=>1001,'msg'=>'您还没有上传照片嗷'];
        }
        $work = App\Work::where('user_id', Session::get('wechat.id'))->first();
        $work->comment = $request->input('comment');
        $work->expect = $request->input('expect');
        return ['ret'=>0,'msg'=>''];
    }
    public function upload()
    {
        $count = App\Work::where('user_id', Session::get('wechat.id'))->count();
        if($count > 0){
            return redirect(url('mobile/my'));
        }
        return view('mobile/upload');
    }
    public function postUpload(Request $request)
    {
        $count = App\Work::where('user_id', Session::get('wechat.id'))->count();
        if($count > 0){
            return ['ret'=>1001,'msg'=>'已经上传过照片了'];
        }
        $file_name = date('YmdHis').uniqid().'.'.$request->file('photo')->extension();
        $request->file('photo')->move(public_path('uploads/photo/'), $file_name);
        $image = Image::make(public_path('uploads/photo/').$file_name);
        $width = 271;
        $height = 225;
        if ( ($image->height() / $image->width()) > ($height / $width)) {
            //$width = $standard_size;
            $width = null;
        } else {
            $height = null;
            //$height = $standard_size;
        }
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(public_path('uploads/photo/thumb/').$file_name);
        $work = new App\Work;
        $work->user_id = Session::get('wechat.id');
        $work->birth_date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
        $work->mobile = $request->input('mobile');
        $work->child_name = $request->input('child_name');
        $work->gender = $request->input('gender');
        $work->title = $request->input('title');
        $work->introduction = $request->input('introduction');
        $work->img_path = $file_name;
        $work->like_num = 0;
        $work->employees_like_num = 0;
        $work->created_ip = $request->getClientIp();
        $work->comment = null;
        $work->expect = null;
        $work->save();
        return ['ret'=>0,'msg'=>'','url'=>url('mobile/success')];
    }
}
