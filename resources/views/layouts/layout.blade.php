<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ url('/css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ url('/css/style.css') }}"/>
  </head>
  <body>
    <div id="app">
    @yield('content')
    <footer class="page-footer grey darken-4">
      <div class="footer-copyright">
        <div class="container">
        © <?php echo date('Y'); ?> Test
        <div class="right">
          <a class="grey-text text-lighten-4" href="https://darkorbit.com/" target="_blank">DarkOrbit</a>
          |
          <a class="grey-text text-lighten-4" href="https://discord.gg/RwytCms" target="_blank">Discord</a>
          |
          <a class="grey-text text-lighten-4" href="https://elitepvpers.com/" target="_blank">Elitepvpers</a>
        </div>
        </div>
      </div>
    </footer>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ url('/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ url('/js/materialize.min.js') }}"></script>
  <script src="{{ url('/js/main.js') }}"></script>
  @yield('javascripts')
  </body>
</html>
