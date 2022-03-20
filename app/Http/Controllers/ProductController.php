<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Producer;
use App\Models\CategoryProduct;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Attributes;
use App\Models\ProductAttribute;

session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();
        $cate_product = CategoryProduct::orderBy('category_product_id','ASC')->get();
        $all_producer = Producer::orderBy('producer_id','DESC')->get(); 
        // $color = Attributes::where('attribute_name','màu')->get();
        // dd($color);
    	return view('admin.Product.add_product')->with(compact('cate_product'))->with(compact('all_producer'))->with(compact('category_post'));
    }
    public function all_product(){
        $this->AuthLogin();

        $all_product = Product::with('category_product')->with('producer')->orderBy('product_id','DESC')->get();
        return view('admin.Product.all_product')->with(compact('all_product',$all_product));

    	
    }
    public function save_product(Request $request){
       
        $this->AuthLogin();
        $this->checkProductAdd($request); 
    	$data = $request->all();
        $product = new Product();

        $product_cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
       
    	$product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug']; 
        $product->product_quantity = $data['product_quantity'];
        $product->product_cost = $product_cost;
    	$product->product_price = $product_price;
    	$product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_parameter = $data['product_parameter'];
        $product->product_active = $data['product_active'];
        $product->product_status = $data['product_status'];
        $product->producer_id = $data['producer_id'];
        $product->category_product_id = $data['category_product_id'];
        $get_image = $request->file('product_image');
        $name = $product->product_name;

        $check = Product::where('product_name',$name)->exists();
        if($check)
        {
            return Redirect()->back()->with('error','Sản phẩm đã tồn tại, Vui lòng kiểm tra lại.')->withInput();
        }
        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
      
        //thêm Hình Ảnh
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $product->product_image=$new_image;
        }
       
        $product->save();
        $pro_id=$product->product_id;
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        // foreach($request->id_atr as $value){
        // $att = new ProductAttribute();
        // $att->product_id=$pro_id;
        // $att->attribute_id=$value;
        // $att->save();
        // }
        return Redirect()->back()->with('success','Thêm sản phẩm thành công');
        
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_active'=>1]);
     
        return Redirect::to('all-product')->with('success','Hiển thị sản phẩm');

    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_active'=>0]);
        
        return Redirect::to('all-product')->with('success','Ẩn sản phẩm');
    }
    public function edit_product($product_id){
        $this->AuthLogin();

        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();
        $cate_product = CategoryProduct::orderBy('category_product_id','ASC')->get();
        $all_producer = Producer::orderBy('producer_id','DESC')->get(); 
        $all_product = Product::find($product_id);

        return view('admin.Product.edit_product')->with(compact('cate_product'))->with(compact('all_producer'))->with(compact('category_post'))->with(compact('all_product'));
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $this->checkProductUpdate($request); 

        $data = $request->all();
        $product = Product::find($product_id);

        $product_cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug']; 
        $product->product_quantity = $data['product_quantity'];
        $product->product_cost = $product_cost;
    	$product->product_price = $product_price;
    	$product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_parameter = $data['product_parameter'];
        $product->product_active = $data['product_active'];
        $product->product_status = $data['product_status'];
        $product->producer_id = $data['producer_id'];
        $product->category_product_id = $data['category_product_id'];
        $product_image = $product->product_image;
        $get_image = $request->file('product_image');  
        
        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        
        if($get_image){
            $product_image_old = $product->product_image;
            $pathh = 'public/uploads/product/'.$product_image;
            unlink($pathh);

            $galleryy = Gallery::where('gallery_image',$product_image_old)->first();
            $pathh = 'public/uploads/gallery/'.$product_image_old;
            unlink($pathh);
            if($galleryy != null){
                $galleryy->delete();
            }

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $product->product_image=$new_image;
        }
        $product->save();
        if($get_image){
        $pro_id=$product->product_id;
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        }
     
        return Redirect::to('/all-product')->with('success','Cập nhật sản phẩm thành công');
    }
    public function delete_product($product_id){
        $this->AuthLogin();

        $product = Product::find($product_id);
        $product_image = $product->product_image;
        if($product_image){
            unlink('public/uploads/product/'.$product_image);
        }
        $product->delete();
    
        return Redirect()->back()->with('success','Xóa sản phẩm thành công');

    }
    //End Admin Page
    public function details_product($product_slug){
        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();
        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get(); 
        
        
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_product_id','=','tbl_product.category_product_id')
        ->where('tbl_product.product_slug',$product_slug)->get();

        foreach($details_product as $key => $value){
            $category_product_id = $value->category_product_id;
            $product_id = $value->product_id;
            $meta_title = $value->product_name;
            $cate_slug = $value->category_product_slug;
            $product_cate = $value->category_product_name;
        }
       
        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get();


        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_product_id','=','tbl_product.category_product_id')
        ->where('tbl_category_product.category_product_id',$category_product_id)->where('product_active','1')->whereNotIn('tbl_product.product_slug',[$product_slug])->inRandomOrder('product_id')->limit(8)->get();
        foreach($related_product as $key => $value){
           
            $product_id_late = $value->product_id;
            
        }
        $ratinglate = Rating::where('product_id',$product_id_late)->avg('rating');
        $ratinglate = round($ratinglate);

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        return view('pages.product.show_details')->with('category',$cate_product)->with('relate',$related_product)->with('product_details',$details_product)->with('category_post',$category_post)->with('gallery',$gallery)->with('meta_title',$meta_title)->with('cate_slug',$cate_slug)->with('product_cate',$product_cate)->with('rating',$rating)->with('ratinglate',$ratinglate);

    }


    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',1)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',1)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= 
            '<div class="product__details__tab__content__item">
                <div class="blog__hero__text">
                    <h2</h2>
                    <ul>
                        <li>'.$comm->comment_date.'</li>
                    </ul>
                </div>
                <h5>'.$comm->comment_name.'</h5>
                <p>'.$comm->comment.'</p>
            </div>';
                                    
            foreach($comment_rep as $key => $rep_comment)  {
                if($rep_comment->comment_parent_comment==$comm->comment_id){                        
                    $output.= 
                    '<div class="product__details__tab__content__item" style="margin-left:20px;">
                        <div class="blog__hero__text">
                        <img src="'.url('/public/frontend/img/admin.png').'" class="">
                        </div>
                        <h5>Quản Trị Viên</h5>
                        <p>'.$rep_comment->comment.'</p>
                    </div>';
                }
            }
        }
        echo $output;
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 0;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }

    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.Comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;
        $comment->comment_name = 'Quản Trị Viên';
        $comment->save();

    }

    //Validation
    public function checkProductAdd(Request $request){
        $this-> validate($request,
        [
            'product_name' => 'required',
            'product_slug' => 'required',
            'product_quantity' => 'required|numeric|min:1',
            'product_image' => 'required',
            'product_cost' => 'required|min:1',
            'product_price' => 'required|min:1',
            'product_desc' => 'required',
            'product_content' => 'required',
            'product_parameter' => 'required',
        ],
        [
            'product_name.required' =>'Vui lòng điền thông tin',
            'product_slug.required' =>'Vui lòng điền thông tin',
            'product_quantity.required' =>'Vui lòng điền thông tin',
            'product_image.required' =>'Vui lòng điền thông tin',
            'product_cost.required' =>'Vui lòng điền thông tin',
            'product_price.required' =>'Vui lòng điền thông tin',
            'product_desc.required' =>'Vui lòng điền thông tin',
            'product_content.required' =>'Vui lòng điền thông tin',
            'product_parameter.required' =>'Vui lòng điền thông tin',
            'product_price.numeric' =>'Vui lòng điền thông tin là số',
            'product_quantity.numeric' =>'Vui lòng điền thông tin là số',
            'product_quantity.min' =>'Vui lòng điền thông tin lớn hơn 0',
            'product_cost.min' =>'Vui lòng điền thông tin lớn hơn 0',
            'product_price.min' =>'Vui lòng điền thông tin lớn hơn 0',
        ]);
    }
    public function checkProductUpdate(Request $request){
        $this-> validate($request,
        [
            'product_name' => 'required',
            'product_slug' => 'required',
            'product_quantity' => 'required|numeric|min:1',
            'product_cost' => 'required',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_content' => 'required',
            'product_parameter' => 'required',
        ],
        [
            'product_name.required' =>'Vui lòng điền thông tin',
            'product_slug.required' =>'Vui lòng điền thông tin',
            'product_quantity.required' =>'Vui lòng điền thông tin',
            'product_cost.required' =>'Vui lòng điền thông tin',
            'product_price.required' =>'Vui lòng điền thông tin',
            'product_desc.required' =>'Vui lòng điền thông tin',
            'product_content.required' =>'Vui lòng điền thông tin',
            'product_parameter.required' =>'Vui lòng điền thông tin',
            'product_quantity.numeric' =>'Vui điền thông tin là số',
            'product_quantity.min' =>'Vui lòng điền thông tin lớn hơn 0',
        ]);
    }
}