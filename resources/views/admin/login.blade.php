<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ligtasss</title>
    <!--===============================================================================================-->
    <link rel="icon" href="{{ url('storage/images/login-logo.png') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('storage/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('storage/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<style>
    .container-login100 {
        background-image: url('{{ url('storage/images/login-bg.jpg') }}');
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .wrap-login100 {
        background-color: rgba(255, 255, 255, 0.7);
        /* Adjust the last value (alpha) to set transparency */
    }
</style>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ url('storage/images/login-logo.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="/admin/login" method="POST">
                    @csrf
                    <span class="login100-form-title">
                        ADMINISTRATOR
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid id is required: ex@abc.xyz">
                        <input class="input100" type="text" name="user_id" placeholder="ID">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        {{-- <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a> --}}
                    </div>

                    <div class="text-center p-t-136">
                        {{-- <a class="txt2" href="#">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ url('storage/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('storage/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('storage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('storage/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('storage/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('storage/js/main.js') }}"></script>

</body>

</html>
