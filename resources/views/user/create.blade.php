@extends('master')

@section('title', 'Project Create || Project Management System')

@section('body')
    <div class="container py-5">
        <h2>Task Create</h2>
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
@endsection
