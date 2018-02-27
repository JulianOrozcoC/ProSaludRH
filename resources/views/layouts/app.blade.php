<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
      (function($){
        $(function(){
          $('.button-collapse').sideNav();
        }); // end of document ready
      })(jQuery); // end of jQuery name space
    </script>
    <div id="app">
      <ul id="slide-out" class="side-nav">
        <li><div class="user-view">
        <div class="background" style="background-color: #7908c8;"></div>
          <a href="#!name"><span class="white-text name">John Doe</span></a>
          <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div></li>
        <li><a href="#!"><i class="material-icons">dashboard</i>Dashboard</a></li>
        <li><a href="#!"><i class="material-icons">business_center</i>Empresas</a></li>
        <li><a href="#!"><i class="material-icons">people</i>Empleados</a></li>
        <li><a href="#!"><i class="material-icons">vpn_key</i>Licencias</a></li>
        <li><a href="#!"><i class="material-icons">verified_user</i>Usuarios</a></li>
      </ul>
      <!-- Dropdown navbar -->
      <ul id="dropdown1" class="dropdown-content" style="background-color:#7908c8;">
        <li><a href="#!">Perfil</a></li>
        <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>
            </li>
      </ul>
      <nav>
        <div class="nav-wrapper" style="background-color:#7908c8;">
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="medium material-icons">menu</i></a>
          <a href="#" class="brand-logo center">Logo</a>
          <ul class="right hide-on-med-and-down">
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons right">arrow_drop_down</i><i class="material-icons right">face</i></a></li>
          </ul>
        </div>
      </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
