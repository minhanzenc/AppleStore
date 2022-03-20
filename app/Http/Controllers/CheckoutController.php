<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Mail;

use App\Models\Customer;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Post;
use App\Models\Slider;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function login_checkout(){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('category_post',$category_post);
    }

    public function create_customer(){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

    	return view('pages.checkout.create_customer')->with('category',$cate_product)->with('category_post',$category_post);
    }


    public function checkout(){
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    	$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
        $city = City::orderby('matp','ASC')->get();

    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('city',$city)->with('category_post',$category_post);
    }


	public function order_place(Request $request){
        //Insert payment_method
     
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //Insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //Insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }else{
            Cart::destroy();

            $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

            $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
           
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('category_post',$category_post)->with('category_post',$category_post);

        }
        
        //return Redirect::to('/payment');
    }

    public function select_delivery_home(Request $request){
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>--Chọn quận / huyện--</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}
    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('maxp','ASC')->get();
    			$output.='<option>--Chọn xã / phường--</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->maxp.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    }
    

    public function confirm_order(Request $request){
        $data = $request->all();

        if($data['order_coupon']!='no'){
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_mail = $coupon->coupon_code;
            $coupon->save();
        }else{
            $coupon_mail = 'không sử dụng mã';
        }

        $this->checkOrder($request);

        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->matp = $data['city'];
        $shipping->maqh = $data['province'];
        $shipping->maxp = $data['wards'];

        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');;
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();
        
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_fee_ship =  $data['order_fee_ship'];
                $order_details->save();
            }
        }


        //send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');

        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;

        $customer = Customer::find(Session::get('customer_id'));
            
        $data['email'][] = $customer->customer_email;
        //Lấy giỏ hàng
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
            $cart_array[] = array(
                'product_name' => $cart_mail['product_name'],
                'product_price' => $cart_mail['product_price'],
                'product_qty' => $cart_mail['product_qty']
            );
            }
        }
        $shipping_array = array(
            'customer_name' => $customer->customer_name,
            'shipping_name' => $data['shipping_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => $data['shipping_method']
            
        );
        //Lấy mã giảm giá, Lấy coupon code
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $checkout_code,
        );

        Mail::send('pages.mail.mail_order',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);//send this mail with subject
            $message->from($data['email'],$title_mail);//send from this mail
        });
        
        Session::forget('coupon');
        Session::forget('cart');
   }

   //Validation
   public function checkOrder(Request $request){
    $this-> validate($request,
    [
        'shipping_name' => 'required',
        'shipping_email' => 'required|email|unique:users,email',
        'shipping_phone' => 'required|numeric|digits_between:10,10',
        'shipping_address' => 'required',
    ],
    [
        'shipping_name.required' =>'Vui lòng điền họ và tên',
        'shipping_email.required' =>'Vui lòng điền email',
        'shipping_phone.required' =>'Vui lòng điền số điện thoại',
        'shipping_address.required' =>'Vui lòng điền địa chỉ',
        'shipping_email.email' =>'Vui lòng kiểm tra lại email',
        'shipping_phone.digits_between' =>'Vui lòng kiểm tra lại số điện thoại',
        'shipping_phone.numeric' =>'Vui lòng kiểm tra lại số điện thoại',
        
    ]);
}

}