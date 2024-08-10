@extends('admin.master')

@section('title', 'Project Create || Project Management System')

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
                    <h6 class="m-0 font-weight-bold text-primary">Projects Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf
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
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
