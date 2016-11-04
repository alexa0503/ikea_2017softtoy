@extends('mobile.layout')
@section('content')
<form action="{{url('mobile/upload')}}" name="upload" method="post" id="form" onSubmit="return false;">
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

        		<input type="tel" class="abs uploadTxt uploadTxt1" value="{{$mobile}}" name="mobile" maxlength="11">
                <input type="text" class="abs uploadTxt uploadTxt2" name="child_name" maxlength="20">
                <div name="reg_testdate">
                    <select class="uploadSel uploadSel1" name="year"  onChange="YYYYDD(this.value);">
                        <option value="">年</option>
                    </select>
                    <select class="uploadSel uploadSel2" name="month"  onChange="MMDD(this.value)">
                        <option value="">月</option>
                    </select>
                    <select class="uploadSel uploadSel3" name="day">
                        <option value="">日</option>
                    </select>
                </div>
				<input type="hidden" name="gender" value="1" />
                <a href="javascript:void(0);" class="genderSel genderSel1 genderSelon" onClick="changeGender(1);"><img src="{{asset('/assets/mobile/images/page5Img2.png')}}"></a>
                <a href="javascript:void(0);" class="genderSel genderSel2" onClick="changeGender(2);"><img src="{{asset('/assets/mobile/images/page5Img2.png')}}"></a>
                <input type="text" name="title" class="abs uploadTxt uploadTxt3" placeholder="限10个字以内" maxlength="10">
                <textarea class="uploadTxtarea" name="introduction" maxlength="50" style="color:#a9a9a9;" onClick="$('.uploadTxtarea').css('color','#000').html('');">限50个字以内</textarea>

                <a href="javascript:void(0);" class="abs agreeLice1 agreeLiceOn" onClick="changeAgree(this);"><img src="{{asset('/assets/mobile/images/page5Img3.png')}}"></a>
                <a href="javascript:void(0);" class="abs agreeLice2 agreeLiceOn" onClick="changeAgree(this);"><img src="{{asset('/assets/mobile/images/page5Img3.png')}}"></a>
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
<div class="pop popRule" style="display:none; z-index:999;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<p>只要你是宜家俱乐部会员并且有未超过12周岁的孩子，即可在2016年11月7日至11月14日微信关注“宜家俱乐部”或登录宜家中国官方网站，上传您孩子的绘画作品，参与全球选拔。最终，全球将选出10幅作品，将其制成真实的毛绒玩具，成为宜家限量版毛绒玩具在全球各宜家商场进行销售。</p>
            <h2>绘画征集主题：孩子为自己设计玩具</h2>
            <p><strong>活动对象：</strong>所有在宜家中国注册的会员，他们未超过12周岁的子女均可参与（包括新注册的会员）<br />
            <strong>活动时间：</strong>2016年11月7日-14日<br />
            <strong>参与商场：</strong>中国地区的21家宜家商场</p>

            <h2>活动参与方式及流程：</h2>
            <p><strong>第一步：</strong>微信关注“宜家俱乐部”或登录宜家中国官方网站，点击“画毛绒玩具”进入活动页面<br />
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
<div class="pop popLice" style="display:none; z-index:999;">
	<div class="innerDiv">
    	<div class="popRuleBlock">
        	<h2>入选要求</h2>
            <p><strong>1. </strong>宜家中国 (IKEA China) 与宜家瑞典 (IKEA of Sweden AB) 于下文中统称为宜家 (IKEA)。<br>
            <strong>2. </strong>征集活动将于下列日期在宜家官网及官方微信举行：2016年11月7日至2016年11月14日。<br>
            <strong>3. </strong>此次征集活动面向所有父母或监护人为宜家俱乐部会员的儿童。参与儿童的年龄必须为0岁到12岁之间。<br>
            <strong>4. </strong>宜家有权随时要求参加评奖活动的宜家俱乐部会员提交参与评奖的身份证明和/或资格证明。若参与者收到此类要求但未能予以满足，则宜家可单方面决定取消参与者资格。<br>
            <strong>5. </strong>参赛前无须进行任何消费。<br>
            <strong>6. </strong>所有有意参选的儿童必须征得其父母或监护人的同意。征集活动当日必须有父母陪伴参与。<br>
            <strong>7. </strong>每位儿童只能提交一副作品。任何参与活动儿童的父母、监护人或任何第三方不得协助儿童完成作品。否则将取消参赛资格。未按时提交或未完成的作品也将取消参选资格。<br>
            <strong>8. </strong>在线/移动客户端活动：每位参与者的画作必须以照片或扫描形式提交。提交画作时，每位参与者必须标注姓名以及父母或监护人的宜家俱乐部会员编号。</p>

            <h2>如何参赛</h2>
            <p><strong>1. </strong>扫码关注微信或直接访问宜家官方网站，填写会员信息登录，系统会自动跳转到活动页面。<br>
            <strong>2. </strong>通过在线投票及宜家（中国）员工的封闭网络投票方式组合计分，确定中国前20名作品。<br>
            <strong>3. </strong>届时 20 幅国家入围画作将发送至宜家瑞典，由评审团挑选出 10 幅图画作为国际获奖作品（“国际获奖作品”）。评审团由宜家瑞典的儿童产品研发专家（高级产品设计师、产品研发工程师、产品设计师、产品供应规划师、商务团队代表）组成。<br>
            <strong>4. </strong>根据新闻价值、独特性以及制造成毛绒玩具的商业潜力和可行性等标准评判和挑选画作。</p>

            <h2>奖品设置</h2>
            <p><strong>5. </strong>每位参与活动的小朋友都将获得一份玩家证书。<br>
            <strong>6. </strong>20幅国家入围作品的作者，将得到：<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<strong>a. </strong>价值100元毛绒玩具（至门店领取）<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<strong>b. </strong>印有各自参赛作品的毛绒靠垫（将于2017年4月发放）<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<strong>c. </strong>作品被送至宜家瑞典总部，参与全球前10个优胜大奖的角逐<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<strong>d. </strong>宜家将以画作作者的名义向UNICEF（联合国儿童基金会）进行捐赠，每一幅画捐赠1欧元<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<strong>e. </strong>获得全球前10的优胜作品，会在2017年成为宜家限量版毛绒玩具在全球各宜家商场进行销售。并在投票结果公布后约2个月送至作者手中。<br>
            <strong>7. </strong>所有奖品均不可更改、转让，也不能退款。任何奖品或部分奖品不得兑换现金或作价销售。若出现无法控制的情形，宜家有权把前述奖品替换为价值相当的奖品。奖品税费由获奖者自行缴纳。<br>
            <strong>8. </strong>若宜家有合理理由认定参与者的行为不符合本条款和条件或行为方式不适当、不合法或具有冒犯性，则宜家保留另行评选获奖者并向其颁发奖品的绝对权利。<br>
            <strong>9. </strong>国际获奖者会收到电话通知。<br>
            <strong>10. </strong>征集活动的获奖者由宜家决定。该决定是最终决定且具有约束力。与征集活动的获奖人相关的任何事宜无需通知任何宜家俱乐部会员。</p>

            <h2>责任和许可</h2>
            <p><strong>11. </strong>此项征集活动的发起者为宜家中国，注册地址位于上海市。<br>
            <strong>12. </strong>对于可能限制、延迟您发送或接收邮件的任何类型的网络故障、电脑故障或软件故障，宜家不承担任何责任。发送证明不是接收证明。<br>
            <strong>13. </strong>任何超出宜家控制范围的延期、取消、延迟或奖品变更或任何第三方供应商的行为或违约所产生的损失，宜家不承担任何责任。宜家不会以任何方式推卸或限制因自身疏忽或欺诈行为引起的人员伤亡责任。<br>
            <strong>14. </strong>要求参与者（或其父母/监护人，视情况而定）在参加征集活动前提供一些个人信息，包括姓名和年龄、联系电子邮件地址、电话号码以及其父母或监护人的宜家俱乐部会员编号。宜家有权鉴于管理征集活动之目的使用参与者的个人信息是，并在其入围和/或成为获奖者后与其联系。在评选过程中，宜家还会与宜家集团的其他公司共享部分评选所需的信息。参选并提供此类信息即表明，每位参与者及其父母/监护人同意按照前述方式使用此类个人信息和画作。<br>
            <strong>15. </strong>征集活动结束后，致信向以下地址并表明参与姓名和日期即可获知获奖者姓名以及当地宜家门店信息。</p>

            <h2>个人信息和知识产权</h2>
            <p><strong>16. </strong>宜家和任何宜家特许经营公司出于宣传目的希望通过网站及其他媒体渠道公布所有参与者的姓名、年龄和参赛作品（画作）。参选即表明参与者及其父母/监护人同意按前述方式使用此类信息，无须征得进一步的同意、通知或补偿。<br>
            <strong>17. </strong>宜家希望根据 10 位国际获奖者的征集活动作品（画作）进行新产品的设计，并且按照此类设计制造限量的产品，在所有宜家特许经营门店以及网店销售（商业使用）。每销售一件此类限量毛绒玩具产品，宜家基金会 (IKEA Foundation) 将向由其自行选定的慈善团体捐赠 1 欧元，为有需要的儿童提供帮助。参选即表明参与者及其父母/监护人同意按前述方式使用此类信息，无须征得进一步的同意、通知或补偿。<br>
            <strong>18. </strong>向参与者和/或其父母/监护人收集的信息将只会在其成为获奖者后披露给第三方，此类披露方仅限于因向您发放奖品需要知悉此类信息的第三方。参选即表明，您同意我们将您的个人信息按前述方式进行披露，即使此类第三方可能位于欧洲经济区之外。宜家还会与宜家集团的其他公司以及其他宜家公司共享此类信息。同样，此类公司可能位于欧洲经济区之外。<br>
            <strong>19. </strong>当参与者的年龄为 12 岁或以下时，参与行为须征得其父母/监护人的同意。允许其子女参选即表明，每个宜家俱乐部会员同意宜家按照本条款和条件所说明的方式处理其子女的个人信息。<br>
            <strong>20. </strong>所有参赛作品必须为参与者原创作品。参选者提交的画作所含知识产权（包括版权和设计权在内）自该画作提交给宜家起即归于宜家所有。前述知识产权包括获奖作品和按获奖作品设计制作的玩具中所含的知识产权。<br>
            <strong>21. </strong>其画作应用于商业用途的 10 位参与者不得因此类使用而对设计享有任何权利，也无权获得除本条款和条件规定奖品以外的任何酬金、报偿或其他益处。宜家不会按照征集活动未获奖的作品研发任何产品。若 10 个画作设计当中有任何设计无法用于制造或商业化，则宜家有权不再对此产品进行商业化，并以其它任何参选作品的所制产品进行替代。<br>
            <strong>22. </strong>参选即表明所有参与者均已同意并接受本条款和条件的约束。</p>

        </div>
        <a href="javascript:void(0);" class="abs ruleCloseBtn" onClick="closePop();"><img src="{{asset('/assets/mobile/images/closeBtn.png')}}"></a>
    </div>
</div>
<img src="{{asset('/assets/mobile/images/loading.gif')}}" width="60" height="60" class="pop loadingImg" style="display:none;">
<div class="pop popPreview" style="display:none; z-index:999;">
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
<div class="pop uploadPop" style="display:none; z-index:999;">
    <div class="innerDiv">
        <p class="loadingTxt"><span>0</span> %</p>
        <div class="loadingBar"></div>
    </div>
</div>
</form>
<script>
$(function(){
	YYYYMMDDstart();
	})
</script>
@endsection
