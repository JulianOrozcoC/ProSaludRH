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
			</div>
	</div>
</div>
@endsection
