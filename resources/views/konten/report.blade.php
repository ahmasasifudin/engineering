@extends('layout.main')

@section('title', 'Report')

@section('content')

<div class="row">
<div class="modal fade" id="keteranganModal" tabindex="-1" aria-labelledby="keteranganModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="keteranganModalLabel">Form Keterangan Decline</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="keteranganForm" method="post">
        @csrf
          <label for="keterangan">Keterangan:</label>
          <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
        </div>
        @foreach ($validasi as $data)
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" id="submitKeterangan" class="btn btn-primary" data-url="{{ url('/report/keterangan') }}" data-id="{{ $data->id }}">Submit</button>
          </div>
        </form>
        @endforeach
    </div>
  </div>
</div>
</div>

  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
      <h5 class="text-titlecase">Report
        <small class="text-muted mx-2">
          <a class="text-muted" href="/">Home</a>
          >
          <a class="text-muted" href="#">Report Pengujian</a>
        </small>
      </h5>
    </div>
  </div>

  @if (Auth::user()->isBasic())
    <div class="row">
      <div class="col-md-3 ml-2 my-2">
        <div class="d-flex align-items-center">
          <a href="/new-report" class="btn btn-primary btn-sm">
            New Report
            <i class="typcn typcn-plus btn-icon-append"></i>                          
          </a>
        </div>
      </div>
    </div>
  @endif

  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <h4 class="mb-3">Validasi Report Pengujian</h4>
          <table class="table table-hover" id="validate-table" style="width:100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Material</th>
                <th>Month Test</th>
                <th>Date Test</th>
                <th>Keterangan</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($validasi as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id_material }}</td>

                @php
                    $date1 = \Carbon\Carbon::parse($item->month_test);
                    $date2 = \Carbon\Carbon::parse($item->date_test);
                    $formattedDate1 = $date1->format('F');
                    $formattedDate2 = $date2->format('F Y');
                @endphp
                <td>{{ $formattedDate1 }}</td>
                <td>{{ $formattedDate2 }}</td>

                <td style="width: 50px;">{{ $item->keterangan }}</td>

                <td>
                  <div class="d-flex justify-content-center">
                    @if (Auth::user()->isBasic())
                      <a href="/report/edit/{{ $item->id }}" class="btn btn-warning btn-sm btn-icon-text mr-3">
                        Edit
                        <i class="typcn typcn-edit btn-icon-append"></i>                          
                      </a>
                      <a href="#" class="btn btn-danger btn-sm btn-icon-text delete" data-id="{{ $item->id }}" data-nama="{{ $item->id_material }}">
                        Delete
                        <i class="typcn typcn-trash btn-icon-append"></i>                     
                      </a>
                    @endif
                    @if (Auth::user()->isAdmin())
                      <a href="{{ url('/view-report', $item->id) }}" class="btn btn-info btn-sm btn-icon-text mr-3">
                        View Report
                        <i class="typcn typcn-eye btn-icon-append"></i>                          
                      </a>
                      <form action="{{ url('report/accept', $item->id) }}" method="post">
                      @csrf
                        <button class="btn btn-success btn-sm btn-icon-text mr-3 accept" type="submit">
                          Accept
                          <i class="typcn typcn-tick btn-icon-append"></i> 
                        </button>
                      </form>
                      <button id="declineButton" class="btn btn-danger btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#keteranganModal">
                        Decline
                        <i class="typcn typcn-times btn-icon-append"></i>                     
                      </button>
                    @endif
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

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <h4 class="mb-3">Report Pengujian</h4>
          <table class="table table-hover" id="report-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Material Name</th>
                <th>Thickness</th>
                <th>Month Test</th>
                <th>Date Test</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($report as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->material_name }}</td>
                <td>{{ $item->thickness }} mm</td>

                @php
                    $date1 = \Carbon\Carbon::parse($item->month_test);
                    $date2 = \Carbon\Carbon::parse($item->date_test);
                    $formattedDate1 = $date1->format('F');
                    $formattedDate2 = $date2->format('F Y');
                @endphp
                <td>{{ $formattedDate1 }}</td>
                <td>{{ $formattedDate2 }}</td>

                <td>
                  <div class="d-flex justify-content-center">
                    <a href="{{ url('/view-report', $item->id) }}" class="btn btn-info btn-sm btn-icon-text mr-3">
                      View Report
                      <i class="typcn typcn-eye btn-icon-append"></i>                          
                    </a>
                    @if (Auth::user()->isAdmin())
                      <a href="#" class="btn btn-danger btn-sm btn-icon-text delete" data-id="{{ $item->id }}" data-nama="{{ $item->id_material }}">
                        Delete
                        <i class="typcn typcn-trash btn-icon-append"></i>                     
                      </a>
                    @endif
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
        title: "Are you sure want to delete report "+nama+" ?",
        text: "Once delete, report will not available on list!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/report/delete/"+idMaterial+""
          swal("Data has been deleted!", {
            icon: "success",
          });
        } else {
        }
      });
    });

    $(document).ready(function() {
      $('#validate-table').DataTable();
    });

    $(document).ready(function() {
      $('#report-table').DataTable();
    });

    const declineButton = document.getElementById('declineButton');
    const keteranganModal = new bootstrap.Modal(document.getElementById('keteranganModal'));
    const submitKeterangan = document.getElementById('submitKeterangan');
    
    declineButton.addEventListener('click', () => {
      keteranganModal.show();
    });

    submitKeterangan.addEventListener('click', async () => {
      const keterangan = document.getElementById('keterangan').value;
      const url = submitKeterangan.getAttribute('data-url') + '/' + submitKeterangan.getAttribute('data-id');

      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ keterangan: keterangan }),
      });

      const responseData = await response.json();
      console.log(responseData);

      if (response.ok) {
        console.log(responseData.message); 
        keteranganModal.hide();

        setTimeout(() => {
          location.reload();
        });
        
      } else {
        console.error(responseData.message);
      }
    });
  </script>
@endsection