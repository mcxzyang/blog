@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
                        <form class="form-horizontal" role="form" onsubmit="task(this)" data-url="{{ route('admin.permission.update', ['permission' => $permission->id]) }}">
                            <div class="form-group">
                                <label class="col-md-2 control-label">名称</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="display_name" value="{{ $permission->display_name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">icon</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{ $permission->icon }}" name="icon">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">路由</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" value="{{ $permission->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">上级菜单</label>
                                <div class="col-md-10">
                                    @inject('menuServer', 'App\Services\MenuService')
                                    {!! $menuServer->topPermissionSelect($permission->fid) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">是否显示</label>
                                <div class="col-md-10">
                                    <input type="checkbox" id="switch" name="is_menu" @if($permission->is_menu) checked @endif value="1" switch="success">
                                    <label for="switch" data-on-label="是" data-off-label="否"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">权重</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="{{ $permission->weight }}" name="weight">
                                    <span class="help-block"><small>数字越大越靠前</small></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                    <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                                    <a href="{{ route('admin.permission.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
                                </div>
                            </div>

                        </form>
                    </div> <!-- end col -->

                    <!-- end col -->

                </div>
            </div>
        </div>
    </div>
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
                jump: '{{ route('admin.permission.index') }}'
            })
        }
    </script>
@stop
