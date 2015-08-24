@extends('layout')

@section('title','Blog')

@section('css')
    @parent
    <link rel="stylesheet" href="[[elixir('css/home.css')]]">
@endsection

@section('header')
    <h1>[[$article->name]]</h1>
    <hr class="small">
    <span class="meta">Posted by <a href="mailto:[[$article->email]]" target="_top">[[$article->email]]</a> on [[$article->created_at->diffForHumans()]]</span>
@endsection

@section('content')
    <p>[[$article->text]]</p>
@endsection


@section('scripts')
    @parent
    <script src="[[elixir('js/home.js')]]"></script>
@endsection
