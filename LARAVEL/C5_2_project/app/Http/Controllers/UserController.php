<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class UserController extends Controller
{
    //
    public function index(){
        return User::all();
    }
    public function register(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user -> password = bcrypt($request-> password);
        $user -> save();
        return response()->json(['message' => 'register successful']);
    }
    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message' => 'Invalid email or password'],404);
        }
        $user= Auth::user();
        $token = $user->createToken('Token')->plainTextToken;
        $cookie = cookie('jwt',$token,60*24);
        return response()->json(['message' => 'success','token'=>$token],202)->withCookie($cookie);
    }
    public function logout(Request $request){
        $cookie= Cookie::forget('jwt');
        return response()->json(['message' => 'logget out '])->withCookie($cookie);
    }
}
