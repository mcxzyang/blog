@extends('home.layouts.app')
@section('css')
    <link rel="stylesheet" href="/backend/css/markdown.css">
    @stop
@section('content')
    <div class="ui container" style="margin-top: 100px; min-height: 600px">
        <h1 style="text-align: center">{{ $article->title }}</h1>
        <h5 style="text-align: center; color: #ccc">{{ $article->created_at->toDateString() }}</h5>
        <div class="ui centered grid">
            <div class="ten wide tablet ten wide computer column">
                <div class="ui raised padded segment">
                    {!! $article->content !!}
                </div>
            </div>

        </div>

    </div>
@stop
