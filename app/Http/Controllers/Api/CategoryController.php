<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\CategoryResource;

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
        $categories = Category::all();
         $categories =  CategoryResource::collection($categories);

        return response()->json([
            'categories' => $categories,
        ],200);
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
            'category_name' => 'required|min:3|max:191',
            ]);

        $categroy = Category::create([
            'name'=> request('category_name')
        ]);

        $categroy = new CategoryResource($categroy);  
        return response()->json([
            'category'  => $categroy,
            'message' => 'Insert Successful!!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $categroy = CategoryResource::make($brand);
        return response()->json([
            'category' => $category
        ]);
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
        $request->validate([
            'category_name' => 'required|min:3|max:191',
            ]);
        $categroy = Category::find($id);
        $categroy->name = request('category_name');
        $categroy->save();

        return response()->json([
            'message' => 'Update Successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categroy = Category::find($id);
        $categroy->delete();
        return response()->json([
            'message' => 'Delete Successful!!'
        ]);
    }
}
