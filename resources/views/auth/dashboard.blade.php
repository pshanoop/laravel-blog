@extends('auth.layout')

@section('title','Admin Dashboard')

@section('css')
    @parent
    <link rel="stylesheet" href="[[elixir('css/app.css')]]">
@endsection

@section('content')
<div ng-controller="DashboardController">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                           [[$user->fullname]] <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li>
                            <li><a href="[[route('logout')]]">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Dashboard</a><span class="sr-only">current</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>
        <div ng-show="isEdit" class="new-article panel panel-primary">
            <div class="panel-heading"><strong>New Article</strong>
            </div>
            <div ng-show="isError" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong>
                <ul>
                   <li ng-repeat="error in errors">
                        {{error}}
                   </li>
                </ul>
            </div>
            <form ng-submit="addArticle(newarticle)">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" ng-model="newarticle.name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" ng-model="newarticle.email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="text" ng-model="newarticle.text" class="form-control" placeholder="Article Goes here"  cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group btn-group-sm pull-right" role="group" aria-label="...">
                                <button type="button" class="btn btn-default" ng-click="cancelArticle()">
                                    Cancel <span class="glyphicon glyphicon-remove"></span></button>
                                <button type="submit" class="btn btn-primary">
                                    Save <span class="glyphicon glyphicon-ok"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <h2 class="sub-header">Articles</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Text</th>
                        <th>
                            <button type="button" ng-click="newArticle()" class="btn btn-success btn-sm" aria-hidden="true">
                                <span class="glyphicon glyphicon-plus"></span> New
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="article in articles | orderBy:id |pagination: currentPage : numPerPage">
                        <td>{{article.id}}</td>
                        <td>{{article.name}}</td>
                        <td>{{article.email}}</td>
                        <td>{{article.text}}</td>
                        <td>
                            <button type="button" ng-click="editArticle(article)" class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                            <button type="button" ng-click="deleteArticle(article)" class="btn btn-danger btn-xs" aria-hidden="true">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix">
                <pagination
                        ng-model="currentPage"
                        total-items="articles.length"
                        max-size="maxSize"
                        items-per-page="numPerPage"
                        boundary-links="true"
                        class="pagination-sm pull-right"
                        previous-text="&lsaquo;"
                        next-text="&rsaquo;"
                        first-text="&laquo;"
                        last-text="&raquo;"
                ></pagination>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    @parent
    <script src="[[elixir('js/dashboard.js')]]"></script>
@endsection