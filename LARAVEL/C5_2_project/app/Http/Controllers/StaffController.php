<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Staff::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->position = $request->position;
        $staff->department = $request->department;
        $staff->save();
        return response()->json(['message' => 'staff created']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $staff = Staff::find($id);
        if(!empty($staff)){
            return $staff;
        }
        return response()->json(['message'=>'staff not found'],404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $staff = Staff::find($id);
        $staff->name = $request->name;
        $staff->position = $request->position;
        $staff->department = $request->department;
        $staff->save();
        return response()->json(['message' => 'staff updated successfully'],);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $staff = Staff::where('id',$id);
        if(!empty($staff)){
            $staff->delete();
            return response()->json(['message'=>'staff deleted '],202);
        }
        return response()->json(['message'=>'staff not found'],404);
    }
}
