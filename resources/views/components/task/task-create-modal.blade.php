<!-- Task Create Modal-->
<div class="modal fade task-create-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">Create a new task</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="create-task-form" name="createProjectForm" action="{{ route('user.task.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Task Name</label>
                        <input type="text" name="title" class="form-control"  id="task-name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="projectDescription" class="form-label" >Task Description</label>
                        <textarea name="description" class="form-control" id=""></textarea>
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
{{--                    <div class="mb-3">--}}
{{--                        <label for="project-name" class="form-label">Assign a member</label>--}}
{{--                        <select name="assigned_to" id="user-name" class="form-control">--}}
{{--                            <option value="" disabled> -- Select Member -- </option>--}}
{{--                            @foreach($users as $item)--}}
{{--                                <option>{{ count($item->roles) }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
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
                    <button  id="" class="btn btn-primary task-submit-btn" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        <!-- Create New Task Start -->
        $('body').on('click','.create-new-task', function () {
            $('.create-task-form').trigger("reset");
            $('.task-create-model').modal('show');
        });

        $('.create-task-form').on('submit', function (e) {
            e.preventDefault();
            $('.task-submit-btn').html('Sending..');

            $.ajax({
                url: "{{ route('user.task.store') }}",
                type: "POST",
                dataType: 'json',
                data: $('.create-task-form').serialize(),

                success: function (data) {
                    console.log(data);
                    $('.create-task-form').trigger("reset");
                    $('.task-create-model').modal('hide');
                    $('.task-data-table').DataTable().ajax.reload();
                    $('.task-submit-btn').html('Send');

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


        <!-- Delete Task End -->
        $('body').on('click', '.deleteTask', function (e) {
            e.preventDefault();
            var taskId = $(this).attr('data-id');
            console.log(taskId);

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
                        url: "{{ route('user.task.index') }}" + '/' + taskId,
                        method: "DELETE",
                        success: function (data) {
                            // Ask for confirm delete
                            $('.task-data-table').DataTable().ajax.reload();
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
        <!-- Delete Task End -->
    });
</script>
