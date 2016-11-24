@extends('mobile.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page1">
        	<div class="innerDiv">
            	<div class="pageReview" style="background-image:url({{asset('/assets/mobile/images/award.jpg')}}); height:3486px;"></div>

                <a href="http://m.ikea.com/cn/zh/" onClick="gaTrackUrl(this,'button','click','IKEA');" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>
                <a href="{{url('mobile/my')}}" onClick="gaTrackUrl(this,'button','click','myartwork');" class="abs pageNav1"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/list')}}" onClick="gaTrackUrl(this,'button','click','gallery');" class="abs pageNav2"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/review')}}" onClick="gaTrackUrl(this,'button','click','review');" class="abs pageNav3"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>

            </div>
        </div>
    </div>
</div>
@endsection
