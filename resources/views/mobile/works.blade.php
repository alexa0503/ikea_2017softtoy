@foreach ($works as $work)
<div class="ilInit" onClick="showDetail(this);" data-url="{{url('mobile/work/'.$work->id)}}">
    <div class="innerDiv">
        <img src="{{asset('uploads/photo/thumb/'.$work->img_path)}}" class="abs iImg">
        <a class="abs iCover"><img src="{{asset('assets/mobile/images/page10Img3.png')}}"></a>
        <a class="abs ilVote">{{$work->like_num}}</a>
        <a class="abs ilName">{{$work->child_name}}</a>
        <a class="abs ilTitle">{{$work->title}}</a>
    </div>
</div>
@endforeach
