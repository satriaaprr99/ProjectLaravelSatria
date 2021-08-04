<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin Patriots</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row ml-5">
                    <div class="col-lg-5">
                        <div class="p-5">
                            <div class="">
                                <h1 class="h2 text-gray-900 mt-5 mb-4">Selamat Datang!</h1>
                            </div>
                            <h6 class="text-gray-900 small mt-5 mb-4 ml-1">Belum Punya Akun?
                                <a class="text-warning" href="register">Register</a> 
                            </h6>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <h6 class="text-gray-900 ml-1">Email</h6>
                                    <input type="text" name="email" class="form-control form-control-user @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h6 class="text-gray-900 ml-1">Password</h6>
                                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword">
                                    @error('password')
                                    <span class="help-error text-danger small"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-sm col-lg-4" tabindex="4">
                                        Masuk
                                    </button>
                                    <a href="#" class="col-lg-8 small text-danger">
                                        Lupa Password?
                                    </a>
                                </div>
                                <!-- <a href="/dashboard" class="btn btn-warning btn-sm col-lg-4">
                                    Masuk
                                </a> -->
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none p-5 mt-5 d-lg-block">
                        <img width="500" src="../assets/img/ilustrasi_login.svg" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    
    <script>
        @if(Session::has('sukses'))
        swal({
            type: 'success',
            title: 'Success!',
            text: '{{ Session::get('sukses') }}'
        });
        @endif
        @if(Session::has('errorr'))
        swal({
            type: 'error',
            title: 'Oops...',
            text: '{{ Session::get('errorr') }}'
        });
        @endif
    </script>
</body>

</html>