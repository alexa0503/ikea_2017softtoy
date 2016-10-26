@extends('layouts.cms')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>控制面板首页</h2>
                        <span class="txt">点击左侧菜单查看详细</span>
                    </div>
                    <div class="header-stats">
                        <div class="spark clearfix">
                        </div>
                        <!--<div class="spark clearfix">
                            <div class="spark-info"><span class="number">17345</span>Views</div>
                            <div id="spark-templateviews" class="sparkline"></div>
                        </div>
                        <div class="spark clearfix">
                            <div class="spark-info"><span class="number">3700$</span>Sales</div>
                            <div id="spark-sales" class="sparkline"></div>
                        </div>-->
                    </div>
                </div>
                <!-- Start .row -->
                <div class="row">
                        <select name="lottery" class="form-control" id="lottery">
                            <option value="">请选择</option>
                            @foreach ($configs as $key => $config)
                            <option value="{{$key}}">{{$config[0]}}~{{$config[1]}}</option>
                            @endforeach
                        </select>
                    <div>
                        <table class="table table-striped table-bordered" id="table-lotteries">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>类别</th>
                                    <th>姓名</th>
                                    <th>手机</th>
                                    <th>省份</th>
                                    <th>城市</th>
                                    <th>地址</th>
                                    <th>点赞</th>
                                    <th>创建时间</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
@section('scripts')
    <script>
    $('#lottery').change(function(){
        if( $(this).val() == ''){
            $('#table-lotteries tbody').html('');
            return false;
        }
        var url = '{{url("cms/create/lottery")}}/' + $(this).val();
        $.getJSON(url,function(json){
            if(json.ret == 0){
                var html = '';
                $.each(json.data, function(index, val) {
                    html += '<tr>';
                    html += '<td><a href="http://ikea.dev/share/'+val.id+'" target="_blank">'+val.id+'</a></td>';
                    if( val.file_type == 0){
                        html += '<td>图片</td>';
                    }
                    else{
                        html += '<td>视频</td>';
                    }
                    html += '<td>'+val.name+'</td>';
                    html += '<td>'+val.mobile+'</td>';
                    html += '<td>'+val.province+'</td>';
                    html += '<td>'+val.city+'</td>';
                    html += '<td>'+val.address+'</td>';
                    html += '<td>'+val.like_num+'</td>';
                    html += '<td>'+val.created_time+'</td>';
                    html += '</tr>';
                });

                $('#table-lotteries tbody').html(html);
            }
            else{
                $('#table-lotteries tbody').html('');
                alert(json.msg);
            }
        })
    })
    /*
        $().ready(function () {
            $('#spark-visitors').sparkline([5,8,10,8,7,12,11,6,13,8,5,8,10,11,7,12,11,6,13,8], {
                type: 'bar',
                width: '100%',
                height: '20px',
                barColor: '#dfe2e7',
                zeroAxis: false,
            });
        })
    */
    </script>
@endsection
