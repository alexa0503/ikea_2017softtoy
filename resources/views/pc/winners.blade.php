@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page8">
        	<div class="innerDiv">
            	<div class="page8Bg"></div>

                <a href="#" class="abs page8Btn"><img src="{{asset('/assets/pc/images/space.gif')}}" width="145" height="75"></a>

                <div class="nav nav1">
                	<ul>
						<li class="navBtn1"><a href="{{url('/')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn2"><a href="{{url('my')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn3"><a href="{{url('list')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn4"><a href="{{url('review')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn5"><a href="javascript:void(0);" onclick="showRule();"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn6"><a href="{{url('winners')}}" class="on"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
		@include('pc.rule')
    </div>
</div>
@endsection
