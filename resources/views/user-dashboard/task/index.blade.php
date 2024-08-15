@extends('user-dashboard.master')

@section('title', 'All Project || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Tasks</h1>
        @if(auth()->user()->can('create-task'))
            <div class="">
                <a href="javascirpt:void(0)" class="create-new-task d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50 mx-1"></i>Create Task
                </a>
            </div>
        @endif
    </div>

    <!-- DataTales Body Start-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered task-data-table" id="task-data-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Status</th>
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
    @include('components.task.task-create-modal')
    <!-- Task Create Modal-->

    <!-- Task Edit Modal-->
    @include('components.task.task-edit-modal')
    <!-- Task Create Modal-->

    <!-- Task Submit Form-->
    <form class="submit-task-form" name="createProjectForm" action="{{ route('admin.task.store') }}" method="POST">
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
    <!-- Task Submit Form-->

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
                    { data: 'status', name: 'status' },
                    { data: 'due_date', name: 'due_date' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Data table data -->



    <!-- Ajax CRUD -->
    <script>
        $(function () {
            <!-- Submit Task Ajax End -->
            $('body').on('click','.submit-task', function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                let taskCompleted = 'Completed';
                // console.log(id);

                $.ajax({
                    url: "{{ route('user.task.index') }}" + '/' + id + '/task-submit',
                    method: "PUT",
                    data: {
                        'status' : taskCompleted,
                    },
                    success: function (response) {
                        $('.task-data-table').DataTable().ajax.reload();

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
            <!-- Submit Task Ajax End -->
        });
    </script>
    <!-- Ajax CRUD -->



@endsection
