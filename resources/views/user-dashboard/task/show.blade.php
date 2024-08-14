@extends('user-dashboard.master')

@section('title', 'Single Task || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Tasks</h1>
    </div>


    <div class="card mb-3">
       <div class="card-body">
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
                       <td scope="col">Task Name</td>
                       <td>{{ $task->title }}</td>
                   </tr>
                   <tr>
                       <td scope="col">Project Name</td>
                       {{--                        <td><pre>{{ $task->name }}</pre></td>--}}
                       <td>{{ $task->project->name}}</td>
                   </tr>

                   <tr>
                       <td scope="col">Due Date</td>
                       <td>{{ $task->due_date }}</td>
                   </tr>
                   </tbody>
               </table>
           </div>
       </div>
    </div>

    <div class="card p-3 mb-3">
       <div class="card-body">
           <h2>All comments</h2>
           @foreach($comments as $comment)
               <div class="row border border-bottom-1 p-4">
                   <div class="col-md-1">
                       <img class="mr-3 rounded-circle img-thumbnail" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" style="width: 60px; height: 60px" />
                   </div>
                   <div class="col-md-11">
                       <div class="d-flex justify-content-between">
                           <h3>{{ $comment->title }}</h3>
                           <span>{{ $comment->created_at->diffForHumans() }}</span>
                       </div>
                       <p class="pe-4">{{ $comment->comment }}</p>
                   </div>

               </div>
           @endforeach
       </div>
    </div>

    <div class="card p-3 mb-3">
        <div class="card-body">
            <h2>Add your comment</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('user.comment.store') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="task_id" class="form-control"  value="{{ $task->id }}">
                        <input type="hidden" name="user_id" class="form-control"  value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"  id="task-name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label" >Comment</label>
                            <textarea name="comment" class="form-control" id="task-image" style="height: 300px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success my-2" style="float: right;">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        $('body').on('click', '.editTaskStatus', function () {
            var id = $(this).attr('id');
            console.log(id);
            $.get("{{ route('user.comment.index') }}"+ '/' + id + "/edit",function (data) {
                  console.log(id);
            });
        });
    </script>
@endsection
