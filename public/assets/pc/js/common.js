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
    $('.loadingBg').show();
    $('.loadingImg').show();
}

function closeLoading() {
    $('.loadingBg').hide();
    $('.loadingImg').hide();
}

function loginAction() {
    var lId = $.trim($('.loginTxt1').val());
    var lName = $.trim($('.loginTxt2').val());
    if (lId == '') {
        alert('请输入会员卡号');
        return false;
    } else if (lName == '') {
        alert('请输入姓名');
        return false;
    } else {
        //ajax提交
        showLoading();

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
    for (var i = (uy - 60); i < (uy + 1); i++) //以今年为准，前60年，后0年
        document.reg_testdate.YYYY.options.add(new Option(i + "年", i));
    //赋月份的下拉框
    for (var i = 1; i < 13; i++) {
        if (um >= i) {
            document.reg_testdate.MM.options.add(new Option(i + "月", i));
        }
    }
    document.reg_testdate.YYYY.value = uy;
    document.reg_testdate.MM.value = new Date().getMonth() + 1;
    var n = MonHead[new Date().getMonth()];
    if (new Date().getMonth() == 1 && IsPinYear(YYYYvalue)) n++;
    writeDay(n); //赋日期下拉框Author:meizz
    document.reg_testdate.DD.value = new Date().getDate();
}

function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)
{
    var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;
    if (MMvalue == "") {
        var e = document.reg_testdate.DD;
        optionsClear(e);
        return;
    }


    var n = MonHead[MMvalue - 1];
    if (MMvalue == 2 && IsPinYear(str)) n++;
    writeDay(n);


    //赋月份的下拉框
    var em = document.reg_testdate.MM;
    optionsClear(em);
    for (var i = 1; i < 13; i++) {
        if ($.trim($('.uploadSel1').val()) == uy && um == i) {
            document.reg_testdate.MM.options.add(new Option(i + "月", i));
            return;
        } else {
            document.reg_testdate.MM.options.add(new Option(i + "月", i));
        }
    }
}

function MMDD(str) //月发生变化时日期联动
{
    var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;
    if (YYYYvalue == "") {
        var e = document.reg_testdate.DD;
        optionsClear(e);
        return;
    }
    var n = MonHead[str - 1];
    if (str == 2 && IsPinYear(YYYYvalue)) n++;
    writeDay(n)
}

function writeDay(n) //据条件写日期的下拉框
{
    var e = document.reg_testdate.DD;
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
        var bili = 380 / 253;
        var imgBili = originalImgWidth / originalImgHeight;
        if (imgBili > bili) { //横版
            $('.upLoadImg').css({
                'width': '380px',
                'height': 'auto',
                'padding-top': (253 - (380 / originalImgWidth * originalImgHeight)) / 2 + 'px'
            });
        } else { //竖版
            $('.upLoadImg').css({
                'width': 'auto',
                'height': '253px',
                'padding-left': (380 - (253 / originalImgHeight * originalImgWidth)) / 2 + 'px'
            });
        }
    }, 100);
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
    } else if (iDesc == '') {
        alert('请输入作品介绍');
        return false;
    } else if (iDesc.length > 50) {
        alert('作品介绍限50个字以内');
        return false;
    } else {
        //已经提交过照片
        //$('.loadingBg').show();
        //$('.uploadPop2').show();

        //未提交过照片 现在提交
        $('.loadingBg').show();
        $('.uploadPop1').show();
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
                        $('.loadingTxt span').html('100');
                        $('.loadingBar').css('background-position', '0 -120px');
                    }, 500);
                }, 700);
            }, 600);
        }, 500);
        //上传成功后执行
        uploadSuccess();

    }
}

function uploadSuccess() {
    clearTimeout(uploadTimeout1);
    clearTimeout(uploadTimeout2);
    clearTimeout(uploadTimeout3);
    clearTimeout(uploadTimeout4);
    clearTimeout(uploadTimeout5);
    $('.loadingTxt span').html('100');
    $('.loadingBar').css('background-position', '0 -120px');
    setTimeout(function() {
        window.location.href = 'uploadSucceed.html';
    }, 1000);
}

function pointSel(e) {
    $('.pointSel').removeClass('pointSelon');
    $('.pointSel' + e).addClass('pointSelon');
}

function submitImageInfo() {
    var iPoint = $('.pointSel').index($('.pointSelon')); //0 不喜欢、1 一般、2 喜欢、3 很喜欢、4 太棒了
    var iSuggest = $.trim($('.uploadSucceedTxt1').val());
    var iEvent = $.trim($('.uploadSucceedTxt2').val());

    //ajax提交
    showLoading();

    //提交成功
    closeLoading();
    $('.page4').hide();
    $('.page5').show();
}

function voteId(e) {
    var canVote = true; //是否可以投票
    if (canVote) {
        var idv = parseInt($(e).html());
        idv++;
        $(e).html(idv);
    } else {
        $('.noteBg').show();
        $('.noVote').show();
    }
}

function closeDetail() {
    $('.loadingBg').hide();
    $('.imgDetail').hide();
}

function showDetail(e) {
    var url = $(e).attr('data-url');
    ga('send', 'event', 'gallery', 'click', 'artwork:' + url);
    $.getJSON(url, function(json) {
        $('.idImg').attr('src', json.data.img_url)
        $('.idName').html(json.data.child_name);
        $('.idTitle').html(json.data.title);
        $('.idDesc').html(json.data.introduction);
        $('.idQc').attr('src', json.data.qrcode_url);
        $('.idVoteBtn').html(json.data.vote_num)

        $('.loadingBg').show();
        $('.imgDetail').show();
    }).fail(function() {
        alert('网络异常~');
    })
}

function closeNoVote() {
    $('.noteBg').hide();
    $('.noVote').hide();
}

function showRule() {
    $('.loadingBg').show();
    $('.rulePop').show();
    $('#scrollbar').tinyscrollbar();
}

function closeRule() {
    $('.loadingBg').hide();
    $('.rulePop').hide();
}

function showLic() {
    $('.loadingBg').show();
    $('.licPop').show();
    $('#scrollbar2').tinyscrollbar();
}

function closeLic() {
    $('.loadingBg').hide();
    $('.licPop').hide();
}
