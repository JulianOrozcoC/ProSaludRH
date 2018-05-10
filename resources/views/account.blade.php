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
                    
                    <div class="input-field col s12 l6">
                        <input id="age" name="age" type="number" class="validate" value="{{\Auth::user()->age}}">
                        <label for="age">Age</label>
                    </div>
                    
                    <div class="input-field col s12 l6">
                        <select id="gender" name="gender">
                            @if(Auth::user()->gender)
                            <option value="{{\Auth::user()->gender}}" selected>{{Auth::user()->gender}}</option>
                            @else
                            <option value="" disabled selected>Choose your option</option>
                            @endif
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <label>Gender</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <select id="status" name="status">
                            @if(Auth::user()->status)
                            <option value="{{\Auth::user()->status}}" selected>{{Auth::user()->status}}</option>
                            @else
                            <option value="" disabled selected>Choose your option</option>
                            @endif
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Other">Other</option>
                        </select>
                        <label>Civil Status</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input id="scholarity" name="scholarity" type="text" class="validate" value="{{\Auth::user()->scholarity}}">
                        <label for="scholarity">Scholarity</label>
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