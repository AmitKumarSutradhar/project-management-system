<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()){
            $users = User::with('roles')->get();
            return DataTables::of($users)
                ->editColumn('role', function ($user) {
                    return $user->roles->pluck('name')->first();
                })
                ->editColumn('status', function ($user) {
                    return  $user->status == 'active' ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($user) {
                    return '<a href="javascript:void(0)" data-id="'.$user->id.'" class="editUser btn btn-sm btn-primary">Edit</a>
                        <a href="javascript:void(0)" data-id="'.$user->id.'" class="deleteUser btn btn-sm btn-danger">Delete</a>';
                })
                ->rawColumns(['role', 'status' , 'action'])
                ->make(true);
        }

        return view('admin.user.index',[
            'users' => User::all(),
            'projects' => Project::all(),
            'roles' => Role::all(),
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
        $user->load('roles');
        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->status = $request->status;
        $user->save();

        $user->syncRoles($request->role);

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
