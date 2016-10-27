@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page7">
        	<div class="innerDiv">
            	<div class="page7Bg"></div>

                <select class="listSel">
                	<option>按时间</option>
                    <option>按点赞数</option>
                </select>

                <input type="text" class="listSearchTxt" placeholder="搜索/SEARCH">
                <a href="javascript:void(0);" class="abs listSearchBtn"><img src="{{asset('/assets/pc/images/space.gif')}}" width="30" height="36"></a>

                <div class="imagesList">
					@foreach ($works as $work)
                	<div class="ilInit">
                    	<div class="innerDiv">
                        	<img src="{{asset('uploads/photo/thumb/'.$work->img_path)}}" class="abs iImg">
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('work',['id'=>$work->id])}}" class="abs iCover"><img src="{{asset('/assets/pc/images/page7Img1.png')}}"></a>
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}" class="abs ilName">{{$work->user->name}}</a>
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}" class="abs ilTitle">{{$work->title}}</a>
                        </div>
                    </div>
					@endforeach
                	<div class="clear"></div>
                </div>

                <div class="listNav">
					{!! $works->links() !!}
                	<!--<a href="javascript:void(0);" class="sBtn">首页</a>

                    <a href="javascript:void(0);" class="sBtn">上一页</a>

                    <a href="javascript:void(0);">1</a>

                    <a href="javascript:void(0);">2</a>

                    <a href="javascript:void(0);">3</a>

                    <a href="javascript:void(0);">4</a>

                    <a href="javascript:void(0);">5</a>

                    <a href="javascript:void(0);" class="sBtn">下一页</a>

                    <a href="javascript:void(0);" class="sBtn">尾页</a>-->
                </div>

                <div class="nav nav1">
					<ul>
                    	<li class="navBtn1"><a href="{{url('/')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn2"><a href="{{url('my')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn3"><a href="{{url('list')}}" class="on"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn4"><a href="javascript:void(0);"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn5"><a href="javascript:void(0);"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn6"><a href="{{url('winners')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="abs loadingBg" style="display:none;"></div>
        <div class="imgDetail" style="display:none;">
        	<div class="innerDiv">
            	<img src="" class="abs idImg">
                <img src="{{asset('/assets/pc/images/page7Img2.png')}}" class="abs idCover">
                <div class="idName"></div>
                <div class="idTitle"></div>
                <div class="idDesc"></div>
                <img src="/assets/pc/images/page1Qc.jpg" class="abs idQc">
                <a href="javascript:void(0);" class="abs idCloseBtn" onClick="closeDetail();"><img src="{{asset('/assets/pc/images/space.gif')}}" width="36" height="36"></a>
                <a href="javascript:void(0);" class="idVoteBtn" onClick="voteId(this);">0</a>
            </div>
        </div>
        <img src="{{asset('/assets/pc/images/loading.gif')}}" width="60" height="60" class="abs loadingImg" style="display:none;">

        <div class="abs noteBg" style="display:none;"></div>
        <div class="abs noVote" style="display:none;">
        	<div class="innerDiv">
            	<a href="javascript:void(0);" class="abs noVoteBtn" onClick="closeNoVote();"><img src="{{asset('/assets/pc/images/space.gif')}}" width="145" height="75"></a>
            </div>
        </div>
    </div>
</div>
@endsection
