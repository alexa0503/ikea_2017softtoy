<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{env("PAGE_TITLE")}}</title>
<link rel="stylesheet" href="{{asset('/assets/mobile/css/common.css')}}">
<script src="{{asset('/assets/mobile/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('/assets/mobile/js/jquery.form.js')}}"></script>
<script src="{{asset('/assets/mobile/js/exif.js')}}"></script>
<script src="{{asset('/assets/mobile/js/common.js')}}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="{{asset('/assets/mobile/js/wx.js')}}"></script>

<!--移动端版本兼容 -->
<script type="text/javascript">
         var phoneWidth =  parseInt(window.screen.width);
         var phoneScale = phoneWidth/640;
         var ua = navigator.userAgent;
         if (/Android (\d+\.\d+)/.test(ua)){
                   var version = parseFloat(RegExp.$1);
                   if(version>2.3){
                            document.write('<meta name="viewport" content="width=640, minimum-scale = '+phoneScale+', maximum-scale = '+phoneScale+', target-densitydpi=device-dpi">');
                   }else{
                            document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
                   }
         } else {
                   document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
         }
</script>
<!--移动端版本兼容 end -->

</head>

<body>
    @yield('content')
    <script>
    $(document).ready(function() {
        $.getJSON('{{url("wx/share")}}', {url:location.href},function(data){
    		data.link = '{{url("mobile/index")}}';
    		wxShare(data);
        })
    });
    </script>
    <script>
    $(document).ready(function() {
        $.getJSON('{{url("wx/share")}}', {url:location.href},function(data){
            @section('wxShare')
            data.link = '{{url("mobile/index")}}';
            wxShare(data);
            @show
        })
    });
    </script>
</body>
</html>
