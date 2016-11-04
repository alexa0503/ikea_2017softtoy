@extends('mobile.layout')
@section('content')
<form action="{{url('mobile/success')}}" method="post" id="form" onSubmit="return false;">
<div class="bg">
	<div class="innerDiv">
    	<div class="page page4">
        	<div class="innerDiv">
            	<div class="page4Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <a href="javascript:void(0);" class="abs pageRuleBtn" onClick="showRule();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="144" height="59"></a>

                <input type="text" class="uploadSucceedTxt uploadSucceedTxt1" maxlength="50" placeholder="限50个字以内" name="comment">
                <input type="text" class="uploadSucceedTxt uploadSucceedTxt2" maxlength="50" placeholder="限50个字以内" name="expect">

                <div class="pointSence"></div>

                <a href="javascript:void(0);" class="pointSel pointSel1" onClick="pointSel(1);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel2" onClick="pointSel(2);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel3" onClick="pointSel(3);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel4" onClick="pointSel(4);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
                <a href="javascript:void(0);" class="pointSel pointSel5 pointSelon" onClick="pointSel(5);"><img src="{{asset('/assets/mobile/images/page6Img2.png')}}"></a>
				<input type="hidden" name="degree" class="degree" value="0" />
                <a href="#" class="abs uploadSucceedBtn" onClick="submitImageInfo();"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="216" height="112"></a>
            </div>
        </div>

        <div class="page page5" style="display:none;">
        	<div class="innerDiv">
            	<div class="page5Bg"></div>

                <a href="http://m.ikea.com/cn/zh/" class="abs logo"><img src="{{asset('/assets/mobile/images/logo.png')}}"></a>

                <img src="{{asset('/assets/mobile/images/page7Img2.png')}}" class="abs page7Img2">
                
                <a href="{{url('mobile/my')}}" class="abs" style="left:194px; top:471px;"><img src="{{asset('/assets/mobile/images/space.gif')}}" width="250" height="132"></a>
                
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
<div class="pop popRule" style="display:none; z-index:999;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<p>只要你是宜家俱乐部会员并且有未超过12周岁的孩子，即可在2016年11月7日至11月14日微信关注”宜家俱乐部‘’或登录宜家中国官方网站，上传您孩子的绘画作品，参与全球选拔。最终，全球将选出10幅作品，将其制成真实的毛绒玩具，成为宜家限量版毛绒玩具在全球各宜家商场进行销售。</p>
            <h2>绘画征集主题：孩子为自己设计玩具</h2>
            <p><strong>活动对象：</strong>所有在宜家中国注册的会员，他们未超过12周岁的子女均可参与（包括新注册的会员）<br />
            <strong>活动时间：</strong>2016年11月7日-14日<br />
            <strong>参与商场：</strong>中国地区的21家宜家商场</p>
            
            <h2>活动参与方式及流程：</h2>
            <p><strong>第一步：</strong>微信关注”宜家俱乐部‘’或登录宜家中国官方网站，点击“画毛绒玩具”进入活动页面<br />
            <strong>第二步：</strong>上传您孩子的画作，填写完整作品信息，并且用一句话概括作品最突出的地方<br />
            <strong>第三步：</strong>告诉我们您对本次活动的评价和建议<br />
            <strong>第四步：</strong>提交画作，等待照片审核（审核所需时间不超过画作提交后的24小时）</p>
            
            <h2>上传作品规则：</h2>
            <p><strong>1. </strong>每位会员只能上传一张画作，并且请确保您拥有上传的画作的版权和所有权<br />
            <strong>2. </strong>照片的内容必须是可以做成毛绒玩具的手绘画作<br />
            <strong>3. </strong>宜家有权自行删除与本次活动无关、违反法律法规或侵犯第三方权益的照片</p>
            
            <h2>评选流程与规则：</h2>
            <p><strong>1. 第一阶段：</strong><br />
            2016年11月7日-14日，采用面向公众的网络公开投票，本次活动所有参与者均可以通过活动页面为所有作品进行投票，同一个微信账号每天限投10票（这10票不可重复投给某一幅画作），参赛作品的得票数将按40%的权重计分，并计入总得分<br />
            • 分数计算方法: 作品A在本次活动中获票数最高, 为100票, 则作品A可获最高的40分, 同时票数为一个基数, 作品B得票数80票, 则作品B可获40 x (80/100)= 32分, 以此类推<br /><br />
            
            <strong>2. 第二阶段：</strong><br />
            2016年11月15日-20日，采用面向宜家（中国）员工的封闭网络投票，宜家（中国）员工可对所有参赛作品进行投票，每位员工限投10票（这10票不可重复投给某一幅画作），参赛作品在此阶段的得票数将按60%的权重计分，并计入总得分<br />
            • 分数计算方法: 作品B在本次活动中获票数最高, 为100票, 则作品B可获最高的60分, 同时票数为一个基数, 作品A得票数80票, 则作品A可获60 x (80/100)= 48分, 以此类推<br /><br />
            
            <strong>3. 最终积分评选：</strong><br />
            2016年11月21日-22日, 最终积分评选, 以第一和二阶段分数总和为最终排名：<br />
            • 分数计算方法, 作品A最终得分= 40分+ 48分= 88分; 作品B最终得分= 32分+ 60分= 92分, 以此类推<br /><br />
            
            <strong>4. </strong>2016年11月25日，前20名优胜作品将于官网活动页面公布<br />
            <strong>5. </strong>2016年12月1日，宜家（中国）将优胜的20幅作品提交至瑞典总部，并在官方微信公布结果<br />
            <strong>6. </strong>2017年3月1日，宜家将公布全球Top 10的作品，并在官方微信和官网公布结果</p>
            
            <h2>奖品：</h2>
            <p><strong>1. </strong>每位参与活动的小朋友都将获得一份玩乐小达人证书（活动结束1周后凭短信于指定时间至各商场领取）<br />
            <strong>2. </strong>宜家（中国）员工将从所有参赛画作中，投票选择中国区前20幅绘画作品。这20位小朋友可额外获得：<br />
            &nbsp;&nbsp;&nbsp;&nbsp;a. 价值100元毛绒玩具（活动结束后凭短信和身份证至商场领取）<br />
            &nbsp;&nbsp;&nbsp;&nbsp;b. 印有各自参赛作品的靠垫（将于2017年4月颁发）<br />
            &nbsp;&nbsp;&nbsp;&nbsp;c. 作品被送至宜家瑞典总部，参与全球前10个优胜大奖的角逐<br />
            &nbsp;&nbsp;&nbsp;&nbsp;d. 获得全球前10的优胜作品，会在2017年成为宜家限量版毛绒玩具在全球各宜家商场进行销售。并在投票结果公布后约2个月送至作者手中<br />
            &nbsp;&nbsp;&nbsp;&nbsp;e. 宜家将以画作作者的名义向UNICEF（联合国儿童基金会）进行捐赠，每一幅画捐赠1欧元</p>
                
            <h2>注意事项：</h2>
            <p><strong>1. </strong>宜家和任何宜家特许经营公司出于宣传目的希望通过网站及其他媒体渠道公布所有参与者的姓名、年龄和参赛作品（画作）。参选即表明参与者及其父母/监护人同意按前述方式使用此类信息，无须征得进一步的同意、通知或补偿。<br />
            <strong>2. </strong>宜家希望根据 10 位国际获奖者的征集活动作品（画作）进行新产品的设计，并且按照此类设计制造限量的产品，在所有宜家特许经营门店以及网店销售（商业使用）。每销售一件此类限量毛绒玩具产品，宜家基金会 (IKEA Foundation) 将向由其自行选定的慈善团体捐赠 1 欧元，为有需要的儿童提供帮助。参选即表明参与者及其父母/监护人同意按前述方式使用此类信息，无须征得进一步的同意、通知或补偿。<br />
            <strong>3. </strong>参与用户不得上传涉及淫秽色情、暴力、侮辱他人等妨碍社会治安、违 法国家法律或有损社会道德风气，以及与本次活动无关的文字、照片或视频。一旦发现上述行为，主办方有权在不通知参与用户的前提下予以删除，并向有关部门举报。<br />
            <strong>4. </strong>参与用户的合法言论、文章及图片一经在本此活动中发表，则该作品的版权，除署名权、发表权、修改权、保护作品完整权归原作者享有外，其他权益无偿转归本站独占所有。“其他权益”包括但不限于：通过复制、发行、信息网络传播、改编、翻译、汇编及应由版权人享有的其他方式使用上述作品的权利。<br />
            <strong>5. </strong>参与活动的用户请详细填写个人信息。如因个人信息不完整或不准确而造成主办方在获奖名单公布后30天内无法联系到中奖者，将视为中奖者自行放弃中奖，主办方将不作任何形式的赔偿。<br />
            <strong>6. </strong>宜家中国区域的21家商场将作为唯一的奖品发放地点，对活动的获奖者进行颁奖。若获奖者所在地不在有宜家商场的城市（即上海、北京、成都、广州、南京、大连、深圳、沈阳、天津、无锡、宁波、重庆、武汉、杭州和西安以外的城市），可要求将奖品以快递形式送至获奖者指定地点。主办方将承担奖品快递费用，但若快递途中奖品有任何损坏，主办方不负任何责任。<br />
            <strong>7. </strong>获奖用户一经确认奖品，不得自行撤销，更改或转让。如因不可抗力因素导致活动主办方无法提供指定奖品，活动主办方可以以等值或价值更高的奖品替代。所有奖品不得兑换现金或作价销售。<br />
            <strong>8. </strong>如果发现有参加活动的用户在活动中使用任何不正当的手段参加活动，活动主办方有权在不事先通知的前提下，取消该用户参加活动的资格。<br />
            <strong>9. </strong>宜家保留在法律允许范围内对本次活动的最终解释权。</p>
        </div>
        <a href="javascript:void(0);" class="abs ruleCloseBtn" onClick="closePop();"><img src="{{asset('/assets/mobile/images/closeBtn.png')}}"></a>
    </div>
</div>
</form>
@endsection
