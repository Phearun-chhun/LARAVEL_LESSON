<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
      return     Post::find(1)->comments;
        // return comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:posts|max:100|min:5',
            'description'=>'required|max:100|min:10'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
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
        $post = Post::find($id);
        if(!empty($post)){
            return $post;
        }
        return Response()->json(['sms', 'user not found!']);
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
        $request->validate([
            'title'=>'required|unique:posts|max:100|min:5',
            'description'=>'required|max:100|min:10'
        ]);
        $post = Post::find($id);
        if(!empty($post)){
            $post->title = $request->title;
            $post->description = $request->description;
            $post->save();
            return response()->json(['sms'=>'updated successfully']);
        }
        return response()->json(['sms'=>'use not found!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!empty($post)){
            $post->delete();
            return Response()->json(['sms', 'post deleted successfully']);
        }
        return Response()->json(['sms', 'post not found!']);
    }
}
