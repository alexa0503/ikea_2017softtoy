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
    public function workList()
    {
        $works = App\Work::orderBy('created_at','DESC')->paginate(20);
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
