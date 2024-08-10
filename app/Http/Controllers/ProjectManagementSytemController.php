<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProjectManagementSytemController extends Controller
{
    public function userDashboard(){
        return view('user-dashboard.dashboard.index');
    }
}
