<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('project.index',[
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

//        return redirect()->route('project.index');
        return response()->json(['success'=>'Project created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project.show',[
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project.edit',[
           'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id  = Auth::user()->id;
        $project->save();

        return redirect()->route('admin.project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
//        return redirect()->route('project.index');
        return response()->json(['success'=>'Project deleted successfully.']);
    }
}
