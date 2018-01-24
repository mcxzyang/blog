@extends('admin.layouts.app')
@section('css')
    <style>
        .list-group .active {
            background-color: #3ac9d6 !important;
            border: 1px solid #3ac9d6 !important
        }
    </style>
@stop
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">编辑菜单</h4>
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
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-10 col-md-8 col-lg-offset-1 col-md-offset-2">
                                <form class="form-horizontal" role="form" onsubmit="task(this)" data-url="{{ route('admin.menu.update', ['menu' => $menu->id]) }}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">名称</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" required value="{{ $menu->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">描述</label>
                                        <div class="col-md-10">
                                            <input type="text" name="description" class="form-control" value="{{ $menu->description }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">icon</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="icon" value="{{ $menu->icon }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">路由</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="slug" value="{{ $menu->slug }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">上级菜单</label>
                                        <div class="col-md-10">
                                            @inject('menuServer', 'App\Services\MenuService')
                                            {!! $menuServer->topPermissionSelect($menu->top_id) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">是否显示</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" id="switch" name="is_show" @if($menu->is_show) checked @endif value="1" switch="success">
                                            <label for="switch" data-on-label="是" data-off-label="否"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-2">
                                            <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                                            <a href="{{ route('admin.menu.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
                                        </div>
                                    </div>

                                </form>
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
        function task(el){
            window.event.preventDefault();
            var url = $(el).data('url');
            return toSubmit({
                el: $(el),
                method: 'PATCH',
                action: url,
                jump: '{{ route('admin.menu.index') }}'
            })
        }
    </script>
    @stop
