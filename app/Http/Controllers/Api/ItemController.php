<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\DB;

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
        // $items = Item::all();
        $items = DB::table('items')
                ->latest()->get();
        $items = ItemResource::collection($items);
        return response()->json([
            'items' => $items
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
            'item_name' => 'required|min:3|max:191',
            'item_price'  => 'required|min:3|max:191',
            'image' => 'required',
            'category' => 'required',
            'brand' => 'required']);
         if($request->hasfile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/image',$name);
            $image = '/image/'.$name;
        }

        $item = Item::create([
            'item_name'   => request('item_name'),
            'item_price'  => request('item_price'),
            'category_id' => request('category'),
            'brand_id'    => request('brand'),
            'image'       => $image,

        ]);

        $item = new ItemResource($item);

        return response()->json([
            'item' => $item,
            'message' => 'Insert Successful'
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
        //


          
         $item=DB::table('items')
            ->where('items.id',$id)
            ->get();
         // $category = $item->category;
         // $brand = $item->brand;
         // $data = ['item' => $item,'category'=>$category,'brand' => $brand];

        $items = ItemResource::collection($item);
        return response()->json([
            'items' => $items
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
            'item_name' => 'required|min:3|max:191',
            'item_price'  => 'required|min:3|max:191',
            'image' => 'required',
            'category' => 'required',
            'brand' => 'required']);
        
        if($request->hasfile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/image',$name);
            $image = '/image/'.$name;
        }else{
            $image = request('oldimg');
        }

        $item = Item::find($id);
        $item->item_name = request('item_name');
        $item->item_price = request('item_price');
        $item->brand_id = request('brand');
        $item->category_id = request('category');
        $item->image = $image;
        $item->save();

        
        return response()->json([
            'message'   =>  ' updated successfully!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return response()->json([
            'message' => 'Delete Successful!!' 
        ]);
    }

    


}
