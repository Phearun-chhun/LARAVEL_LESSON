<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::with(['category'])->get();
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
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json(['sms'=>'product created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        if(!empty($product)){
            return $product ;
        }
        return response()->json(['sms'=>'product not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product =  Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json(['sms'=>'product updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        $product= Product::where('id',$id);
        if(!empty($product)){
            $product->delete();
            return response()->json(['sms'=>'product deleted']);
        }
        return response()->json(['sms'=>'product not found']);
    }
}
