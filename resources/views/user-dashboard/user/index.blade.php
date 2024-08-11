@extends('admin.master')

@section('title', 'All User || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Users</h1>
        <div class="">
{{--            <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create Project</a>--}}
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
{{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="user-datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- User Edit Modal-->
    <div class="modal fade" id="edit-user-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalHeading">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="user-edit-form" name="createProjectForm" action="{{ route('admin.user.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="user-edit-id" class="form-control"  id="user-edit-id">
                        <div class="mb-3">
                            <label for="edit-user-name" class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control"  id="edit-user-name">
                        </div>
                        <div class="mb-3">
                            <label for="user-email-edit" class="form-label" >User Email</label>
                            <input type="email" name="email" class="form-control" id="user-email-edit" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="user-status-edit" class="form-label">Choose a project</label>
                            <select name="status" id="user-status-edit" class="form-control">
                                <option value="" disabled selected> -- Select Status -- </option>
                                <option value="active"> Active </option>
                                <option value="inactive"> Inactive </option>
{{--                                @foreach($users as $item)--}}
{{--                                    <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user-status-edit" class="form-label">Choose a Role</label>
                            <select name="role" id="user-status-edit" class="form-control">
                                <option value="" disabled selected> -- Select Role -- </option>
                                <option value="project_manager"> project manager </option>
                                <option value="team_member"> team member </option>
                                <option value="user"> User </option>
{{--                                @foreach($users as $item)--}}
{{--                                    <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="save-user-edit-data" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- User Create Modal-->


    <!-- Data table data -->
    <script>
        $(document).ready(function() {
            $('#user-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.user.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Data table data -->


    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Edit User Ajax End -->
            $('body').on('click', '.editUser', function () {
                var id = $(this).attr('data-id');
                console.log(id)
                $.get("{{ route('admin.user.index') }}" + '/' + id + '/edit', function (data) {
                    $('#editTaskModalHeading').html("Edit Task Info");
                    // $('#savedata').val("edit-user");
                    // $('#id').val(data.id);
                    $('#user-edit-id').val(data.user.id);
                    $('#edit-user-name').val(data.user.name);
                    $('#user-email-edit').val(data.user.email);
                    // $('#edit-task-description').val(data.task.description);
                    $('#edit-user-model').modal('show');
                })
            });
            <!-- Edit User Ajax End -->

            <!-- Update User Info Ajax End -->
            $('#user-edit-form').on('submit', function (e) {
                e.preventDefault();
                var id = $('#user-edit-id').val();
                var formData = $(this).serialize();
                console.log(id)
                $('#save-user-edit-data').html('Updating...');

                $.ajax({
                    url: "{{ route('admin.user.index') }}" + '/' + id,
                    method: "PUT",
                    data: formData,
                    success: function (response) {
                        // console.log(response)
                        $('#user-edit-form').trigger("reset");
                        $('#edit-user-model').modal('hide');
                        $('#user-datatable').DataTable().ajax.reload();
                        $('#save-user-edit-data').html('Update');
                        $('#updateProjectData').html('Update');

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
                            title: response.success,
                        });

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#savedata').html('Save Changes');
                    }
                });
            });
            <!-- Update User Info Ajax End -->


            <!-- Delete User Ajax Start -->
            $('body').on('click', '.deleteUser', function () {
                var id = $(this).attr('data-id');
                console.log(id);
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
                            url: "{{ route('admin.user.index') }}" + '/' + id,
                            type: "DELETE",
                            success: function (response) {
                                // Ask for confirm delete
                                $('#user-datatable').DataTable().ajax.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });

            });
            <!-- Delete Project Ajax End -->
        });
    </script>
@endsection
