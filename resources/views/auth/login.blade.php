<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>SangalTec</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Iniciar sesión</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="inputEmail" >{{ __('Correo Electronico') }}</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                    <div class="form-floating mb-3">
                            
                        <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        <label for="inputPassword" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2 mb-0">   
                        
                        @if (Route::has('password.request'))
                            <a class="small btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste Tu Contraseña?') }}
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ __('Iniciar Sesion') }}
                        </button>
                    </div>
                </form>



            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE Ap -->
    <script src="/dist/js/adminlte.min.js"></script>
</body>

</html>



{{-- ---------------------- --}}


