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
                @foreach($questions as $questionName => $question)

                <p class="question">{{$question["question"]}}</p>
                <ul class="answers">
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="1" type="radio" id="question-{{$questionName}}-1" />
                    <label for="question-{{$questionName}}-1">{{$question["answer1"]}}</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="2" type="radio" id="question-{{$questionName}}-2" />
                    <label for="question-{{$questionName}}-2">{{$question["answer2"]}}</label>
                </p>
                <p>
                    <input class="with-gap" name="{{$questionName}}" value="3" type="radio" id="question-{{$questionName}}-3" />
                    <label for="question-{{$questionName}}-3">{{$question["answer3"]}}</label>
                </p>

                </ul>

                @endforeach
               
                <button type="submit" class="btn btn-large">
                    Submit
                </button>
        
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
@endsection
