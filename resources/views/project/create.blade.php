@extends('master')

@section('title', 'Project Create || Project Management System')

@section('body')
    <div class="container py-5">
        <h2>Project Create</h2>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
