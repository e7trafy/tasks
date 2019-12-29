<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $tasks = Task::with('user')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $tasks = Auth::user()->tasks()->orderBy('due_date', 'desc')->paginate(10);
        }
        if ($request->ajax()) {
            $view = view('tasks.tasksList', compact('tasks'))->render();
            return response()->json(['count' => $tasks->count() ,'html' => $view]);
        }
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {

        $user = $request->member;
        $date = \Carbon\Carbon::parse($request->due_date);
        $description = $request->task_desc;
        $task = Task::create([
            'description' => $description,
            'due_date' => $date,
            'user_id' => $user
        ]);

        $task->load('user');
        $view = View::make('tasks.singleTask')->with('task', $task)->render();

        return response()->json([
            'error' => false,
            'data' => $view,
        ]);

    }

    public function complete($id)
    {
        $task = Task::find($id);
        $task->is_complete = true;
        $task->save();
        return response()->json([
            'error' => false,
            'data' => $task,
        ]);
    }
}
