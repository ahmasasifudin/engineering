<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Engineering MWT | @yield('title')</title>

    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('css/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/schedule.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <!-- End plugin css for this page -->

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    
    <!-- Styles select2 -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <style>
        #validate-table tbody td:nth-child(5) {
            width: 150px;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>

</head>
<body>
    
    <div class="container-scroller">
        @include('partial.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('partial.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('partial.footer')
            </div>
        </div>
    </div>

    <!-- base:js -->
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/file-upload.js') }}"></script>
    <script src="{{ asset('js/typeahead.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <!-- End custom js for this page-->
    {{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</body>
</html>