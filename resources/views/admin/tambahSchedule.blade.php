@extends('layout.main')

@section('title', 'New Schedule')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Schedule
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="/schedule">Schedule Pengujian</a>
                >
                <a class="text-muted" href="#">New Schedule</a>
            </small>
        </h5>
    </div>
  </div>

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Form New Schedule</h1>
        <form action="/new-schedule" method="POST" enctype="multipart/form-data">
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
                <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" placeholder="Material Name (ex: JSH270C)" required readonly>
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
                <label for="supplier">Supplier Name</label>
                <select class="form-control" name="supplier" id="supplier" required>
                <option selected>Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="month_test">Month Testing</label>
                <input type="date" class="form-control col-md-3 @error('month_test') @enderror" id="month_test" name="month_test" placeholder="Month Testing" required>
                @error('month_test')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
          
            <div class="form-group">
                <label for="project">Material For New Project</label>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="project" id="option1" value="Reguler">
                    Reguler
                </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="project" id="option2" value="New Project" checked>
                    New Project
                </label>
                </div>
            </div>

            <div class="row justify-content-end">
                <button type="submit" class="btn btn-primary mr-2" onclick="tambahData()">Submit</button>
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
        if (cek) {
          $.ajax({
            url: '/new-schedule/' + cek,
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

    function tambahData() {
      var a = document.getElementById("id_material").value;
      var b = document.getElementById("material_name").value;
      var c = document.getElementById("thickness").value;
      var d = document.getElementById("supplier").value;
      var e = document.getElementById("month_test").value;

      // Periksa apakah data kosong
      if (
        a === '' || 
        b === '' || 
        c === '' ||
        d === '' || 
        e === ''
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
          text: 'New schedule has been added!'
        });
        return true;
      }
    };
  </script>
@endsection