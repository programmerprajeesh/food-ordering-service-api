<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();        
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
            'name'=>['required','unique:categories'],            
            'description'=>'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif','max:1024'],
            'status'=>'required'

        ]);
        
        $img_name = $request->file('image')->getClientOriginalName(); 
        $img_path = $request->file('image')->store('public/images');
        $form_data  = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $img_name,
            'image_path' => $img_path,
            'status' => $request->status,                        
        );
        return Category::create($form_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return Category::find($id);
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
        $category = Category::find($id);

        if(!$request->file('image')) {

            $category->update($request->all());

        } else {
            
            $img_name = $request->file('image')->getClientOriginalName();
 
            $img_path = $request->file('image')->store('public/images');

            $form_data  = array(
                'name' => $request->name,
                'description' => $request->description,
                'image' => $img_name,
                'image_path' => $img_path,
                'status' => $request->status,                        
            );

            $category->update($form_data);

        } 

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function sorted(Request $request)
    {
        // $collection = collect([
        //     ['name' => 'Taylor Otwell', 'age' => 34],
        //     ['name' => 'Abigail Otwell', 'age' => 30],
        //     ['name' => 'Taylor Otwell', 'age' => 36],
        //     ['name' => 'Abigail Otwell', 'age' => 32],
        // ]);

        // $sorted = $collection->sortBy([
        //     ['name', 'asc'],
        //     ['age', 'desc'],
        // ]);

        // $sorted->values()->all();
        return response("abc");
    }
  
}
