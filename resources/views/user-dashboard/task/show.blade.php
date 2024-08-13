@extends('user-dashboard.master')

@section('title', 'Single Task || Project Management System')

@section('body')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Tasks</h1>
    </div>


    <div>
{{--        <div class="table-responsive">--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Info</th>--}}
{{--                        <th scope="col">Description</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <td scope="col">Project Name</td>--}}
{{--                        <td>{{ $task->title }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td scope="col">Description</td>--}}
{{--                        <td>{{ $task->description }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td scope="col">Status</td>--}}
{{--                        <td>{{ $task->status }}</td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--            <div class="">--}}

{{--                @foreach($task->comments as $comment)--}}
{{--                    <p class="border border-primary-subtle rounded-2 p-2">--}}
{{--                        {{ $comment->comment }}--}}
{{--                    </p>--}}
{{--                @endforeach--}}
{{--                <form action="{{ route('comment.store') }}" method="POST" >--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="task_id" value="{{$task->id}}">--}}
{{--                    <textarea name="comment" id="" class="form-control"></textarea>--}}
{{--                    <button type="submit" class="btn btn-primary float-end my-4">Submit</button>--}}
{{--                </form>--}}

{{--                <div class="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <div class="card p-4">
        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-1">
                    <img class="mr-3 rounded-circle img-thumbnail" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" style="width: 60px; height: 60px" />
                </div>
                <div class="col-md-11">
                    <div class="d-flex justify-content-between">
                        <h3>Comment Title</h3>
                        <span>5:25PM, 12 Jan 2024</span>
                    </div>
                    <p class="pe-4">A, accusamus ad animi aut dolorum, ducimus ea eaque eius enim explicabo in itaque iure laudantium magnam, maxime necessitatibus nemo officiis quasi quis reprehenderit saepe sequi sunt temporibus totam voluptas voluptates.</p>
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-1">
                    <img class="mr-3 rounded-circle img-thumbnail" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" style="width: 60px; height: 60px" />
                </div>
                <div class="col-md-11">
                    <div class="d-flex justify-content-between">
                        <h3>Comment Title</h3>
                        <span>5:25PM, 12 Jan 2024</span>
                    </div>
                    <p class="pe-4">Delectus dolorem fugiat hic magnam magni nesciunt rem ullam ut voluptas? Alias commodi debitis explicabo incidunt, nulla obcaecati ratione. Consectetur nulla quam sunt tempora. Adipisci amet aperiam asperiores, consectetur consequuntur debitis delectus dignissimos eligendi esse ex harum illum impedit ipsa ipsam ipsum itaque nesciunt, perferendis possimus quam quisquam, rem rerum sunt vel veniam vitae. At delectus earum enim necessitatibus nulla quia suscipit! Aliquid aperiam asperiores commodi consequatur dicta doloribus dolorum, eum harum, laudantium minima non quasi quis quod similique voluptatibus. Accusamus accusantium ad alias architecto assumenda atque consequuntur cupiditate debitis, distinctio doloribus ea et, eum ex harum hic id illo impedit ipsam laudantium maiores modi nisi nobis non numquam omnis perferendis porro, provident quas quia quibusdam quis quisquam recusandae suscipit temporibus ullam unde voluptas. Alias, commodi cumque ex fugiat id, incidunt molestias nam nisi officiis .</p>
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        @csrf
                        <input type="text" class="form-control" name="message">
                        <textarea name="comment" id="" class="form-control" style="height: 350px"></textarea>
                        <button type="submit" class="btn btn-success my-2" style="float: right;">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
