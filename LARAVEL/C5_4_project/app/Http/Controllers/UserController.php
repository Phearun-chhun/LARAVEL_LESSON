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
        return User::all();
    }
    public function getOneUserAndProductCategories()
    {
        return User::with(['product','product.category'])->get();
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(['sms'=>'user created']);
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
        $user = User::find($id);
        if(!empty($user)){
            return $user ;
        }
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
        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(['sms'=>'user updated']);
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
        $user= User::where('id',$id);
        if(!empty($user)){
            $user->delete();
            return response()->json(['sms'=>'user deleted']);
        }
        return response()->json(['sms'=>'user not found']);
    }
    public function register(Request $request)
    {
        //
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $token = $user->createToken($request->password);
        $response=[
            'user'  => $user,
            'token' => $token
        ];
        return response()->json([$response]);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user= User::where('email', $request->email)->first();
        if(!$user||!Hash::check($request->password, $user->password)){
            return response ('longin invalid ',503);
        }
        return $use->createToken($request->email)->plainTextToken;
    }
    public function logout(Request $request){{
        auth()->user()->tokens()->delete();
        return response()->json(['sms'=>'logged out']);
    }
}
