<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'attribute_name','attribute_value','product_id'
    ];
    protected $primaryKey = 'attribute_id';
 	protected $table = 'tbl_attributes';
}
