@extends('layout.main')

@section('title', 'Edit Supplier')

@section('content')
  <div class="row justify-content-between">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="text-titlecase">Data Master
            <small class="text-muted mx-2">
                <a class="text-muted" href="/">Home</a>
                >
                <a class="text-muted" href="/supplier">Data Supplier</a>
                >
                <a class="text-muted" href="#">Edit Supplier</a>
            </small>
        </h5>
    </div>
  </div>

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Form Edit Supplier</h1>
        <form action="/supplier/edit/{{ $data_supplier->id }}/simpan" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="supplier">Supplier Name</label>
            <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" placeholder="Supplier Name" required value="{{ old('supplier', $data_supplier->supplier) }}">
            @error('supplier')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="tgl_registrasi">Registration Date</label>
            <input type="date" class="form-control col-md-3 @error('tgl_registrasi') @enderror" id="tgl_registrasi" name="tgl_registrasi" placeholder="Registration Date" value="{{ old('tgl_registrasi', $data_supplier->tgl_registrasi) }}">  
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
      var b = document.getElementById("supplier").value;
      var c = document.getElementById("tgl_registrasi").value;

      // Periksa apakah data kosong
      if (
        b === '' || 
        c === '' 
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
          text: 'New supplier has been updated!'
        });
        return true;
      }
    };
  </script>
@endsection