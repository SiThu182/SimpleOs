<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Resources\BrandResource;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $brands = BrandResource::collection($brands);
        return response()->json([
            'brands' => $brands
        ]);
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
            'brand_name' => 'required|min:3|max:191',
            ]);

        $brand = Brand::create([
            'name'=> request('brand_name')
        ]);

        $brand = new BrandResource($brand);  
        return response()->json([
            'brand'  => $brand,
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
        $brand = Brand::find($id);
        $brand = BrandResource::make($brand);
        return response()->json([
            'brand' => $brand
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
            'brand_name' => 'required|min:3|max:191',
            ]);
        $brand = Brand::find($id);
        $brand->name = request('brand_name');
        $brand->save();

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
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json([
            'message' => 'Delete Successful!!'
        ]);
    }
}
