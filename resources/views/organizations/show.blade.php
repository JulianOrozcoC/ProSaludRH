@extends('layouts.app')

@section('header')
<h2 class="header white-text col s12">{{$organization->name}}</h2>
@endsection

@section('content')
<div id="organization">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col s12 m4 l4">
                    <div class="card purple darken-1 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title">Total Credits</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4 l4">
                    <div class="card purple darken-1 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title">Used Credits</span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4 l4">
                    <div class="card purple darken-1 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title">Remaining Credits</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large primary-color">
            <i class="large material-icons">more_vert</i>
        </a>
        <ul>
            <li>
                <a href="#edit-organization-modal" class="btn-floating edit-organization tooltipped blue" data-tooltip="Edit organization">
                    <i class="large material-icons">mode_edit</i>
                </a>
            </li>
            @if(Auth::user()->user_type == 1)
            <li>
                <a href="#delete-organization-modal" class="btn-floating modal-trigger delete-organization tooltipped red" data-tooltip="Delete organization" data-organization-id="{{$organization->id}}">
                    <i class="material-icons">delete</i>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
<div id="edit-organization-modal" class="modal">
    <div class="modal-content">
        <form class="col s12" role="form" method="POST">
            
            <h4 id="modal-title">@lang('organizations.organization_edit')</h4>
            {{ csrf_field() }}
            
            
            <div class="row">
                <div class="input-field col s12">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{$organization->name}}">
                </div>
            </div>
            
            <div class="modal-footer">
                <a href="#!" class="red white-text  modal-action modal-close waves-effect waves-red btn-flat">@lang('common.close')</a>
                <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.save')</button>
            </div>
        </form>
    </div>
</div>
<div id="delete-organization-modal" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Are you sure you want to delete the organization?</h4>
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
    <script src="{{asset('/js/organization.js')}}"></script>
@endsection