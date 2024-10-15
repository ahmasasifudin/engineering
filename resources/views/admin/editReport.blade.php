@extends('layout.main')

@section('title', 'New Report')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Report
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="/report">Report Pengujian</a>
                >
                <a class="text-muted" href="#">New Report</a>
            </small>
        </h5>
    </div>
  </div>

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Form New Report</h1>
        <form action="/report/edit/{{ $data_report->id }}/simpan" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
          <div class="form-group">
            <label for="id_material">ID Material</label>
            <input type="text" class="form-control @error('id_material') is-invalid @enderror" name="id_material" id="id_material" required readonly value="{{ old('id_material', $data_report->id_material) }}">
          </div>

          <div class="form-group">
            <label for="material_name">Material Name</label>
            <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" placeholder="Material Name (ex: JSH270C)" value="{{ old('material_name', $data_report->material_name) }}" required readonly>
            @error('material_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="thickness">Thickness</label>
            <div class="input-group">
              <input type="text" pattern="[0-9]+(\.[0-9]+)?" class="form-control col-md-3 @error('thickness') is-invalid @enderror" id="thickness" name="thickness" placeholder="Thickness (ex: 1.0)" required readonly value="{{ old('thickness', $data_report->thickness) }}">
              <div class="input-group-append">
                <span class="input-group-text">mm</span>
              </div>
                
              @error('thickness')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group">
            {{-- <label for="monthTest">Month Testing</label> --}}
            <input type="date" class="form-control col-md-3 @error('month_test') @enderror" id="month_test" name="month_test" placeholder="Month Testing" required disabled readonly hidden value="{{ old('month_test', $data_report->month_test) }}">
            @error('month_test')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="dateTest">Date Testing</label>
            <input type="date" class="form-control col-md-3 @error('date_test') @enderror" id="date_test" name="date_test" placeholder="Date Testing" required value="{{ old('date_test', $data_report->date_test) }}">  
            @error('date_test')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label>File upload</label>
            <input type="file" id="file_report" name="file_report" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info col-md-4 @error('file_report') @enderror" disabled placeholder="Upload File Report" value="{{ old('file_report', $data_report->file_report) }}">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
            @error('file_report')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="row justify-content-end">
            <button type="submit" class="btn btn-primary mr-2" onclick="updateData()">Submit</button>
            <button class="btn btn-light" onclick="window.history.back();">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#id_material').on('change', function() {
        var cek = $(this).val();
        // console.log(cek);
        if (cek) {
          $.ajax({
            url: '/new-report/' + cek,
            type: 'GET',
            data: {
              '_token': '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
              $('#material_name').val(data[0].material_name);
              $('#thickness').val(data[0].thickness);
              $('#month_test').val(data[0].month_test);
            }
          });
        } else {
          $('#material_name').empty();
          $('#thickness').empty();
          $('#month_test').empty();
        }
      });
    });

    $(document).ready(function() {
      $('form').submit(function() {
          $('#month_test').prop('disabled', false);
      });
    });

    function updateData() {
      swal({
        icon: 'success',
        title: 'Success',
        text: 'Report has been updated!'
      });
    };
  </script>
@endsection