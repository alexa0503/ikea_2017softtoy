@extends('mobile.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page1">
        	<div class="innerDiv">
            	<div class="pageReview"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>
                <a href="{{url('mobile/my')}}" class="abs pageNav1"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/list')}}" class="abs pageNav2"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/review')}}" class="abs pageNav3"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>

            </div>
        </div>
    </div>
</div>
@endsection
