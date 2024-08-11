@extends('admin.master')

@section('title', 'All Roles || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Roles</h1>
        <div class="">
            <a href="javascirpt:void(0)" id="createNewRole" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Roles
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
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
{{--                        @foreach($roles as $item)--}}
{{--                            <tr>--}}
{{--                                <td scope="row">{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $item->name }}</td>--}}
{{--                                <td>{{ $item->name }}</td>--}}
{{--                                <td class="d-flex">--}}
{{--                                    <a href="{{ route('project.show',$item->id) }}" class="btn btn-warning"><i class="fa fa-book"></i></a>--}}
{{--                                    <a href="javascript:void(0)"  id="{{ $item->id }}" class="editRole btn btn-primary mx-2"><i class="fa fa-edit"></i></a>--}}
{{--                                    <a href="javascript:void(0)" id="{{ $item->id }}" class="deleteRole btn btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--  Add New Role Modal Start -->
    <div class="modal fade" id="rolesCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Create a project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="addNewRoleForm" name="addNewRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control"   id="roleName" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="saveRoleData" class="btn btn-primary">Submit</button>
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
                    <h5 class="modal-title" id="modelHeading">Create a project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateRoleForm" name="updateRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" value=""   id="roleName" aria-describedby="emailHelp">
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


    <script>
        {{--$(function () {--}}

        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $('#createNewRole').on('click',function () {--}}
        {{--        $('#savedata').val("create-project");--}}
        {{--        $('#id').val('');--}}
        {{--        $('#addNewRoleForm').trigger("reset");--}}
        {{--        $('#modelHeading').html("Create New Role");--}}
        {{--        $('#rolesCreateModal').modal('show');--}}
        {{--    });--}}

        {{--    <!-- Edit Role Info -->--}}
        {{--    // $('body').on('click', '.editRole', function () {--}}
        {{--    //     var id = $(this).attr('id');--}}
        {{--    //     $.get("role/"+ id + '/edit', function (data) {--}}
        {{--    //         console.log(data)--}}
        {{--    //         $('#modelHeading').html("Edit Role");--}}
        {{--    //         $('#savedata').val("edit-role");--}}
        {{--    //         $('#rolesCreateModal').modal('show');--}}
        {{--    //         $('#id').val(data.id);--}}
        {{--    //         $('#roleName').val(data.name);--}}
        {{--    //         // $('#description').val(data.description);--}}
        {{--    //     })--}}
        {{--    // });--}}

        {{--    <!-- Add New Role -->--}}
        {{--    $('#saveRoleData').click(function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        $(this).html('Sending..');--}}

        {{--        $.ajax({--}}
        {{--            data: $('#addNewRoleForm').serialize(),--}}
        {{--            url: "{{ route('role.store') }}",--}}
        {{--            type: "POST",--}}
        {{--            dataType: 'json',--}}
        {{--            success: function (data) {--}}
        {{--                $('#addNewRoleForm').trigger("reset");--}}
        {{--                $('#rolesCreateModal').modal('hide');--}}
        {{--                // table.draw();--}}

        {{--                const Toast = Swal.mixin({--}}
        {{--                    toast: true,--}}
        {{--                    position: "top-end",--}}
        {{--                    showConfirmButton: false,--}}
        {{--                    timer: 3000,--}}
        {{--                    timerProgressBar: true,--}}
        {{--                    didOpen: (toast) => {--}}
        {{--                        toast.onmouseenter = Swal.stopTimer;--}}
        {{--                        toast.onmouseleave = Swal.resumeTimer;--}}
        {{--                    }--}}
        {{--                });--}}
        {{--                Toast.fire({--}}
        {{--                    icon: "success",--}}
        {{--                    title: data.success,--}}
        {{--                });--}}

        {{--            },--}}
        {{--            error: function (data) {--}}
        {{--                console.log('Error:', data);--}}
        {{--                $('#savedata').html('Save Changes');--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}

        {{--    <!-- Edit Role Info -->--}}

        {{--    $('.editRole').on('click',function () {--}}
        {{--        $('#savedata').val("create-project");--}}
        {{--        $('#id').val('');--}}
        {{--        // $('#addNewRoleForm').trigger("reset");--}}
        {{--        $('#modelHeading').html("Update Role Info");--}}
        {{--        $('#rolesCreateModal').modal('show');--}}
        {{--    });--}}

        {{--    $('body').on('click', '#updateRoleData', function () {--}}

        {{--        var id = $(this).attr('id');--}}
        {{--        var name =  $('#roleName').val();--}}
        {{--        console.log(id);--}}
        {{--        console.log(name);--}}
        {{--        // console.log('success:', data);--}}
        {{--        // confirm("Are You sure want to delete this Product!");--}}

        {{--        $.ajax({--}}
        {{--            type: "PUT",--}}
        {{--            url: "role/"+ id,--}}
        {{--            --}}{{--url: "{{ route('project.destroy') }}" + '/' + id,--}}
        {{--            success: function (data) {--}}
        {{--                // table.draw();--}}
        {{--                const Toast = Swal.mixin({--}}
        {{--                    toast: true,--}}
        {{--                    position: "top-end",--}}
        {{--                    showConfirmButton: false,--}}
        {{--                    timer: 3000,--}}
        {{--                    timerProgressBar: true,--}}
        {{--                    didOpen: (toast) => {--}}
        {{--                        toast.onmouseenter = Swal.stopTimer;--}}
        {{--                        toast.onmouseleave = Swal.resumeTimer;--}}
        {{--                    }--}}
        {{--                });--}}
        {{--                Toast.fire({--}}
        {{--                    icon: "success",--}}
        {{--                    title: data.success,--}}
        {{--                });--}}
        {{--            },--}}
        {{--            error: function (data) {--}}
        {{--                console.log('Error:', data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}





        {{--    <!-- Delete Project -->--}}
        {{--    $('body').on('click', '.deleteRole', function () {--}}

        {{--        var id = $(this).attr('id');--}}
        {{--        // console.log(id);--}}
        {{--        // console.log('success:', data);--}}
        {{--        confirm("Are You sure want to delete this Product!");--}}

        {{--        $.ajax({--}}
        {{--            type: "DELETE",--}}
        {{--            url: "role/"+ id,--}}
        {{--            --}}{{--url: "{{ route('project.destroy') }}" + '/' + id,--}}
        {{--            success: function (data) {--}}
        {{--                // table.draw();--}}
        {{--                const Toast = Swal.mixin({--}}
        {{--                    toast: true,--}}
        {{--                    position: "top-end",--}}
        {{--                    showConfirmButton: false,--}}
        {{--                    timer: 3000,--}}
        {{--                    timerProgressBar: true,--}}
        {{--                    didOpen: (toast) => {--}}
        {{--                        toast.onmouseenter = Swal.stopTimer;--}}
        {{--                        toast.onmouseleave = Swal.resumeTimer;--}}
        {{--                    }--}}
        {{--                });--}}
        {{--                Toast.fire({--}}
        {{--                    icon: "success",--}}
        {{--                    title: data.success,--}}
        {{--                });--}}
        {{--            },--}}
        {{--            error: function (data) {--}}
        {{--                console.log('Error:', data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}

        {{--});--}}
    </script>
@endsection
