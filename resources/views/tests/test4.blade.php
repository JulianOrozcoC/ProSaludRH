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
                    <label style="font-size:1rem">{{$question["answer1"]}}</label>
                    <input style="width: 5%" name="{{$questionName}}[]" type="number" min="1" max="4" id="question-{{$questionName}}-1" />
                    
                </p>
                <p>
                   <label style="font-size:1rem">{{$question["answer2"]}}</label>
                    <input style="width: 5%" name="{{$questionName}}[]" type="number" min="1" max="4" id="question-{{$questionName}}-2" />
                </p>
                <p>
                   <label style="font-size:1rem" >{{$question["answer3"]}}</label>
                    <input style="width: 5%" name="{{$questionName}}[]" type="number" min="1" max="4" id="question-{{$questionName}}-3" />
                </p>
                <p>
                   <label style="font-size:1rem" >{{$question["answer4"]}}</label>
                    <input style="width: 5%" name="{{$questionName}}[]" type="number" min="1" max="4" id="question-{{$questionName}}-4" />
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