@extends('layouts.app')
@section('title',$title)
@section('content')
<br>
<div class="app-title dive-border-bottom">
    <div>
        <h1><i class="fa fa-cubes"></i> {{$title}}</h1>
    </div>
    <div>           
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Department</a>
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
                                        <th style="text-align:left">Department</th>
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
                <h3 class="text-center modal-title">Add New Department</h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="saveDepartmentPost">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Department <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="department" class="form-control inputnumber" placeholder="Enter Department Name">
                                <div class="text-danger" id="required_department"></div>
                            </div>
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" id="submitPostForm" class="btn btn-success"
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
                <h3 class="text-center modal-title">Update Department</h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateDepartmentPost">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Department <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="hidden" name="department_id" id="setDepartmentId">
                                <input type="text" name="department" class="form-control inputnumber" id="setsetDepartmentName" placeholder="Enter Department Name">
                                <div class="text-danger" id="required_department2"></div>
                            </div>
                        </div>
                    </div><br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                style="border-radius: 10px;"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" id="updatePostForm" class="btn btn-success"
                                style="border-radius: 10px;"><i class="fa fa-check"></i> Update</button>
                    </div>
                </form>
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
            ajax: "{{ URL::to('get_department_list') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
<script type="text/javascript">
    $("#submitPostForm").click(function (e) {
        e.preventDefault();
        var data = $('#saveDepartmentPost').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('department.store') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#submitPostForm').html('<i class="fa fa-save"></i> Saving.....');
            },
            success: function (data) {
                $(".modal-body form")[0].reset();
                $("#required_department").html('');
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
                $('#submitPostForm').html('<i class="fa fa-save"></i> Save');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#required_department").html(errors.department);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.edit_department', function () {
            var id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '{{URL::to("get_department_info")}}',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function (data) {
                    $("#setDepartmentId").val(id);
                    $("#setsetDepartmentName").val(data.name);
                    $("#updateModal").modal('show');
                },
                error: function () {
                    alert('Something is wrong !');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $("#updatePostForm").click(function (e) {
        e.preventDefault();
        var data = $('#updateDepartmentPost').serialize();
        $.ajax({
            type: 'post',
            url: "{{ route('department.update') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#updatePostForm').html('<i class="fa fa-check"></i> Updating.....');
            },
            success: function (data) {
                $("#required_department2").html('');
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
                $('#updatePostForm').html('<i class="fa fa-check"></i> Update');
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $("#required_department2").html(errors.department);
                } else {
                    alert('Something Went Wrong!');
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_department', function () {
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
                        url: '{{route("department.delete")}}',
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
    });
</script>
<script>
    $(document).ready(function () {
        $("#departments").addClass('active');
    });
</script>
@endsection