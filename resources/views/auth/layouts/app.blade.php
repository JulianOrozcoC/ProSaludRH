<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <!-- Reference for Google Material Icons -->
    <link href="{{asset('css/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <style media="screen">
        body{
            background: url(https://marketingland.com/wp-content/ml-loads/2016/08/personas-people-diverse-ss-1920.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/materialize.min.js')}}"></script>
    <script src="{{asset('/js/masonry.min.js')}}"></script>    
    <script src="{{asset('/js/layout.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").sideNav();
            $('.modal').modal();
            var errors = $.parseJSON('{!! json_encode($errors->all()) !!}');
            $.each(errors , function(i, val) {
                Materialize.toast(errors[i], 5000 + i*1000);
            });
            var message = '{{ Session::get('flash_message') }}';
                Materialize.toast(message, 7000);
        });
    </script>
    @yield('scripts')
</body>
</html>
