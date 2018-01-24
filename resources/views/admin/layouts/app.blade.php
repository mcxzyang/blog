@extends('admin.layouts.basic')

@section('body')
    <body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo"><span>Zir<span>cos</span></span><i class="mdi mdi-layers"></i></a>

            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">

                    <!-- Navbar-left -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                    <!-- Right(Notification) -->
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown user-box">

                            <a href="index.html" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                Hi, {{ Auth::guard('admin')->user()->name }} <img src="{{ getPicAsset(Auth::guard('admin')->user()->avatar) }}" alt="user-img" class="img-circle user-img" id="header-avatar">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                <li>
                                    <h5>Hi, {{ Auth::guard('admin')->user()->name }}</h5>
                                </li>
                                <li><a href="{{ route('admin.account.profile') }}"><i class="ti-user m-r-5"></i> 个人信息</a></li>
                                <li><a href="{{ route('admin.account.password') }}"><i class="ti-settings m-r-5"></i> 修改密码</a></li>
                                <li><a href="{{ route('admin.auth.logout') }}"><i class="ti-power-off m-r-5"></i> 退出</a></li>
                            </ul>
                        </li>

                    </ul> <!-- end navbar-right -->

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.menu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                @inject('permissionServer', 'App\Services\PermissionService')
                                <h4 class="page-title">{{ $webTitle = $permissionServer->getPermissionName(Route::currentRouteName()) }}</h4>
                                @section('title', $webTitle)
                                {!! Breadcrumbs::render(Route::currentRouteName()) !!}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    @yield('content')
                    <!-- end content -->

                </div> <!-- container -->

            </div> <!-- content -->

            @include('admin.layouts.footer')

        </div>

        <!-- Right Sidebar -->

    </div>
    <!-- END wrapper -->

    </body>
@stop
