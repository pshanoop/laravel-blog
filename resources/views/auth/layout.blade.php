<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Brand - @yield('title')</title>

    @section('css')
        <link rel="stylesheet" href="[[elixir('css/bootstrap.css')]]">
    @show
</head>
<body>

    @yield('content')

    @section('js')
        <script src="[[elixir('js/framework.js')]]"></script>
    @show
</body>
</html>