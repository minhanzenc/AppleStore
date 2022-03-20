<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'product_id', 'attribute_id'
    ];
    protected $primaryKey = 'product_attribute_id';
 	protected $table = 'tbl_product_attribute';
}
