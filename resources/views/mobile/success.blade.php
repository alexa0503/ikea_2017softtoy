@extends('mobile.layout')
@section('content')
<form action="{{url('mobile/success')}}" method="post" id="form" onsubmit="return false;">
<div class="bg">
	<div class="innerDiv">
    	<div class="page page4">
        	<div class="innerDiv">
            	<div class="page4Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>

                <input type="text" class="uploadSucceedTxt uploadSucceedTxt1" maxlength="50" placeholder="限50个字以内">
                <input type="text" class="uploadSucceedTxt uploadSucceedTxt2" maxlength="50" placeholder="限50个字以内">

                <div class="pointSence"></div>

                <a href="javascript:void(0);" class="pointSel pointSel1" onClick="pointSel(1);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel2" onClick="pointSel(2);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel3" onClick="pointSel(3);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel4" onClick="pointSel(4);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel5 pointSelon" onClick="pointSel(5);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>

                <a href="#" class="abs uploadSucceedBtn" onClick="submitImageInfo();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
            </div>
        </div>

        <div class="page page5" style="display:none;">
        	<div class="innerDiv">
            	<div class="page5Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <img src="{{asset('/assets/mobile/images/page7Img2.png')}}" class="abs page7Img2">
				<a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>
				<a href="{{url('mobile/my')}}" class="abs pageNav1"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
				<a href="{{url('mobile/list')}}" class="abs pageNav2"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
				<a href="javascript:void(0);" class="abs pageNav3"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>

            </div>
        </div>

        <div class="abs loadingBg" style="display:none;"></div>
        <img src="{{asset('/assets/mobile/images/loading.gif')}}" width="60" height="60" class="abs loadingImg" style="display:none;">
    </div>
</div>

<div class="popBg" style="display:none;"></div>
<div class="pop popRule" style="display:none;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<img src="{{asset('/assets/mobile/images/rule.png')}}">
        </div>
        <a href="javascript:void(0);" class="abs ruleCloseBtn" onClick="closePop();"><img src="{{asset('/assets/mobile/images/closeBtn.png')}}"></a>
    </div>
</div>
</form>
@endsection
