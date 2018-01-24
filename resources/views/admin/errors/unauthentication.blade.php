@extends('admin.layouts.basic')
@section('body')
    <body class="bg-transparent">

    <!-- HOME -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12 text-center">

                    <div class="wrapper-page">
                        <img src="/backend/images/animat-search-color.gif" alt="" height="120">
                        <h2 class="text-uppercase text-danger">权限错误</h2>
                        <p class="text-muted">您没有权限访问此页面，请联系管理员！</p>

                        <a class="btn btn-success waves-effect waves-light m-t-20" href="javascript:window.history.go(-1);"> 返回上一页面</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    </body>
@stop
