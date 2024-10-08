<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $projects = Project::where('assigned_to',auth()->user()->id)->get();
            return DataTables::of($projects)
                ->addColumn('action', function ($project) {
                    return '<a href="#" data-id="'.$project->id.'" class="edit-project-status btn btn-sm btn-success">Update Status</a>';
                })
                ->make(true);
        }
        return view('user-dashboard.project.index',[
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id  = Auth::user()->id;
        $project->save();

        return response()->json(['success'=>'Project created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.project.show',[
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return response()->json([
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $project->status = $request->status;
        $project->save();

        return response()->json([
            'success' => 'Project status updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['success'=>'Project deleted successfully.']);
    }
}
