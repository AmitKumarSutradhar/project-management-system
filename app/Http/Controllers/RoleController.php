<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $roles = Role::all();
            return DataTables::of($roles)
                ->addColumn('action', function ($roles) {
                    return '<a href="#" data-id="'.$roles->id.'" class="editRole btn btn-sm btn-primary">Edit</a>
                        <a href="#" data-id="'.$roles->id.'" class="deleteRole btn btn-sm btn-danger">Delete</a>';
                })
                ->make(true);
        }
        return view('admin.role.index',[
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
        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json(['success'=>'Role created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return response()->json([
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->save();
        return response()->json(['success'=>'Role info updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success'=>'Role deleted successfully.']);
    }
}
