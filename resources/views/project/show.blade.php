@extends('admin.master')

@section('title', 'Project Details || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Create Projects</h1>
        <div class="">
            <a href="{{ route('project.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-right fa-sm text-white-50"></i> All Projects</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th scope="col">Info</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td scope="col">Project Name</td>
                                <td>{{ $project->name }}</td>
                            </tr>
                            <tr>
                                <td scope="col">Description</td>
                                <td>{{ $project->description }}</td>
                            </tr>
                            <tr>
                                <td scope="col">Status</td>
                                <td>{{ $project->status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Task List</h6>
                        <div class="">
                            <a href="{{ route('task.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#taskCreate">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Add task
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($project->tasks as $task)
                            <li>{{ $task->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Create Modal-->
    <div class="modal fade" id="taskCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
