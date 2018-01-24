@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ route('admin.admin_user.create') }}" data-toggle="modal" data-animate="bounceInRight" data-target="#myModal-primary" class="btn btn-danger m-b-20"><i class="fa fa-plus"></i> 新增</a>
                </div><!-- end col -->
                <div class="col-sm-10" style="text-align: right;">
                    <form class="form-inline">
                        <div class="form-group m-r-10">
                            <label for="exampleInputName2">用户名</label>
                            <input type="text" name="username" class="form-control" id="exampleInputName2" value="{{ Request::get('username') }}">
                        </div>
                        <div class="form-group m-r-10">
                            <label for="exampleInputEmail2">昵称</label>
                            <input type="text" name="nickname" class="form-control" id="exampleInputEmail2" value="{{ Request::get('nickname') }}">
                        </div>
                        <button type="submit" class="btn btn-search" data-toggle="tooltip" data-placement="top" title="搜索"><i class="fa fa-search"></i></button>
                    </form>
                </div>
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
                                    <th>用户名</th>
                                    <th>昵称</th>
                                    <th>头像</th>
                                    <th>角色</th>
                                    <th>超级管理员</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img class="media-object img-circle" alt="64x64" src="{{ getPicAsset($item->avatar) }}" style="width: 54px; height: 54px;"></td>
                                        <td>
                                            @if(count($item->roles))
                                                @foreach($item->roles as $role)
                                                    <span class="label label-info">{{ $role->alias }}</span>
                                                    @endforeach
                                                @endif
                                        </td>
                                        <td>
                                            {!! $item->is_super ? '<span class="label label-success">是</span>':'<span class="label label-danger">否</span>' !!}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.admin_user.edit', ['id' => $item->id]) }}"
                                               class="btn btn-xs btn-success"  data-toggle="modal" data-animate="bounceInRight" data-target="#myModal-primary"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-xs btn-danger delete-item" data-toggle="tooltip" data-placement="right" title="删除"
                                               data-href="{{ route('admin.admin_user.destroy', ['id' => $item->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="float: right">
                                {!! $list->appends(['username' => Request::get('username'), 'nickname' => Request::get('nickname')])->links() !!}
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@stop

