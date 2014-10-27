@extends('deficient.master')

@section('content')

<div class="jumbotron">
    <h1>{{ $title or 'Hello' }}</h1>
    <p >
        {{ $content or 'Hello deficient!' }}
    </p>
</div>
@stop