@extends('layout.main')

@section('title', 'Edit Schedule')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Schedule
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="/schedule">Schedule Pengujian</a>
                >
                <a class="text-muted" href="#">Edit Schedule</a>
            </small>
        </h5>
    </div>
  </div>

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Form Edit Schedule</h1>
        <form action="/schedule/edit/{{ $data_schedule->id }}/simpan" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="id_material">ID Material</label>
            <input type="text" class="form-control @error('id_material') is-invalid @enderror" id="id_material" name="id_material" placeholder="ID Material" readonly required value="{{ old('id_material', $data_schedule->id_material) }}" >
            @error('id_material')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="material_name">Material Name</label>
            <input type="text" class="form-control @error('material_name') is-invalid @enderror" id="material_name" name="material_name" placeholder="Material Name (ex: SPCC)" autofocus required readonly value="{{ old('material_name', $data_schedule->material_name) }}">
            @error('material_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="thickness">Thickness</label>
            <div class="input-group">
              <input type="text" pattern="[0-9]+(\.[0-9]+)?" class="form-control col-md-3 @error('thickness') is-invalid @enderror" id="thickness" name="thickness" placeholder="Thickness (ex: 1.0)" required readonly value="{{ old('thickness', $data_schedule->thickness) }}">
              <div class="input-group-append">
                <span class="input-group-text">mm</span>
              </div>
            </div>
            @error('thickness')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-group">
              <label for="supplierName">Supplier Name</label>
              {{-- <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" placeholder="Supplier Name" required value="{{ old('supplier', $data_schedule->supplier) }}"> --}}
              <select class="form-control" name="supplier" id="supplier" required>
                <option selected>Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                @endforeach
            </select>
              @error('supplier')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
          </div>
          <div class="form-group">
            <label for="monthTest">Month Testing</label>
            <input type="date" class="form-control col-md-3 @error('month_test') @enderror" id="month_test" name="month_test" placeholder="Month Testing" value="{{ old('month_test', $data_schedule->month_test) }}">  
          </div>
          <div class="form-group">
            <label>Material For New Project</label>
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
            <button type="submit" class="btn btn-primary mr-2" onclick="updateData()">Submit</button>
            <button class="btn btn-light" onclick="window.history.back();">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function updateData() {
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
          text: 'New schedule has been updated!'
        });
        return true;
      }
    };
  </script>
@endsection