@php
$pageName = 'Manage Users';
@endphp
@extends('admin.layouts.admin')
@section('content')
<div class="page-heading">
  <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last mb-3">
              <h3>{{ $user->name }}</h3>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  @include('alerts.success')
  <div class="col-12 ">
      <div class="card">
          <div class="card-header">
              <h4>{{ $user->name }}</h4>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-lg">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Questions</th>
                              <th>question_point</th>
                          </tr>
                      </thead>
                      <tbody>
                              <tr class="bg-primary text-white">
                                  <td>ss</td>
                                  <td>
                                      sss
                                  </td>
                                  <td class="col-auto">
                                      <p class=" mb-0">ss</p>
                                  </td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td class="col-auto">
                                          <p class=" mb-0">
                                          <ul>
                                              <li>
                                                  sss
                                              </li>
                                          </ul>
                                          </p>
                                  </td>
                                  <td>Correct Answer:
                                      <span style="color: rgb(40, 196, 110)"
                                          class="h5">s</span>
                                  </td>
                              </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
@endsection
