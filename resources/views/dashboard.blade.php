@extends('layouts.app')

@section('content')
    <!-- End Navbar -->
    <section class="dashboard">
        <div class="page-header">
            <div class="container">
                <div class="page-header-text">
                    <div class="dashboard-header d-flex">
                        <div class="d-flex align-items-center flex-column ">
                            <div id="profileImg" class="dashboard-center ">
                                <img class="dashboard-img" src="{{ Auth::user()->image }}" alt="" id="profile">
                            </div>
                            <div class="welcome">
                                <div class="dashboard-title">Hi <span id="username">{{ Auth::user()->name }}</span> !
                                </div>
                                <div class="dashboard-des">Welcome back</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="quizes-title">
                <div class="quize-bold">Quizes</div>
                <div class="quize-des">Test your knowledge</div>
            </div>
            <div class="row quizes-padding ">
                @foreach ($exams as $exam)
                    <div class="col-lg-4 col-md-6 col-sm-6 ">
                        <div class="quizes-card">
                            <div class="box_grid">
                                <img src="{{ asset("img/$exam->exam_img") }}" alt="">
                                <div class="quiz-card">
                                    <div class="card-title">
                                        {{ $exam->exam_name }}
                                    </div>
                                    <ul>
                                        <li> <i class="far fa-book-open"></i><span
                                                class="mx-1">{{ $exam->exam_num_qus }}</span><span
                                                class="dm-none">Question</span></li>
                                        <li> <i class="far fa-history"></i><span class="mx-1">01.25</span><span
                                                class="dm-none">Minute</span></li>
                                        <li><a href="quiz.html" id="quizStart1" class="btn primaryBtn start-btn ">Start</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
