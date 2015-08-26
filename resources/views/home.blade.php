@extends('layout')

@section('title','Blog')

@section('css')
    @parent
    <link rel="stylesheet" href="[[elixir('css/home.css')]]">
@endsection

@section('header')
    <h1>Brand Blog</h1>
    <hr class="small">
    <span class="subheading">Some awesome tag line</span>
@endsection

@section('content')
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="[[route('post',$article->id)]]">
                <h2 class="post-title">
                    [[$article->name]]
                </h2>
                <h3 class="post-subtitle">
                    [[str_limit($article->text,45)]]
                </h3>
            </a>
            <p class="post-meta">Post on [[$article->updated_at->diffForHumans()]]</p>
        </div>
        <hr>
    @endforeach
@endsection

@section('pager')
    {!! $articles->render() !!}
@endsection

@section('scripts')
    @parent
    <script src="[[elixir('js/home.js')]]"></script>
@endsection
