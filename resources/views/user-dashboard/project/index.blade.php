@extends('user-dashboard.master')

@section('title', 'All Project || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Projects</h1>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Project Status Update Modal-->
    <div class="modal fade" id="editProjectStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Update <span id="project-name"></span> status</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="project-status-update-form" name="createProjectForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="project-id">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Status</label>
                            <select name="status" id="project-status-option" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="In progress">In progress</option>
                                <option value="Completed">Completed</option>
                            </select>
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
    <!-- Project Status Update Modal-->

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
    <!-- Project Edit Modal-->

    <!-- Project Data table data -->
    <script>
        $(document).ready(function() {
            $('#project-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.project.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
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


            <!-- Edit Project Status Ajax End -->
            $('body').on('click', '.edit-project-status', function () {
                var id = $(this).attr('data-id');
                // console.log(id)
                $.get("{{ route('user.project.index') }}" + '/' + id + '/edit', function (data) {
                    console.log(data)
                    $('#project-name').html(data.project.title);
                    $('#project-status-option').val(data.project.status);
                    $('#project-id').val(data.project.id);
                    $('#editProjectStatus').modal('show');
                })
            });
            <!-- Edit Project Status Ajax End -->

            <!-- Update Project Ajax End -->
            $('#project-status-update-form').on('submit', function (e) {
                e.preventDefault();
                var id = $('#project-id').val();
                var formData = $(this).serialize();
                $('#updateProjectData').html('Updating...');

                $.ajax({
                    url: "{{ route('user.project.index') }}" + '/' + id,
                    method: "PUT",
                    data: formData,
                    success: function (response) {
                        $('#project-status-update-form').trigger("reset");
                        $('#editProjectStatus').modal('hide');
                        $('#project-datatable').DataTable().ajax.reload();

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


        });
    </script>
@endsection
