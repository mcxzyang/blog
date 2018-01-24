@extends('home.layouts.app')

@section('content')
    @if(count($ads))
    <div class="ui secondary segment">
        <div class="ui main container" style="margin-top: 3em">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($ads as $ad)
                        <div class="swiper-slide"><img src="{{ getQiniuPic($ad->image, 1150, 340) }}" alt=""></div>
                        @endforeach
                </div>
                <!-- 如果需要分页器 -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    @endif
    <!-- content -->
    <div class="ui container">
        @if(count($albums))
        <div class="ui two column stackable grid link cards">
            @foreach($albums as $album)
                <div class="column">
                    <div class="ui fluid card">
                        <div class="ui fluid image" style="">
                            <div class="ui teal ribbon label"><i class="star icon"></i> 精选专辑</div>
                            <a class="image" href=""><img src="{{ getQiniuPic($album->image, 1200, 750) }}"></a>
                        </div>
                        <div class="content">
                            <a class="header">{{ $album->title }}</a>
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
        </div>
        @endif
        <div class="ui section horizontal divider"><i class="trophy icon"></i></div>
        <div class="ui grid">
            <div class="ui column tag labels">
                <a class="ui teal label">全部</a>
                @if(count($tags))
                    @foreach($tags as $tag)
                        <a class="ui label">{{ $tag->title }}</a>
                        @endforeach
                    @endif
            </div>
        </div>
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
        <div class="ui container" style="margin-top: 1em">
            {!! $articles->links('vendor.pagination.semantic-ui') !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        var swiper = new Swiper('.swiper-container', {
            speed: 600,
            parallax: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay:true,
        });
    </script>
    @stop
