<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];

    public function items($value='')
    {
    	# code...
    	return $this->hasMany('App\Item');
    }

  
}
