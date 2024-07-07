<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\CreateArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->paginate();

        return view('article.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();

        return view('article.create', compact('article'));
    }

    public function show($id)
    {
        $article = Article::query()->findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function store(CreateArticleRequest $request)
    {
        $article = new Article();

        $article->fill($request->validated());

        $request->session()->flash('status', 'Action not saved!');

        $article->save();

        $request->session()->flash('status', 'Action saved!');

        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $article = Article::query()->findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::query()->findOrFail($id);
        $request->session()->flash('status_error', "{$article->name} didn't update");

        $article->fill($request->validated());

        $article->save();

        $request->session()->flash('status_success', "{$article->name} updated");

        return redirect()
            ->route('articles.index');
    }

    public function destroy(Request $request, $id)
    {
        $article = Article::query()->find($id);
        if ($article) {
            $article->delete();
            $request->session()->flash('status_destroy', "{$article->name} deleted!");
        }

        return redirect()->route('articles.index');
    }
}
