<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amder Dokan</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminAssets/backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('AdminAssets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminAssets/backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="https://aabason.com/" target="_blank" class="h1"><b>Amder Dokan</b></a>
        </div>
        <div class="card-body ">
            <p class="login-box-msg ">Sign in to start your session</p>
            <form action="{{ route('checklogin')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope" style="color:#5179aa"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock" style="color:#662a82"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        {{--            <div class="icheck-primary">--}}
                        {{--              <input type="checkbox" id="remember">--}}
                        {{--              <label for="remember">--}}
                        {{--                Remember Me--}}
                        {{--              </label>--}}
                        {{--            </div>--}}
                    </div>
                    <!-- /.col -->
                    <div class="col-12 d-flex justify-content-center" >

{{--                        <p class="mb-1">--}}
{{--                            <a href="forgot-password.html"><ins><span class="pb-2">I forgot my password </span></ins></a>--}}
{{--                        </p>--}}
                        <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

        {{--      <p class="mb-1">--}}
        {{--        <a href="forgot-password.html">I forgot my password</a>--}}
        {{--      </p>--}}
        <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
