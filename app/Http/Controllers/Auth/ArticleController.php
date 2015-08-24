<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request as Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use Validator;
use Auth;

use App\Article;

class ArticleController extends Controller
{
    /**
     * Data validator for article
     * @param array $data
     * @return Validator
     */

    protected function validator(array $data)
    {
//        TODO More efficient validation on text for html or GitHub Markup
       return  Validator::make($data,[
            'name' =>'required|text|max:255',
            'email'=>'required|email',
            'text' =>'required'
        ],[
       'text'=>'The :attribute simple text contains alphabets,numbers and symbol (., ,newline)'
       ]);
    }

    /**
     * Display a listing of the articles owned by logged user.
     *
     * @return Response
     */
    public function index()
    {
        //
        return Article::where('user_id',Auth::id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return Response::json($validator->errors(),
                400);
        }
        $article = new Article($request->all());

        $article->user_id = Auth::id(); //Set owner as logged user

        if($article->save())
            return $article;

        return Response::json(['error'=> 'Server is down']
            ,500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        return Article::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //

        $validator = $this->validator($request->all());
        if($validator->fails())
            return Response::json($validator->errors(),400);

        $article = Article::find($id);

        if($article->update($request->all()))
            return $article;

        return Response::json(['error'=>'Server is down'],
            500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        if(Article::destroy($id))
            return Response::json(['msg'=>'Article deleted']);
        else
            return Response::json(['error'=>'Records not found'],404);
    }
}
