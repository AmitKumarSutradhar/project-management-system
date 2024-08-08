@extends('master')

@section('title', 'All Project || Project Management System')

@section('body')
   <div class="container py-5">
       <h2>All Pro***jects</h2>
       <div class="table-responsive">
           <table class="table">
               <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Project Name</th>
                       <th scope="col">Description</th>
                       <th scope="col">Status</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($projects as $item)
                       <tr>
                           <th scope="row">{{ $loop->iteration }}</th>
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->description }}</td>
                           <td>{{ $item->status }}</td>
                           <td class="d-flex">
                               <a href="{{ route('project.show',$item->id) }}" class="btn btn-warning">Show</a>
                               <a href="{{ route('project.edit',$item->id) }}" class="btn btn-primary">Edit</a>

                               <form action="{{ route('project.destroy',$item->id) }}" method="POST">
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
