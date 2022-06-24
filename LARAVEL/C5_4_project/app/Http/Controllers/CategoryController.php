<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Category::with(['product'])->get();
    }
     public function countProductEachCategory()
    {
      return Category::withCount(['product'])->get();
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
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = $request->user_id;
        $category->save();
        return response()->json(['sms'=>'category created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::find($id);
        if(!empty($category)){
            return $category ;
        }
        return response()->json(['sms'=>'category not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $category = Category::find($id);
        $category->name = $request->name;
        $category->user_id = $request->user_id;
        $category->save();
        return response()->json(['sms'=>'category updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category= Category::where('id',$id);
        if(!empty($category)){
            $category->delete();
            return response()->json(['sms'=>'category deleted']);
        }
        return response()->json(['sms'=>'category not found']);
    }
}
