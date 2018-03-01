@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card card-default">
			<div class="card-header">{{$organization->name}}</div>
			<div class="card-body" style="max-height: 800px;">
					
			</div>
	</div>
  
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
          <a class="btn-floating btn-large purple">
            <i class="material-icons">add</i>
          </a>
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
@endsection
