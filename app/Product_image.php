<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    protected $table = "product_image";

    public function product(){
    	return $this->belongsTo('App\Product_image','id_product','id');
    }
    
}
