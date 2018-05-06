@extends('layouts.app')

@section('header')
    <h2 class="header white-text">Account Settings</h2>
@stop


@section('content')
    <div id="account-settings">
        <div class="section">
            <div class="container">
                <form role="form" method="POST" action="{{ url('/account-settings') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <br>
                    <div class="row">
                        <div class="input-field col s12 l6">
                            <input id="email" name="email" type="email" class="validate" value="{{\Auth::user()->email}}">
                            <label for="email">Email</label>
                        </div>
                    
                        <div class="input-field col s12 l6">
                            <input id="name" name="name" type="text" class="validate" value="{{\Auth::user()->name}}">
                            <label for="name">Name</label>
                        </div>
                    
                        <div class="hidden change-password">
                            <div class="input-field col s12 l6">
                                <input id="old_password" name="old_password" type="password" class="validate" minlength="6">
                                <label for="old_password">Old Password</label>
                            </div>
                        </div>
                        <div class="hidden change-password">
                            <div class="input-field col s12 l6">
                                <input id="new_password" name="new_password" type="password" class="validate" minlength="6">
                                <label for="new_password">New password</label>
                            </div>
                        </div>
                        <div class="hidden change-password">
                            <div class="input-field col s12 l6">
                                <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="validate" minlength="6">
                                <label for="new_password_confirmation">New password confirmed</label>
                            </div>
                        </div>
                    </div>
                    <div class="row center">
                        <div class="col s8 l6 center">
                            <a id="change-password" class="waves-effect waves-light btn-large secondary-button">Change password</a>
                        </div>
                         <div class="col s4 l6 center">
                                <button id="saveUser" type="submit" class="primary-button waves-effect waves-light btn-large">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/account-settings.js')}}"></script>
@stop