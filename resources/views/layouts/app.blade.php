<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('/')}}image/favicon.ico" />
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <!-- Font-icon css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{asset('/')}}css/datatables.min.css">
        <link rel="stylesheet" href="{{ asset('/') }}css/sweetalert.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('/') }}css/toastr.css">
        <title>@yield('title') || {{ env('APP_NAME') }}</title>
        <style>
            @font-face {
                font-family: 'Calibri Light';
                src: url('<?=asset('fonts/Calibri.woff')?>');
                font-weight: normal;
                font-style: normal;
            }
            body {
                font-family: 'Calibri Light';
    
            }
            .app-menu__item.active, .app-menu__item:hover, .app-menu__item:focus {
                background: #445f81;
                border-left-color: #5D60EF;
                text-decoration: none;
                color: #fff;
            }
            .actives {
                background: #ff7916;
            }


            .dive-border-bottom {
                border-bottom: 2px solid #25456c;
            }
            .dropdown-bg{
                background: #25456c;
            }
            .dropdown-color{
                color:#fff;
            }
            .dropdown-color:hover{
                color:#fff;
            }
            .allDate {
                z-index: 1151 !important;
            }
            .hoverEfect:hover {
                background: #0197d6;
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
            .blink {
                animation: blinker 1.8s linear infinite;
                /*        color: #1c87c9;*/
                font-size: 15px;
                font-weight: bold;
                font-family: sans-serif;
            }

            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
            .modal-dialog.modal-90w {
                max-width:80% !important;
                /*use modal-fullscreen class*/
            }
            .bootstrap-tagsinput {
                width: 100%;
                min-height: calc(2.25rem + 2px);
                padding: .375rem .75rem;
                line-height: 1.5;
                border: 1px solid #ced4da;
                border-radius: .375rem;
                display: flex;
                flex-wrap: wrap;
                cursor: text;
            }

            .bootstrap-tagsinput .tag {
                margin-right: 5px;
                color: #fff;
                background-color: #0d6efd;
                padding: .2em .5em;
                border-radius: .25rem;
            }
        </style>
        <script src="{{ asset('/') }}js/jquery-3.7.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    </head>
    <body class="app sidebar-mini">
        <header class="app-header" style="background-color: #ffffffff;">
            <a class="app-header__logo" href="{{URL::to('/')}}" style="background: #F2F5F8 !important;">
                <img src="{{asset('/')}}image/logo.png" alt="RG" style="width: 100%; max-width:150px; height: auto; position: relative;">
            </a>

            <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <ul class="app-nav">
                <li class="dropdown">
                    <a class="app-nav__item" href="javascript:void(0)" style="text-decoration:none">
                        <span>{{auth()->user()->name}}</span><br>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu">
                        <img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
                    </a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item logout" style="cursor: pointer"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <br>
            <ul class="app-menu">
                @include('layouts.menu')
            </ul>
        </aside>
        <main class="app-content">
            @yield('content')
        </main>
        <div class="row">
            <form id="logoutForm" action="{{route('logout')}}" method="post">
                @csrf
            </form>
        </div>
        <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
        <script src="{{ asset('/') }}js/main.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}js/sweetalert.min.js"></script>
        <script src="{{ asset('/') }}js/toastr.min.js"></script>
        <script></script>
        <script>
        $(function () {
            $("form").submit(function () {
                $('#postloader').show();
            });
        });
        </script>
        <script type="text/javascript">
            $('.logout').click(function () {
                $("#logoutForm").submit();
            });
        </script>
        <script type="text/javascript">
            $('.getTable').DataTable();
        </script>
        <!-- Data table plugin-->
        <script type="text/javascript">
            $('.allDate').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                todayHighlight: true
            });
            $('.select2').select2();
        </script>
        <script>
            $(document).ready(function () {
                $('form').attr('autocomplete', 'off');
            });
        </script>
        @if (Session::has('message'))
        <script>
            var type = "{{ Session::get('type') }}";
            if (type === "success") {
                toastr.options.timeOut = 3000;
                toastr.success("{{ Session::get('message') }}");
            } else if (type === "warning") {
                toastr.options.timeOut = 3000;
                toastr.warning("{{ Session::get('message') }}");
            } else {
                toastr.options.timeOut = 3000;
                toastr.error("{{ Session::get('message') }}");
            }
        </script>
        @endif
    </body>
</html>