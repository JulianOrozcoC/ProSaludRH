@extends('layouts.app')

@section('content')
<!-- Modal Structure -->
<!-- Modal Structure -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
<div class="container">
	<div class="card card-default">
			<div class="card-header">Empresas</div>
			<div class="card-body" style="max-height: 800px;">
					@if (session('status'))
							<div class="alert alert-success">
									{{ session('status') }}
							</div>
					@endif
          @if(count($organizations) > 0)
          <?php
            $colcount = count($organizations);
            $i = 1;
          ?>
          <div id="organizations">
            <div class="row text-center">
                @foreach($organizations as $organization)
                  @if($i == $colcount)
                    <div class="col s4">
                    <a href="">
                      <div class="col s12">
                        <div class="card darken-1" style="background-color: #9347c7;">
                          <div class="card-content white-text">
                            <span class="card-title"><h1>{{$organization->name}}</h1></span>
                            <h4>Licencias: <h3>10</h3></h4>
                          </div>
                        </div>
                      </div>
                    </a>
                  @else
                    <div class="col s4">
                      <div class="col s12">
                        <div class="card darken-1" style="background-color: #9347c7;">
                          <div class="card-content white-text">
                            <span class="card-title"><h1>{{$organization->name}}</h1></span>
                            <h4>Licencias: <h3>14</h3></h4>
                          </div>
                        </div>
                      </div>
                  @endif
                  @if($i % 3 == 0)
                  </div></div><div class="row">
                  @else
                    </div>
                  @endif
                  <?php $i++; ?>
                @endforeach
            </div>
          </div>
          @else
            <p>No hay empresas registradas!</p>
          @endif
			</div>
	</div>
  <a href="#modal1" style="float: right;" class="modal-trigger btn-floating btn-large waves-effect waves-light purple"><i class="material-icons">add</i></a>
</div>
<script>
  (function ($) {
    $(function () {
        //initialize all modals           
        $('.modal').modal();
        //click on trigger
        $('.trigger-modal').modal();
    }); // end of document ready
  })(jQuery); // end of jQuery name space
</script>
@endsection
