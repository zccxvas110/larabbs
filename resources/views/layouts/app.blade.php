<!DOCTYPE html>
<html lang="{{ $app->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>@yield('title','LaraBBS') - Laravel</title>

      <!-- Styles -->
      <link href="{{mix('css/app.css')}}" rel = "stylesheet">
  </head>
  <body>
    <div id="app" class="{{ route_class() }}-page">
      @incluad('layouts._header')

      <div class="container">
        @incluad('shared._messages')
        @yield('content')
      </div>

      @incluad('layouts._footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>


  </body>


</html>
