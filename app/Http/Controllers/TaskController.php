<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Department;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /*===============================================
        INDEX
    ===============================================*/
    public function index()
    {
        // dd() ;
        // $tasks = Task::all() ;  // retrieve all Tasks
        $users = User::all();
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10); // Paginate Tasks
        // dd($tasks) ;
        // pass is_overdue
        // $today = \Carbon\Carbon::now() ; // not used
        // dd ($today) ;
        return view('task.tasks')
            ->with('tasks', $tasks)
            ->with('users', $users);
        //  ->with('today', $today) ;
    }

    /*===============================================
        LIST Tasks
    ===============================================*/
    public function tasklist($departmentid)
    {
        $users = User::all();
        $d_name = Department::find($departmentid);
        // ->get()  will return a collection
        $task_list = Task::where('department_id', '=', $departmentid)->get();
        return view('task.list')
            ->with('users', $users)
            ->with('d_name', $d_name)
            ->with('task_list', $task_list);
    }

    /*===============================================
        VIEW Task
    ===============================================*/
    public function view($id)
    {
        $task_view = Task::find($id);

        // Get task created and due dates
        $from = \Carbon\Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $task_view->created_at
        );
        $to = \Carbon\Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $task_view->duedate
        ); // add here the due date from create task

        $current_date = \Carbon\Carbon::now();

        // Format dates for Humans
        $formatted_from = $from->toRfc850String();
        $formatted_to = $to->toRfc850String();

        $diff_in_days = $current_date->diffInDays($to);

        // Check for overdue tasks
        $is_overdue = $current_date->gt($to) ? true : false;

        $departments = Department::all();
        return view('task.view')
            ->with('task_view', $task_view)
            ->with('departments', $departments)
            ->with('diff_in_days', $diff_in_days)
            ->with('is_overdue', $is_overdue)
            ->with('formatted_from', $formatted_from)
            ->with('formatted_to', $formatted_to);
    }

    /*===============================================
        SORT TASKS
    ===============================================*/
    public function sort($key)
    {
        $users = User::all();
        // dd ($key) ;
        switch ($key) {
            case 'task':
                $tasks = Task::orderBy('task')->paginate(10); // replace get() with paginate()
                break;

            case 'completed':
                $tasks = Task::orderBy('completed')->paginate(10);
                break;
        }

        return view('task.tasks')
            ->with('users', $users)
            ->with('tasks', $tasks);
    }

    /*===============================================
        CREATE TASK
    ===============================================*/
    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('task.create')
            ->with('departments', $departments)
            ->with('users', $users);
    }

    /*===============================================
        STORE NEW TASK
    ===============================================*/
    public function store(Request $request)
    {
        // dd($request->all() ) ;
        $tasks_count = Task::count();

        if ($tasks_count < 20) {
            // dd( $request->all()  ) ;
            // dd($request->file('photos'));

            $this->validate($request, [
                'task_title' => 'required',
                'department_id' => 'required|numeric',
            ]);

            // dd($request->all() ) ;
            // First save Task Info
            $task = Task::create([
                'department_id' => $request->department_id,
                'user_id' => $request->user,
                'task_title' => $request->task_title,
                'duedate' => $request->duedate,
            ]);

            Session::flash('success', 'Task Created');
            return redirect()->route('task.show');
        } else {
            Session::flash(
                'info',
                'Please delete some tasks, Demo max tasks: 20'
            );
            return redirect()->route('task.show');
        }
    }

    /*===============================================
        MARK TASK AS COMPLETED
    ===============================================*/
    public function completed($id)
    {
        $task_complete = Task::find($id);
        $task_complete->completed = 1;
        $task_complete->save();
        return redirect()->back();
    }

    /*===============================================
        EDIT TASK
    ===============================================*/
    public function edit($id)
    {
        $task = Task::find($id);

        // dd($taskfiles) ;
        $departments = Department::all();
        $users = User::all();
        return view('task.edit')
            ->with('task', $task)
            ->with('departments', $departments)
            ->with('users', $users);
    }

    /*===============================================
        UPDATE TASK
    ===============================================*/
    public function update(Request $request, $id)
    {
        // dd( $request->all() ) ;
        $update_task = Task::find($id);
        // dd( $update_task->id ) ;

        $this->validate($request, [
            'task_title' => 'required',
            'department_id' => 'required|numeric',
        ]);

        $update_task->task_title = $request->task_title;
        $update_task->user_id = $request->user_id;
        $update_task->department_id = $request->department_id;
        $update_task->completed = $request->completed;
        $update_task->duedate = $request->duedate;

        $update_task->save();

        Session::flash('success', 'Task was sucessfully edited');
        return redirect()->route('task.show');
    }

    /*===============================================
        DESTROY TASK
    ===============================================*/
    public function destroy($id)
    {
        $delete_task = Task::find($id);
        $delete_task->delete();
        Session::flash('success', 'Task was deleted');
        return redirect()->back();
    }
}