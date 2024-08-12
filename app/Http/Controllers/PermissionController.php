<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
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
            $role = Role::all();
            return DataTables::of($role)
                ->addColumn('action', function ($permission) {
                    return '<a href="#" data-id="'.$permission->id.'" class="assignPermission btn btn-sm btn-primary">Assign Permission</a>';
                })
                ->make(true);
        }
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return response()->json(['success'=>'Permission created successfully.']);
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
