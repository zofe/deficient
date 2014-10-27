<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
        @section('mainmenu')
          <li @if (is_route('^/$'))class="active"@endif><a href="/">Home</a></li>
          <li @if (is_route('^/test/(\w+)$'))class="active"@endif><a href="/test/about">About</a></li>
        @show
        </ul>
        <h3 class="text-muted">@yield('title')</h3>
      </div>

      <br />
      <br />
      <div class="jumbotron">
      @yield('content')
      </div>

    </div>

  </body>
</html>