@extends('layouts.app')

@section('header')
<h2 class="header white-text col s12">@lang('credits.credits')</h2>
@endsection

@section('content')
<div id="credits">
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
                    </div>
                    <div class="collapsible-body">
                        <ul class="collection">
                            @foreach($organization->tests as $test)
                            <li class="collection-item">
                                
                                <div class="">
                                    <span class="primary-color-text"></span><b> Test Name: </b>{{$test->name}}<span class="primary-color-text"></span><b> Credits: </b>{{$test->pivot->amount}}
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
        <a href="#add-credit-modal" class="modal-trigger btn-large btn-floating red"><i class="large material-icons">add</i></a>
    </div>
</div>
<div id="add-credit-modal" class="modal">
    <div class="modal-content">
        <form class="col s12" role="form" method="POST">
            
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
        </form>
    </div>
</div>
@endsection

@section('scripts')
@endsection
