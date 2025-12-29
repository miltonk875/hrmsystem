@extends('layouts.app')
@section('title',$title)
@section('content')
<br>
<div class="app-title dive-border-bottom">
    <div>
        <h1><i class="fa fa-user-secret"></i> {{$title}}</h1>
    </div>
    <div>           
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add User</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile dive-border">
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table width="100%" id="dataTable" class="table table-striped table-bordered align-middle text-nowrap">
                                <thead>
                                    <tr class="tableheader">
                                        <th style="text-align:left">S/N</th>
                                        <th style="text-align:left">Username</th>
                                        <th style="text-align:left">Email</th>
                                        <th style="text-align:left">Password</th>
                                        <th style="text-align:left">Status</th>
                                        <th style="text-align:left">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content tableborder">
            <div class="modal-header">
                <h3 class="text-center modal-title">Add New User</h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="saveUserAccess">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Username <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control inputnumber" placeholder="Enter Username">
                                <div class="text-danger" id="username_required_2"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Email Address (System Login) <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control inputnumber" placeholder="Enter Email Address">
                                <div class="text-danger" id="email_required_2"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label>New Password <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control inputnumber" placeholder="Enter New Password">
                                <div class="text-danger" id="password_required_2"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="password" name="password_confirmation"
                                       class="form-control inputnumber" placeholder="Enter Confirm Password">
                                <div class="text-danger" id="conpassword_required_2"></div>
                            </div>
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" id="submitAccessForm" class="btn btn-success"
                                style="border-radius: 10px;"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content tableborder">
            <div class="modal-header">
                <h3 class="text-center modal-title">Update User Access</h3>
            </div>
            <div class="modal-body">
                <div class="bs-component">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#userInfo">Info</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#userPassword">Password</a></li>
                    </ul><br>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="userInfo">
                            <form method="POST" id="updateUserInfoForm">
                                @csrf
                                <input type="hidden" name="user_id" id="setUserId">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>User Name <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control inputnumber" id="setUserName" placeholder="Enter User Name">
                                            <div class="text-danger" id="username_required"></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email Address (System Login) <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control inputnumber" id="setUserEmail" placeholder="Enter Email Address">
                                            <div class="text-danger" id="email_required"></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                            style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" id="submitUpdateInfoForm" class="btn btn-success"
                                            style="border-radius: 10px;"><i class="fa fa-check"></i> Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="userPassword">
                            <form method="POST" id="updateUserPassword">
                                @csrf
                                <input type="hidden" name="user_id" id="set_user_dataid">
                                <input type="hidden" name="password_change" id="set_password_change" value="yes">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>New Password <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control inputnumber change_password" placeholder="Enter New Password">
                                            <div class="text-danger" id="password_required"></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation"
                                                   class="form-control inputnumber cornchange_password" placeholder="Enter Confirm Password">
                                            <div class="text-danger" id="conpassword_required"></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div style="text-align: center">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                            style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" id="submitPasswordForm" class="btn btn-success"
                                            style="border-radius: 10px;"><i class="fa fa-check"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#dataTable').DataTable({
            order: [],
            lengthMenu: [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
            processing: true,
            responsive: {
                details: true
            },
            serverSide: true,
            searching: true,
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            ajax: "{{ URL::to('get_users_list') }}",
            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'password', name: 'password'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
<script type="text/javascript">
    $("#submitAccessForm").click(function (e) {
        e.preventDefault();
        var data = $('#saveUserAccess').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('store.user.info') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#submitAccessForm').html('<i class="fa fa-save"></i> Saving.....');
            },
            success: function (data) {
                $(".modal-body form")[0].reset();
                $("#username_required_2").html('');
                $("#email_required_2").html('');
                $("#password_required_2").html('');
                $("#conpassword_required_2").html('');
                $("#addModal").modal('hide');
                var message = data.message;
                var type = data.type;
                if (type === "success") {
                    toastr.options.timeOut = 4000;
                    toastr.success(message);
                } else if (type === "warning") {
                    toastr.options.timeOut = 4000;
                    toastr.warning(message);
                } else {
                    toastr.options.timeOut = 4000;
                    toastr.error(message);
                }
                var oTable = $('#dataTable').DataTable();
                oTable.draw(false);
            },
            complete: function (response) {
                $('#submitAccessForm').html('<i class="fa fa-save"></i> Save');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#username_required_2").html(errors.username);
                    $("#email_required_2").html(errors.email);
                    $("#password_required_2").html(errors.password);
                    $("#conpassword_required_2").html(errors.password_confirmation);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.change_user_status', function () {
            var id = $(this).attr('id');
            var value = $(this).val();
            swal({
                title: "Are you sure ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        url: '{{route("change.user.status")}}',
                        data: {id: id, value: value},
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            var message = data.message;
                            var type = data.type;
                            if (type === "success") {
                                toastr.options.timeOut = 4000;
                                toastr.success(message);
                            } else {
                                toastr.options.timeOut = 4000;
                                toastr.error(message);
                            }
                            var oTable = $('#dataTable').DataTable();
                            oTable.draw(false);
                        },
                        error: function () {
                            alert('Something is wrong !');
                        }
                    });
                } else {
                    swal("Cancelled");
                }
            });
        });
    });</script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.edit_user_data', function () {
            var id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '{{URL::to("get_user_info")}}',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function (data) {
                    $("#setUserId").val(id);
                    $("#setUserName").val(data.name);
                    $("#setUserEmail").val(data.email);
                    $("#updateModal").modal('show');
                },
                error: function () {
                    alert('Something is wrong !');
                }
            });
        });
    });</script>
<script type="text/javascript">
    $("#submitUpdateInfoForm").click(function (e) {
        e.preventDefault();
        var data = $('#updateUserInfoForm').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('update.user.info') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#submitUpdateInfoForm').html('<i class="fa fa-check"></i> Updating.....');
            },
            success: function (data) {
                $("#username_required").html('');
                $("#email_required").html('');
                $("#updateModal").modal('hide');
                var message = data.message;
                var type = data.type;
                if (type === "success") {
                    toastr.options.timeOut = 4000;
                    toastr.success(message);
                } else if (type === "warning") {
                    toastr.options.timeOut = 4000;
                    toastr.warning(message);
                } else {
                    toastr.options.timeOut = 4000;
                    toastr.error(message);
                }
                var oTable = $('#dataTable').DataTable();
                oTable.draw(false);
            },
            complete: function (response) {
                $('#submitUpdateInfoForm').html('<i class="fa fa-check"></i> Update');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#username_required").html(errors.username);
                    $("#email_required").html(errors.email);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });</script>
<script type="text/javascript">
    $("#submitPasswordForm").click(function (e) {
        e.preventDefault();
        var data = $('#updateUserPassword').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('update.user.password') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#submitPasswordForm').html('<i class="fa fa-check"></i> Updating.....');
            },
            success: function (data) {
                $("#password_required").html('');
                $("#conpassword_required").html('');
                $("#updateModal").modal('hide');
                var message = data.message;
                var type = data.type;
                if (type === "success") {
                    toastr.options.timeOut = 4000;
                    toastr.success(message);
                } else if (type === "warning") {
                    toastr.options.timeOut = 4000;
                    toastr.warning(message);
                } else {
                    toastr.options.timeOut = 4000;
                    toastr.error(message);
                }
                var oTable = $('#dataTable').DataTable();
                oTable.draw(false);
            },
            complete: function (response) {
                $('#submitPasswordForm').html('<i class="fa fa-check"></i> Update');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#password_required").html(errors.password);
                    $("#conpassword_required").html(errors.password_confirmation);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_user', function () {
            var id = $(this).attr('id');
            swal({
                title: "Are you sure ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        url: '{{route("delete.user.access")}}',
                        data: {id: id},
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            var message = data.message;
                            var type = data.type;
                            if (type === "success") {
                                toastr.options.timeOut = 4000;
                                toastr.success(message);
                            } else {
                                toastr.options.timeOut = 4000;
                                toastr.error(message);
                            }
                            var oTable = $('#dataTable').DataTable();
                            oTable.draw(false);
                        },
                        error: function () {
                            alert('Something is wrong !');
                        }
                    });
                } else {
                    swal("Cancelled");
                }
            });
        });
    });</script>
<script>
    $(document).ready(function () {
        $("#user_management").addClass('active');
    });
</script>
@endsection