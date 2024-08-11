@extends('admin.master')

@section('title', 'All Roles || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Roles</h1>
        <div class="">
            <a href="javascirpt:void(0)" id="create-new-role" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Role
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
                <table class="table table-bordered" id="role-datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
{{--                            <th>Permissions</th>--}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
{{--                            <th>Permissions</th>--}}
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!--  Add New Role Modal Start -->
    <div class="modal fade" id="role-create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Create a role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="add-role-form" name="addNewRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control"   id="roleName" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="saveRoleData" class="btn btn-primary">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Add New Role Modal Start -->

    <!--  Edit Role Modal Start -->
    <div class="modal fade" id="roleEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modelHeading">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-role-form" name="updateRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="role-id" class="form-control" value="">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" value=""  id="edit-role-name" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="updateRoleData" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Edit Role Modal Start -->

    <!-- Role Datatable data -->
    <script>
        $(document).ready(function() {
            $('#role-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.role.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Role Datatable data  -->


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Add New Role Start -->
            $('#create-new-role').on('click',function () {
                $('#savedata').val("create-project");
                $('#id').val('');
                $('#add-role-form').trigger("reset");
                $('#modelHeading').html("Add New Role");
                $('#role-create-modal').modal('show');
            });

            $('#add-role-form').on('submit', function (e) {
                e.preventDefault();
                $('#saveRoleData').html('Sending..');

                $.ajax({
                    data: $('#add-role-form').serialize(),
                    url: "{{ route('admin.role.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#add-role-form').trigger("reset");
                        $('#role-create-modal').modal('hide');
                        $('#role-datatable').DataTable().ajax.reload();
                        $('#saveRoleData').html('Add Role');

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
            $('body').on('click', '.editRole', function () {
                var id = $(this).attr('data-id');
                $.get("{{ route('admin.role.index') }}" + '/' + id + '/edit', function (data) {
                    $('#edit-modelHeading').html("Edit Role Info");
                    $('#savedata').val("edit-role");
                    $('#roleEditModal').modal('show');
                    $('#role-id').val(data.role.id);
                    $('#edit-role-name').val(data.role.name);
                })
            });

            $('#edit-role-form').on('submit', function (e) {
                e.preventDefault();
                var id = $('#role-id').val();
                var formData = $(this).serialize();
                $('#updateRoleData').html('Sending...')
                // console.log(id)

                $.ajax({
                    url: "{{ route('admin.role.index') }}" + '/' + id,
                    type: "PUT",
                    data: formData,
                    success: function (data) {
                        $('#edit-role-form').trigger('reset');
                        $('#roleEditModal').modal('hide');
                        $('#role-datatable').DataTable().ajax.reload();
                        $('#updateRoleData').html('Update Info');
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


            <!-- Delete Role Ajax -->
            $('body').on('click', '.deleteRole', function () {
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
                            url: "{{ route('admin.role.index') }}" + '/' + id,
                            type: "DELETE",
                            success: function (data) {
                                // Ask for confirm delete
                                $('#role-datatable').DataTable().ajax.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
            <!-- Delete Role Ajax -->

        });
    </script>
@endsection
