<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        // return User::all();
        // return User::find($id)->comments;
        return User::with(['posts','comments'])->get();

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
        $request->validate([
            'name'=>'required|min:3|max:20|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $password = $request->password;
        $user->password = Hash::make($password);
        $user->save();
        return response()->json(['sms'=>'created successfully']);
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
        $user = User::with(['posts','comments'])->find($id);
        if(!empty($user)){
            return $user;
        };
        return response()->json(['sms'=>'user not found']);
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
        //
        $request->validate([
            'name'=>'required|min:3|max:15|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string',
        ]);
        $user = User::find($id);
        if(!empty($user)){
            $user->name = $request->name;
            $user->email = $request->email;
                $password = $request->password;
                $user->password = Hash::make($password);
                $user->save();
            return response()->json(['message'=>'user updated successfully']);
        }
        return response()->json(['message'=>'user can not updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::where('id', $id);
        if($user){
            $user->delete();
            return response()->json(['sms'=>'deleted successfully']);
        }
        return response()->json(['sms'=>'User can not found!!']);
    }
}
