@extends('layout.main')

@section('title', 'Schedule')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Schedule
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="#">Schedule Pengujian</a>
            </small>
        </h5>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6 ml-2 my-2">
      <div class="d-flex align-items-center">
        <a href="/new-schedule" class="btn btn-primary btn-sm btn-icon-text">
          New Schedule
          <i class="typcn typcn-plus btn-icon-append"></i>                          
        </a>
        <a href="/schedule-calendar" class="btn btn-info btn-sm btn-icon-text ml-2">
          See Details Calendar
          <i class="typcn typcn-eye btn-icon-append"></i>                          
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <table class="table table-hover" id="schedule-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Material Name</th>
                <th>Thickness</th>
                <th>Supplier Name</th>
                <th>Project</th>
                <th>Month Testing</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($material as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->material_name }}</td>
                  <td>{{ $item->thickness }} mm</td>
                  <td>{{ $item->supplier }}</td>
                  <td>{{ $item->project }}</td>
                  
                    @php
                      $date = \Carbon\Carbon::parse($item->month_test);
                      $formattedDate = $date->format('F');
                    @endphp

                  <td>{{ $formattedDate }}</td>

                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="/schedule/edit/{{ $item->id }}" class="btn btn-warning btn-sm btn-icon-text mr-3">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>                          
                      </a>
                      <a href="#" class="btn btn-danger btn-sm btn-icon-text delete" data-id="{{ $item->id }}" data-nama="{{ $item->id_material }}">
                        Delete
                        <i class="typcn typcn-trash btn-icon-append"></i>                     
                      </a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('.delete').click(function() {
      var idMaterial = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');
      swal({
        title: "Are you sure want to delete schedule "+nama+" ?",
        text: "Once delete, data will not available on list!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/schedule/delete/"+idMaterial+""
          swal("Data has been deleted!", {
            icon: "success",
          });
        } else {
        }
      });
    });

    $(document).ready(function() {
      $('#schedule-table').DataTable();
    });
  </script>
@endsection