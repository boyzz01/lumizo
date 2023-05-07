<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article', ['articles' => $articles]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->content = nl2br($request->content);
        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $article->photo = $filename;
        }

        $article->save();
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
