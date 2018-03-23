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
                                <div class="collapsible-header primary-color-text">{{$organization->name}}
																	<a href="#delete-organization-modal" class="right modal-trigger delete-organization tooltipped" data-tooltip="Delete organization" data-organization-id="{{$organization->id}}">
																		<i class="material-icons red-text">delete</i>
																	</a>
																	<a href="/show/{{$organization->id}}" class="right show-organization tooltipped" data-tooltip="Show organization">
																		<i class="material-icons purple-text">info</i>
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
            <a class="btn-floating btn-large primary-color">
                <i class="large material-icons">more_vert</i>
            </a>
            <ul>
                <li><a href="#assign-user-modal" class="btn-floating teal modal-trigger"><i class="material-icons">group</i></a></li>
                <li><a href="#add-organization-modal" class="btn-floating green modal-trigger"><i class="material-icons">add</i></a></li>
            </ul>
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
			<div id="delete-organization-modal" class="modal bottom-sheet">
					<div class="modal-content">
							<h4 id="title"></h4>
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