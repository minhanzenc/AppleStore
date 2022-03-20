<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attributes;
use App\Http\Requests;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    public function indexpage(){
    
        if(Session::get('welcome')){
            Session::put('welcome','hello');
            $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();

            $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

            $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
            
            $all_product_new = DB::table('tbl_product')->where('product_active','1')->where('product_status','2')->where('product_quantity','>=',1)->inRandomOrder('product_id')->limit(8)->get(); 

            $all_product_sale = DB::table('tbl_product')->where('product_active','1')->where('product_status','1')->where('product_quantity','>=',1)->inRandomOrder('product_id')->limit(8)->get(); 

            return view('pages.home')->with('category',$cate_product)->with('all_product_new',$all_product_new)->with('category_post',$category_post)->with('all_product_sale',$all_product_sale)->with('slider',$slider);
        }else{
            return view('pages.homepage');
        }
    }

    public function index(){
        Session::put('welcome','hello');

        $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    	$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

        
        
        $all_product_new = DB::table('tbl_product')->where('product_active','1')->where('product_status','2')->where('product_quantity','>=',1)->inRandomOrder('product_id')->limit(8)->get(); 

        $all_product_sale = DB::table('tbl_product')->where('product_active','1')->where('product_status','1')->where('product_quantity','>=',1)->inRandomOrder('product_id')->limit(8)->get(); 

    	return view('pages.home')->with('category',$cate_product)->with('all_product_new',$all_product_new)->with('category_post',$category_post)->with('all_product_sale',$all_product_sale)->with('slider',$slider);
    }

    public function product(){

        $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();

    	$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

        $all_product = DB::table('tbl_product')->where('product_active','1')->inRandomOrder('product_id')->get(); 

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    	return view('pages.product.product')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post)->with('slider',$slider);
    }

    public function blog_list(){
        $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();

    	$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
        
        $all_product = DB::table('tbl_product')->where('product_active','1')->inRandomOrder('product_id')->get(); 

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    	return view('pages.blog.blog_list')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post)->with('slider',$slider);
    }

    public function search(Request $request){

        $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();

        $keywords = $request->keywords_submit;

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        return view('pages.product.search')->with('category',$cate_product)->with('search_product',$search_product)->with('keywords',$keywords)->with('category_post',$category_post)->with('slider',$slider);

    }

    public function autocomplete_ajax(Request $request){

        $data = $request->all();

        if($data['query']){

            $product = Product::where('product_active',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();

            $output = '
            <ul  class="dropdown-menu">
                <li class="li_search_ajax">Gợi ý tìm kiếm</li>'
            ;

            foreach($product as $key => $val){
               $output .= '
               <li class="li_search_ajax"><a href="'.url('/product/'.$val->product_slug).'" ><i class="fas fa-search"></i>'.$val->product_name.'</a></li>
               ';
            }

            $output .= '</ul>';
            echo $output;
        }


    }

    public function wistlist(Request $request){
      
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

       $slider = Slider::orderBy('slider_id','ASC')->where('slider_status','1')->take(4)->get();
       
       $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
       
       $all_product = DB::table('tbl_product')->where('product_active','1')->where('product_quantity','>=',1)->inRandomOrder('product_id')->get(); 

       return view('pages.wistlist.wistlist')->with('category',$cate_product)->with('all_product',$all_product)->with('slider',$slider)->with('category_post',$category_post); //1
    
   }
    
}
