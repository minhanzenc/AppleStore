<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Mail;
use Session;
use DB;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Slider;
use App\Models\Product;

class MailController extends Controller
{
    public function send_coupon_regular($coupon_time,$coupon_condition,$coupon_number,$coupon_code){
		//get customer
		$customer = Customer::where('customer_vip','=',NULL)->get();

		$coupon = Coupon::where('coupon_code',$coupon_code)->first();
		$start_coupon = $coupon->coupon_date_start;
		$end_coupon = $coupon->coupon_date_end;

		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

		$title_mail = "Mã khuyến mãi ngày".' '.$now;
		
		$data = [];
		foreach($customer as $normal){
			$data['email'][] = $normal->customer_email;
		}
		$coupon = array(
			
			'start_coupon' =>$start_coupon,
			'end_coupon' =>$end_coupon,
			'coupon_time' => $coupon_time,
			'coupon_condition' => $coupon_condition,
			'coupon_number' => $coupon_number,
			'coupon_code' => $coupon_code
		);
		Mail::send('pages.send_coupon_regular',  ['coupon'=>$coupon] , function($message) use ($title_mail,$data){
	            $message->to($data['email'])->subject($title_mail);//send this mail with subject
	            $message->from($data['email'],$title_mail);//send from this mail
	    });
  
		 return redirect()->back()->with('success','Gửi mã khuyến mãi khách thường thành công');
    }

    public function send_coupon_vip($coupon_time,$coupon_condition,$coupon_number,$coupon_code){
		//get customer
		$customer_vip = Customer::where('customer_vip',1)->get();

		$coupon = Coupon::where('coupon_code',$coupon_code)->first();
		$start_coupon = $coupon->coupon_date_start;
		$end_coupon = $coupon->coupon_date_end;

		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

		$title_mail = "Mã khuyến mãi ngày".' '.$now;
		
		$data = [];
		foreach($customer_vip as $vip){
				$data['email'][] = $vip->customer_email;
		}
		$coupon = array(
			'start_coupon' =>$start_coupon,
			'end_coupon' =>$end_coupon,
			'coupon_time' => $coupon_time,
			'coupon_condition' => $coupon_condition,
			'coupon_number' => $coupon_number,
			'coupon_code' => $coupon_code
		);
		
		Mail::send('pages.send_coupon_vip', ['coupon' => $coupon] , function($message) use ($title_mail,$data){
	            $message->to($data['email'])->subject($title_mail);//send this mail with subject
	            $message->from($data['email'],$title_mail);//send from this mail
	    });
	    
  
		return redirect()->back()->with('success','Gửi mã khuyến mãi khách VIP thành công');
    }

	//Password

	public function iforgot(Request $request){

		$category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();
	   
		$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
	   
	   $all_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->paginate(6); 


	   return view('pages.checkout.forgot_pass')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post); //1
   	}

    public function recover_pass(Request $request){
    	$data = $request->all();
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
		$title_mail = "Lấy lại mật khẩu hqdworld.com".' '.$now;
		$customer = Customer::where('customer_email','=',$data['email_account'])->first();
		
		
		if($customer){
			$token_random = Str::random();
			$customer_id = $customer->customer_id;
            $customer = Customer::find($customer_id);
            $customer->customer_token = $token_random;
            $customer->save();
            //send mail
              
            $to_email = $data['email_account'];//send to this email
            $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
             
            $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']); //body of mail.blade.php
                
            Mail::send('pages.checkout.forgot_pass_notify', ['data'=>$data] , function($message) use ($title_mail,$data){
		        $message->to($data['email'])->subject($title_mail);//send this mail with subject
		        $message->from($data['email'],$title_mail);//send from this mail
	    	});
            //--send mail
            return redirect()->back()->with('success', 'Gửi mail thành công, vui lòng vào Email để cập nhật mật khẩu.');
           
        }else{ 	
            return redirect()->back()->with('error', 'Email này không hợp lệ hoặc không được hỗ trợ.');
        }
    }

    public function update_new_pass(Request $request){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();
        
    	$cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
         
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->paginate(6); 

    	return view('pages.checkout.new_pass')->with('category',$cate_product)->with('all_product',$all_product)->with('category_post',$category_post);
    }

	public function reset_new_pass(Request $request){
    	$data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->first();
        
        if($customer){
            $customer_id = $customer->customer_id;
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('success', 'Mật khẩu đã cập nhật, vui lòng đăng nhập.');
        }else{
            return redirect('iforgot')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn.');
        }
    }

    public function mail_example(){
    	return view('pages.send_coupon_vip');
    }
   
    public function mail_order(){
        return view('pages.mail.mail_order');    
    }

    



}