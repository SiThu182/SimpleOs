<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
    	'item_name','item_price','category_id','brand_id','image'
    ];

    public function category($value='')
    {
    	# code...
    	return $this->belongsTo('App\Category');
    }

    public function brand($value='')
    {
    	return $this->belongsTo('App\Brand');
    }

    
}
