@extends('layouts.app')

@section('header')
    <h2 class="header center-on-small-only white-text">Organizations</h2>
@endsection

@section('content')
    <div id="staff">
        <div class="section">
            <div class="container">
                @if($administrators->count())
                <div class="row">
                    <div class="col s12 m9">
                        <h4 class="primary-color-text">Administrators</h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="collection">
                        @foreach($administrators as $administrator)
                            <li class="collection-item avatar">
                                <img src="{{asset('/images/avatar.png')}}" alt="" class="circle">
                                <span class="title">{{$administrator->name}}</span>
                                <p>{{$administrator->email}}</p>
                                @if($administrators->count() > 1 && \Auth::user()->id != $administrator->id)
                                    <a href="#delete-staff-modal" class="secondary-content delete-staff" data-staff-id="{{$administrator->id}}"><i class="material-icons red-text">delete</i></a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($authorizers->count())
                <div class="row">
                    <div class="col s12 m9">
                        <h4 class="primary-color-text">Authorizers</h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="collection">
                        @foreach($authorizers as $authorizer)
                            <li class="collection-item avatar">
                                <img src="{{asset('/images/avatar.png')}}" alt="" class="circle">
                                <span class="title">{{$authorizer->name}}</span>
                                <p>{{$authorizer->email}}</p>
                                <a href="#delete-staff-modal" class="secondary-content delete-staff" data-staff-id="{{$authorizer->id}}"><i class="material-icons red-text">delete</i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($quoters->count())
                <div class="row">
                    <div class="col s12 m9">
                        <h4 class="primary-color-text">Quoters</h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="collection">
                        @foreach($quoters as $quoter)
                            <li class="collection-item avatar">
                                <img src="{{asset('/images/avatar.png')}}" alt="" class="circle">
                                <span class="title">{{$quoter->name}}</span>
                                <p>{{$quoter->email}}</p>
                                <a href="#delete-staff-modal" class="secondary-content delete-staff" data-staff-id="{{$quoter->id}}"><i class="material-icons red-text">delete</i></a>
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
                <li><a href="/staff/add" class="btn-floating red tooltipped" data-tooltip="New staff member" data-position="left" data-delay="10"><i class="material-icons">add</i></a></li>
                <li><a id="search-button" class="btn-floating blue tooltipped" data-tooltip="Search staff member" data-position="left" data-delay="10"><i class="material-icons">search</i></a></li>
            </ul>
        </div>
    </div>
    <div id="delete-staff-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4 id="title">Are you sure you want to delete this user?</h4>
        </div>
        <div class="modal-footer">
            <form method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="modal-action modal-close waves-effect waves-red btn-flat red white-text">Yes</button>
                <a class="modal-action modal-close waves-effect waves-blue btn-flat blue white-text">Nevermind</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/staff.js')}}"></script>
    <script src="{{asset('/js/fancy-search.js')}}"></script>
@endsection
