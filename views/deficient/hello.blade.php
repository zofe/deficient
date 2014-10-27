@extends('deficient.master')

@section('content')

<div class="jumbotron">
    <h1>{{ $title or 'Hello' }}</h1>
    <p>
        {{ $content or 'Hello deficient!' }}
    </p>
</div>
        {{ document_code(app('path').'/index.php', 10,7) }}
        {{ document_code(app('path').'/views/deficient/hello.blade.php') }}
@stop