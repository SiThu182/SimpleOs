<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Category;
use  App\Brand;
class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
             'item_name'  => $this->item_name,
            'item_price'  => $this->item_price,
            'categories' => new CategoryResource(Category::find($this->category_id)),
            'brands'    => new BrandResource(Brand::find($this->brand_id)),
            'image'       => $this->image,
        ];
    }
}
