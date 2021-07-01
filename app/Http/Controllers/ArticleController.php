<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('CreateArticle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:250|min:25|unique:articles',
            'tagline' => 'required|max:50|min:10|unique:articles',
            'text' => 'required|max:25000|min:250',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'tagline' => $request->tagline,
            'text' => $request->text,
            'user_id' => auth()->id()
        ]);

        $article->save();

        return redirect()->back()->with('message', 'Published Successfully.');
        // return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if($article == null) {
            return Inertia::render('Error', ['error' => 404]);
        }

        //Currently unused
        //$author = User::find($article->user_id)->name;

        return Inertia::render('Article', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if($article == null || auth()->id() != $article->user_id) {
            return Inertia::render('Error', ['error' => 404]);
        }
        return Inertia::render('CreateArticle', ['article' => $article, 'edit' => true]);
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
        $validated = $request->validate([
            'title' => ['required', 'max:250', 'min:25', Rule::unique('articles')->ignore($id),],
            'tagline' => ['required', 'max:50', 'min:10', Rule::unique('articles')->ignore($id),],
            'text' => 'required|max:25000|min:250',
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->tagline = $request->tagline;
        $article->text = $request->text;

        $article->save();
        
        return redirect()->back()->with('message', 'Published Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
