@extends('layouts.app')

@section('header')
    <h2 class="header white-text col s12">@lang('staff.staff')</h2>
@endsection

@section('content')
    <div id="staff">
        <div class="section">
            <div class="container">
                <br>
                @if($users->count())
                <div class="row">
                    <div class="col s12 m9">
                        <h4 class="primary-color-text">@lang('staff.users')</h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="collection">
                        @foreach($users as $user)
                            <li class="collection-item avatar">
                                @if($user->photo_url != null)
                                    <img class="circle" src="/uploads/avatars/{{$user->photo_url}}" alt="">
                                @else
                                    <img class="circle" src="/images/avatar.png" alt="">
                                @endif
                                <span class="title">{{$user->name}}</span>
                                <p>{{$user->email}}</p>
                                <p>{{$user->phone}}</p>
                                <p>{{$user->organization->name}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large primary-color">
                <i class="large material-icons">more_vert</i>
            </a>
            <ul>
                <li><a href="#add-staff-modal" class="modal-trigger btn-floating red"><i class="material-icons">add</i></a></li>
            </ul>
        </div>
    </div>
    <div id="add-staff-modal" class="modal">
        <div class="modal-content">
            <form class="col s12" role="form" method="POST">

                <h4 id="modal-title">@lang('staff.add_user')</h4>
                {{ csrf_field() }}


                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select id="organization" name="organization" required>                        
                            <option value="" disabled selected>Choose an organization</option>
                            @foreach($organizations as $organization)
                                    <option value="{{$organization->id}}">{{$organization->name}}</option> 
                            @endforeach                        
                        </select>
                        <label for="organization">Organization</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#!" class="red white-text  modal-action modal-close waves-effect waves-red btn-flat">@lang('common.close')</a>
                    <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.add')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/staff.js')}}"></script>
@endsection
