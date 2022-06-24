<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        // return Post::find(2)->comments;
        return Post::all();
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
        $request-> validate([
            'title' => 'required|min:10|max:255',
            'user_id' => 'required',
            'description' => 'required|min:10|max:255'
        ]);
        $post =new Post();
        $post->title = $request->title;
        $post->user_id = $request->user_id;
        $post->description = $request->description;
        $post->save();
        return response()->json(['sms'=>'created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post =Post::find($id);
        if(!empty($post)){
            return $post;
        };
        return response()->json(['sms'=>'not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request-> validate([
            'title' => 'required|min:10|max:255',
            'user_id' => 'required',
            'description' => 'required|min:10|max:255'
        ]);
        $post =Post::find($id);
        if(!empty($post)){
            $post->title = $request->title;
            $post->user_id = $request->user_id;
            $post->description = $request->description;
            $post->save();
            return response()->json(['sms'=>'updated successfully']);

        };
        return response()->json(['sms'=>'post not found']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $post= Post::find($id);
        if(!empty($post)){
            $post->delete();
            return response()->json(['sms'=>'delete successfully']);
        }
        return response()->json(['sms'=>'post not found']);
    }
}
