<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $users = User::all();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="#" data-id="'.$user->id.'" class="editUser btn btn-sm btn-primary">Edit</a>
                        <a href="#" data-id="'.$user->id.'" class="deleteUser btn btn-sm btn-danger">Delete</a>';
                })
                ->make(true);
        }

        return view('admin.user.index',[
            'users' => User::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
//        return response()->json([
//            'request' => $request->all(),
//        ]);

        $user->name = $request->name;
        $user->status = $request->status;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => 'User Info updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success'=>'User deleted successfully.']);
    }
}
