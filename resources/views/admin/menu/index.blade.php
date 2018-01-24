@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">菜单管理</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="index.html#">Zircos</a>
                            </li>
                            <li>
                                <a href="index.html#">Dashboard</a>
                            </li>
                            <li class="active">
                                Dashboard
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-2">
                            <a href="{{ route('admin.menu.create') }}" class="btn btn-danger m-b-20" data-toggle="tooltip" data-placement="top" title="" data-original-title="新增"><i class="fa fa-plus"></i> 新增</a>
                        </div><!-- end col -->

                    </div>

                    <div class="card-box">

                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
                                @if(count($menus))
                                <div class="custom-dd-empty dd" id="nestable_list_3">
                                    <ol class="dd-list">
                                        @foreach($menus as $first)
                                            <li class="dd-item dd3-item" data-id="{{ $first->id }}">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">
                                                    {{ $first->name }}
                                                    @if($first->is_show)
                                                        <span class="badge badge-info">显示</span>
                                                    @else
                                                        <span class="badge badge-danger">已隐藏</span>
                                                    @endif
                                                    <a href="" class="btn btn-xs btn-danger pull-right m-l-5" data-toggle="tooltip" data-placement="right" title="删除"><i class="fa fa-close"></i> 删除</a>
                                                    <a href="{{ route('admin.menu.edit', ['menu' => $first->id]) }}" class="btn btn-xs btn-success pull-right m-l-5" data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 修改</a>

                                                </div>
                                                @if(count($first->childers))
                                                    <ol class="dd-list">
                                                    @foreach($first->childers as $second)
                                                        <li class="dd-item dd3-item" data-id="{{ $second->id }}">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content">
                                                                {{ $second->name }}
                                                                @if($second->is_show)
                                                                    <span class="badge badge-info">显示</span>
                                                                    @else
                                                                    <span class="badge badge-danger">已隐藏</span>
                                                                @endif
                                                                <a href="" class="btn btn-xs btn-danger pull-right m-l-5" data-toggle="tooltip" data-placement="right" title="删除"><i class="fa fa-close"></i> 删除</a>
                                                                <a href="{{ route('admin.menu.edit', ['menu' => $second->id]) }}" class="btn btn-xs btn-success pull-right m-l-5" data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 修改</a>
                                                            </div>
                                                            @if(count($second->childers))
                                                                <ol class="dd-list">
                                                                    @foreach($second->childers as $third)
                                                                        <li class="dd-item dd3-item" data-id="{{ $third->id }}">
                                                                            <div class="dd-handle dd3-handle"></div>
                                                                            <div class="dd3-content">
                                                                                {{ $third->name }}
                                                                                @if($third->is_show)
                                                                                    <span class="badge badge-info">显示</span>
                                                                                @else
                                                                                    <span class="badge badge-danger">已隐藏</span>
                                                                                @endif
                                                                                <a href="" class="btn btn-xs btn-danger pull-right m-l-5" data-toggle="tooltip" data-placement="right" title="删除"><i class="fa fa-close"></i> 删除</a>
                                                                                <a href="{{ route('admin.menu.edit', ['menu' => $third->id]) }}" class="btn btn-xs btn-success pull-right m-l-5" data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 修改</a>
                                                                            </div>
                                                                        </li>
                                                                        @endforeach
                                                                </ol>
                                                                @endif
                                                        </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </li>
                                            @endforeach

                                    </ol>
                                </div>
                                @endif

                            </div> <!-- end col -->


                            <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- end content -->

        </div> <!-- container -->

    </div> <!-- content -->
@stop

@section('js')
    <script>
        $(function(){
            $('#nestable_list_3').nestable();
        })
    </script>
    @stop
