<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{{env("PAGE_TITLE")}}</title>
<link rel="stylesheet" href="{{asset('/assets/pc/css/common.css')}}">
<script src="{{asset('/assets/pc/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('/assets/pc/js/common.js')}}?v=0.01"></script>
<script src="{{asset('/assets/pc/js/jquery.tinyscrollbar.min.js')}}"></script>
</head>

<body>
@yield('content')

<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');  ga('create', 'UA-66883310-15', 'auto');  ga('send', 'pageview');


function gaTrackUrl(e,gat,act,lab){
	var gUrl=$(e).attr('href');
	ga('send','event',gat,act,lab,{'hitCallback':function(){
			window.location.href=gUrl;
			}});
	return false;
	}

</script>

</body>
</html>
