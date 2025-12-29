@extends('layouts.app')
@section('title',$title)
@section('content')
<br>
<div class="app-title dive-border-bottom">
    <div>
        <h1><i class="fa fa-users"></i> {{$title}}</h1>
    </div>
    <div>           
        <a href="{{URL::to('create_employee')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Employee</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile dive-border">
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label>Department Wise Search</label>
                        <select style="width:100%" class="form-control select2" id="getDepartment">
                            <option selected disabled>-- Select Department --</option>
                            @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table width="100%" id="dataTable" class="table table-striped table-bordered align-middle text-nowrap">
                                <thead>
                                    <tr class="tableheader">
                                        <th style="text-align:left">S/N</th>
                                        <th style="text-align:left">First Name</th>
                                        <th style="text-align:left">Last Name</th>
                                        <th style="text-align:left">Email</th>
                                        <th style="text-align:left">Department</th>
                                        <th style="text-align:left">Skills</th>
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
<script type="text/javascript">
    $(function () {
        let table = $('#dataTable').DataTable({
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
            ajax: {
                url: "{{ URL::to('show_employees') }}",
                data: function (d) {
                    d.department_id = $('#getDepartment').val();
                }
            },
            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", orderable: false},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'department', name: 'department'},
                {data: 'skills', name: 'skills'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#getDepartment').on('change', function () {
            table.ajax.reload();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.change_employee_status', function () {
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
                        url: '{{route("manage.employee.status")}}',
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
    });
</script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.view_employee', function () {
            var id = $(this).attr('id');
            window.location.href = "{{URl::to('view_employee_info')}}" + "/" + id;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.edit_employee', function () {
            var id = $(this).attr('id');
            window.location.href = "{{URl::to('edit_employee_info')}}" + "/" + id;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete_employee', function () {
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
                        url: '{{route("employee.delete")}}',
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
        $("#employees").addClass('active');
    });
</script>
@endsection