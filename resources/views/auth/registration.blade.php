<!DOCTYPE html>
<html lang="bn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration Form || {{env('APP_NAME')}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('/')}}image/favicon.ico" />
        <link rel="icon" href="{{ asset('/') }}image/cropped-bigbag-software-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" href="{{ asset('/') }}image/cropped-bigbag-software-favicon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ asset('/') }}image/cropped-bigbag-software-favicon-180x180.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link rel="stylesheet" href="{{ asset('/') }}css/toastr.css">
        <style>
            @font-face {
                font-family: 'Calibri Light';
                src: url('<?= asset('fonts/Calibri.woff') ?>') format('woff');
                font-weight: normal;
                font-style: normal;
            }

            body {
                font-family: 'Calibri Light';
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background: #f5f7fa;
                color: #333;
            }

            /* Full screen background container */
            .bg {
                background-image: url('{{ asset('image/right-side.webp') }}');
                background-size: cover;
                background-position: center;
                height: auto;
                width: 100%;
                z-index: -1;
            }

            /* Form Section */
            .contents {
                border-radius: 10px;
                box-shadow: 0 10px 20px rgba(150, 138, 138, 0.1);
                padding: 40px;
                width: 100%;
                max-width: 450px;
                text-align: left; /* Aligning content to the left */
                margin-top: 50px; /* Added some margin to give space from the top */
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

            /* Logo Styling */
            .logo {
                width: 200px;
                position: absolute;
                top: 30px;
                right: 30px;
                left: auto;
                z-index: 10;
            }

            /* Form Group */
            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-weight: 500;
                margin-bottom: 10px;
                text-align: left; /* Align labels to the left */
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
                background-color: #6c5ce7;
                color: white;
            }

            .btn-primary:hover {
                background-color: #5e54e1;
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

            /* Responsive Design */
            @media (max-width: 768px) {
                .contents {
                    padding: 20px;
                    width: 90%;
                }
            }

            /* Two-column layout */
            .row {
                display: flex;
                align-items: center;
                height: 100vh;
            }

            .login-form {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .bg-image {
                flex: 1;
                height: 100%;
                background-image: url('{{ asset('image/right-side.jpg') }}');
                background-size: cover;
                background-position: center;
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
                <!-- Left Column (Registration Form) -->
                <div class="login-form">
                    <div class="contents">
                        <div class="form-container">
                            <h3>Create Your Account</h3>
                            @if(session('success'))
                            <div id="hideMessage" class="alert alert-success mb-3">{{ session('success') }}</div>
                            @endif
                            <form action="{{ route('user.registration') }}" method="POST" autocomplete="off" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="full_name">Username <span style="color:red">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Your Name" value="{{ old('name') }}">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="company_email">Email Address <span style="color:red">*</span></label>
                                    <input
                                        type="email"
                                        placeholder="Enter Emaill Address"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        id="getEmailAddress"
                                        value="{{ old('email') }}"
                                        pattern="^[a-zA-Z0-9._%+-]+@renaissance\.com\.bd$"
                                        title="Only emails ending with @renaissance.com.bd are allowed"
                                        >
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" name="password">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div><br>
                                <div class="form-group">
                                    <label for="password">Confirm Password <span style="color:red">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Confirm Password" name="password_confirmation">
                                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div><br>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Register</button><br><br>
                                <button type="button" class="btn btn-primary" onclick="window.location.href ='{{URL::to('/')}}'"><i class="fa fa-sign-in"></i> LOGIN</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="{{ asset('/') }}js/toastr.min.js"></script>
        <script></script>
        <script>
        $(document).ready(function () {
            $(document).on('blur', '#getEmailAddress', function () {
                var email = $(this).val();
                if (email.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route("check.user.email")}}',
                        data: {email: email},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.exists) {
                                toastr.options.timeOut = 2000;
                                toastr.error('This Email Already Exists');
                                $("#getEmailAddress").val('');
                            }
                        },
                        error: function () {
                            alert('Something is wrong !');
                        }
                    });
                } else {
                    return false;
                }

            });
        });
        </script>
        <script>
            $(function () {
                $("form").submit(function () {
                    $('#postloader').show();
                });
            });
        </script>
    </body>
</html>
