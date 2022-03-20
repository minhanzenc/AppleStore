<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'category_product_name', 'category_product_slug','category_product_status','category_product_image','category_order'
    ];
    protected $primaryKey = 'category_product_id';
 	protected $table = 'tbl_category_product';

     public function product(){
        $this->hasMany('App\Models\Product');
    }

}
