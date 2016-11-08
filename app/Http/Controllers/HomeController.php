<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        //$this->middleware('wechat.auth');
    }
    public function resizeImg()
    {
        $file_name = 'test.jpg';
        $image = Image::make(public_path('uploads/photo/').$file_name);
        $width = 271;
        $height = 225;
        if ( ($image->height() / $image->width()) > ($height / $width)) {
            $width = null;
        } else {
            $height = null;
        }
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save(public_path('uploads/photo/thumb/').$file_name);
        return ['ret'=>0, 'msg'=>'ok'];
    }
    public function index()
    {
        return view('pc/index');
    }
    public function review()
    {
        return view('pc/review');
    }
    public function workList(Request $request)
    {
        $model = App\Work::where('is_active', '1');
        if( null != $request->get('key') ){
            $model->where(function($query) use ($request)
            {
                $query->where('title','LIKE', '%'.urldecode($request->get('key')).'%')
                      ->orWhere('child_name','LIKE', '%'.urldecode($request->get('key')).'%')
                      ->orWhere('mobile','LIKE', '%'.urldecode($request->get('key')).'%');
            });
        }

        if( 'time' == $request->get('order') ){
            $model->orderBy('created_at', 'DESC');
        }
        elseif( 'num' == $request->get('order')){
            $model->orderBy('like_num', 'DESC');
        }
        else{
            $n = rand(1,3);
            $sort_type = rand(1,2) == 1 ? 'DESC' : 'ASC';
            if($request->get('page') == 1 || $request->get('page') == null){
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
                'vote_num'=>$work->like_num+$work->employees_like_num,
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
