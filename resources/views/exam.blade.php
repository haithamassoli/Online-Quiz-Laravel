@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/quiz.css')}}" />
@php $title = "Exam"; @endphp
@section('title', $title)
@section('content')
  <div class="info_box activeInfo">
    <div class="info-title"><span>Some Rules of this Quiz</span></div>
    <div class="info-list">
      <div class="info">
        1. You will have only <span>15 seconds</span> per each question.
      </div>
      <div class="info">
        2. Once you select your answer, it can't be undone.
      </div>
      <div class="info">
        3. You can't select any option once time goes off.
      </div>
      <div class="info">
        4. You can't exit from the Quiz while you're playing.
      </div>
      <div class="info">
        5. You'll get points on the basis of your correct answers.
      </div>
    </div>
    <div class="buttons">
      <button class="btn borderBtn btn-width mt-1 me-1 quit"><a href="dashboard.html">Exit Quiz</a></button>
      <button class="btn primaryBtn btn-width mt-1 me-1 restart">Continue</button>
    </div>
  </div>
  <div class="quiz-container">

    <div class="page-header">
      <div class="container">
        <div class=" page-header-text category">Quiz<span class="questionsNum"></span>:
          <span class="quiz-name"></span></div>
      </div>
    </div>
    <div class="container result">
      <div class="row inner-page">
        <div class="d-flex justify-content-between align-items-center">
          <div><span class="timer timer_sec me-2"></span> <span class="time_left_txt"> Time left</span></div>
          <div><a href="dashboard.html" class="btn primaryBtn">Start Over</a></div>
        </div>
        <div class="col-lg-12 ">
          <div class="time_line"></div>

        </div>
        <div class="question"></div>
        <div class="answers all-answers"></div>
        <div class="d-flex justify-content-between mt-4">
          <div class="bullets">
            <div class="spans"></div>
          </div>
          <button class="btn primaryBtn px-4 submit-btn">@if ($exam->exam_num_qus == 1) Submit @else Next @endif</button>
        </div>
      </div>
    </div>
  </div>

  <div class="result_box ">
    <div>
      <img class="result_img" src="" alt="">
    </div>
    <div class="complete_text">You've completed the Quiz!</div>
    <div class="score_text">
      <!-- Here I've inserted Score Result from JavaScript -->
    </div>
    <div class="buttons">
      <button class="btn borderBtn btn-width mt-1 me-1 Show_Answer">Show Answer</button>
      <button class="btn primaryBtn btn-width mt-1 me-1 quit"><a class="white" href="dashboard.html">Quit</a></button>
    </div>
  </div>
  <script src="{{asset('js/quiz.js')}}"></script>
@endsection