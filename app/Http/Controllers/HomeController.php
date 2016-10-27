<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use Session;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        //$this->middleware('wechat.auth');
    }
    public function index()
    {
        return view('pc/index');
    }
    public function workList(Request $request)
    {
        $model = App\Work::whereNotNull('title');
        if( null != $request->get('key') ){
            $model->where(function($query) use ($request)
            {
                $query->orWhere('title','like', '%'.urlencode($request->get('key')).'%')
                      ->orWhere('child_name','like', '%'.urlencode($request->get('key')).'%')
                      ->orWhere('mobile','like', '%'.urlencode($request->get('key')).'%');
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
        /*
        if( 'num' != $request->get('order') ){
            $works = App\Work::orderBy('created_at','DESC')->paginate(10);
        }
        else{
            $works = App\Work::orderBy('like_num','DESC')->paginate(10);
        }
        */

        return view('pc/list',['works'=>$works]);
    }
    public function work(Request $request,$id)
    {
        $work = App\Work::find($id);
        $result = [
            'ret' => 0,
            'data' => [
                'title'=>$work->title,
                'child_name'=>$work->child_name,
                'introduction'=>$work->introduction,
                'img_url'=>asset('uploads/photo/'.$work->img_path),
                'qrcode_url'=>asset('uploads/qrcodes/'.$work->id.'.png')
            ]
        ];
        return $result;
    }
    public function winners()
    {
        return view('pc/winners');
    }
}
