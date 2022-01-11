@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/quiz.css') }}" />
@php $title = "Result"; @endphp
@section('title', $title)
@section('content')

@php $total = 0; @endphp
@php $user_mark = 0; @endphp

@foreach ($exam[0]->userAnswer as $key => $item)
@php $user_mark += $item->marks; @endphp
@endforeach

@foreach ($exam[0]->questions as $key => $item)
    @php $total += $item->question_point; @endphp
@endforeach

    <div class="quiz-container active">

        <div class="page-header">
            <div class="container">
                <div class="page-header-text category flex-between">
                    <div>
                        Quiz: <span class="quiz-name">{{ $exam[0]->exam_name }}</span>
                    </div>
                    <div>
                        {{$user_mark}}/{{$total}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container result">
            <div class="largeDiv">
                @foreach ($exam[0]->questions as $key => $item)
                    @php $total += $item->question_point; @endphp
                    <div class="qusContainer">
                        <div class="row">
                            <h3 class="col-10">{!! $item->question_content !!}</h3>
                            <h3 class=" col-1">{{$exam[0]->userAnswer[$key]->marks}}/{{$item->question_point}}</h3>
                        </div>
                        <div class="answers">
                            @php
                                $options = array_map('trim', explode(',', $item->question_options));
                            @endphp
                            @foreach ($options as $option)
                                <label class="resultLabel @if ($item->correct_answer == $option) correct @endif @foreach ($exam[0]->userAnswer as $userAnswer)  @if ($userAnswer->user_answer != $item->correct_answer && $userAnswer->user_answer == $option) incorrect @endif @endforeach ">{{ $option }}</label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
