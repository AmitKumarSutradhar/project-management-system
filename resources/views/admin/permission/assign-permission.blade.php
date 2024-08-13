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
                    <input type="hidden" class="assign-permission-role-id" name="roleId">
                    <div class="modal-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            @foreach($permissions as $item)
                                <div class="mx-2">
                                    <input type="checkbox" name="permission[]" class="" id="permission-{{ $item->id }}" value="{{ $item->id }}">
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
                    { data: 'permissions', name: 'permissions' },
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
                var roleId = $(this).data('id');
                var rolePermissions = $(this).data('permissions'); // JSON array of permission IDs
                console.log(roleId)
                // Set the role ID in the hidden input field
                $('.assign-permission-role-id').val(roleId);

                // Uncheck all checkboxes first
                $('#assign-permission-modal input[type="checkbox"]').prop('checked', false);

                // Loop through each permission checkbox and check it if it matches a role's permission
                $('#assign-permission-modal input[type="checkbox"]').each(function() {
                    var permissionId = $(this).val();
                    if (rolePermissions.includes(parseInt(permissionId))) {
                        $(this).prop('checked', true);
                    }
                });

                // Show the modal
                $('#assign-permission-modal').modal('show');
            });

            <!-- Assign Permission - Save form data -->
            $('#assign-permission-form').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $('#assign-permission-btn').html('Saving...')

                $.ajax({
                    url: "{{ route('admin.permission.assign') }}",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        // console.log(data);
                        $('#assign-permission-form').trigger('reset');
                        $('#assign-permission-modal').modal('hide');
                        $('#assign-permission-datatable').DataTable().ajax.reload();
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
