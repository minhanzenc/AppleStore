<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Models\Attributes;
use Session;
session_start();

class AttributesController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_attribute(){
        $this->AuthLogin();
    	return view('admin.Attribute.add_attribute');
    }
    
    public function list_attribute(){
        $this->AuthLogin();

        $attribute = Attributes::orderBy('attribute_id','ASC')->get();
    	
    	return view('admin.Attribute.list_attribute')->with(compact('attribute'));


    }
    public function save_attribute(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $attribute = new Attributes();
    	$attribute->attribute_name = $data['attribute_name'];
        $attribute->attribute_value = $data['attribute_value'];
        
        $attribute->save();

    	return Redirect()->back()->with('success','Thêm thuộc tính thành công');
    }
}
