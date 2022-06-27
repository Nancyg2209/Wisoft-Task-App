<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = Task::
        $centers = Center::all();
        return view('centers.centers')->with('centers', $centers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centers_count = Center::count();

        if ($centers_count < 10) {
            // dd( $request->all()  ) ;
            $this->validate($request, [
                'center' => 'required',
                'center_location' => 'required',
            ]);

            $center_new = new Center();
            $center_new->center_name = $request->center;
            $center_new->center_location = $request->center_location;
            $center_new->center_postcode = $request->center_postcode;
            $center_new->opening_date = $request->center_openingDate;
            $center_new->save();
            Session::flash('success', 'Center Created');
            return redirect()->route('center.show');
        } else {
            Session::flash('info', 'Please delete some centers, Demo max: 10');
            return redirect()->route('center.show');
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
        $edit_center = Center::find($id);
        return view('center.edit')->with('edit_center', $edit_center);
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
        $update_center = Center::find($id);
        $update_center->center_name = $request->name;
        $update_center->save();
        Session::flash('success', 'Center was sucessfully edited');
        return redirect()->route('center.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_center = Center::find($id);
        $delete_center->delete();
        Session::flash(
            'success',
            'Center was deleted and tasks associated with it'
        );
        return redirect()->back();
    }
}