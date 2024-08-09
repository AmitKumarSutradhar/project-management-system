@extends('master')

@section('title', 'All Project || Project Management System')

@section('body')
   <div class="container py-5">
       <div class="d-flex justify-content-between">
           <h2>All Users</h2>
           <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
       </div>
       <div class="table-responsive">
           <table class="table">
               <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">User Name</th>
                       <th scope="col">Description</th>
                       <th scope="col">Status</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($users as $item)
                       <tr>
                           <th scope="row">{{ $loop->iteration }}</th>
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->email }}</td>
                           <td>{{ $item->status }}</td>
                           <td class="d-flex">
                               <a href="{{ route('user.show',$item->id) }}" class="btn btn-warning">Show</a>
                               <a href="{{ route('user.edit',$item->id) }}" class="btn btn-primary mx-2">Edit</a>

                               <form action="{{ route('user.destroy',$item->id) }}" method="POST">
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
