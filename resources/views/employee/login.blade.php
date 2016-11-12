@extends('employee.layout')
@section('content')
<div class="bg">
	<div class="innerDiv">
    	<div class="page page2">
        	<div class="innerDiv">
            	<div class="page2BgB"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <input type="tel" class="abs loginTxt loginTxt3" maxlength="8">

                <a href="javascript:void(0);" class="abs loginBtn2" onClick="ga('send', 'event', 'button', 'click', 'login');loginAction2('{{url("employee/login")}}');"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="217" height="112"></a>
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
    	<a href="#" class="abs haveDoneNoteBtn"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="217" height="112"></a>
    </div>
</div>
@endsection
