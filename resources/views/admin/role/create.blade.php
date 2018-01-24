@extends('admin.layouts.app')

@section('content')
    <div class="row animated bounceInRight">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                        <form role="form" onsubmit="task(this)">
                            <div class="form-group">
                                <label class="control-label">名称</label>
                                <input type="text" class="form-control" name="alias" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Slug</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">描述</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">权限</label>
                                @if(count($permissions))
                                    @foreach($permissions as $permission)
                                        <div class="panel panel-color panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <input id="{{ $permission->name }}" name="permissions[]" type="checkbox" value="{{ $permission->name }}">
                                                    <label for="{{ $permission->name }}">
                                                        {{ $permission->display_name }}
                                                    </label>
                                                </h3>
                                            </div>
                                            @if($permission->sub_permission->count())
                                            <div class="panel-body">
                                                @foreach($permission->sub_permission as $sub)
                                                    <div class="panel panel-color panel-success">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                <input id="{{ $sub->name }}" name="permissions[]" type="checkbox" value="{{ $sub->name }}">
                                                                <label for="{{ $sub->name }}">
                                                                    {{ $sub->display_name }}
                                                                </label>
                                                            </h3>
                                                        </div>
                                                        @if($sub->sub_permission->count())
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    @foreach($sub->sub_permission as $su)
                                                                        <div class="col-xs-4">
                                                                            <div class="checkbox checkbox-info m-b-15">
                                                                                <input id="{{ $su->name }}" name="permissions[]" type="checkbox" value="{{ $su->name }}">
                                                                                <label for="{{ $su->name }}">
                                                                                    {{ $su->display_name }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @endforeach
                                            </div>
                                                @endif
                                        </div>
                                    @endforeach
                                    @endif

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-save"></i> 保存</button>
                                <a href="{{ route('admin.role.index') }}" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light"><i class="fa fa-reply"></i> 返回</a>
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
        $(function(){
            $('input[type="checkbox"]').click(function(){
                var checked = $(this).prop('checked');
                $(this).parents('.panel-heading').siblings('.panel-body').find('input[type="checkbox"]').prop('checked', checked);
            })
        });

        function task(el){
            window.event.preventDefault();
            return toSubmit({
                el: $(el),
                method: 'POST',
                action: '{{ route('admin.role.store') }}',
                jump: '{{ route('admin.role.index') }}'
            })
        }
    </script>
@stop
