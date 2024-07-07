@if(session('status_error'))
    <div class="alert alert-danger">
        {{ session('status_error') }}
    </div>
@endif

{{ html()->modelForm($article, 'PATCH', route('articles.update', $article))->open() }}
    @include('article.form')
    {{ html()->submit('Обновить')->class('btn btn-primary') }}
{{ html()->closeModelForm() }}

