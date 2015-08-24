<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//User Authentication routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);


Route::get('/{page?}',['as'=>'home','uses'=>'HomeController@getHome'])
        ->where('page','[0-9]+');

Route::get('/post/{id}',['as'=>'post','uses'=>'HomeController@showArticle']);


//TODO add middle ware auth
Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){
//Route::group(['prefix'=>'admin'],function(){
    Route::get('dashboard',['as'=>'dashboard','uses'=>function () {
        $user= Auth::user();
        return view('auth.dashboard',['user'=>$user]);
    }]);

    Route::resource('article','Auth\ArticleController');
});

// Using different syntax for Blade to avoid conflicts with Angular template.
\Blade::setContentTags('[[', ']]'); // For variables and all things Blade.
\Blade::setEscapedContentTags('{{--', '--}}'); // For escaped data.
