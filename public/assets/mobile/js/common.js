//找到url中匹配的字符串
function findInUrl(str) {
    url = location.href;
    return url.indexOf(str) == -1 ? false : true;
}
//获取url参数
function queryString(key) {
    return (document.location.search.match(new RegExp("(?:^\\?|&)" + key + "=(.*?)(?=&|$)")) || ['', null])[1];
}

//产生指定范围的随机数
function randomNumb(minNumb, maxNumb) {
    var rn = Math.round(Math.random() * (maxNumb - minNumb) + minNumb);
    return rn;
}

function showLoading() {
    $('.popBg').show();
    $('.loadingImg').show();
}

function closeLoading() {
    $('.popBg').hide();
    $('.loadingImg').hide();
}

function loginAction(url1,url2) {
    var lTel = $.trim($('.loginTxt1').val());
    var lName = $.trim($('.loginTxt2').val());
    var pattern = /^1\d{10}$/;
    if (lTel == '' || !pattern.test(lTel)) {
        alert('请输入正确的手机号码');
        return false;
    } else if (lName == '') {
        alert('请输入姓名');
        return false;
    } else {
        //ajax提交
        showLoading();
		$.post(url1, {mobile:lTel,name:lName},function(json){
			closeLoading();
			if(json && json.ret == 0){
		        window.location.href = url2;
			}
			else{
				//$('.popBg').show();
				//$('.haveDoneNote').show();
				alert(json.msg)
			}
		},"json").fail(function(){
			closeLoading();
			alert('提交失败，请重试');
		});

        //已经上传过
        //closeLoading();
        //$('.popBg').show();
        //$('.haveDoneNote').show();

        //提交成功

    }
}

function loginAction2() {
    var uid = $.trim($('.loginTxt3').val());
    if (uid == '') {
        alert('请输入员工号');
        return false;
    } else {
        //ajax提交
        showLoading();

        //已经上传过
        //closeLoading();
        //$('.popBg').show();
        //$('.haveDoneNote').show();

        //提交成功
        closeLoading();
        window.location.href = 'upload.html';
    }
}

//年月日
var uy, um, ud;

function YYYYMMDDstart() {

    MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    //先给年下拉框赋内容
    uy = new Date().getFullYear();
    um = new Date().getMonth() + 1;
    ud = new Date().getDate();
    uy = 2016;
    um = 11;
    ud = 14;
    for (var i = (uy - 12); i < (uy + 1); i++) //以今年为准，前60年，后0年
        document.upload.year.options.add(new Option(i + "年", i));
    //赋月份的下拉框
    for (var i = 1; i < 13; i++) {
        if (um >= i) {
            document.upload.month.options.add(new Option(i + "月", i));
        }
    }
    document.upload.year.value = uy;
    document.upload.month.value = new Date().getMonth() + 1;
    var n = MonHead[new Date().getMonth()];
    if (new Date().getMonth() == 1 && IsPinYear(YYYYvalue)) n++;
    writeDay(n); //赋日期下拉框Author:meizz
    document.upload.day.value = new Date().getDate();
}

function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)
{
    var MMvalue = document.upload.month.options[document.upload.month.selectedIndex].value;
    if (MMvalue == "") {
        var e = document.upload.day;
        optionsClear(e);
        return;
    }


    var n = MonHead[MMvalue - 1];
    if (MMvalue == 2 && IsPinYear(str)) n++;
    writeDay(n);


    //赋月份的下拉框
    var em = document.upload.month;
    optionsClear(em);
    for (var i = 1; i < 13; i++) {
        if ($.trim($('.uploadSel1').val()) == uy && um == i) {
            document.upload.month.options.add(new Option(i + "月", i));
            return;
        } else {
            document.upload.month.options.add(new Option(i + "月", i));
        }
    }
}

function MMDD(str) //月发生变化时日期联动
{
    var YYYYvalue = document.upload.year.options[document.upload.year.selectedIndex].value;
    if (YYYYvalue == "") {
        var e = document.upload.day;
        optionsClear(e);
        return;
    }
    var n = MonHead[str - 1];
    if (str == 2 && IsPinYear(YYYYvalue)) n++;
    writeDay(n)
}

function writeDay(n) //据条件写日期的下拉框
{
    var e = document.upload.day;
    optionsClear(e);
    for (var i = 1; i < (n + 1); i++)
        if ($.trim($('.uploadSel1').val()) == uy && $.trim($('.uploadSel2').val()) == um && i > ud) {

        } else {
            e.options.add(new Option(i + "日", i));
        }
}

function IsPinYear(year) //判断是否闰平年
{
    return (0 == year % 4 && (year % 100 != 0 || year % 400 == 0));
}

function optionsClear(e) {
    e.options.length = 1;
}

function changeGender(e) {
    $('.genderSel').removeClass('genderSelon');
    $('.genderSel' + e).addClass('genderSelon');
    $("input[name='gender']").val(e);
}

function changeAgree(e) {
    if ($(e).hasClass('agreeLiceOn')) {
        $(e).removeClass('agreeLiceOn');
    } else {
        $(e).addClass('agreeLiceOn');
    }
}

//全局变量
var isSelectedImg = false; //是否选择图片
var originalImgWidth; //原图宽度
var originalImgHeight; //原图高度
var oimg; //new image
var ow, oh;
var isOr = false;

function selectFileImage(fileObj) {
    var file = fileObj.files['0'];
    //图片方向角 added by lzk
    var Orientation = null;

    if (file) {
        var rFilter = /^(image\/jpeg|image\/png|image\/jpg)$/i; // 检查图片格式
        if (!rFilter.test(file.type)) {
            //showMyTips("请选择jpeg、png格式的图片", false);
            return;
        }
        // var URL = URL || webkitURL;
        //获取照片方向角属性，用户旋转控制
        EXIF.getData(file, function() {
            // alert(EXIF.pretty(this));
            EXIF.getAllTags(this);
            //alert(EXIF.getTag(this, 'Orientation'));
            Orientation = EXIF.getTag(this, 'Orientation');
            //return;
        });

        var oReader = new FileReader();
        oReader.onload = function(e) {
            //var blob = URL.createObjectURL(file);
            //_compress(blob, file, basePath);
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                if (Orientation == 6 || Orientation == 8) {
                    isOr = true;
                } else {
                    isOr = false;
                }
            }
        };
    };
    oReader.readAsDataURL(file);
}

//图片预览
function setImagePreview() {
    var docObj = document.getElementById("uploadBtn");
    var fileName = docObj.value;
    if (!fileName.match(/.jpg|.png/i)) {
        alert('您上传的图片格式不正确，请重新选择！');
        //isSelectedImg=false;
        return false;
    }

    var imgObjPreview = document.getElementById("preview");
    var upBtnImg = document.getElementById("upBtnImg");
    if (docObj.files && docObj.files[0]) {
        var localImagId = document.getElementById("localImag");
        localImagId.style.display = 'none';
        upBtnImg.style.display = 'none';
        //火狐下，直接设img属性
        imgObjPreview.style.display = 'block';
        imgObjPreview.style.width = '100%';
        //imgObjPreview.src = docObj.files[0].getAsDataURL();
        if (window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1) {
            imgObjPreview.src = window.webkitURL.createObjectURL(docObj.files[0]);
            oimg = new Image();
            oimg.onload = function() {
                originalImgWidth = oimg.width;
                originalImgHeight = oimg.height;
                isSelectedImg = true;
                goUploadStep2();
            }
            oimg.src = imgObjPreview.src;
        } else {
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
            oimg = new Image();
            oimg.onload = function() {
                originalImgWidth = oimg.width;
                originalImgHeight = oimg.height;
                isSelectedImg = true;
                goUploadStep2();
            }
            oimg.src = imgObjPreview.src;
        }
    } else {
        //IE下，使用滤镜
        docObj.select();
        docObj.blur();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("localImag");
        imgObjPreview.style.display = 'none';
        upBtnImg.style.display = 'none';
        //必须设置初始大小
        localImagId.style.width = "100%";
        //localImagId.style.height = "60px";
        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try {
            localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            oimg = new Image();
            oimg.onload = function() {
                originalImgWidth = oimg.width;
                originalImgHeight = oimg.height;
                isSelectedImg = true;
                goUploadStep2();
            }
            oimg.src = imgSrc;
        } catch (e) {
            alert("您上传的图片格式不正确，请重新选择！");
            //isSelectedImg=false;
            return false;
        }
        imgObjPreview.style.display = 'none';
        document.selection.empty();
    }
    return true;
}


function goUploadStep2() {
    $('.upLoadImg').css({
        'width': '0px',
        'height': '0px',
        'padding-top': '0px',
        'padding-left': '0px'
    });
    $('.uploadImgBlock').show();
    $('.uploadImg').addClass('uploadImged');
    setTimeout(function() {
        var bili = 521 / 347;
        if (isOr) {
            var tw = originalImgWidth;
            originalImgWidth = originalImgHeight;
            originalImgHeight = tw;
        }
        var imgBili = originalImgWidth / originalImgHeight;
        if (imgBili > bili) { //横版
            $('.upLoadImg').css({
                'width': '521px',
                'height': 'auto',
                'padding-top': (347 - (521 / originalImgWidth * originalImgHeight)) / 2 + 'px'
            });
        } else { //竖版
            $('.upLoadImg').css({
                'width': 'auto',
                'height': '347px',
                'padding-left': (521 - (347 / originalImgHeight * originalImgWidth)) / 2 + 'px'
            });
        }
    }, 100);
}

function goPage4() {
    if (!isSelectedImg) {
        alert('请上传作品');
        return false;
    } else {
        $('.page3').hide();
        $(window).scrollTop(0);
        $('.page4').show();
    }
}

function goPage3() {
    $('.page4').hide();
    $(window).scrollTop(0);
    $('.page3').show();
}

function preView() {
    var piSrc = $('#preview').attr('src');
    $('.piImg').attr('src', piSrc);
    var bili = 525 / 347;
    var imgBili = originalImgWidth / originalImgHeight;
    if (imgBili > bili) { //横版
        $('.piImg').css({
            'width': '525px',
            'height': 'auto',
            'padding-top': (347 - (525 / originalImgWidth * originalImgHeight)) / 2 + 'px'
        });
    } else { //竖版
        $('.piImg').css({
            'width': 'auto',
            'height': '347px',
            'padding-left': (525 - (347 / originalImgHeight * originalImgWidth)) / 2 + 'px'
        });
    }
    $('.piName').text($.trim($('.uploadTxt2').val()));
    $('.piTitle').text($.trim($('.uploadTxt3').val()));
    var piDesc = $.trim($('.uploadTxtarea').val());
    if (piDesc == '限50个字以内') {
        piDesc = '';
    }
    $('.piDesc').text(piDesc);
    $('.popBg').show();
    $('.popPreview').show();
}

var uploadTimeout1, uploadTimeout2, uploadTimeout3, uploadTimeout4, uploadTimeout5;

function submitImages() {
    var iTel = $.trim($('.uploadTxt1').val());
    var iName = $.trim($('.uploadTxt2').val());
    var iYY = $.trim($('.uploadSel1').val());
    var iMM = $.trim($('.uploadSel2').val());
    var iDD = $.trim($('.uploadSel3').val());
    var iGender = $('.genderSel').index($('.genderSelon')); //0 男、1 女
    var iTitle = $.trim($('.uploadTxt3').val());
    var iDesc = $.trim($('.uploadTxtarea').val());
    if (iDesc == '限50个字以内') {
        iDesc = '';
    }
    var needSynv = true ? $('.agreeLice2').hasClass('agreeLiceOn') : false; //是否需要同步更新宜家俱乐部会员信息

    var pattern = /^1\d{10}$/;

    if (!isSelectedImg) {
        alert('请上传作品');
        return false;
    } else if (!$('.agreeLice1').hasClass('agreeLiceOn')) {
        alert('请同意本次条件与条款');
        return false;
    } else if (iTel == '' || !pattern.test(iTel)) {
        alert('请输入正确的手机号码');
        return false;
    } else if (iName == '') {
        alert('请输入小作者姓名');
        return false;
    } else if (iYY == '' || iMM == '' || iDD == '') {
        alert('请选择小作者生日');
        return false;
    } else if (iGender != 0 && iGender != 1) {
        alert('请选择小作者性别');
        return false;
    } else if (iTitle == '') {
        alert('请输入作品名称');
        return false;
    } else if (iTitle.length > 10) {
        alert('作品名称限10个字以内');
        return false;
    }
    /*else if(iDesc == ''){
    	alert('请输入作品介绍');
    	return false;
    	}
    else if(iDesc.length>50){
    	alert('作品介绍限50个字以内');
    	return false;
    	}*/
    else {
        //已经提交过照片


        //未提交过照片 现在提交
        $('.popBg').show();
        $('.uploadPop').show();
        uploadTimeout1 = setTimeout(function() {
            var rt = randomNumb(5, 15);
            $('.loadingTxt span').html(rt);
            uploadTimeout2 = setTimeout(function() {
                var rt = randomNumb(25, 35);
                $('.loadingTxt span').html(rt);
                $('.loadingBar').css('background-position', '0 -40px');
                uploadTimeout3 = setTimeout(function() {
                    var rt = randomNumb(60, 70);
                    $('.loadingTxt span').html(rt);
                    $('.loadingBar').css('background-position', '0 -80px');
                    uploadTimeout4 = setTimeout(function() {
                        $('.loadingTxt span').html('99');
                        $('.loadingBar').css('background-position', '0 -120px');
                    }, 500);
                }, 700);
            }, 600);
        }, 500);
        //上传成功后执行
        $('#form').ajaxSubmit({
            dataType: 'json',
            success: function(json) {
                if(json.ret == 0){
                    uploadSuccess(json.url);
                }
                else{
                    $('.loadingBg').show();
                    $('.uploadPop2').show();
                    alert(json.msg);
                }
                //location.href = json.url;
                return false;
            },
            error: function(xhr) {
                $('.loadingBg').show();
                $('.uploadPop2').show();
                alert('上传失败~');
                //var json = jQuery.parseJSON(xhr.responseText);
                //alert(json.msg);
                //console.log(json);
                return false;
            }
        });


    }
}

function uploadSuccess(url) {
    clearTimeout(uploadTimeout1);
    clearTimeout(uploadTimeout2);
    clearTimeout(uploadTimeout3);
    clearTimeout(uploadTimeout4);
    clearTimeout(uploadTimeout5);
    $('.loadingTxt span').html('100');
    $('.loadingBar').css('background-position', '0 -120px');
    setTimeout(function() {
        window.location.href = url;
    }, 1000);
}

function pointSel(e) {
    $('.pointSel').removeClass('pointSelon');
    $('.pointSel' + e).addClass('pointSelon');
    $('.pointSence').css('background-position', '0 ' + parseInt(e) * (-43) + 'px');
    $('.degree').val(e);
}

function submitImageInfo() {
    var iPoint = $('.pointSel').index($('.pointSelon')); //0 不喜欢、1 一般、2 喜欢、3 很喜欢、4 太棒了
    var iSuggest = $.trim($('.uploadSucceedTxt1').val());
    var iEvent = $.trim($('.uploadSucceedTxt2').val());
    //ajax提交
    showLoading();
    $('#form').ajaxSubmit({
        dataType: 'json',
        success: function(json) {
            if(json.ret == 0){
                //提交成功
                closeLoading();
                $('.page4').hide();
                $('.page5').show();
            }
            else{
                closeLoading();
                alert(json.msg);
            }
            //location.href = json.url;
            return false;
        },
        error: function(xhr) {
            closeLoading();
            alert('提交失败~');
            //var json = jQuery.parseJSON(xhr.responseText);
            //alert(json.msg);
            //console.log(json);
            return false;
        }
    });




}

function voteId(e) {
    var url = $('.idVoteBtn').attr('data-url');
    $.getJSON(url,function(json){
        if(json.ret == 0){
            console.log(obj);
            var idv = parseInt($(e).html());
            idv++;
            $(e).html(idv);
            obj.find('.ilVote').html(idv);
            $('.idVoteBtn').addClass('idVoteBtnEd');
        }
        else{
            $('.noVoteBg').show();
            $('.noVote').show();
        }
    }).fail(function(){
        alert('抱歉，请求失败~');
    })

}

function closeNoVote() {
    $('.noVoteBg').hide();
    $('.noVote').hide();
}

function closeDetail() {
    $('.popBg').hide();
    $('.imgDetail').hide();
}
var obj;
function showDetail(e) {
    obj = $(e);
    var url = $(e).attr('data-url');
    $.getJSON(url,function(json){
        $('.popBg').show();
        $('.idImg').attr('src',json.data.img_url)
        $('.idVoteBtn').attr('data-url',json.data.vote_url)
        $('.idName').html(json.data.child_name);
        $('.idTitle').html(json.data.title);
        $('.idDesc').html(json.data.introduction);
        $('.idVoteBtn').html(json.data.vote_num);
        if(json.data.has_vote == 1){
            $('.idVoteBtn').addClass('idVoteBtnEd');
        }
        else{
            $('.idVoteBtn').removeClass('idVoteBtnEd');
        }

        workId = json.data.id;
        //$(window).scrollTop(0);
        $('.imgDetail').show();
    }).fail(function(){
        alert('网络异常~');
    })
}

function showRule() {
    $('.pop').hide();
    $('.popBg').show();
    //$(window).scrollTop(0);
    $('.popRule').show();
}

function closePop() {
    $('.popBg').hide();
    $('.pop').hide();
}

function showLice() {
    $('.pop').hide();
    $('.popBg').show();
    //$(window).scrollTop(0);
    $('.popLice').show();
}

var loadListImgLock = true;
var page = 1;

function loadListImg(url) {
    if (loadListImgLock) {
        loadListImgLock = false;
        var key = queryString('key');
        var order = queryString('order');
        //ajax请求数据
        $.get(url,{page:page,key:key,order:order},function(html){
            $('.imagesList .innerDiv').append(html);
            if(html != ''){
                loadListImgLock = true; //请求成功或者失败都解锁 如果没有数据了则不用解锁
                ++page;
            }

        });
    }
}
