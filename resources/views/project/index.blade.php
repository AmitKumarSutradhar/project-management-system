@extends('admin.master')

@section('title', 'All Project || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Projects</h1>
        <div class="">
{{--            <a href="{{ route('project.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create Project</a>--}}
{{--            <a href="javascirpt:void(0)" id="createNewProject" data-toggle="modal" data-target="#projectAjaxModel" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">--}}
{{--                <i class="fas fa-plus fa-sm text-white-50"></i> Create Project--}}
{{--            </a>--}}
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <tbody>
                        @foreach($projects as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->status }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('project.show',$item->id) }}" class="btn btn-warning"><i class="fa fa-book"></i></a>
                                    <a href="{{ route('project.edit',$item->id) }}" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" id="{{ $item->id }}" class="deleteProject btn btn-danger"><i class="fa fa-trash"></i></a>

{{--                                    <form action="{{ route('project.destroy',$item->id) }}" method="POST">--}}
{{--                                        @method('DELETE')--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
{{--                                    </form>--}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
                <form id="createProjectForm" name="createProjectForm" action="{{ route('project.store') }}" method="POST">
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


    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createNewProject').on('click',function () {
                $('#savedata').val("create-project");
                $('#id').val('');
                $('#createProjectForm').trigger("reset");
                $('#modelHeading').html("Create New Project");
                $('#projectAjaxModel').modal('show');
            });

            {{--$('body').on('click', '.editProduct', function () {--}}
            {{--    var id = $(this).data('id');--}}
            {{--    $.get("{{ route('products.index') }}" + '/' + id + '/edit', function (data) {--}}
            {{--        $('#modelHeading').html("Edit Product");--}}
            {{--        $('#savedata').val("edit-user");--}}
            {{--        $('#ajaxModelexa').modal('show');--}}
            {{--        $('#id').val(data.id);--}}
            {{--        $('#title').val(data.title);--}}
            {{--        $('#description').val(data.description);--}}
            {{--    })--}}
            {{--});--}}

            $('#savedata').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#createProjectForm').serialize(),
                    url: "{{ route('project.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#createProjectForm').trigger("reset");
                        $('#projectAjaxModel').modal('hide');
                        // table.draw();

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

            <!-- Delete Project -->
            $('body').on('click', '.deleteProject', function () {

                var id = $(this).attr('id');
                // console.log(id);
                // console.log('success:', data);
                confirm("Are You sure want to delete this Product!");

                $.ajax({
                    type: "DELETE",
                    url: "project/"+ id,
                    {{--url: "{{ route('project.destroy') }}" + '/' + id,--}}
                    success: function (data) {
                        // table.draw();
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

        });
    </script>
@endsection
