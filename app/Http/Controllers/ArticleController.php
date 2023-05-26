<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $article = DB::select('select * from article');
 
        return view('article/index', ['article' => $article]);
    }
    public function store(Request $request)
    {
        $formInput = new Article;
        $formInput->title = $request->input('title');
        $formInput->description = $request->input('description');
        $formInput->save();

        return redirect('/')->with('success', 'Form input saved successfully.');
    }
    public function update($id, Request $request)
    {
        $formInput = new Article;
        $formInput = Article::find($id);
        $formInput->title = $request->input('title');
        $formInput->description = $request->input('description');
        $formInput->update();

        return redirect('/')->with('success', 'Form input saved successfully.');
    }
    public function view($id)
    {
        $article = Article::where('id', $id)
        ->orderBy('name')
        ->take(1)
        ->get();
 
        return view('Article/view', ['article' => $article]);
    }
    public function edit($id)
    {
        $articleedit = Article::where('id', $id)
        ->first()
        ->get();
        return view('Article/edit', ['article' => $articleedit]);
    }
    public function delete($id)
    {
        Article::where('id', '=', $id)->delete();
        return redirect('/');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');

        if ($type == 'any'){
            $article = Article::where('title', 'LIKE', "%$query%")
            ->get();
        }else{
            $article = Article::where('title', 'LIKE', "%$query%")
            ->where('type', $type)
            ->get();
        };
 
        return view('search', ['article' => $article]);
    }
}
