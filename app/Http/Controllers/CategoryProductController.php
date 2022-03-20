<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\Slider;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
session_start();

class CategoryProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.CategoryProduct.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();

        $category_product =  CategoryProduct::where('category_product_id',1)->orderBy('category_product_id','DESC')->get();
        
    	$all_category_product = CategoryProduct::orderBy('category_product_id','DESC')->orderBy('category_order','ASC')->get();
    	$manager_category_product  = view('admin.CategoryProduct.all_category_product')->with('all_category_product',$all_category_product)->with('category_product',$category_product);
        
    	return view('admin_layout')->with('admin.CategoryProduct.all_category_product', $manager_category_product);


    }
    public function save_category_product(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $category_product = new CategoryProduct();
    	$category_product->category_product_name = $data['category_product_name'];
        $category_product->category_product_slug = $data['category_product_slug'];
        $category_product->category_product_status = $data['category_product_status'];
        $get_image = $request->file('category_product_image');
        $name = $category_product->category_product_name;

        $check = CategoryProduct::where('category_product_name',$name)->exists();
        if($check)
        {
            return Redirect()->back()->with('error','Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/categoryproduct',$new_image);
            $category_product->category_product_image=$new_image;
            $category_product->save();
            return Redirect()->back()->with('success','Thêm danh mục sản phẩm thành công');
        }else{
            return Redirect()->back()->with('error','Vui lòng thêm hình ảnh');
        }

    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_product_id',$category_product_id)->update(['category_product_status'=>1]);
    
        return Redirect::to('all-category-product')->with('success','Hiển thị danh mục ');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_product_id',$category_product_id)->update(['category_product_status'=>0]);

        return Redirect::to('all-category-product')->with('success','Ẩn danh mục ');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = CategoryProduct::orderBy('category_product_id','DESC')->get();

        $edit_category_product = DB::table('tbl_category_product')->where('category_product_id',$category_product_id)->get();

        $manager_category_product  = view('admin.CategoryProduct.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category',$category);

        return view('admin_layout')->with('admin.CategoryProduct.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $category_product = CategoryProduct::find($category_product_id);
    	$category_product->category_product_name = $data['category_product_name'];
        $category_product->category_product_slug = $data['category_product_slug'];
        $category_product->category_product_status = $data['category_product_status'];
        $category_product_image = $category_product->category_product_image;
        $get_image = $request->file('category_product_image');
        $name = $category_product->category_product_name;

        $check = CategoryProduct::where('category_product_name',$name)->exists();
        if($check)
        {
            return Redirect()->back()->with('error','Danh mục đã tồn tại, Vui lòng kiểm tra lại.');
        }
      
        if($get_image){
            $category_image_old = $category_product->category_product_image;
            $path = 'public/uploads/categoryproduct/'.$category_product_image;
            unlink($path);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/categoryproduct',$new_image);
            $category_product->category_product_image=$new_image;
        }
        $category_product->save();
        return Redirect::to('/all-category-product')->with('success','Cập nhật danh mục sản phẩm thành công');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        $category_product = CategoryProduct::find($category_product_id);
        $category_product_image = $category_product->category_product_image;
        if($category_product_image){
            unlink('public/uploads/categoryproduct/'.$category_product_image);
        }
        $category_product->delete();
    
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }

    public function arrange_category(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = CategoryProduct::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Updated'; 
    }

    //End Function Admin Page
    public function show_category_home($category_product_slug){
        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
        
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_product_id','=','tbl_category_product.category_product_id')->where('tbl_category_product.category_product_slug',$category_product_slug)->where('product_active','1')->orderby('product_id','desc')->get();
        
        $category_name = CategoryProduct::where('tbl_category_product.category_product_slug',$category_product_slug)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('category_post',$category_post);
    }

}
