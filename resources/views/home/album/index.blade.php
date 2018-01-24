@extends('home.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 52.6px">
            <div class="row sp-header" style="position: relative; height: 260px;overflow: hidden;background: url('http://heijing.chuangzaoshi.com/wp-content/uploads/2017/07/mbe.png') no-repeat;background-size:cover;">
                <div class="sp-header-title text-center" style="text-align: center; position: absolute; top: 40%; width: 100%; color: #fff">
                    <div class="h2" style="font-size: 30px">专辑与教程</div>
                    <div class="h5" style="margin-top: 10px">共有 {{ count($albums) }} 篇文章</div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="ui horizontal divider header"><i class="tag icon"></i> 专辑 </h4>

    <div class="ui container">
        <div class="ui two column stackable grid link cards">
            @if(count($albums))
                @foreach($albums as $album)
                    <div class="column">
                        <div class="ui fluid card">
                            <div class="ui fluid image" style="">
                                <div class="ui black ribbon label"><i class="star icon"></i> 专辑</div>
                                <a class="image" href="{{ url('album', ['id' => $album->id]) }}"><img src="{{ getQiniuPic($album->image, 1200, 750) }}"></a>
                            </div>
                            <div class="content">
                                <a class="header" href="{{ url('album', ['id' => $album->id]) }}">{{ $album->title }}</a>
                                <h5 style="color: rgba(0, 0, 0, 0.4)">{{ $album->description }}</h5>
                            </div>
                            <div class="extra content">
                                <span>{{ count($album->articles) }} 篇文章</span>
                                <span class="right floated">
                                    <span class="like"><i class="like icon"></i> {{ $album->like_number }} </span>
                                    <span class="star"><i class="unhide icon"></i> {{ $album->view_number }} </span>
                                    <span class="wait"><i class="wait icon"></i> {{ $album->created_at->toDateString() }} </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

        </div>
    </div>
@stop
