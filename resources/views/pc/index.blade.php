@extends('pc.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page1">
        	<div class="innerDiv">
            	<div class="page1Bg"></div>
                <img src="{{asset('/assets/pc/images/page1Qc.png')}}" class="abs page1Qc">

                <a href="{{url('login')}}" class="abs page1Btn"><img src="{{asset('/assets/pc/images/space.gif')}}" width="148" height="37"></a>

                <div class="nav nav1">
                    <ul>
                    	<li class="navBtn1"><a href="{{url('/')}}" class="on"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn2"><a href="{{url('my')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn3"><a href="{{url('list')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn4"><a href="javascript:void(0);"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn5"><a href="javascript:void(0);"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                        <li class="navBtn6"><a href="{{url('winners')}}"><img src="{{asset('/assets/pc/images/space.gif')}}"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
