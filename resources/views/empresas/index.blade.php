@extends('layouts.app')

@section('content')
<!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Agregar Organizacion</h4>
      <div class="row">
        <form class="col s12" action="{{route('post.organization')}}" method="post">
          {{csrf_field()}}
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="name" name="name" type="text" class="validate">
              <label for="name">Nombre</label>
            </div>
          </div>
          <button class="btn waves-effect waves-light" type="submit" name="action">Guardar
          </button>           
        </form>
      </div>
    </div>
  </div>
<div class="container row">
	<div class="card card-default col s12 m10 l8 offset-m1 offset-l2">
  <div class="card-content">
    <span class="card-title">Empresas</span>
  </div> 
	<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if($organizations->count())
    <div id="organizations">
      <div class="row text-center">
          @foreach($organizations as $organization)
                {{--  <a href="/show/{{$organization->id}}">
                  <div class="card hoverable darken-1 col s12 m6 l4" style="background-color: #9347c7;">
                    <div class="card-content white-text">
                      <span class="card-title"><h1>{{$organization->name}}</h1></span>
                    </div>
                  </div>
                </a>  --}}
                <div class="col s12 m6 l4">
    <div class="card blue-grey darken-1 hoverable">
      <div class="card-content white-text">
        <span class="card-title">Card Title</span>
        <p>I am a very simple card. I am good at containing small bits of information.
        I am convenient because I little markup t effectively.</p>
      </div>
      
    </div>
  </div>
        @endforeach
  </div>
        
    </div>
    @else
      <p>No hay empresas registradas!</p>
    @endif
    </div>
	</div>
  
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a href="#modal1" class="modal-trigger btn-floating btn-large purple"><i class="material-icons">add</i></a>
  </div>
  <span style="float: left;">  
    @if(count($errors) > 0)
      @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{$error}}
        </div>
      @endforeach
    @endif
  </span>
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
