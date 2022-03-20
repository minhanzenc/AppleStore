<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'producer_name','producer_status'
    ];
    protected $primaryKey = 'producer_id';
 	protected $table = 'tbl_producer';

     public function product(){
        $this->hasMany('App\Models\Product');
    }
}
