<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function register(Request $request){
        $user  = new User;
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = bcrypt($request-> password);
        $user->save();
        return response()->json(['sms'=>'user created successfully']);
    }
    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['message' => 'Invalid email credentials'],404);
        }
        $user= Auth::user();
        $token=$user->createToken('token')->plainTextToken;
        $cookie=cookie('jwt', $token,60*24);
        return response()->json(['message' => 'success','token'=>$token],202)->withCookie($cookie);
    }
    public function logout(Request $request ){
        $cookie = Cookie::forget('jwt');
        return response()->json(['message'=>'logged out'])->withCookie($cookie);
    }
}
