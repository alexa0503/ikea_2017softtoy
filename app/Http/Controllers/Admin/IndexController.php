<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    public function works(Request $request)
    {
        $model = \App\Work::whereNotNull('is_active');
        if( null != $request->get('child_name') ){
            $model->where('child_name','LIKE', '%'.urldecode($request->get('child_name')).'%');
        }

        if( null != $request->get('mobile') ){
            $model->where('mobile','LIKE', '%'.urldecode($request->get('mobile')).'%');
        }

        if( null != $request->get('title') ){
            $model->where('mobile','LIKE', '%'.urldecode($request->get('title')).'%');
        }

        if( null != $request->get('name') ){
            $model->whereHas('user', function($query) use($request){
                $query->where('name','LIKE', '%'.urldecode($request->get('name')).'%');
                //->where('name','LIKE', '%'.urldecode($request->get('mobile')).'%')
            });
        }

        $works = $model->paginate(20);

        return view('admin/works', ['works'=>$works]);
    }
    public function workUpdate($id)
    {
        $work = \App\Work::find($id);
        $work->is_active = $work->is_active == 1 ? 0 : 1;
        $work->save();
        return ['ret'=>0];
    }
    /**
     * @return mixed
     * session 查看
     */
    public function sessions($id = null)
    {
        if( null == $id)
            $sessions = DB::table('sessions')->paginate(20);
        else
            $sessions = DB::table('sessions')->where('id', '=', $id)->paginate(20);
        return view('cms/sessions', ['sessions' => $sessions]);
    }
    /**
     * 导出
     */
    public function export()
    {
        $filename = 'lottery-'.date('YmdHis');
        $collection = \App\Lottery::whereNotNull('prize_id')->get();
        $data = $collection->map(function($item){
            $code = $item->prize_code_id != null ? $item->prizeCode->code : '--';
            return [
                $item->id,
                json_decode($item->user->nick_name),
                $item->prizeInfo->title,
                $code,
                $item->lottery_time
            ];
        });
        Excel::create($filename, function($excel) use($data) {
            $excel->setTitle('中奖记录');
            // Chain the setters
            $excel->setCreator('Alexa');
            // Call them separately
            $excel->setDescription('中奖记录');
            $excel->sheet('Sheet', function($sheet) use($data) {
                $sheet->row(1, array('ID','用户昵称','奖品','抽奖码','抽奖时间'));
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xlsx');
    }
    /**
     *账户管理
     */
    public function account()
    {
        return view('cms/account');
    }
    public function accountPost(Requests\AccountFormRequest $request)
    {
        //var_dump($request->user()->id);
        $user = \App\User::find($request->user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('cms/logout');
        //var_dump($request->input('password'));
    }
    public function userLogs()
    {
        $logs = \App\UserLog::limit(30)->offset(0)->orderBy('create_time', 'DESC')->get();
        return view('cms/userLogs',['logs' => $logs]);
    }
}
