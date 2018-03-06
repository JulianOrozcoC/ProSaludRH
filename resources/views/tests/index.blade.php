@extends('layouts.app')

@section('header')
    <h2 class="header white-text col s12">@lang('test.tests')</h2>
@endsection

@section('content')
    <div id="credits">
        <div class="section">
            <div class="container">
                <br>
                {{-- EVENTS SECTION --}}
                @if(count($tests) > 0)
                    <br>
                    <ul class="collapsible popout" data-collapsible="accordion">

                        @foreach($tests as $test)
                            <li>
                                <div class="collapsible-header primary-color-text">{{$test->name}}
																	<a href="#delete-test-modal" class="right modal-trigger delete-test tooltipped" data-tooltip="Delete test" data-organization-id="{{$test->id}}">
																		<i class="material-icons red-text">delete</i>
																	</a>
																	<a href="/show/{{$test->id}}" class="right show-test tooltipped" data-tooltip="Show test">
																		<i class="material-icons purple-text">info</i>
																	</a> 
																</div>
                                <div class="collapsible-body">
                                    <ul class="collection">
                                      <li class="collection-item">
                                          <div class="">
                                              <span class="primary-color-text"></span><b> Fecha: </b>{{$test->updated_at->format('d-m-Y')}}
                                          </div>
                                      </li>
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
                <li><a href="#add-credit-modal" class="modal-trigger btn-floating red"><i class="material-icons">add</i></a></li>
            </ul>
        </div>
    </div>
    <div id="add-credit-modal" class="modal">
        <div class="modal-content">
            {{--  <form class="col s12" role="form" method="POST">

                <h4 id="modal-title">@lang('credits.add_credit')</h4>
                {{ csrf_field() }}
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
                <div class="row">
                    <div class="input-field col s12">
                        <select id="test" name="test" required>                        
                            <option value="" disabled selected>Choose a test</option>
                            @foreach($tests as $test)
                                    <option value="{{$test->id}}">{{$test->name}}</option> 
                            @endforeach                        
                        </select>
                        <label for="test">Test</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="quantity">Quantity</label>
                        <input id="quantity" type="text" name="quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="red white-text  modal-action modal-close waves-effect waves-red btn-flat">@lang('common.close')</a>
                    <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.add')</button>
                </div>
            </form>  --}}
        </div>
    </div>
@endsection

@section('scripts')
@endsection
