@extends('master')

@section('title', 'Single Task || Project Management System')

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
                        <td>{{ $task->title }}</td>
                    </tr>
                    <tr>
                        <td scope="col">Description</td>
                        <td>{{ $task->description }}</td>
                    </tr>
                    <tr>
                        <td scope="col">Status</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="">

                @foreach($task->comments as $comment)
                    <p class="border border-primary-subtle rounded-2 p-2">
                        {{ $comment->comment }}
                    </p>
                @endforeach
                <form action="{{ route('comment.store') }}" method="POST" >
                    @csrf
                    <input type="hidden" name="task_id" value="{{$task->id}}">
                    <textarea name="comment" id="" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary float-end my-4">Submit</button>
                </form>

                <div class="">
                </div>
            </div>
        </div>
    </div>
@endsection
