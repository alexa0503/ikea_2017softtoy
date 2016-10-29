@extends('mobile.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page6">
        	<div class="innerDiv">
            	<div class="page6Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

				<a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>
                <a href="{{url('mobile/my')}}" class="abs pageNav1"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/list')}}" class="abs pageNav2"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/review')}}" class="abs pageNav3"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>

                <div class="myImg">
                	<div class="innerDiv">
                    	<img src="{{asset('uploads/photo/'.$work->img_path)}}">
                        <img src="{{asset('/assets/mobile/images/page8Img3.png')}}" class="abs page8Img3">
                    </div>
                </div>
                <div class="myName">{{$work->user->nick_name}}</div>
                <div class="myImageTitle">{{$work->title}}</div>
                <div class="myImageDesc">{{$work->introduction}}</div>

                <a href="javascript:void(0);" class="myVoteBtn">{{$work->like_num+$work->employees_like_num}}</a>
            </div>
        </div>

        <div class="abs loadingBg" style="display:none;"></div>
        <img src="{{asset('/assets/mobile/images/loading.gif')}}" width="60" height="60" class="abs loadingImg" style="display:none;">
    </div>
</div>
@endsection
@section('wxShare')
data.link = '{{url("mobile/share",["id"=>$work->id])}}';
wxShare(data);
@endsection
