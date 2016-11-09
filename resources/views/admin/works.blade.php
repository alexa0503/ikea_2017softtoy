@extends('admin.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>信息</h2>
                        <span class="txt"></span>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <div class="row">
                                    <!--<div class="col-md-2 col-xs-12 ">
                                        <div class="dataTables_length" id="responsive-datatables_length"><label><span><select name="responsive-datatables_length" aria-controls="responsive-datatables" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></span></label>
                                        </div>
                                    </div>-->
                                    <div class="col-md-10 col-xs-12">
                                        <div id="responsive-datatables_filter" class="dataTables_filter">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <label class="sr-only" for="">请输入用户名</label>
                                                    <input type="text" class="form-control input-sm" placeholder="请输入用户名" name="name" value="{{Request::get('name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="">请输入电话</label>
                                                    <input type="search" class="form-control input-sm" placeholder="请输入电话" aria-controls="responsive-datatables" name="mobile" value="{{Request::get('mobile')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="">请输入小孩名</label>
                                                    <input type="search" class="form-control input-sm" placeholder="请输入小孩名" aria-controls="responsive-datatables" name="child_name" value="{{Request::get('child_name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="">请输入作品名称</label>
                                                    <input type="search" class="form-control input-sm" placeholder="请输入作品名称" aria-controls="responsive-datatables" name="title" value="{{Request::get('title')}}">
                                                </div>
                                                <button type="submit" class="btn btn-success ml10">搜索</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="basic-datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>照片</th>
                                        <th>手机号(IKEA)</th>
                                        <th>姓名(IKEA)</th>
                                        <th>手机</th>
                                        <th>生日</th>
                                        <th>小孩姓名</th>
                                        <th>性别</th>
                                        <th>标题</th>
                                        <th>介绍</th>
                                        <th>创建时间</th>
                                        <th>创建IP</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($works as $work)
                                    <tr>
                                        <td>{{ $work->id }}</td>
                                        <td><a href="{{ asset('uploads/photo/'.$work->img_path) }}"><img src="{{ asset('uploads/photo/thumb/'.$work->img_path) }}" style="max-width:160px;max-height:160px;" /></a></td>
                                        <td>{{ $work->user->mobile }}</td>
                                        <td>{{ $work->user->name }}</td>
                                        <td>{{ $work->mobile }}</td>
                                        <td>{{ $work->birth_date }}</td>
                                        <td>{{ $work->child_name }}</td>
                                        <td>{{ $work->gender }}</td>
                                        <td>{{ $work->title }}</td>
                                        <td>{{ $work->introduction }}</td>
                                        <td>{{ $work->created_at }}</td>
                                        <td>{{ $work->created_ip }}</td>
                                        <td>{{ ($work->is_active == 1) ? '正常' : '关闭'}}</td>
                                        <td><a href="{{url('admin/work/update',['id'=>$work->id])}}" class="label label-primary update">{{ ($work->is_active == 1) ? '关闭' : '开启'}}</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $works->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .panel -->
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
$(document).ready(function() {
    $('.delete').click(function(){
        var url = $(this).attr('href');
        var obj = $(this).parents('td').parent('tr');
        if( confirm('该操作无法返回,是否继续?')){
            $.ajax(url, {
                dataType: 'json',
                success: function(json){
                    if(json.ret == 0){
                        obj.remove();
                    }
                },
                error: function(){
                    alert('请求失败~');
                }
            });
        }
        return false;
    })
    $('.update').click(function(){
        var url = $(this).attr('href');
        var obj = $(this);
        $.ajax(url, {
            dataType: 'json',
            success: function(json){
                if(json.ret == 0){
                    location.reload();
                }
            },
            error: function(){
                alert('请求失败~');
            }
        });
        return false;
    })
});
</script>
@endsection
