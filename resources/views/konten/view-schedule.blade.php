<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Engineering MWT | Detail Calendar Schedule</title>

    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('css/typicons/typicons.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}"> --}}
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    
    <div class="container-scroller">
      @include('partial.navbar')

      <div class="container-fluid page-body-wrapper">
        @include('partial.sidebar')

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row justify-content-between">
              <div class="col-xl-8 grid-margin stretch-card flex-column">
                <h5 class="text-titlecase">Schedule
                  <small class="text-muted mx-2">
                    <a class="text-muted" href="/">Home</a>
                      >
                    <a class="text-muted" href="/schedule">Schedule Pengujian</a>
                      >
                    <a class="text-muted" href="#">Detail Calendar Schedule</a>
                  </small>
                </h5>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 ml-2 my-2">
                <div class="d-flex align-items-center">
                  <a href="/schedule" class="btn btn-info btn-sm btn-icon-text">
                    <i class="typcn typcn-arrow-back btn-icon-append"></i>                          
                    back to Schedule Pengujian
                  </a>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div id="calendar" class="mx-3 my-3"></div>
                </div>
              </div>
            </div>
          </div>
              
          @include('partial.footer')
        </div>
      </div>
    </div>

    <!-- base:js -->
    {{-- <script src="{{ asset('js/vendor.bundle.base.js') }}"></script> --}}
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
    <script>
      $(document).ready(function () {
        var jadwal = @json($schedule);
        console.log(jadwal);
        $('#calendar').fullCalendar({
          header: {
              left: 'none',
              center: 'title'
          },
          events: jadwal,
          selectable: true,
          selectHelper: true,
          // select: function()
        })
      });
    </script>
</body>
</html>