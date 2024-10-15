<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Engineering MWT | Login</title>

    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('css/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

</head>
<body>
    
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo" style="text-align: center">
                                <img src="images/logo.png" alt="logo" style="width: 25%">
                                <h4 class="mt-2" style="text-align: center">Engineering MWT</h4>
                            </div>

                            <h6 class="font-weight-light" style="text-align: center">Please Sign In.</h6>

                            <form class="pt-3" action="/login" method="post">
                            @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in
                                        </label>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- base:js -->
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
</body>
</html>
    