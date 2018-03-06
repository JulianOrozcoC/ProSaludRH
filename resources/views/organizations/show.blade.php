@extends('layouts.app')

@section('header')
    <h2 class="header white-text col s12">{{$organization->name}}</h2>
@endsection

@section('content')
    <div id="organization">
        <div class="section">
            <div class="container">
							<div class="row">
								<div class="col s12 m4 l4">
									<div class="card purple darken-1 hoverable">
										<div class="card-content white-text">
											<span class="card-title">Total Credits</span>
										</div>
									</div>
								</div>
								<div class="col s12 m4 l4">
									<div class="card purple darken-1 hoverable">
										<div class="card-content white-text">
											<span class="card-title">Used Credits</span>
										</div>
									</div>
								</div>
								<div class="col s12 m4 l4">
									<div class="card purple darken-1 hoverable">
										<div class="card-content white-text">
											<span class="card-title">Remaining Credits</span>
										</div>
									</div>
								</div>
							</div>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large primary-color">
                <i class="large material-icons">more_vert</i>
            </a>
            <ul>
                <li><a href="#assign-user-modal" class="btn-floating teal modal-trigger"><i class="material-icons">group</i></a></li>
                <li><a href="#add-organization-modal" class="btn-floating green modal-trigger"><i class="material-icons">add</i></a></li>
            </ul>
        </div>
    </div>

@endsection