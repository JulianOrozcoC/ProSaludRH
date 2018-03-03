<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Reference for Google Material Icons -->
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/materialize.clockpicker.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">

</head>
<body>
    <div id="app">
        <div class="navbar-fixed">
            <nav class="primary-color">
                <div class="nav-wrapper">
                    <ul id="slide-out" class="side-nav">
                        <li>
                            <div class="userView">
                                <div class="background primary-color">
                                </div>
                                <a href="/account-settings"><img class="circle" src="{{asset('/images/avatar.png')}}"></a>
                                <a href="/account-settings"><span class="white-text name">{{\Auth::user()->name}}</span></a>
                                <a href="/account-settings"><span class="white-text email">{{\Auth::user()->email}}</span></a>
                            </div>
                        </li>
                        <li><a href="/organizations"><i class="material-icons">business</i>Organizations</a></li>
                        <li><a href="/staff"><i class="material-icons">face</i>Staff</a></li>
                        <li><div class="divider"></div></li>
                        <li><a href="/account-settings"><i class="material-icons">settings</i>Account settings</a></li>
                        <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">power_settings_new</i>Logout</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
                    <a href="/" class="brand-logo left hide-on-small-only">Segamac</a>
                    <form id="search-form" role="form" method="GET" action="{{ url('/search') }}" autocomplete="on">
                        <div id="search-input-field" class="input-field">
                            <input id="search" type="search" placeholder="Search..." name="query" required value="{{\Request::get('query')}}">
                            <label class="label-icon" for="query"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <main>
            @if(!isset($headerOff))
            <div class="section primary-color" id="index-banner">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            @yield('header')
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/js/materialize.min.js')}}"></script>
    <script src="{{asset('/js/materialize.clockpicker.js')}}"></script>
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/layout.js')}}"></script>
    <script type="text/javascript">
        var query = '{{ \Request::get('query') }}';
        $(document).ready(function(){
            var errors = $.parseJSON('{!! json_encode($errors->all()) !!}');
            $.each(errors , function(i, val) {
                Materialize.toast(errors[i], 5000 + i*1000);
            });
            var message = '{{ Session::get('flash_message') }}';
                Materialize.toast(message, 7000);

        });
    </script>
    @yield('scripts')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</body>
</html>
