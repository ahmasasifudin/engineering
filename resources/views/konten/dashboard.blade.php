@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
  <div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Dashboard
          <small class="text-muted mx-2">
            <a class="text-muted" href="/">Home</a> >
          </small>
        </h5>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-2 my-2">
          <h5>Keterangan:</h5>
          <label class="btn btn-sm btn-success col-md-2"> > 30 hari </label>
          <label class="btn btn-sm btn-warning col-md-2"> < 30 hari </label>
          <label class="btn btn-sm btn-danger col-md-3"> Jadwal terlewat, Wajib diuji! </label>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="mx-4 my-4">
          <h4 class="mb-3">Daftar List Pengujian Material</h4>
          <table class="table table-hover" id="dashboard-table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Material Name</th>
                <th>Thickness</th>
                <th>Project</th>
                <th>Month Test</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @php
                $counter = 0
              @endphp

              @foreach ($data as $item)
              
                @if ($item['keterangan'] === 'confirmed')
                  @continue
                @endif
                <tr>
                  {{-- <td>{{ $loop->iteration }}</td> --}}
                  <td>{{ ++$counter }}</td>
                  <td>{{ $item->material_name }}</td>
                  <td>{{ $item->thickness }}</td>
                  <td>{{ $item->project }}</td>

                  @php
                    $target = $item->month_test;
    
                    $today = \Carbon\Carbon::today();
                    $date = \Carbon\Carbon::parse($target);
                    $selisih = $today->diffInDays($date);
                    
                    $formattedDate = $date->format('F Y');
                    
                    if ($target < $today) {
                      if ($selisih > 0) { //tanggal lewat
                        $tanda = '+';
                      } elseif ($selisih < 0) {
                        $tanda = '-';
                        $selisih = abs($selisih);
                      } else {
                        $tanda = ''; 
                      }
                    } else {
                      if ($selisih > 0) { //tanggal depan
                        $tanda = '-';
                      } elseif ($selisih < 0) {
                        $tanda = '+';
                        $selisih = abs($selisih);
                      } else {
                        $tanda = ''; 
                      }
                    }
                  @endphp

                  <td>{{ $formattedDate }}</td>
                  
                  <td>
                    @if ($tanda === '-' && $selisih > 30)
                      <label class="btn btn-sm btn-success">{{ $tanda }} {{ $selisih }} days</label>
                    @elseif ($tanda === '-' && $selisih < 30)
                      <label class="btn btn-sm btn-warning">{{ $tanda }} {{ $selisih }} days</label>
                    @else
                      <label class="btn btn-sm btn-danger">{{ $tanda }} {{ $selisih }} days</label>
                    @endif
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
    $(document).ready(function() {
      $('#dashboard-table').DataTable();
    });
  </script>
@endsection