<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot your password</title>
     <link rel="icon" href="{{asset('/')}}image/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="{{ asset('/') }}css/toastr.css">
    <style>
        @font-face {
            font-family: 'Calibri Light';
            src: url('<?=asset('fonts/Calibri.woff')?>') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Calibri Light';
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #f5f7fa;
            color: #333;
        }
        .container-fluid, .row {
            min-height: 100vh;
        }
        .row {
            display: flex;
            align-items: center;
        }
        .login-form, .bg-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 0;
        }
        .contents {
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(150, 138, 138, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            background: #fff;
        }
        .form-container h3 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .form-container p {
            font-size: 16px;
            color: #777;
            margin-bottom: 20px;
        }
        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 30px auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            padding: 14px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 20px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 5px rgba(108, 92, 231, 0.5);
        }
        .btn {
            width: 100%;
            padding: 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s ease;
        }
        .btn-primary {
            background-color: #6180a5;
            color: white;
        }
        .btn-primary:hover {
            background-color: #a1b0c2;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #a1b0c2;
            color: white;
            margin-top: 10px;
        }
        .btn-secondary:hover {
            background-color: #8c97a5;
            transform: scale(1.05);
        }
        .bg-image {
            background-image: url('{{ asset('image/right-side.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
        @media (max-width: 991.98px) {
            .contents {
                padding: 25px;
                max-width: 100%;
            }
        }
        @media (max-width: 767.98px) {
            .row {
                flex-direction: column;
                min-height: unset;
            }
            .login-form, .bg-image {
                flex: unset;
                width: 100%;
                min-height: 0;
            }
            .bg-image {
                min-height: 200px;
                height: 200px;
            }
            .contents {
                margin: 30px 0;
                padding: 18px;
            }
        }
        @media (max-width: 575.98px) {
            .contents {
                padding: 10px;
            }
            .form-container h3 {
                font-size: 22px;
            }
            .logo {
                width: 90px;
                margin-bottom: 20px;
            }
        }
        
        #postloader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url("{{ asset('/') }}image/loader.gif") no-repeat center center;
            z-index: 99999;
        }
        
    </style>
</head>
<body>
    <div id="postloader"></div>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Column (Login Form) -->
            <div class="login-form">
                <div class="contents">
                    <div class="form-container">
                        <img src="{{ asset('image/logo.png') }}" alt="Company Logo" class="logo ai-logo" style="width: 250px; height: auto; margin-bottom: 30px; margin-top: 0; position: static; top: 0;">
                        <h5 class="mb-3">Forgot your password?</h5>
                          <p class="text-muted">Enter your email and we’ll send you a reset link.</p>
                        <form method="post" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email address" autofocus value="{{ old('email') }}">
                                    <div class=""><i class="icon-user"></i></div>
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Right Column (Background Image) -->
            <div class="bg-image"></div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('/') }}js/toastr.min.js"></script>
    <script></script>
    <script>
        $(function () {
            $("form").submit(function () {
                $('#postloader').show();
            });
        });
    </script>
    @if (Session::has('message'))
        <script>
            var type = "{{ Session::get('type') }}";
            if (type === "success") {
                toastr.options.timeOut = 4000;
                toastr.success("{{ Session::get('message') }}");
            } else if (type === "warning") {
                toastr.options.timeOut = 4000;
                toastr.warning("{{ Session::get('message') }}");
            } else {
                toastr.options.timeOut = 4000;
                toastr.error("{{ Session::get('message') }}");
            }
        </script>
    @endif
</body>
</html>
