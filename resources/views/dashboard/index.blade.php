@extends('master')

@section('body')
   <section>
       <div class="container">
           <p>Hello {{ Auth::user()->name }}, Welcome to dashboard.</p>
           <p>Your role is {{ Auth::user()->role }}.</p>

           @if(auth()->user()->isAdmin())
               <a href="#">Ami Admin</a>
           @endif
           @if(auth()->user()->isProjectManager())
               <a href="#">Ami Project Manager</a>
           @endif
           @if(auth()->user()->isTeamMember())
               <a href="#">Ami Team Member</a>
           @endif
           @if(auth()->user()->isUser())
               <a href="#">Ami User</a>
           @endif
       </div>
   </section>
@endsection
