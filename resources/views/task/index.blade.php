@extends('master')

@section('title', 'All Project || Project Management System')

@section('body')
   <div class="container py-5">
       <div class="d-flex justify-content-between">
           <h2>All Task</h2>
           <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
       </div>
       <div class="table-responsive">
           <table class="table">
               <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Task Name</th>
                       <th scope="col">Description</th>
                       <th scope="col">Assigned to</th>
                       <th scope="col">Due Date</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
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
                               <a href="{{ route('task.edit',$item->id) }}" class="btn btn-primary">Edit</a>

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
@endsection
