@extends('layouts.app')

@section('header')
    <h2 class="header white-text col s12">{{$test->name}}</h2>
@endsection

@section('content')
    <div id="credits">
        <div class="section">
            <div class="container">
                <form method="POST" > 
                {{ csrf_field() }}
                @foreach($questions_test1 as $questionName => $question)

                <p class="question">{{$question}}</p>
                <ul class="answers">
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="1" type="radio" id="question-{{$questionName}}-1" />
                    <label for="question-{{$questionName}}-1">Siempre</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="2" type="radio" id="question-{{$questionName}}-2" />
                    <label for="question-{{$questionName}}-2">Casi siempre</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="3" type="radio" id="question-{{$questionName}}-3" />
                    <label for="question-{{$questionName}}-3">Algunas veces</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="4" type="radio" id="question-{{$questionName}}-4" />
                    <label for="question-{{$questionName}}-4">Casi nunca</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="5" type="radio" id="question-{{$questionName}}-5" />
                    <label for="question-{{$questionName}}-5">Nunca</label>
                </p>

                </ul>

                @endforeach
               
                <button type="submit">
                    Submit
                </button>
        
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
@endsection
