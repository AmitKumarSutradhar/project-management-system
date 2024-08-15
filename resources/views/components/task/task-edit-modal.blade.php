<div class="modal fade edit-user-task-model" id="edit-user-task-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalHeading">Edit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="edit-task-form" name="createProjectForm" action="{{ route('admin.task.store') }}" method="POST">
                @csrf
                <input type="text" name="task-id" class="form-control edit-task-id" id="edit-task-id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Task Name</label>
                        <input type="text" name="title" class="form-control edit-task-name"  id="" aria-describedby="">
                    </div>
                    <div class="mb-3">
                        <label for="projectDescription" class="form-label" >Task Description</label>
                        <textarea name="description" class="form-control edit-task-description" id=""></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="project-name" class="form-label">Project name</label>
                        <select name="project_id" id="project-name" class="form-control edit-task-project_id">
                            <option value="" disabled> -- Select project -- </option>
                            @foreach($projects as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="project-name" class="form-label">Choose a project</label>
                        <select name="assigned_to" id="user-name" class="form-control edit-assigned_to">
                            <option value="" disabled> -- Select Member -- </option>
                            @foreach($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="projectImage" class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control task-due-date" id="">
                    </div>
                    <div class="mb-3">
                        <label for="projectImage" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="projectImage">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button  id="" class="btn btn-primary edit-task-data" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
        <!-- Edit Task Start -->
        $('body').on('click','.edit-task', function () {
            var taskId = $(this).attr('data-id');
            $('.edit-task-form').trigger("reset");
            $('.edit-user-task-model').modal('show');

            $.get("{{ route('user.task.index') }}" + '/' + taskId + '/edit', function (data) {
                $('#edit-task-id').val(data.task.id);
                $('.edit-task-name').val(data.task.title);
                $('.edit-task-description').val(data.task.description);
                $('.edit-task-project_id').val(data.task.project_id);
                $('.edit-assigned_to').val(data.task.assigned_to);
                $('.task-due-date').val(data.task.due_date);
            })
        });

        $('.edit-task-form').on('submit', function (e) {
            e.preventDefault();
            $('.edit-task-data').html('Sending..');

            var taskId = $('#edit-task-id').val();
            console.log(taskId);

            $.ajax({
                url: "{{ route('user.task.index') }}" + '/' + taskId,
                type: "PUT",
                dataType: 'json',
                data: $('.edit-task-form').serialize(),

                success: function (data) {
                    console.log(data);
                    $('.edit-task-form').trigger("reset");
                    $('.edit-user-task-model').modal('hide');
                    $('.task-data-table').DataTable().ajax.reload();
                    $('.edit-task-data').html('Send');

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
                    $('.edit-task-data').html('Save Changes');
                }
            });
        });
        <!-- Create New Task End -->

    });
</script>
