<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $tasks = Task::where('created_by', Auth::id())->orWhere('assigned_to', Auth::user()->id)->get();
            return DataTables::of($tasks)
                ->addColumn('action', function ($task) {
                    $actions = '';
                    $actions .= '<a href="'. route('user.task.show', $task->id) .' " id="'.$task->id.'"  class="btn btn-sm btn-primary">Show</a> ';
                    if ( auth()->user()->can('submit-task') ){
                        $actions .= '<a href="javascript:void(0)" data-id="'.$task->id.'" class="submit-task btn btn-sm btn-success">Submit</a> ';
                    }
                    if ( auth()->user()->can('edit-task') ){
                        $actions .= '<a href="javascript:void(0)" data-id="'.$task->id.'" class="edit-task btn btn-sm btn-warning">Edit</a> ';
                    }
                    if ( auth()->user()->can('delete-task') ){
                        $actions .= '<a href="javascript:void(0)" data-id="'.$task->id.'"  class="deleteTask btn btn-sm btn-danger">Delete</a> ';
                    }
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user-dashboard.task.index',[
            'projects' => Project::all(),
            'users' => User::with('roles')->get(),
            'task' => Task::where('assigned_to ',auth()->user()->id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.task.create',[
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
        $task->created_by  = auth()->user()->id;
        $task->assigned_to  = $request->assigned_to;
        $task->due_date  = $request->due_date;
        $task->save();

//        if ($request->assigned_to){
//            $task->user()->notify(new TaskAssignNotification($task));
//        }


        return response()->json(['success'=>'Task created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('user-dashboard.task.show',[
            'task' => $task,
            'comments' => Comment::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return response()->json(['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id  = $request->project_id;
        $task->assigned_to  = $request->assigned_to;
        $task->due_date  = $request->due_date;
        $task->save();

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

    public function taskSubmit(Request $request, Task $task)
    {
        $task->status = $request->status;
        $task->save();
        return response()->json(['task'=>$task]);
    }
}
