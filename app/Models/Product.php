<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'producer_id','category_product_id','product_name', 'product_slug','product_desc','product_content','product_parameter','product_active','product_cost','product_price','product_image','product_status','product_quantity'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';

     public function category_product(){
        return $this->belongsTo('App\Models\CategoryProduct','category_product_id');
    }

    public function producer(){
        return $this->belongsTo('App\Models\Producer','producer_id');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
