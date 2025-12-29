@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="tile dive-border">
            <div class="row">
                <!-- Total Registrations -->
                <div class="col-md-4 col-sm-6">
                    <div class="widget-small" style="background-color: #e075b5f7; color: white; padding: 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
                        <i class="icon fa fa-book fa-3x"></i>
                        <div class="info">
                            <a href="{{URL::to('user_management')}}" style="color:#fff;text-decoration:none">
                                <h4 style="font-size:16px;font-weight:bold;text-transform:capitalize;">Total Registrations</h4>
                                <p style="font-size:24px;margin-top:10px;"><b>{{$totalReg}}</b></p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pending Registrations -->
                <div class="col-md-4 col-sm-6">
                    <div class="widget-small" style="background-color: #6BA4F4; color: white; padding: 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
                        <i class="icon fa fa-clock fa-3x"></i>
                        <div class="info">
                            <a href="{{URL::to('user_management')}}" style="color:#fff;text-decoration:none">
                                <h4 style="font-size:16px;font-weight:bold;text-transform:capitalize;">Pending</h4>
                                <p style="font-size:24px;margin-top:10px;"><b>{{$totalPending}}</b></p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- New Registrations -->
                <div class="col-md-4 col-sm-6">
                    <div class="widget-small" style="background-color: #45A19E; color: white; padding: 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);">
                        <i class="icon fa fa-user-plus fa-3x"></i>
                        <div class="info">
                            <a href="{{URL::to('user_management')}}" style="color:#fff;text-decoration:none">
                                <h4 style="font-size:16px;font-weight:bold;text-transform:capitalize;">New</h4>
                                <p style="font-size:24px;margin-top:10px;"><b>{{$totalNew}}</b></p>
                            </a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#dashboard').addClass('active');
    });
</script>
@endsection
