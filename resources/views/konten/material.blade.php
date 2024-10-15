@extends('layout.main')

@section('title', 'Data Material')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Data Master
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="#">Data Material</a>
            </small>
        </h5>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-3 ml-2 my-2">
      <div class="d-flex align-items-center">
        <a href="/new-material" class="btn btn-primary btn-sm btn-icon-text">
          New Material
          <i class="typcn typcn-plus btn-icon-append"></i>                          
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <table class="table table-hover" id="material-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID Material</th>
                <th>Material Name</th>
                <th>Thickness</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($material as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->id_material }}</td>
                  <td>{{ $item->material_name }}</td>
                  <td>{{ $item->thickness }} mm</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <a href="/material/edit/{{ $item->id }}" class="btn btn-warning btn-sm btn-icon-text mr-3">
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
        title: "Are you sure want to delete material "+nama+" ?",
        text: "Once delete, data will not available on list!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/material/delete/"+idMaterial+""
          swal("Data has been deleted!", {
            icon: "success",
          });
        } else {
        }
      });
    });

    $(document).ready(function() {
      $('#material-table').DataTable();
    });
  </script>
@endsection