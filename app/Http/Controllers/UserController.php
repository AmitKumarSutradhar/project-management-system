<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function userDashboard(){
       auth()->user()->unreadNotifications->markAsRead();

       return view('user-dashboard.dashboard.index');
   }
}
