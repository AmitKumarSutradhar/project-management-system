<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProjectManagementSytemController extends Controller
{
    public function test(){
        var_dump(User::roles());
    }
}
