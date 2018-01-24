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
                            <a href="{{ route('admin.account.profile') }}" class="list-group-item active">基本信息</a>
                            <a href="{{ route('admin.account.password') }}" class="list-group-item">修改密码</a>
                        </div>

                    </div> <!-- end col -->

                    <div class="col-md-8 col-lg-9">
                        <h4>基本信息</h4>

                        <hr>

                        <div class="row">
                            <div class="col-md-8 col-sm-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">用户名</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" readonly value="{{ optional(auth('admin')->user())->username }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">姓名</label>
                                        <input type="text" class="form-control" name="name" value="{{ optional(auth('admin')->user())->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">创建时间</label>
                                        <input type="text" class="form-control" value="{{ optional(auth('admin')->user())->created_at }}" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect m-t-10 w-sm waves-light">保存</button>
                                </form>
                            </div> <!-- end col -->

                            <div class="col-md-4 col-sm-6">

                                <div class="member-card" id="crop-avatar">
                                    <div class="thumb-xl member-thumb m-b-10 center-block avatar-view">
                                        <img src="{{ getPicAsset(Auth::guard('admin')->user()->avatar) }}" class="img-circle img-thumbnail" alt="profile-image">
                                        <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                    </div>

                                    <a href="{{ route('admin.account.avatar') }}" data-toggle="modal" data-target="#myModal-large" class="btn btn-success btn-block btn-sm w-sm waves-effect m-t-10 waves-light">更换头像</a>

                                </div>

                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div>
                    <!-- end col -->

                </div>
            </div>
        </div>
    </div>
@stop
