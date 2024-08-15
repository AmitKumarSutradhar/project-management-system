<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Show permission.
     */
    public function showAllPermission()
    {
        $permission = Permission::all();
        return response()->json(['permission'=>$permission]);
    }
    /**
     * Show permission.
     */
    public function assignPermissionToRole(Request $request)
    {
        $role = Role::findOrFail($request->roleId);
        $newPermissions = $request->permission;
        $role->permissions()->sync($newPermissions);
        return response()->json(['success' => 'Permission assigned to user successfully.']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $permission = Permission::all();
            return DataTables::of($permission)
                ->addColumn('action', function ($permission) {
                    return '<a href="#" data-id="'.$permission->id.'" class="editPermission btn btn-sm btn-primary">Edit</a>
                        <a href="#" data-id="'.$permission->id.'" class="deletePermission btn btn-sm btn-danger">Delete</a>';
                })
                ->make(true);
        }
        return view('admin.permission.index',[
//            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()){
            $roles = Role::all();
            return DataTables::of($roles)
                ->editColumn('permissions', function ($role) {
                    return $role->permissions->pluck('name')->map(function($name) {
                        return '<span class="bg-success text-white rounded rounded-2 px-3">'.$name.'</span >';
                    })->join(' ');
                })
                ->addColumn('action', function ($role) {
                    $permissions = $role->permissions->pluck('id')->toArray(); // Get the permission IDs as an array
                    $permissionsJson = htmlspecialchars(json_encode($permissions), ENT_QUOTES, 'UTF-8');

                    return '<a href="#"
                                data-id="' . $role->id . '"
                                data-permissions="' . $permissionsJson . '"
                                class="assignPermission btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#assign-permission-modal">Assign Permission</a>';
                })
                ->rawColumns(['permissions','action'])
                ->make(true);
        }
        return view('admin.permission.assign-permission',[
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        return response()->json([
            'permission'=> $request,
            'success'=> 'Permission added successfully.'
        ]);
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
    public function edit(Permission $permission)
    {
        return response()->json([
            'permission'=> $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->name = $request->name;
        $permission->save();
        return response()->json(['success'=>'Permission info updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success'=>'Permission deleted successfully.']);
    }


}
