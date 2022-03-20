<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Cart;
use Alert;
use App\Models\Slider;
use App\Models\Coupon;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use Carbon\Carbon;
session_start();

class CartController extends Controller
{
    // public function save_cart(Request $request){
    // 	$productId = $request->productid_hidden;
    // 	$quantity = $request->qty;
    // 	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 

    //     $data['id'] = $product_info->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] = $product_info->product_price;
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     // Cart::destroy();
    //     return Redirect::to('/show-cart');
       
    // }

    
    public function check_coupon(Request $request){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $data = $request->all();
        if(Session::get('customer_id')){
           $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->where('coupon_used','LIKE','%'.Session::get('customer_id').'%')->first();
           if($coupon){
                return redirect()->back()->with('error','Mã khuyến mãi đã sử dụng, vui lòng nhập mã khuyến mãi khác');
            }else{
           $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable==0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,
                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,
                            );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('success','Thêm mã khuyến mãi thành công');
                    }
                }else{
                    return redirect()->back()->with('error','Mã khuyến mãi không đúng - hoặc đã hết hạn');
                }
            }
            //neu chua dang nhap
        }else{
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('success','Thêm mã khuyến mãi thành công');
                }
            }else{
                return redirect()->back()->with('error','Mã khuyến mãi không đúng - hoặc đã hết hạn');
            }
        }
    } 

    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    // $flag=$val['product_id'];
                    // break;
                }
            }
            // if($is_avaiable!=0 && $flag==$data['cart_product_id']){
            //     $cart['product_qty']=$data['cart_product_qty']+1;
            //     Session::put('cart',$cart);
            // }
            
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }   

    public function gio_hang(){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','asc')->get(); 
        
        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('category_post',$category_post);
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        Session::put('cart',$cart);
                        return redirect()->back()->with('success','Cập nhật số lượng  thành công'); 
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        return redirect()->back()->with('error','Cập nhật số lượng thất bại. Vui lòng chọn số lượng nhỏ hơn');
                    }
                }
            }
        }
        
    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            Session::forget('coupon');
            return redirect()->back()->with('success','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('error','Xóa sản phẩm thất bại');
        }

    }

    public function  count_cart_products(){
        $total=0;
        $output ='';
        foreach(Session::get('cart') as $key => $cart){
            $count=(int)($cart['product_qty']);
            $total += $count;
            
        }
        if($total>0){
            $output .= '<span>'.$total.'</span>';
        }else{
            $output .='';
        }
        echo $output;
    }

}