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
        <form action="/new-report" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="id_material">ID Material</label>
            <select class="form-control" name="id_material" id="id_material" required>
              <option selected>ID Material</option>
              @foreach ($materials as $material)
                <option value="{{ $material->id_material }}">{{ $material->material_name }} - {{ $material->thickness }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="material_name">Material Name</label>
            <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" placeholder="Material Name (ex: JSH270C)" value="{{ old('material_name') }}" required readonly>
            @error('material_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="thickness">Thickness</label>
            <div class="input-group">
              <input type="text" pattern="[0-9]+(\.[0-9]+)?" class="form-control col-md-3 @error('thickness') is-invalid @enderror" id="thickness" name="thickness" placeholder="Thickness (ex: 1.0)" required readonly>
              <div class="input-group-append">
                <span class="input-group-text">mm</span>
              </div>
                
              @error('material_name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>

          <div class="form-group">
            {{-- <label for="monthTest">Month Testing</label> --}}
            <input type="date" class="form-control col-md-3 @error('month_test') @enderror" id="month_test" name="month_test" placeholder="Month Testing" required disabled readonly hidden>
            @error('month_test')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="dateTest">Date Testing</label>
            <input type="date" class="form-control col-md-3 @error('date_test') @enderror" id="date_test" name="date_test" placeholder="Date Testing" required>  
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
              <input type="text" class="form-control file-upload-info col-md-4 @error('file_report') @enderror" disabled placeholder="Upload File Report" accept=".pdf">
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
              <button type="submit" class="btn btn-primary mr-2" onclick="tambahDataReport()">Submit</button>
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
        console.log(cek);
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

    function tambahDataReport() {
      var a = document.getElementById("id_material").value;
      var b = document.getElementById("material_name").value;
      var c = document.getElementById("thickness").value;
      var d = document.getElementById("supplier").value;
      var e = document.getElementById("month_test").value;
      var f = document.getElementById("date_test").value;
      var g = document.getElementById("file_report").value;

      // Periksa apakah data kosong
      if (
        a === '' || 
        b === '' || 
        c === '' || 
        d === '' || 
        e === '' || 
        f === '' || 
        g === ''
        ) {
        // Jika data masih kosong, tampilkan SweetAlert warning
        swal({
          icon: 'warning',
          title: 'Warning',
          text: 'Please fill the form with the correct before submit!'
        });
        return false; // Menghentikan proses submit
      } else {
        swal({
          icon: 'success',
          title: 'Success',
          text: 'New report has been added!'
        });
        return true;
      }
    };
  </script>
@endsection