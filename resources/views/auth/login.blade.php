@extends('auth.layout')

@section('title','Login')

@section('css')
    @parent
    <link rel="stylesheet" href="[[elixir('css/app.css')]]">
    <style>
        body {
            background: #eee;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">

        <form class="form-signin" method="post" action="[[URL::route('login')]]">
            [[csrf_field()]]
            <h2 class="form-signin-heading">Please login</h2>
            <input type="text" class="form-control" name="username" placeholder="User name" required="" autofocus="" />
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
            <label class="checkbox">
                <input type="checkbox" value="remember" id="rememberMe" name="remember"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            [[--validation errors--]]
            @if(count($errors))
                <div class="errors">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>[[$error]]</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </form>
    </div>
@endsection