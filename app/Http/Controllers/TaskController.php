<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignNotification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function Carbon\Traits\get;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $tasks = Task::with('user')->get();
            return DataTables::of($tasks)
                ->editColumn('assigned_to', function ($task) {
                    return !empty($task->user->name) ? $task->user->name : 'Not Assigned';
                })
                ->addColumn('action', function ($task) {
                    return '<a href="#" id="'.$task->id.'" class="editTask btn btn-sm btn-primary">Edit</a>
                        <a href="#" id="'.$task->id.'" class="deleteTask btn btn-sm btn-danger">Delete</a>';
                })
                ->make(true);
        }

        return view('admin.task.index',[
            'projects' => Project::all(),
            'users' => User::with('roles')->get(),
            'task' => Task::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.task.create',[
            'projects' => Task::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id  = $request->project_id;
        $task->assigned_to  = $request->assigned_to;
        $task->due_date  = $request->due_date;
        $task->save();

        if ($request->assigned_to){
            $task->user()->notify(new TaskAssignNotification($task));
        }

        return response()->json(['success'=>'Task created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('admin.task.show',[
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return response()->json([
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $task->title =  $request->title;
        $task->description = $request->description;
        $task->project_id  = $request->project_id;
        $task->assigned_to  = $request->assigned_to;
        $task->due_date  = $request->due_date;
        $task->save();

        $task->user->notify(new TaskAssignNotification($task, auth()->user()->id));

        return response()->json(['success'=>'Task updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success'=>'Task deleted successfully.']);
    }
}
