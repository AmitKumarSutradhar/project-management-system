@extends('master')

@section('title', 'Project Details || Project Management System')

@section('body')
    <div class="container py-5">
        <h2>All Information</h2>
        <div class="table-responsive">
            <table class="table">
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

        <div class="">
            <p>Task List</p>
            <ul>
                @foreach($project->tasks as $task)
                    <li>{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
