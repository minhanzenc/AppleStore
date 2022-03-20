<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Slider;
use App\Models\Contact;

session_start();

class ContactController extends Controller
{
    public function contact(Request $request){
        //category post
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        
        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','desc')->get(); 

        $contact = Contact::where('info_id',1)->get();

        return view('pages.contact.contact')->with('category',$cate_product)->with('category_post',$category_post)->with('contact',$contact);

    }
    public function information(){
        $contact = Contact::where('info_id',1)->get();

        return view('admin.Information.add_information')->with(compact('contact'));
    }
    public function update_info(Request $request,$info_id){
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_contact = $data['info_contact'];	
        $contact->info_map = $data['info_map'];

        $get_image = $request->file('info_image');
        $path = 'public/uploads/contact/';
        if($get_image){
            unlink($path.$contact->info_logo);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }

        $contact->save();
        return redirect()->back()->with('success','Cập nhật thông tin Apple Store thành công');
    }
    public function save_info(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];	
        $contact->info_map = $data['info_map'];
        
        $get_image = $request->file('info_image');
        $path = 'public/uploads/contact/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
        }

        $contact->save();
        return redirect()->back()->with('success','Cập nhật thông tin website thành công');

    }
}