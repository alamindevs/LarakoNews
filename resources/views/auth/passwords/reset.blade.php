<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{$logo->logo}}">
    <title>Reset Password</title>
    <link href="{{asset('content/admin')}}/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{asset('content/admin')}}/assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <span class="db"><img src="{{$logo->logo}}" alt="logo" /></span>
                        <h5 class="font-medium mb-3" style="margin-top: 30px;">Recover Password</h5>
                        <!-- <span>Enter your Email and instructions will be sent to you!</span> -->
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12" method="POST" action="{{ route('password.update') }}">
                          @csrf

                          <input type="hidden" name="token" value="{{ $token }}">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"  placeholder="Email"  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password"  placeholder="Password"  name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="password"  placeholder="Confirm Password"  name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('content/admin')}}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{asset('content/admin')}}/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{asset('content/admin')}}/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
</body>
</html>
