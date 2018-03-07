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
																	<a href="/show/{{$test->id}}" class="right show-test tooltipped" data-tooltip="Show test">
																		<i class="material-icons purple-text">info</i>
																	</a> 
                                  <a href="#edit-test-modal" class="modal-trigger right tooltipped" data-tooltip="Edit test" data-test-id="{{$test->id}}"><i class="material-icons">mode_edit</i></a>
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
    </div>
    <div id="edit-test-modal" class="modal">
        <div class="modal-content">
            <form class="col s12" role="form" method="POST">

                <h4 id="modal-title">@lang('test.edit_test')</h4>
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="red white-text  modal-action modal-close waves-effect waves-red btn-flat">@lang('common.close')</a>
                    <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.save')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
