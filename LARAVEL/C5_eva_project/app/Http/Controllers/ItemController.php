<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Item::get();   
        return Item::with(['category','user'])->get();   
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
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'user_id' => 'required',
        ]);
        $item =new Item();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->user_id = $request->user_id;
        $item->save();
        return response()->json(['sms'=>'created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item =Item::with(['category','user'])->find($id);
        if(!empty($item)){
            return $item;
        };
        return response()->json(['sms'=>'not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'user_id' => 'required',
        ]);
        $item = Item::find($id);
        if(!empty($item)){
            $item->category_id = $request->category_id;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->user_id = $request->user_id;
            $item->save();
            return response()->json(['message'=>'user updated successfully']);
        }
        return response()->json(['message'=>'user can not updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item= Item::find($id);
        if(!empty($item)){
            $item->delete();
            return response()->json(['sms'=>'delete successfully']);
        }
        return response()->json(['sms'=>'item not found']);
    }
}
