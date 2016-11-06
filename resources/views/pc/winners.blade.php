@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page8">
        	<div class="innerDiv">
            	<div class="page8Bg"></div>

                <a href="#" onClick="gaTrackUrl(this,'button','click','winnerlist');" class="abs page8Btn"><img src="{{asset('/assets/pc/images/space.gif')}}" width="145" height="75"></a>

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
		@include('pc.rule')
    </div>
</div>
@endsection
