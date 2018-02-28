@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card card-default">
			<div class="card-header">Empresas</div>
			<div class="card-body">
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
                    <div class="col s3">
                    <a href="">
                      <div class="col s12 m6">
                        <div class="card blue-grey darken-1">
                          <div class="card-content white-text">
                            <span class="card-title">{{$organization->name}}</span>
                          </div>
                        </div>
                      </div>
                    </a>
                  @else
                    <div class="col s3">
                      <div class="col s12 m6">
                        <div class="card blue-grey darken-1">
                          <div class="card-content white-text">
                            <span class="card-title">{{$organization->name}}</span>
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
  <span><a href="/empresas/create" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a></span>
</div>
@endsection
