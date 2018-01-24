@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-danger m-b-20" data-toggle="tooltip" data-placement="top" title="" data-original-title="新增"><i class="fa fa-plus"></i> 新增</a>
                </div><!-- end col -->

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <div class="table-responsive">
                            <!-- 主体列表 -->
                            <table class="table table-colored table-centered table-hover table-bordered table-inverse m-0" id="table-permission">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>显示名称</th>
                                    <th>路由</th>
                                    <th>图标</th>
                                    <th>是否菜单</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr data-node="treetable-{{ $permission->id }}">
                                        <td>
                                            {{ $permission->id }}
                                        </td>
                                        <td>{{ $permission->display_name }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{!! $permission->icon !!}</td>
                                        <td>
                                            {!! $permission->is_menu ? '<span class="label label-success">是</span>':'<span class="label label-danger">否</span>' !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.permission.edit', ['permission' => $permission->id]) }}"
                                               class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-xs btn-danger delete-item" data-toggle="tooltip" data-placement="right" title="删除"
                                               data-href="{{ route('admin.permission.destroy', ['permission' => $permission->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                    @if($permission->sub_permission->count())
                                        @foreach($permission->sub_permission as $sub)
                                            <tr data-node="treetable-{{ $sub->id }}"  data-pnode="treetable-parent-{{ $sub->fid }}">
                                                <td>
                                                    {{ $sub->id }}
                                                </td>
                                                <td>{{ $sub->display_name }}</td>
                                                <td>{{ $sub->name }}</td>
                                                <td>{!! $sub->icon !!}</td>
                                                <td>
                                                    {!! $sub->is_menu ? '<span class="label label-success">是</span>':'<span class="label label-danger">否</span>' !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.permission.edit', ['permission' => $sub->id]) }}"
                                                       class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 编辑</a>
                                                    <a class="btn btn-xs btn-danger delete-item" data-toggle="tooltip" data-placement="right" title="删除"
                                                       data-href="{{ route('admin.permission.destroy', ['permission' => $sub->id]) }}">
                                                        <i class="fa fa-trash-o"></i> 删除</a>
                                                </td>
                                            </tr>
                                            @if($sub->sub_permission->count())
                                                @foreach($sub->sub_permission as $su)
                                                    <tr data-node="treetable-{{ $su->id }}"  data-pnode="treetable-parent-{{ $su->fid }}">
                                                        <td>
                                                            {{ $su->id }}
                                                        </td>
                                                        <td>{{ $su->display_name }}</td>
                                                        <td>{{ $su->name }}</td>
                                                        <td>{!! $su->icon !!}</td>
                                                        <td>
                                                            {!! $su->is_menu ? '<span class="label label-success">是</span>':'<span class="label label-danger">否</span>' !!}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.permission.edit', ['permission' => $su->id]) }}"
                                                               class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top" title="修改"><i class="fa fa-pencil"></i> 编辑</a>
                                                            <a class="btn btn-xs btn-danger delete-item" data-toggle="tooltip" data-placement="right" title="删除"
                                                               data-href="{{ route('admin.permission.destroy', ['permission' => $su->id]) }}">
                                                                <i class="fa fa-trash-o"></i> 删除</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@stop

@section('js')
    <script src="/backend/js/bootstrap-treefy.min.js"></script>
    <script>
        $(function(){
            $("#table-permission").treeFy({
                treeColumn: 0,
                initStatusClass: 'treetable-collapsed'
            });
        });

    </script>
    @stop

