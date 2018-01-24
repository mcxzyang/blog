@extends('home.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 52.6px">
            <div class="row sp-header" style="position: relative; height: 260px;overflow: hidden;background: url('http://heijing.chuangzaoshi.com/wp-content/uploads/2017/07/mbe.png') no-repeat;background-size:cover;">
                <div class="sp-header-title text-center" style="text-align: center; position: absolute; top: 40%; width: 100%; color: #fff">
                    <div class="h2" style="font-size: 30px">{{ $album->title }}</div>
                    <div class="h5" style="margin-top: 10px">{{ $album->description }}</div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="ui horizontal divider header"><i class="tag icon"></i> 全部文章 </h4>

    <div class="ui container">
        @if(count($articles))
            <div class="ui three column stackable grid link cards">
                @foreach($articles as $article)
                    <div class="column">
                        <div class="ui fluid card">
                            <div class="ui fluid image" style="">
                                <div class="ui black ribbon label"><i class="fire icon"></i> 文章</div>
                                <a class="image" href="{{ url('article', ['id' => $article->id]) }}"><img src="{{ getQiniuPic($article->image, '', 250) }}" style="height: 250px;"></a>
                            </div>
                            <div class="content">
                                <a class="header" href="{{ url('article', ['id' => $article->id]) }}">{{ $article->title }}</a>
                            </div>
                            <div class="extra content">
                                    <span class="right floated">
                                        <span class="like"><i class="like icon"></i> Like </span>
                                        <span class="star"><i class="unhide icon"></i> watch </span>
                                        <span class="wait"><i class="wait icon"></i> {{ $article->created_at->toDateString() }} </span>
                                    </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@stop
