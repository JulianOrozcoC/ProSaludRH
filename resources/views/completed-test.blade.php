@extends('layouts.app')

@section('header')
<h2 class="header white-text col s12">{{$testApplication->test->name}} for {{ $testApplication->user->name }}</h2>
@endsection

@section('content')
    <div id="contracts">
        <div class="section">
            <div class="container">
                <br>

                {{-- EVENTS SECTION --}}
                @if(count($gradings) > 0)

                    <div class="row grid">
                        @foreach($gradings as $key =>$grading)
                            <div class="col s12 m3 l3 grid-item">
                                <div class="card white hoverable">
                                    <div class="card-content center ">
                                        <h5 class="primary-color-text">{{$key}}</h5>
                                        <p >{{$grading}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>


    </div>

@endsection