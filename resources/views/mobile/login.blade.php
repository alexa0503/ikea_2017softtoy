@extends('mobile.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page2">
        	<div class="innerDiv">
            	<div class="page2Bg"></div>
                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>
                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>
                <a href="{{url('mobile/my')}}" class="abs pageNav1"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="{{url('mobile/list')}}" class="abs pageNav2"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>
                <a href="javascript:void(0);" class="abs pageNav3"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="176" height="71"></a>

                <a href="#" class="abs regBtn"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="398" height="36"></a>

                <input type="tel" class="abs loginTxt loginTxt1" maxlength="11">
                <input type="text" class="abs loginTxt loginTxt2">
                <a href="javascript:void(0);" class="abs loginBtn" onClick="loginAction('{{url("mobile/login")}}','{{url("mobile/upload")}}');"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="217" height="112"></a>
            </div>
        </div>
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
<img src="{{asset('/assets/mobile/images/loading.gif')}}" width="60" height="60" class="pop loadingImg" style="display:none;">
<div class="pop haveDoneNote" style="display:none;">
	<div class="innerDiv">
    	<a href="{{url('mobile/my')}}" class="abs haveDoneNoteBtn"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="217" height="112"></a>
    </div>
</div>
@endsection
