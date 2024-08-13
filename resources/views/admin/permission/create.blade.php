@extends('admin.master')

@section('title', 'Assign Permission || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Assign permission</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
{{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="assign-permission-datatable" width="100%" cellspacing="0">
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
                </table>
            </div>
        </div>
    </div>

    <!--  Assign Permission Modal Start -->
    <div class="modal fade" id="assign-permission-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assign-permission-modal-heading">Assign permission</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="assign-permission-form" name="addNewRoleForm" action="{{ route('admin.project.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="assign-permission-role-id" name="roleId">
                    <div class="modal-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            @foreach($permissions as $item)
                                <div class="mx-2">
                                    <input type="checkbox" name="permission[]" class="" id="permission-{{ $item->id }}" value="{{ $item->name }}">
                                    <label for="permission-{{ $item->id }}" class="form-label">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button  id="assign-permission-btn" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Assign Permission Modal Start -->


    <!-- Permission Datatable data -->
    <script>
        $(document).ready(function() {
            $('#assign-permission-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.permission.create') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'permission', name: 'permission' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <!-- Permission Datatable data  -->


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            <!-- Assign Permission -->
            $('body').on('click', '.assignPermission', function () {
                var id = $(this).attr('data-id');
                $('#assign-permission-role-id').val(id);
                $.get("{{ route('admin.permission.all') }}", function (data) {
                    console.log(data);
                    $('#assign-permission-modal-heading').html("Assign permission to role:");
                    $('#savedata').val("edit-role");
                    $('#assign-permission-modal').modal('show');
                    $('#permission-id').val(data.permission.id);
                    $('#edit-permission-name').val(data.permission.name);
                })
            });

            $('#assign-permission-form').on('submit', function (e) {
                e.preventDefault();
                // var id = $('#permission-id').val();
                var formData = $(this).serialize();
                $('#assign-permission-btn').html('Saving...')

                $.ajax({
                    url: "{{ route('admin.permission.assign') }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        $('#edit-role-form').trigger('reset');
                        $('#edit-permission-modal').modal('hide');
                        $('#permission-datatable').DataTable().ajax.reload();
                        $('#assign-permission-btn').html('Save data');
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
