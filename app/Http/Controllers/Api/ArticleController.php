<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get articles
        $articles = Article::paginate(10);

        // Return collection of articles as a resource
        // return ArticleResource::collection($articles);
        return response(['articles' => ArticleResource::collection($articles), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'body' => 'required',
            'author' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'type' => 'Validation Error']);
        }

        $articles = Article::create($data);

        return response(['article' => new ArticleResource($articles), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Article::findOrFail($id);

        // Return single article as a resource
        return response(['article' => new ArticleResource($articles), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articles = Article::findOrFail($id);
        //dd($articles);
        $articles->update($request->all());

        return response(['article' => new ArticleResource($articles), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        if ($articles->delete()) {
            return response(['article' => new ArticleResource($articles), 'message' => 'Deleted successfully'], 200);
        }
        // return response('silindi', 200)
        //     ->header('Content-Type', 'text/plain');
    }
}
