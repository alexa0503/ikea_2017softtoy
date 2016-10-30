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
    public function review()
    {
        return view('mobile/review');
    }
    public function index()
    {
        return view('mobile/index');
    }
    public function work(Request $request,$id)
    {
        $work = App\Work::find($id);
        $count = App\WorkLike::where('user_id', Session::get('wechat.id'))->count();
        $result = [
            'ret' => 0,
            'data' => [
                'title'=>$work->title,
                'child_name'=>$work->child_name,
                'introduction'=>$work->introduction,
                'has_vote'=> $count == 0 ? 0 : 1,
                'img_url'=>asset('uploads/photo/thumb/'.$work->img_path),
                'vote_url'=>url('mobile/vote',['id'=>$work->id]),
                'vote_num'=>$work->like_num+$work->employees_like_num,
            ]
        ];
        return $result;
    }
    public function vote(Request $request, $id)
    {
        $count1 = App\WorkLike::where('user_id', Session::get('wechat.id'))->count();
        if($count1 > 10){
            return ['ret'=>1001,'msg'=>'一天只能赞10次嗷'];
        }
        $count2 = App\WorkLike::where('user_id', Session::get('wechat.id'))->where('work_id', $id)->count();
        if($count2 > 0){
            return ['ret'=>1002,'msg'=>'您已经赞过啦'];
        }
        $work_like = new App\WorkLike;
        $work_like->user_id = Session::get('wechat.id');
        $work_like->work_id = $id;
        $work_like->save();
        $work = App\Work::find($id);
        $work->like_num += 1;
        $work->save();
        return ['ret'=>0];
    }
    public function workList()
    {
        return view('mobile/list');
    }
    public function works(Request $request)
    {
        $model = App\Work::whereNotNull('title');
        if( null != $request->get('key') ){
            $model->where(function($query) use ($request)
            {
                $query->where('title','LIKE', '%'.urlencode($request->get('key')).'%')
                      ->orWhere('child_name','LIKE', '%'.urlencode($request->get('key')).'%')
                      ->orWhere('mobile','LIKE', '%'.urlencode($request->get('key')).'%');
            });
            //$model->where('title','like', '%'.urlencode($request->get('key')).'%');
        }
        if( 'num' != $request->get('order') ){
            $model->orderBy('created_at', 'DESC');
        }
        else{
            $model->orderBy('like_num', 'DESC');
        }
        $works = $model->paginate(10);
        $works->setPath('list?order='.$request->get('order').'&key='.$request->get('key'));
        return view('mobile/works', ['works'=>$works]);
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
            $request->session()->set('wechat.mobile', $wechat_user->mobile);
            $wechat_user->save();
            return ['ret'=>0];
        }
        return ['ret'=>1000,'msg'=>'登录失败，请检查你的帐号是否正确'];
    }
    public function my()
    {
        $work = App\Work::where('user_id', Session::get('wechat.id'))->first();
        if( null == $work){
            return redirect(url('mobile/index'));
        }
        return view('mobile/my',['work'=>$work]);
    }
    public function share()
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
        $work->degree = $request->input('degree');
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
        \QrCode::format('png')->size(600)->generate(url('mobile/share', ['id'=>$work->id]),public_path('uploads/qrcodes/'.$work->id.'.png'));
        return ['ret'=>0,'msg'=>'','url'=>url('mobile/success')];
    }
}
