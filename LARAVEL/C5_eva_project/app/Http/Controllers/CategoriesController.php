<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Category::get();
        return Category::with(['user'])->get();
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
        $categories = new Category();
        $categories->name = $request->name;
        $categories->user_id = $request->user_id;
        $categories->save();
        return response()->json(['sms'=>'categories created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $categories = Category::find($id);
        if(!empty($categories)){
            return $categories;
        };
        return response()->json(['sms'=>'categories not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $categories = Category::find($id);
        if(!empty($categories)){
            $categories->name = $request->name;
            $categories->user_id = $request->user_id;
            $categories->save();
            return response()->json(['sms'=>'categories updated successfully']);
        }
        return response()->json(['sms'=>'categories cannot updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $category= Category::where('id',$id);
        // if(!empty(category)){
        //     category->destroy();
        //     return response()->json(['sms'=>'categories deleted successfully']);
        // }
        // return response()->json(['sms'=>'categories cannot be deleted'] ) ;
        return Category::where('id',$id)->delete();
    }
}
