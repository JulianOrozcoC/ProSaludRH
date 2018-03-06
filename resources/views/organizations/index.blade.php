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
			<div id="assign-user-modal" class="modal">
				<div class="modal-content">
						<form method="POST" action="{{ route('register') }}">
							<h4 id="modal-title">@lang('organizations.create_user')</h4>
							@csrf
							<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
									<div class="col-md-6">
											<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

											@if ($errors->has('name'))
													<span class="invalid-feedback">
															<strong>{{ $errors->first('name') }}</strong>
													</span>
											@endif
									</div>
							</div>

							<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
									<div class="col-md-6">
											<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

											@if ($errors->has('email'))
													<span class="invalid-feedback">
															<strong>{{ $errors->first('email') }}</strong>
													</span>
											@endif
									</div>
							</div>

							<div class="form-group row">
									<label for="organization" class="col-md-4 col-form-label text-md-right">Organization</label>
									<div class="col-md-6">
										<select class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" id="organization" name="organization" required>
											<option value="" disabled selected>Choose your option</option>
											@foreach($organizations as $organization)
												<option value="{{ $organization->id }}">{{ $organization->name }}</option>
											@endforeach
										</select>
									</div>
							</div>

							<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
									<div class="col-md-6">
											<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
											@if ($errors->has('password'))
													<span class="invalid-feedback">
															<strong>{{ $errors->first('password') }}</strong>
													</span>
											@endif
									</div>
							</div>

							<div class="form-group row">
									<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
									<div class="col-md-6">
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
									</div>
							</div>
							<div class="modal-footer">
									<a href="#!" class="red white-text  modal-action modal-close waves-effect waves-red btn-flat">@lang('common.close')</a>
									<button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.add_employee')</button>
							</div>
					</form>
			</div>
	</div>
@endsection