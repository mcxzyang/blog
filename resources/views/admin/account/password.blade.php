@extends('admin.layouts.app')
@section('css')
    <style>
        .list-group .active {
            background-color: #36404e !important;
            border: 1px solid #36404e !important
        }
    </style>
    @stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">
                                账号设置
                            </a>
                            <a href="{{ route('admin.account.profile') }}" class="list-group-item">基本信息</a>
                            <a href="{{ route('admin.account.password') }}" class="list-group-item active">修改密码</a>
                        </div>

                    </div> <!-- end col -->

                    <div class="col-md-8 col-lg-9">
                        <h4>修改密码</h4>

                        <hr>

                        <div class="row">
                            <div class="col-md-8 col-sm-6">
                                <form role="form"  onsubmit="task(this)">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">原始密码</label>
                                        <input type="password" class="form-control" name="old_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">新密码</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">确认新密码</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect m-t-10 w-sm waves-light">保存</button>
                                </form>
                            </div> <!-- end col -->


                        </div> <!-- end row -->

                    </div>
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
            return toSubmit({
                el: $(el),
                method: 'POST',
                action: '{{ route('admin.account.passwordHandle') }}',
                jump: '{{ route('admin.account.password') }}'
            })
        }
    </script>
@stop
