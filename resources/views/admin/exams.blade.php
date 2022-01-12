@php
$pageName = 'Manage Exams';
@endphp
@extends('admin.layouts.admin')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-3">
                    <h3>Manage Exams</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Exams</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @include('alerts.success')
        <section class="section">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content:space-between; align-items:center">
                    <div>Exams Table</div>
                    <div>
                        <form action="/admin/exams/create" method="GET">
                            <label for="">Number of Questions</label>
                            <input max=30 value=1 style="border: rgb(67,94,190) solid 3px; width:70px; height:36px"
                                class="btn" type="number" name="exam_num_qus">
                            <button class="btn btn-primary">Add Exam</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quiz Name</th>
                                <th>Quiz Descreption</th>
                                <th>Number of Questions</th>
                                <th>Image</th>
                                <th>Adjustments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $exam->id }}</td>
                                    <td>{{ $exam->exam_name }}</td>
                                    <td>{{ $exam->exam_desc }}</td>
                                    <td>{{ $exam->exam_num_qus }}</td>
                                    <td>
                                        <img class="avatar me-2" style="object-fit: cover" width="50" height="50"
                                            src="{{ asset("img/$exam->exam_img") }}" alt="profile_photo">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.exams.show', $exam->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{ route('admin.exams.edit', $exam->id) }}" class="ms-3 ">
                                            <i class="fas fa-cog"></i>
                                        </a>
                                        <form style="display: inline-block" method="POST"
                                            action="{{ route('admin.exams.destroy', $exam->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn text-primary"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endsection
