@extends('layout.main')

@section('title', 'Data Supplier')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Data Master
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="#">Data Supplier</a>
            </small>
        </h5>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-3 ml-2 my-2">
      <div class="d-flex align-items-center">
        <a href="/new-supplier" class="btn btn-primary btn-sm btn-icon-text">
          New Supplier
          <i class="typcn typcn-plus btn-icon-append"></i>                          
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <table class="table table-hover" id="supplier-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Supplier</th>
                <th>Supplier Name</th>
                <th>Registration Date</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplier as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->id_supplier }}</td>
                  <td>{{ $item->supplier }}</td>

                  @php
                    $date = \Carbon\Carbon::parse($item->tgl_registrasi);
                    $formattedDate = $date->format('d F Y');
                  @endphp

                  <td>{{ $formattedDate }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="/supplier/edit/{{ $item->id }}" class="btn btn-warning btn-sm btn-icon-text mr-3">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>                          
                      </a>
                      <a href="#" class="btn btn-danger btn-sm btn-icon-text delete" data-id="{{ $item->id }}" data-nama="{{ $item->supplier }}">
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
      var idSupplier = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');
      swal({
        title: "Are you sure want to delete supplier "+nama+" ?",
        text: "Once delete, data will not available on list!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/supplier/delete/"+idSupplier+""
          swal("Data has been deleted!", {
            icon: "success",
          });
        } else {
        }
      });
    });

    $(document).ready(function() {
      $('#supplier-table').DataTable();
    });
  </script>
@endsection