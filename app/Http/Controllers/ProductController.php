<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'name'=>'required|unique:products',
            'category'=>'required' ,
            'unit_price'=>'required',
            'description'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:250',
            'status'=>'required'

        ]);

        $img_name = $request->file('image')->getClientOriginalName(); 
        $img_path = $request->file('image')->store('public/images');
        
        $form_data  = array(
            'name' => $request->name,
            'category' => $request->category,
            'unit_price' => $request->unit_price,
            'description' => $request->description,
            'image' => $img_name,
            'image_path' => $img_path,
            'status' => $request->status,                        
        );

        return Product::create($form_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
        $product = Product::find($id);

        if(!$request->file('image')) {

            $category->update($request->all());

        } else {
            $img_name = $request->file('image')->getClientOriginalName();
 
            $img_path = $request->file('image')->store('public/images');

            $form_data  = array(
                'name' => $request->name,
                'category' => $request->category,
                'unit_price' => $request->unit_price,
                'description' => $request->description,
                'image' => $img_name,
                'image_path' => $img_path,
                'status' => $request->status,                        
            );

            $category->update($form_data);

        } 
        
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
