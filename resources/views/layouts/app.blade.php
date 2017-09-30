<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My App</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

    <body>
      @include('partials.nav')

      <div class="container">
        @include('partials.messages')
        @yield('content')
      </div>

      @include('partials.footer')

      <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
