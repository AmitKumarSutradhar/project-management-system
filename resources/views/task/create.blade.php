@extends('admin.master')

@section('title', 'Project Create || Project Management System')

@section('body')

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Create Task</h1>
        <div class="">
            <a href="{{ route('task.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-right fa-sm text-white-50"></i> All Tasks</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('task.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Select Project</label>
                            <select name="project_id" class="form-control" id="projectName">
                                <option value="">-- Select Project --</option>
                                @foreach($projects as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Task Title</label>
                            <input type="text" name="title" class="form-control"  id="projectName" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label" >Task Description</label>
                            <textarea name="description" class="form-control" id="taskDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deuDate" class="form-label" >Due Date</label>
                            <input type="date" name="due_date" class="form-control" id="deuDate">
                        </div>
                        <div class="mb-3">
                            <label for="projectImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="projectImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
