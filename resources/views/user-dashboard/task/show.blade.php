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
{{--                                               <td><pre>{{ $task }}</pre></td>--}}
                       <td>{{ $task->project->name}}</td>
                   </tr>

                   <tr>
                       <td scope="col">Due Date</td>
                       <td>{{ !empty($task->due_date) ? $task->due_date : 'Not fixed' }}</td>
                   </tr>
                   </tbody>
               </table>
           </div>
       </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card h-100 p-3 mb-3">
                <div class="card-body">
                    <h2>Add your comment</h2>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('user.comment.store') }}" method="POST" id="createNewComment">
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
                                <button type="submit" class="btn btn-success my-2" id="commentSubmitBtn" style="float: right;">Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 p-3 mb-3">
                <div class="card-body">
                    <h2>All comments</h2>
                    <hr>
                    @if(count($comments) > 0)
                        <div class="table-responsive border-0">
                            <table class="table">
                                <tbody class="comment-table-body">
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td scope="col" style=" width: 100px; ">
                                                <img class="mr-3 rounded-circle img-thumbnail" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" style="width: 60px; height: 60px" />
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <h3>{{ $comment->title }}</h3>
                                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="pe-4">{{ $comment->comment }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="text-center">No comments available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>




    <script>
        $('body').on('click', '#commentSubmitBtn', function (e) {
            e.preventDefault();
            // var id = $(this).attr('id');
            // console.log(id);
            var formData = $('#createNewComment').serialize();
            $.ajax({
                url: "{{ route('user.comment.store') }}",
                type: "POST",
                dataType: 'json',
                data: formData,
                success: function (data) {
                    var html = '<tr> ' +
                                '<td> <img class="mr-3 rounded-circle img-thumbnail" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" style="width: 60px; height: 60px" /> </td> ' +
                                '<td> ' +
                                    '<div>  ' +
                                        '<div class="d-flex justify-content-between"> ' +
                                            '<h3> + data.title +</h3>' +
                                        '</div>' +
                                        '<p>data.comment</p>' +
                                    '</div>' +
                                ' </td> ' +
                        '</tr>';
                    $('.comment-table-body').append(html);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        });
    </script>
@endsection
