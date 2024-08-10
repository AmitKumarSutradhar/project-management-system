@extends('admin.master')

@section('title', 'All Project || Project Management System')

@section('body')

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h3 text-gray-800">Tasks</h1>
        <div class="">
            <a href="{{ route('task.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create Tasks
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{--            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>Task Name</th>
                           <th>Description</th>
                           <th>Assigned to</th>
                           <th>Due Date</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Assigned to</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                   <tbody>
                        @foreach($task as $item)
                        <tr>
                           <th scope="row">{{ $loop->iteration }}</th>
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->description }}</td>
                           <td>{{ !empty($item->assigned_to) ? $item->assigned_to : 'None' }}</td>
                           <td>{{ $item->due_date }}</td>
                           <td class="d-flex">
                               <a href="{{ route('task.show',$item->id) }}" class="btn btn-warning">Show</a>
                               <a href="{{ route('task.edit',$item->id) }}" class="btn btn-primary mx-2">Edit</a>

                               <form action="{{ route('task.destroy',$item->id) }}" method="POST">
                                   @method('DELETE')
                                   @csrf
                                   <button type="submit" class="btn btn-danger">Delete</button>
                               </form>

                           </td>
                       </tr>
                        @endforeach
                   </tbody>
                </table>
            </div>
        </div>
   </div>
@endsection
