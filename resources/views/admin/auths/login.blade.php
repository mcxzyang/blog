@extends('admin.layouts.basic')

@section('title', '登录')

@section('body')
    <body class="bg-transparent login-body">

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">

                            <div class="account-content">
                                <form class="form-horizontal" onsubmit="task(this)">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" name="username" required="" placeholder="用户名">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" name="password" required="" placeholder="密码">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox-signup" type="checkbox" name="remember" value="1" checked>
                                                <label for="checkbox-signup">
                                                    记住我
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">登录</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <!-- end card-box-->

                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    </body>
@stop

@section('js')
    <script>
        function task(el){
            window.event.preventDefault();
            return toSubmit({
                el: $(el),
                method: 'POST',
                action: '{{ route('admin.auth.post-login') }}',
                callback: function(){
                    window.location.href = '{{ route('admin.index') }}'
                }
            })
        }
    </script>
    @stop
