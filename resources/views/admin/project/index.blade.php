@extends('admin.master')

@section('title', 'All Project || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Projects</h1>
        <div class="">
            <a href="javascirpt:void(0)" id="createNewProject" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Project
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
                <table class="table table-bordered" id="project-datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- Project Create Modal-->
    <div class="modal fade" id="projectAjaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Create a project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="createProjectForm" name="createProjectForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" name="name" class="form-control"  id="projectName" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Project Description</label>
                            <textarea name="description" class="form-control" id="projectDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="savedata" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Project Edit Modal-->
    <div class="modal fade" id="editProjectInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectModalHeading">Edit project info</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateProjectForm" name="updateProjectForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="" id="edit-project-id">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" name="name" class="form-control"  id="editProjectName" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Project Description</label>
                            <textarea name="description" class="form-control" id="editProjectDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Project Assign to</label>
                            <select name="assigned_to" id="" class="form-control">
                                <option value="" selected disabled>-- Select Options --</option>
                                @foreach(projectManagers as $user)
                                    <option value="{{  $user->id }}">
                                        {{ $user->name}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit"  id="updateProjectData" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Project Data table data -->
    <script>
        $(document).ready(function() {
            $('#project-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.project.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'assigned_to', name: 'assigned_to' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Project Data table data  -->

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Create New Project Ajax Start -->
            $('body').on('click','#createNewProject',function () {
                $('#savedata').val("create-project");
                $('#id').val('');
                $('#createProjectForm').trigger("reset");
                $('#modelHeading').html("Create New Project");
                $('#projectAjaxModel').modal('show');
            });

            $('#savedata').click(function (e) {
                e.preventDefault();
                $(this).html('Sending...');

                $.ajax({
                    data: $('#createProjectForm').serialize(),
                    url: "{{ route('admin.project.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#createProjectForm').trigger("reset");
                        $('#projectAjaxModel').modal('hide');
                        $('#project-datatable').DataTable().ajax.reload();
                        $('#savedata').html('Send');

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
            <!-- Create New Project Ajax End -->


            <!-- Edit Project Ajax End -->
            $('body').on('click', '.editProject', function () {
                var id = $(this).attr('id');
                // console.log(id)
                $.get("{{ route('admin.project.index') }}" + '/' + id + '/edit', function (data) {
                    $('#editProjectModalHeading').html("Edit Project Info check");
                    $('#savedata').val("edit-user");
                    $('#id').val(data.id);
                    $('#edit-project-id').val(data.project.id);
                    $('#editProjectName').val(data.project.name);
                    $('#editProjectDescription').val(data.project.description);
                    $('#editProjectInfo').modal('show');
                })
            });
            <!-- Edit Project Ajax End -->

            <!-- Update Project Ajax End -->
            $('#updateProjectForm').on('submit', function (e) {
                e.preventDefault();
                var id = $('#edit-project-id').val();
                var formData = $(this).serialize();
                $('#updateProjectData').html('Updating...');

                $.ajax({
                    url: "{{ route('admin.project.index') }}" + '/' + id,
                    method: "PUT",
                    data: formData,
                    success: function (response) {
                        // console.log(response)
                        $('#updateProjectForm').trigger("reset");
                        $('#editProjectInfo').modal('hide');
                        $('#project-datatable').DataTable().ajax.reload();
                        $('#updateProjectData').html('Update');
                        // $('#updateProjectData').html('Update');

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
            <!-- Update Project Ajax End -->


            <!-- Update Project Ajax End -->
            <!-- Update Project Ajax End -->


            <!-- Delete Project Ajax Start -->
            $('body').on('click', '.deleteProject', function () {
                var id = $(this).attr('id');
                // console.log(id);
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
                                url: "{{ route('admin.project.index') }}" + '/' + id,
                                method: "DELETE",
                                success: function (data) {
                                    // Ask for confirm delete
                                    $('#project-datatable').DataTable().ajax.reload();
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
