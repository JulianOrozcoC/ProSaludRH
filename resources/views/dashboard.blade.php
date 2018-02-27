@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card card-default">
			<div class="card-header">Dashboard</div>

			<div class="card-body">
					@if (session('status'))
							<div class="alert alert-success">
									{{ session('status') }}
							</div>
					@endif

				<div class="row">
					<div class="col s4">
						<div class="row">
							<div class="col s12 m6">
								<div class="card blue-grey darken-1">
									<div class="card-content white-text">
										<span style="text-align: center;" class="card-title">Total de Empresas</span>
										<span style="text-align: center;"><h1>8 <i class="material-icons">business_center</i></h1></span>
									</div>
								</div>
							</div>
      			</div>
					</div>
					<div class="col s4">
						<div class="row">
							<div class="col s12 m6">
								<div class="card blue-grey darken-1">
									<div class="card-content white-text">
										<span style="text-align: center;" class="card-title">Total de Empleados</span>
										<span style="text-align: center;"><h1>8 <i class="material-icons">people</i></h1></span>
									</div>
								</div>
							</div>
      			</div>
					</div>
					<div class="col s4">
						<div class="row">
							<div class="col s12 m6">
								<div class="card blue-grey darken-1">
									<div class="card-content white-text">
										<span style="text-align: center;" class="card-title">Total de Licencias</span>
										<span style="text-align: center;"><h1>8 <i class="material-icons">vpn_key</i></h1></span>
									</div>
								</div>
							</div>
      			</div>
					</div>
					<!-- End column -->
				</div>
				<!-- End row -->
				<div class="row">
					<div class="col s4">
						<div class="row">
							<div class="col s12 m6">
								<div class="card blue-grey darken-1">
									<div class="card-content white-text">
										<span style="text-align: center;" class="card-title">Total de Usuarios</span>
										<span style="text-align: center;"><h1>8 <i class="material-icons">verified_user</i></h1></span>
									</div>
								</div>
							</div>
      			</div>
					</div>
					<div class="col s4">
						<div class="row">
							<div class="col s12 m6">
								<div class="card blue-grey darken-1">
									<div class="card-content white-text">
										<span style="text-align: center;" class="card-title">Total de Examenes</span>
										<span style="text-align: center;"><h1>8 <i class="material-icons">note</i></h1></span>
									</div>
								</div>
							</div>
      			</div>
					</div>
					<!-- End column -->
				</div>
				<!-- End row -->
			</div>
	</div>
</div>
@endsection
