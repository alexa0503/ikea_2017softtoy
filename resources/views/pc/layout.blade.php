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
</body>
</html>
