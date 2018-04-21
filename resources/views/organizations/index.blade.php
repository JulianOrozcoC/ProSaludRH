@extends('layouts.app')

@section('header')
<h2 class="header white-text col s12">@lang('organizations.organizations')</h2>
@endsection

@section('content')
<div id="organizations">
    <div class="section">
        <div class="container">
            <br>
            
            {{-- EVENTS SECTION --}}
            @if(count($organizations) > 0)
            <br>
            <ul class="collapsible popout" data-collapsible="accordion">
                
                @foreach($organizations as $organization)
                <li>
                    <div class="collapsible-header primary-color-text">
                        <a href="/organization/{{$organization->id}}" class="show-organization tooltipped" data-tooltip="Show organization">
                            {{$organization->name}}
                        </a>
                    </div>
                    <div class="collapsible-body">
                        <ul class="collection">
                            @foreach($organization->users as $user)
                            <li class="collection-item">
                                
                                <div class="">
                                    <span class="primary-color-text"></span><b> {{$user->name}}</b> ({{$user->email}}) 
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        
                    </div>
                </li>
                @endforeach
                
            </ul>
            
            @else
            <br><br><br>
            <h4 class="center-align grey-text">No organizations registered</h4>
            @endif
            
        </div>
    </div>
    
    <div class="fixed-action-btn">
            <a href="#add-organization-modal" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
    </div>
</div>


<div id="add-organization-modal" class="modal">
    <div class="modal-content">
        <form class="col s12" role="form" method="POST">
            
            <h4 id="modal-title">@lang('organizations.organization_create')</h4>
            {{ csrf_field() }}
            
            
            <div class="row">
                <div class="input-field col s12">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name">
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