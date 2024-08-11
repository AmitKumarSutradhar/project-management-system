<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use function Illuminate\Foundation\Configuration\respond;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $projects = Project::all();
            return DataTables::of($projects)
                ->addColumn('action', function ($project) {
                    return '<a href="#" id="'.$project->id.'" class="editProject btn btn-sm btn-primary">Edit</a>
                        <a href="#" id="'.$project->id.'" class="deleteProject btn btn-sm btn-danger">Delete</a>';
                })
                ->make(true);
        }
        return view('admin.project.index',[
//            'projects' => Project::all(),
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
        return view('admin.project.show',[
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
//        return view('admin.project.edit',[
//           'project' => $project,
//        ]);
        return response()->json([
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

        return response()->json([
            'success' => 'Project updated successfully.',
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
