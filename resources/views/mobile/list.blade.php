@extends('mobile.layout')
@section('content')

<div class="bg">
	<div class="innerDiv">
    	<div class="page page7">
        	<div class="innerDiv">
            	<div class="page7Bg"></div>
                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('assets/mobile/images/space.gif')}}" width="144" height="59"></a>
                <a href="{{url('mobile/my')}}" class="abs pageNav1"><img src="{{asset('assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/list')}}" class="abs pageNav2"><img src="{{asset('assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="javascript:void(0);" class="abs pageNav3"><img src="{{asset('assets/mobile/images/space.gif')}}" width="176" height="71"></a>

				<form method="get" action="{{url('mobile/list')}}" id="search_form">
                <select class="listSel" name="order">
                	<option value="time">按时间</option>
                    <option value="num">按点赞数</option>
                </select>

                <input type="text" name="key" class="listSearchTxt" placeholder="搜索/SEARCH">
				</form>
                <a href="javascript:void(0);" class="abs listSearchBtn"><img src="{{asset('assets/mobile/images/space.gif')}}" width="53" height="56"></a>

                <div class="imagesList">
                	<div class="innerDiv">
						@foreach ($works as $work)
                    	<div class="ilInit" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}">
                            <div class="innerDiv">
                                <img src="{{asset('uploads/photo/thumb/'.$work->img_path)}}" class="abs iImg">
                                <a class="abs iCover"><img src="{{asset('assets/mobile/images/page10Img3.png')}}"></a>
                                <a class="abs ilVote">{{$work->like_num+$work->employees_like_num}}</a>
                                <a class="abs ilName">{{$work->user->nick_name}}</a>
                                <a class="abs ilTitle">{{$work->title}}</a>
                            </div>
                        </div>
						@endforeach
                    </div>

                	<div class="clear"></div>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="popBg" style="display:none;"></div>
<div class="pop popRule" style="display:none;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<img src="{{asset('assets/mobile/images/rule.png')}}">
        </div>
        <a href="javascript:void(0);" class="abs ruleCloseBtn" onClick="closePop();"><img src="{{asset('assets/mobile/images/closeBtn.png')}}"></a>
    </div>
</div>
<div class="pop imgDetail" style="display:none;">
    <div class="innerDiv">
        <img src="{{asset('assets/mobile/images/upload/img1.png')}}" class="abs idImg">
        <img src="" class="abs idCover">
        <div class="idName"></div>
        <div class="idTitle"></div>
        <div class="idDesc"></div>
        <a href="javascript:void(0);" class="abs idCloseBtn" onClick="closeDetail();"><img src="{{asset('assets/mobile/images/closeBtn.png')}}"></a>
        <a href="javascript:void(0);" class="idVoteBtn" onClick="voteId(this);">0</a>
    </div>
</div>
<div class="noVoteBg" style="display:none;" onClick="closeNoVote();"></div>
<div class="pop noVote" style="display:none;">
    <div class="innerDiv">
        <img src="{{asset('assets/mobile/images/page9Img4.png')}}" onClick="closeNoVote();">
    </div>
</div>

<script>
$(function(){
	$('.listSearchBtn').on('click', function(){
		$('#search_form').submit();
	})
})

window.onscroll = function(){
    var t = document.documentElement.scrollTop || document.body.scrollTop;  //离上方的距离
    var h =window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight; //可见宽度
    if( t >= document.documentElement.scrollHeight -h -100 ) {
        loadListImg();
    }
}
</script>
@endsection
