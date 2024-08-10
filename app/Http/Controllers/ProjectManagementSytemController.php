<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProjectManagementSytemController extends Controller
{
    public function dashboard(){
        return view('dashboard.index');
    }
    public function test(){
        return view('dashboard.index');
    }
}
