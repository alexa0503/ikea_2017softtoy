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
    public function list()
    {
        $works = App\Work::orderBy('created_at','DESC')->paginate(20);
        return view('pc/list',['works'=>$works]);
    }
    public function winners()
    {
        return view('pc/winners');
    }
}
