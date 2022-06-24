<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }




    public function register(Request $request){
        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = bcrypt($request-> password);
        $user->save();
        $token = $user ->createToken('myToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json([$response]);
    }
    public function login(Request $request){
        // $user = User::where('email', $request->email)->first();
        // if ($user) {
        //     if (Hash::check($request->password, $user->password)) {
        //         $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        //         $response = ['token' => $token];
        //         return response($response, 200);
        //     } else {
        //         $response = ["message" => "Password mismatch"];
        //         return response($response, 422);
        //     }
        // }        

        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
             ]);
       
             $user = User::where('email', $request->email)->first();
       
             if (!$user || !Hash::check($request->password, $user->password)) {
                return response('Login invalid', 503);
             }
             return $user->createToken($request->email)->plainTextToken;
        }
    }
    public function logout(Request $request ){
        // auth()->User()->currentAccessToken()->delete();
        auth()->user()->tokens()->delete();
        return response()->json(['sms'=>'logged out']);
    }
}
