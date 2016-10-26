@extends('mobile.layout')
@section('content')
<form action="{{url('mobile/upload')}}" method="post" id="form" onsubmit="return false;">
<div class="bg">
	<div class="innerDiv">
    	<div class="page page3">
        	<div class="innerDiv">
            	<div class="page3Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>

                <input type="file" name="photo" class="uploadImg" id="uploadBtn" onChange="selectFileImage(this);setImagePreview();">

                <div class="uploadImgBlock" style="display:none;">
                    <div class="innerDiv">
                        <img src="" class="abs upBtnImg upLoadImg" id="upBtnImg">
                        <img src="" class="abs upLoadImg" id="preview" />
                        <img src="" class="abs upLoadImg" id="localImag" />
                        <img src="{{asset('/assets/mobile/images/page4Img4.png')}}" class="uploadImgCover">
                    </div>
                </div>

                <a href="javascript:void(0);" class="abs uploadBtn1" onClick="goPage4();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
            </div>
        </div>

        <div class="page page4" style="display:none;">
        	<div class="innerDiv">
            	<div class="page3BgB"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

            	<a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>

        		<input type="text" class="abs uploadTxt uploadTxt1" name="mobile" maxlength="11">
                <input type="text" class="abs uploadTxt uploadTxt2" name="child_name" maxlength="20">
                <div name="reg_testdate">
                    <select class="uploadSel uploadSel1" name="year">
                        <option value="">年</option>
						@for ($i = 1980; $i <= 2016; $i++)
						<option value="{{$i}}">{{$i}}年</option>
						@endfor
                    </select>
                    <select class="uploadSel uploadSel2" name="month">
                        <option value="">月</option>
						@for ($i = 1; $i <= 12; $i++)
						<option value="{{$i}}">{{$i}}月</option>
						@endfor
                    </select>
                    <select class="uploadSel uploadSel3" name="day">
                        <option value="">日</option>
						@for ($i = 1; $i <= 31; $i++)
						<option value="{{$i}}">{{$i}}日</option>
						@endfor
                    </select>
                </div>
				<input type="hidden" name="gender" value="1" />
                <a href="javascript:void(0);" class="genderSel genderSel1 genderSelon" onClick="changeGender(1);"><img src="{{asset('/assets/mobile/images/page5Img2.png')}}"></a>
                <a href="javascript:void(0);" class="genderSel genderSel2" onClick="changeGender(2);"><img src="{{asset('/assets/mobile/images/page5Img2.png')}}"></a>
                <input type="text" name="title" class="abs uploadTxt uploadTxt3" placeholder="限10个字以内" maxlength="10">
                <textarea class="uploadTxtarea" name="introduction" maxlength="50" style="color:#a9a9a9;" onClick="$('.uploadTxtarea').css('color','#000').html('');">限50个字以内</textarea>

                <a href="javascript:void(0);" class="abs agreeLice1 agreeLiceOn" onClick="changeAgree(this);"><img src="{{asset('/assets/mobile/images/page5Img3.png')}}"></a>
                <a href="javascript:void(0);" class="abs agreeLice2 agreeLiceOn"><img src="{{asset('/assets/mobile/images/page5Img3.png')}}"></a>
                <a href="javascript:void(0);" class="abs uploadBtn3" onClick="showLice();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="116" height="24"></a>
                <a href="javascript:void(0);" class="abs uploadBtn4" onClick="showLice();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="150" height="24"></a>

                <a href="javascript:void(0);" class="abs uploadBtn7" onClick="preView();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="73" height="102"></a>

                <a href="javascript:void(0);" class="abs uploadBtn5" onClick="goPage3();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
                <a href="javascript:void(0);" class="abs uploadBtn2" onClick="submitImages();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
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
<div class="pop popLice" style="display:none;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<img src="{{asset('/assets/mobile/images/rule.png')}}">
        </div>
        <a href="javascript:void(0);" class="abs ruleCloseBtn" onClick="closePop();"><img src="{{asset('/assets/mobile/images/closeBtn.png')}}"></a>
    </div>
</div>
<img src="{{asset('/assets/mobile/images/loading.gif')}}" width="60" height="60" class="pop loadingImg" style="display:none;">
<div class="pop popPreview" style="display:none;">
	<div class="innerDiv">
    	<div class="previewImgBlock">
        	<div class="innerDiv">
            	<img src="" class="piImg">
                <img src="{{asset('/assets/mobile/images/page5Img5.png')}}" class="abs page5Img5">
            </div>
        </div>
        <div class="piName"></div>
		<div class="piTitle"></div>
		<div class="piDesc"></div>
        <a href="javascript:void(0);" class="abs uploadBtn8" onClick="closePop();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
    </div>
</div>
<div class="pop uploadPop" style="display:none;">
    <div class="innerDiv">
        <p class="loadingTxt"><span>0</span> %</p>
        <div class="loadingBar"></div>
    </div>
</div>
</form>
@endsection
