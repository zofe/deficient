@extends('master')

@section('content')

<h1>{{ $code or 'Error' }}</h1>
<p>
{{ $message or 'Error' }}
</p>
@stop