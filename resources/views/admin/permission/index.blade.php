@extends('admin.master')

@section('title', 'All Permission || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Roles</h1>
        <div class="">
            <a href="javascirpt:void(0)" id="create-new-permission" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Permission
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
{{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="permission-datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
{{--                            <th>Permissions</th>--}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
{{--                            <th>Permissions</th>--}}
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!--  Add New Role Modal Start -->
    <div class="modal fade" id="permission-create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Create a permission</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="create-permission-form" name="addNewRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control"   id="roleName" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="save-permission-btn" class="btn btn-primary">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Add New Role Modal Start -->

    <!--  Edit Role Modal Start -->
    <div class="modal fade" id="edit-permission-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modelHeading">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-permission-form" name="edit-permission-form" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="permission-id" class="form-control" value="">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-permission-name" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control" value=""  id="edit-permission-name" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="update-permission-btn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Edit Role Modal Start -->

    <!-- Permission Datatable data -->
    <script>
        $(document).ready(function() {
            $('#permission-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.permission.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Permission Datatable data  -->


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Add New Role Start -->
            $('#create-new-permission').on('click',function () {
                $('#id').val('');
                $('#create-permission-form').trigger("reset");
                $('#save-permission-btn').html("Add Permission");
                $('#permission-create-modal').modal('show');
            });

            $('#create-permission-form').on('submit', function (e) {
                e.preventDefault();
                $('#save-permission-btn').html('Sending..');

                $.ajax({
                    data: $('#create-permission-form').serialize(),
                    url: "{{ route('admin.permission.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#create-permission-form').trigger("reset");
                        $('#permission-create-modal').modal('hide');
                        $('#permission-datatable').DataTable().ajax.reload();
                        $('#save-permission-btn').html('Add Permission');

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: data.success,
                        });

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#savedata').html('Save Changes');
                    }
                });
            });
            <!-- Add New Role End -->

            <!-- Edit Role Info -->
            $('body').on('click', '.editPermission', function () {
                var id = $(this).attr('data-id');
                $.get("{{ route('admin.permission.index') }}" + '/' + id + '/edit', function (data) {
                    $('#edit-modelHeading').html("Edit Permission Info");
                    $('#savedata').val("edit-role");
                    $('#edit-permission-modal').modal('show');
                    $('#permission-id').val(data.permission.id);
                    $('#edit-permission-name').val(data.permission.name);
                })
            });

            $('#edit-permission-form').on('submit', function (e) {
                e.preventDefault();
                var id = $('#permission-id').val();
                var formData = $(this).serialize();
                $('#update-permission-btn').html('Updating...')
                // console.log(id)

                $.ajax({
                    url: "{{ route('admin.permission.index') }}" + '/' + id,
                    type: "PUT",
                    data: formData,
                    success: function (data) {
                        $('#edit-role-form').trigger('reset');
                        $('#edit-permission-modal').modal('hide');
                        $('#permission-datatable').DataTable().ajax.reload();
                        $('#update-permission-btn').html('Update Info');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: data.success,
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });


            <!-- Delete Permission Ajax -->
            $('body').on('click', '.deletePermission', function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.permission.index') }}" + '/' + id,
                            type: "DELETE",
                            success: function (data) {
                                // Ask for confirm delete
                                $('#permission-datatable').DataTable().ajax.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
            <!-- Delete Permission Ajax -->

        });
    </script>
@endsection
