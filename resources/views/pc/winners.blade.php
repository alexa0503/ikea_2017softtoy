@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page pageReview">
        	<div class="innerDiv">
            	<div class="pageReviewBg"></div>

                <div class="reviewBlock">
                	<div class="innerDiv">
                    	<div id="scrollbar3">
                            <div class="scrollbar">
                                <div class="track">
                                    <div class="thumb">
                                        <div class="end"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="viewport">
                                <div class="overview">
                                    <img src="{{asset('/assets/pc/images/award.jpg')}}" width="978" height="1170">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <script>
                	$(function(){
						$('#scrollbar3').tinyscrollbar();
						})
                </script>

                <div class="nav nav1">
                	<ul>
						<li class="navBtn1"><a href="{{url('/')}}" onClick="gaTrackUrl(this,'button','click','homepage');"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn2"><a href="{{url('my')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn3"><a href="{{url('list')}}" onClick="gaTrackUrl(this,'button','click','gallery');"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn4"><a href="{{url('review')}}" onClick="gaTrackUrl(this,'button','click','review');"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn5"><a href="javascript:void(0);" onClick="showRule();ga('send','event','button','click','rules');"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn6"><a href="{{url('winners')}}" onClick="gaTrackUrl(this,'button','click','winner');" class="on"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="abs loadingBg" style="display:none;"></div>
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
@endsection
