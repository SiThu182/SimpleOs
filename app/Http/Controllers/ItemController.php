<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;

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
        $items = Item::all();
        $categories = Category::all();
        $brands = Brand::all();

        return view('item',compact('items','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
         if($request->hasfile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/image',$name);
            $image = '/image/'.$name;
        }

        Item::create([
            'item_name'   => request('name'),
            'item_price'  => request('price'),
            'category_id' => request('category_id'),
            'brand_id'    => request('brand_id'),
            'image'       => $image,

        ]);

        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
         $id = request('id');
         $item = Item::find($id);
         $category = $item->category;
         $brand = $item->brand;
         $data = ['item' => $item,'category'=>$category,'brand' => $brand];

         return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $base_url = 'http://onlineshopapi.khaingthinkyi.me'; 
        $id = request('id');
        if($request->hasfile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/image',$name);
            $image = $base_url.'/image/'.$name;
        }else{
            $image = request('oldimg');
        }

        $item = Item::find($id);
        $item->item_name = request('name');
        $item->item_price = request('price');
        $item->brand_id = request('brand_id');
        $item->category_id = request('category_id');
        $item->image = $image;
        $item->save();

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('item.index');
    }
}
