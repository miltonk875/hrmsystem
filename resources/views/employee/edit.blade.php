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
                <form method="POST" id="postEmplyeeForm" name="getformdata">
                    @csrf
                    <div class="row">
                        <label class="form-label col-md-3">First Name <span style="color:red">*</span></label>
                        <div class="col-md-6">
                            <input type="hidden" name="employee_id" value="{{$employeeInfo->id}}">
                            <input type="text" class="form-control" name="first_name" placeholder="Enter First name" value="{{ old('first_name',$employeeInfo->first_name) }}">
                            <div class="text-danger" id="first_name_error"></div>
                        </div>
                    </div><br>
                    <div class="row">
                        <label class="form-label col-md-3">Last Name <span style="color:red">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last name" value="{{ old('last_name',$employeeInfo->last_name) }}">
                            <div class="text-danger" id="last_name_error"></div>
                        </div>
                    </div><br>
                    <div class="row">
                        <label class="form-label col-md-3">Email Address <span style="color:red">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" placeholder="Enter Email Address" value="{{ old('email',$employeeInfo->email) }}">
                            <div class="text-danger" id="email_error"></div>
                        </div>
                    </div><br>
                    <div class="row">
                        <label class="form-label col-md-3">Department <span style="color:red">*</span></label>
                        <div class="col-md-6">
                            <select style="width:100%" class="form-control select2" name="department">
                                <option selected disabled>-- Select Department --</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="department_error"></div>
                        </div>
                    </div><br>
                    <div class="row">
                        <label class="form-label col-md-3">Skills</label>
                        <div class="col-md-6">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="tableheader">
                                        <th style="text-align:left">Name</th>
                                        <th style="text-align:left">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    @foreach ($employeeInfo->skills as $skillv)
                                    <tr>                                   
                                        <td>
                                            <select style="width:100%" class="form-control select2" name="skills[]">
                                                <option selected disabled>-- Select Skill --</option>
                                                @foreach($skills as $skill)
                                                <option value="{{$skill->id}}" {{ $skillv->id == $skill->id ? 'selected' : '' }}>{{$skill->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>                                    
                                        <td><button class="btn btn-danger remCF" type="button" style="border-radius:10px"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-danger" id="skills_error"></div>
                        </div>
                    </div><br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" type="button" id="addMore" style="margin-right:30px"><i class="fa fa-plus"></i> Add More Skill</button>
                        <button id="submitEmplyeeForm" type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-check"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.forms['getformdata'].elements['department'].value = '<?= $employeeInfo->department_id ?>';
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#addMore").click(function () {
            var tr = '<tr>' +
                    '<td>' +
                    '<select style="width:100%" class="form-control select2" name="skills[]">' +
                    '<option selected disabled>-- Select Skill --</option>' +
<?php foreach ($skills as $skill) { ?>
                '<option value="<?= $skill->id ?>"><?= $skill->name ?></option>' +
<?php } ?>
            '</select>' +
                    '</td>' +
                    '<td><button class="btn btn-danger remCF" type="button" style="border-radius:10px"><i class="fa fa-times"></i></button></td> ' +
                    '</tr>';
            $("#items").append(tr);
            $('.select2').select2();
        });
        $("#items").on('click', '.remCF', function () {
            $(this).parent().parent().remove();
        });
    });
</script>
<script type="text/javascript">
    $("#submitEmplyeeForm").click(function (e) {
        e.preventDefault();
        var data = $('#postEmplyeeForm').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('employee.update') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#submitEmplyeeForm').html('<i class="fa fa-save"></i> Saving.....');
            },
            success: function (data) {
                $("#postEmplyeeForm")[0].reset();
                $("#first_name_error").html('');
                $("#last_name_error").html('');
                $("#email_error").html('');
                $("#department_error").html('');
                $("#skills_error").html('');

                var message = data.message;
                var type = data.type;
                if (type === "success") {
                    toastr.options.timeOut = 3000;
                    toastr.success(message);
                } else if (type === "warning") {
                    toastr.options.timeOut = 3000;
                    toastr.warning(message);
                } else {
                    toastr.options.timeOut = 3000;
                    toastr.error(message);
                }

                setTimeout(function () {
                    location.reload();
                }, 4000);
            },
            complete: function (response) {
                $('#submitEmplyeeForm').html('<i class="fa fa-save"></i> Save');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#first_name_error").html(errors.first_name);
                    $("#last_name_error").html(errors.last_name);
                    $("#email_error").html(errors.email);
                    $("#department_error").html(errors.department);
                    $("#skills_error").html(errors.skills);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#employees").addClass('active');
    });
</script>
@endsection