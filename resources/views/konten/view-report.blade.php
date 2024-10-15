@extends('layout.main')

@section('title', 'View Report')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
      <h5 class="text-titlecase">Report
        <small class="text-muted mx-2">
          <a class="text-muted" href="/">Home</a>
          >
          <a class="text-muted" href="/report">Report Pengujian</a>
          >
          <a class="text-muted" href="#">{{ $data->id_material }}</a>
        </small>
      </h5>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 ml-4 my-2">
      <div class="d-flex align-items-center">
        <a href="/report" class="btn btn-info btn-sm btn-icon-text">
          <i class="typcn typcn-arrow-back btn-icon-append"></i>                          
          back to Report Pengujian
        </a>
      </div>
    </div>
  </div>

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">{{ $data->material_name }} - {{ $data->thickness }}</h1>
        <iframe class="col-12" style="height: 500px" src="/reports/{{ $data->file_report }}"></iframe>
      </div>
    </div>
  </div>

@endsection