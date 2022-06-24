<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        return User::all();
    }
    public function getUserAndPost()
    {
        return User::with(['post'])->get();
    }
    public function getUserAndPostComment()
    {
        return User::with(['post','post.comment'])->get();
    }
    public function getOneUserAndPostComment($id)
    {
        return User::with(['post','post.comment'])->find($id);
    }
    public function getUserAndCountPostComment()
    {
      return User::withCount(['post','comment'])->get();
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
            return $user;
        }
        return response()->json(['message'=>'user not found']);
    }



 
    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:15|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user -> password = bcrypt($request-> password);
        $user -> save();
        return response()->json(['message' => 'register successful']);
    }

    public function destroy($id)
    {
        //
        $comment = Comment::where('id',$id);
        if(!empty($comment)){
            $comment->delete();
            return response()->json(['sms'=>'comment delete']);
        }
        return response->json(['sms'=>'comment cannot delete']);
    }
}
