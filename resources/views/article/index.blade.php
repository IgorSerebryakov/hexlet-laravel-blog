@extends('layouts.app')

@if(session('status_success'))
    <div class="alert alert-success">
        {{ session('status_success') }}
    </div>
@endif

@if(session('status_destroy'))
    <div class="alert alert-success">
        {{ session('status_destroy') }}
    </div>
@endif

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <a href="/articles/{{ $article->id }}">{{ $article->name }}</a>
        <a href="/articles/{{ $article->id }}/edit">Редактировать</a>
        <a href="{{ route('articles.destroy', $article->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
@endsection
