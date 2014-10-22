@extends('master')

@section('content')

<h1>{{ $title or 'Hello' }}</h1>
<p>
{{ $content or 'Hello deficient!' }}
</p>
@stop