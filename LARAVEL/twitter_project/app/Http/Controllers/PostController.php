<?php

namespace App\Http\Controllers;

use App\Models\post;
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
        return Post::with(['user','comment'])->get();
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
            'title'=>'required|min:3|max:255|string',
            'description'=>'required|string'
        ]);
        // $name = $request->file('image')->getClientOriginalName();
        // $post->image = $request->file('image')->storeAs('public/image',$name);
        // $post['image']=URL('storage/image/'.$request->file('image')->getClientOriginalName());
        
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $path = public_path('images');
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        $file = $request->file('image');
        $fileName =uniqid() . '_' .trim($file->getClientOriginalName()) ;
        $post->image = asset('/images/'.$fileName);
        $post->save();
        $file->move($path, $fileName);
        return response()->json(['message' =>'post created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        if(!empty($post)){
            return $post;
        }
        return response()->json(['message'=> 'post not found']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title'=>'required|min:3|max:255|string',
            'description'=>'required|string'
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        // $name = $request->file('image')->getClientOriginalName();
        // $post->image = $request->file('image')->storeAs('public/image',$name);
        // $post['image']=URL('storage/image/'.$request->file('image')->getClientOriginalName());
        // $currentPhoto = Post::find($id)->photo;  //fecthing user current photo
        // if($request->photo != $currentPhoto){  //if not matched
        //     $userPhoto = public_path('img/profile/').$currentPhoto;
        //     if(file_exists($userPhoto)){
        //         @unlink($userPhoto); // then delete previous photo
        //     }
        //     //now insert new image
        // }
        $path = public_path('images');
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        $file = $request->file('image');
        $fileName =uniqid() . '_' .trim($file->getClientOriginalName()) ;
        $post->image = asset('/images/'.$fileName);
        $post->save();
        $file->move($path, $fileName);
        return response()->json(['message' =>'post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!empty($post)){
            $image = $post->image;
            $postPhoto = public_path('images/').$image;
            if(file_exists($postPhoto)){
                @unlink($postPhoto); // then delete previous photo
            }
            $post->delete();
            // return response()->json(['sms'=>'deleted successfully']);
            return response()->json($postPhoto);
        }
        return response()->json(['sms'=>'User can not found!!']);
    }
   
}
