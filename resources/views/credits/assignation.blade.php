@extends('layouts.app')

@section('header')
<h2 class="header white-text col s12">@lang('credits.credits')</h2>
@endsection

@section('content')
<div id="credits">
    <div class="section">
        <div class="container">
            <form class="col s12" role="form" method="POST">
            
                <h4 id="modal-title">@lang('staff.add_user')</h4>
                {{ csrf_field() }}
                
                
               
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">face</i>
                        <input autocomplete="off" type="text" name="user" id="autocomplete-input" class="autocomplete">
                        <label for="autocomplete-input">User</label>
                    </div>
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
                    <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">@lang('common.add')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){        
            $('#autocomplete-input').autocomplete({
                data: 
                    {!!$users!!}
                ,
                limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function(val) {
                // Callback function when value is autcompleted.
                },
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        });
        
    </script>
@endsection



