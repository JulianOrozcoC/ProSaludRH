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

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

            </div>
        </div>


    </div>

@endsection

@section('scripts')

    <script>
        window.onload = function () {
            
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            
            title:{
                text:""
            },
            axisX:{
                interval: 1
            },
            axisY2:{
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)",
                title: "Score"
            },
            data: [{
                type: "bar",
                name: "companies",
                axisYType: "secondary",
                color: "#014D65",
                dataPoints: [
                    @foreach($gradings as $key => $grading)
                        { y:{{$grading}}, label: '{{$key}}' },
                    @endforeach
                ]
            }]
        });
        chart.render();
        
        }
    </script>
    
@endsection