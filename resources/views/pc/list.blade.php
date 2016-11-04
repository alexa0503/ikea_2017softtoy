@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page7">
        	<div class="innerDiv">
            	<div class="page7Bg"></div>
				<form method="get" action="{{url('list')}}" id="search_form">
					<select class="listSel" name="order">
						<option value="time" {{ Request::get('order') != 'num' ? 'selected=selected' : ''}}>按时间排序</option>
	                    <option value="num" {{ Request::get('order') == 'num' ?  'selected=selected' : ''}}>按点赞数排序</option>
	                </select>

                	<input type="text" class="listSearchTxt" value="{{Request::get('key')}}" name="key" placeholder="搜索/SEARCH">
				</form>
                <a href="javascript:void(0);" class="abs listSearchBtn"><img src="{{asset('/assets/pc/images/space.gif')}}" width="30" height="36"></a>

                <div class="imagesList">
					@foreach ($works as $work)
                	<div class="ilInit">
                    	<div class="innerDiv">
                        	<div class="iOuter">
                            	<img src="{{asset('uploads/photo/thumb/'.$work->img_path)}}" class="iImg">
                            </div>
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('work',['id'=>$work->id])}}" class="abs iCover"><img src="{{asset('/assets/pc/images/page7Img1.png')}}"></a>
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}" class="abs ilName">{{$work->child_name}}</a>
                            <a href="javascript:void(0);" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}" class="abs ilTitle">{{$work->title}}</a>
                        </div>
                    </div>
					@endforeach
                	<div class="clear"></div>
                </div>

				@include('pc.pagination', ['paginator' => $works, 'interval' => 5])
                <!--<div class="listNav">
                	<a href="javascript:void(0);" class="sBtn">首页</a>

                    <a href="javascript:void(0);" class="sBtn">上一页</a>

                    <a href="javascript:void(0);">1</a>

                    <a href="javascript:void(0);">2</a>

                    <a href="javascript:void(0);">3</a>

                    <a href="javascript:void(0);">4</a>

                    <a href="javascript:void(0);">5</a>

                    <a href="javascript:void(0);" class="sBtn">下一页</a>

                    <a href="javascript:void(0);" class="sBtn">尾页</a>
                </div>-->

                <div class="nav nav1">
					<ul>
                    	<li class="navBtn1"><a href="{{url('/')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn2"><a href="{{url('my')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn3"><a href="{{url('list')}}" class="on"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn4"><a href="{{url('review')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn5"><a href="javascript:void(0);" onClick="showRule();"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
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
                <a href="javascript:void(0);" class="idVoteBtn"></a>
            </div>
        </div>
        <img src="{{asset('/assets/pc/images/loading.gif')}}" width="60" height="60" class="abs loadingImg" style="display:none;">

        <div class="abs noteBg" style="display:none;"></div>
        <div class="abs noVote" style="display:none;">
        	<div class="innerDiv">
            	<a href="javascript:void(0);" class="abs noVoteBtn" onClick="closeNoVote();"><img src="{{asset('/assets/pc/images/space.gif')}}" width="145" height="75"></a>
            </div>
        </div>
		<div class="rulePop" style="display:none;">
		    <div class="innerDiv">
		        <div class="ruleTitle"><img src="{{asset('/assets/pc/images/ruleTitle.png')}}"></div>
		        <div class="ruleBlock">
		            <div class="innerDiv">
		                <div id="scrollbar">
		                    <div class="scrollbar">
		                        <div class="track">
		                            <div class="thumb">
		                                <div class="end"></div>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="viewport">
		                        <div class="overview">
		                            <img src="{{asset('/assets/pc/images/rule.png')}}">
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="ruleBottom">
		            <a href="javascript:void(0);" onClick="closeRule();"><img src="{{asset('/assets/pc/images/closeBtn.jpg')}}"></a>
		        </div>
		    </div>
		</div>
    </div>
</div>
<script>
$(function(){
	$('.listSearchBtn').on('click', function(){
		$('#search_form').submit();
	})
	$('.listSel').on('change', function(){
		$('#search_form').submit();
	})
})

</script>
@endsection
