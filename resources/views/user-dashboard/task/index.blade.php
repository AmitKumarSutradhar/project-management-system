@extends('user-dashboard.master')

@section('title', 'All Project || Project Management System')

@section('body')

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Tasks</h1>
        <div class="">
            <a href="javascirpt:void(0)" id="createNewTask" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 mx-1"></i>Create Task
            </a>
        </div>
    </div>

    <!-- DataTales Body Start-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="task-data-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Assigned to</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Assigned to</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DataTales Body End -->

    <!-- Task Create Modal-->
    <div class="modal fade" id="task-ajax-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Create a project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="create-task-form" name="createProjectForm" action="{{ route('user.task.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Task Name</label>
                            <input type="text" name="title" class="form-control"  id="task-name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Task Description</label>
                            <textarea name="description" class="form-control" id="task-image"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="project-name" class="form-label">Project name</label>
                            <select name="project_id" id="project-name" class="form-control">
                                <option value="" disabled> -- Select project -- </option>
                                @foreach($projects as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="project-name" class="form-label">Assign a member</label>
                            <select name="assigned_to" id="user-name" class="form-control">
                                <option value="" disabled> -- Select Member -- </option>
                                @foreach($users as $item)
                                    <option>{{ count($item->roles) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" id="projectImage">
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="save-task-data" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Task Edit Modal-->
    <div class="modal fade" id="edit-user-task-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalHeading">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-user-task-form" name="createProjectForm" action="{{ route('admin.task.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Task Name</label>
                            <input type="text" name="title" class="form-control"  id="edit-task-name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Task Description</label>
                            <textarea name="description" class="form-control" id="edit-task-description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="project-name" class="form-label">Project name</label>
                            <select name="project_id" id="project-name" class="form-control">
                                <option value="" disabled> -- Select project -- </option>
                                @foreach($projects as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="project-name" class="form-label">Choose a project</label>
                            <select name="assigned_to" id="user-name" class="form-control">
                                <option value="" disabled> -- Select Member -- </option>
                                @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Due Date</label>
                            <input type="date" name="due_date" class="form-control" id="projectImage">
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="save-task-data" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Task Create Modal-->

    <!-- Task Status Edit Modal-->
    <div class="modal fade" id="edit-task-status-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalHeading">Edit Task Status</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="create-task-form" name="createProjectForm" action="{{ route('admin.task.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Task Status</label>
                            <select name="status" id="" class="form-control">
                                @foreach($task as $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="save-task-data" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Task Status Create Modal-->

    <!-- Data table data -->
    <script>
        $(document).ready(function() {
            $('#task-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.task.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'assigned_to', name: 'assigned_to.user.name' },
                    { data: 'due_date', name: 'due_date' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Data table data -->


    <!-- Ajax CRUD Start -->
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Create New Task Start -->
            $('body').on('click','#createNewTask',function () {
                $('#save-task-data').val("create-task");
                $('#id').val('');
                $('#addNewTask').trigger("reset");
                $('#modelHeading').html("Add New Task");
                $('#task-ajax-model').modal('show');
            });

            $('#save-task-data').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#create-task-form').serialize(),
                    url: "{{ route('admin.task.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#create-task-form').trigger("reset");
                        $('#task-ajax-model').modal('hide');
                        $('#task-data-table').DataTable().ajax.reload();
                        $('#save-task-data').html('Send');

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
                        $('#save-task-data').html('Save Changes');
                    }
                });
            });
            <!-- Create New Task End -->

            <!-- Edit Project Ajax End -->
            $('body').on('click', '.editTask', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                console.log(data)
                $.get("{{ route('user.task.index') }}" + '/' + id + '/edit', function (data) {
                    console.log(data)
                    $('#editTaskModalHeading').html("Edit Task Info");
                    // $('#savedata').val("edit-user");
                    // $('#id').val(data.id);
                    // $('#edit-task-id').val(data.task.id);
                    $('#edit-task-name').val(data.task.name);
                    // $('#edit-task-description').val(data.task.description);
                    $('#edit-user-task-model').modal('show');
                })
            });
            <!-- Edit Project Ajax End -->

            <!-- Update Task Info Ajax End -->
            $('#edit-user-task-form').on('submit', function (e) {
                e.preventDefault();
                var id = $('#edit-project-id').val();
                var formData = $(this).serialize();
                // console.log(id)
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
            <!-- Update Task Info Ajax End -->

            <!-- Update Task Status Ajax End -->
            $('body').on('click', '.editTaskStatus', function () {
                var id = $(this).attr('id');
                console.log(id);
                $.get("{{ route('user.task.index') }}"+ '/' + id + "/task-status-edit",function (data) {
                    $('#edit-task-status-modal').modal('show');
                });
            });
            <!-- Update Task Status Ajax End -->

            <!-- Delete Project Ajax Start -->
            $('body').on('click', '.deleteTask', function () {
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
                            url: "{{ route('admin.task.index') }}" + '/' + id,
                            method: "DELETE",
                            success: function (response) {
                                // Ask for confirm delete
                                $('#task-data-table').DataTable().ajax.reload();
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
    <!-- Ajax CRUD End -->

@endsection
