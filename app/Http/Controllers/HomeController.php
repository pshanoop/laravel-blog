<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getHome($page=1)
    {

        //Get articles per page
        $numPerPage = \Config::get('app.article_per_page');

        $articles = Article::orderBy('created_at','desc')->simplePaginate($numPerPage);
        return View('home',['articles'=>$articles,'isArticle'=>false]);
    }

    /**
     * Show the article from given id
     *
     * @return Response
     */
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);
        return View('post',['article'=>$article,'isArticle'=>true]);
    }
}
