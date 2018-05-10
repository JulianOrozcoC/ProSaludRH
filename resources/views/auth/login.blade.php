@extends('auth.layouts.app')

@section('content')
<div id="login">
    <div class="row">
        <div class="container">
            <div class="row login-form">
                <div class="col s12  m6 offset-m3">
                    <div class="card grey lighten-4">
                        <div class="card-content container">
                            <div class="row login-logo">
                                <div class="container center">
                                    {{--  <img src="https://scontent.fmfe1-1.fna.fbcdn.net/v/t1.0-9/12509824_1051764521511287_9090022779093199900_n.png?_nc_eui2=v1%3AAeGkqvGm4dQwJOTcMsXs4Fbcf7h9SWDyBn4XW5e3XO-iYaHz9ZRY0irOZg14MeKzSGynIkeS3-b47t8OpaFmjfV3lvknxbLGYnDhewY2VNjRpQ&oh=bc40d882b9abaecc0d59757a401470c7&oe=5B09E36D" class="responsive-img">  --}}
                                    <h3 class="primary-color-text">Imperia</h3>
                                </div>
                            </div>
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" name="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row hidden">
                                    <div class="input-field col s12">
                                        <input id="password" name="password" type="password" class="validate">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row right">
                                    <a href="#" class="password-label"><span>Use password</span> <i class="material-icons">keyboard_arrow_down</i></a>
                                </div>
                                <div class="row">
                                    <button type="submit" class="waves-effect waves-light btn-large col s12 primary-button">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('/js/login.js')}}"></script>
@endsection
