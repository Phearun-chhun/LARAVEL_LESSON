<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return Comment::get();
    //    return Comment::where('text','like','h%')->get();
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
            'post_id'=>'required|max:10|min:1|integer',
            'text'=>'required|max:255|min:3|string'
        ]);
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->text = $request->text;
        $comment->save();
        return response()->json(['sms'=>'created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $comment =Comment::find($id);
        if(!empty($comment)){
            return $comment;
        };
        return response()->json(['sms'=>'not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'post_id'=>'required|max:10|min:1|integer',
            'text'=>'required|max:255|min:3|string'
        ]);
        $comment = Comment::find($id);
        if(!empty($comment)){
            $comment->post_id = $request->post_id;
            $comment->user_id = $request->user_id;
            $comment->text = $request->text;
            $comment->save();
            return response()->json(['sms'=>'updated successfully']);
        }
        return response()->json(['sms'=>'comment not found!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::find($id);
        if(!empty($comment)){
            $comment->delete();
            return Response()->json(['sms', 'comment deleted successfully']);
        }
        return Response()->json(['sms', 'comment not found!']);
    }
}
