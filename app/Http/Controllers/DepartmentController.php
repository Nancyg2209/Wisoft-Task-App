<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use App\Models\Task;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = Task::
        $departments = Department::all();
        return view('departments.departments')->with(
            'departments',
            $departments
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departments_count = Department::count();

        if ($departments_count < 10) {
            // dd( $request->all()  ) ;
            $this->validate($request, [
                'department' => 'required',
            ]);

            $department_new = new Department();
            $department_new->department_name = $request->department;
            $department_new->save();
            Session::flash('success', 'Department Created');
            return redirect()->route('department.show');
        } else {
            Session::flash(
                'info',
                'Please delete some departments, Demo max: 10'
            );
            return redirect()->route('department.show');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_department = Department::find($id);
        return view('department.edit')->with(
            'edit_department',
            $edit_department
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_department = Department::find($id);
        $update_department->department_name = $request->name;
        $update_department->save();
        Session::flash('success', 'Department was sucessfully edited');
        return redirect()->route('department.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_department = Department::find($id);
        $delete_department->delete();
        Session::flash(
            'success',
            'Department was deleted and tasks associated with it'
        );
        return redirect()->back();
    }

    // does not work see  /app/Http/Controllers/Auth/LoginController.php
    // public function logout () {
    //     //logout user
    //     auth()->logout();
    //     // redirect to homepage or login
    //     return redirect('/login');
    // }
}