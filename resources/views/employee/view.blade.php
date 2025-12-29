@extends('layouts.app')
@section('title',$title)
@section('content')
<br>
<div class="app-title dive-border-bottom">
    <div>
        <h1><i class="fa fa-user"></i> {{$title}}</h1>
    </div>
    <div>           
        <a href="{{URL::to('employees')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile dive-border">
            <div class="tile-body">
                <div style="position:relative;top:10px">
                    <center>
                        <h4 style="font-family: Montserrat;font-size:14px;font-weight: bold"><?= $title ?></h4>
                    </center>
                </div>
                <table class="table table-bordered" style="">
                    <tr>
                        <td><span style=""><b>Created At</b> :</span></td>
                        <td><span style="">{{date('d-M-Y, g:i A', strtotime($employeeInfo->created_at))}}</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style=""><b>First name</b> :</span></td>
                        <td><span style="">{{$employeeInfo->first_name}}</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style=""><b>Last name</b> :</span></td>
                        <td><span style="">{{$employeeInfo->last_name}}</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style=""><b>Email Address</b> :</span></td>
                        <td><span style="">{{$employeeInfo->email}}</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style=""><b>Department</b> :</span></td>
                        <td><span style="">{{$employeeInfo->department->name}}</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span style=""><b>Skills</b> :</span></td>
                        <td>
                            <?php
                            $ul = '<ul>';
                            foreach ($employeeInfo->skills as $skill) {
                                $ul .= '<li>' . e($skill->name) . '</li>';
                            }
                            $ul .= '</ul>';
                            echo $ul;
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#employees").addClass('active');
    });
</script>
@endsection