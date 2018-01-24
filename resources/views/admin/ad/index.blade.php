@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ route('admin.ad.create') }}" class="btn btn-danger m-b-20"><i class="fa fa-plus"></i> 新增</a>
                </div><!-- end col -->
                <div class="col-sm-10" style="text-align: right;">
                    <form class="form-inline">
                        <div class="form-group m-r-10">
                            <label for="exampleInputName2">名称</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName2" value="{{ Request::get('title') }}">
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
                                    <th>标题</th>
                                    <th>图片</th>
                                    <th>链接</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ads as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td><img src="{{ getPicAsset($item->image) }}" height="50" alt=""></td>
                                        <td>{{ $item->link }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.ad.edit', ['id' => $item->id]) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-xs btn-danger delete-item" data-toggle="tooltip" data-placement="right" title="删除"
                                               data-href="{{ route('admin.ad.destroy', ['id' => $item->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="float: right">
                                {!! $ads->appends(['title' => Request::get('title')])->links() !!}
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@stop

