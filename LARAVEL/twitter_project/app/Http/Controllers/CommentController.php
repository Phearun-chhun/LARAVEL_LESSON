<?php

namespace App\Http\Controllers;

use App\Models\comment;
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
        return Comment::with(['user','post'])->get();
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
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->save();
        return response()->json(['sms'=>'comment created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $comment = Comment::find($id);
        if(!empty($comment)){
            return $comment;
        }
        return response()->json(['sms'=>'comment not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $comment = Comment::find($id);
        if(!empty($comment)){

            $comment->text = $request->text;
            $comment->user_id = $request->user_id;
            $comment->post_id = $request->post_id;
            $comment->save();
            return response()->json(['sms'=>'comment created']);
        }
        return response()->json(['sms'=>'comment cannot updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::find($id);
        if(!empty($comment)){
            $comment->delete();
            return response()->json(['sms'=>'comment delete']);
        }
        return response->json(['sms'=>'comment cannot delete']);
    }
}
