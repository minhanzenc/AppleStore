<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Post;
use App\CategoryPost;
session_start();

class CustomerController extends Controller
{
    //Admin

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_customer_admin(){
        $this->AuthLogin();
    	return view('admin.Customer.add_customer_admin');
    }
    
    public function list_customer(){
        $this->AuthLogin();

        $all_customer = Customer::orderBy('customer_id','DESC')->paginate(5);
    	
    	return view('admin.Customer.list_customer')->with(compact('all_customer'));
    }

    public function save_customer(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $customer = new Customer();
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->save();

    	Session::put('message','Thêm khách hàng thành công');
    	return Redirect()->back();
    }
    
    public function edit_customer($customer_id){
        $this->AuthLogin();

        $all_customer = Customer::find($customer_id);
        
        return view('admin.Customer.edit_customer')->with(compact('all_customer'));
    }
    public function update_customer(Request $request,$customer_id){
        $this->AuthLogin();
        
        $data = $request->all();
        $customer = Customer::find($customer_id);
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        if($customer->customer_password==$data['customer_password']){
            $customer->customer_password = $data['customer_password'];
        }else{
            $customer->customer_password = md5($data['customer_password']);
        }
       
        $customer->save();

    	Session::put('message','Cập nhật thông tin khách hàng thành công');
    	return Redirect::to('/list-customer');
    }
    public function delete_customer($customer_id){
        $this->AuthLogin();
        $customer = Customer::find($customer_id);
        $customer->delete();
        Session::put('message','Xóa khách hàng thành công');
        return Redirect()->back();
    }
    //End Admin

    //Front End    

    public function login_checkout(){

        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','ASC')->get();

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('category_post',$category_post);
    }

    public function create_customer(){

        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

    	return view('pages.checkout.create_customer')->with('category',$cate_product)->with('category_post',$category_post);
    }

    public function add_customer(Request $request){

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
        $get_image = $request->file('customer_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/Avata',$new_image);
            $data['customer_image'] = $new_image;
            $customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
        return Redirect::to('/checkout');
        }
        $data['customer_image'] = '';

    	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/checkout');
    
    }

    public function account_information($customer_id){
        
        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $customer = Customer::find($customer_id);
    	
    	return view('pages.checkout.account_information')->with('category',$cate_product)->with('category_post',$category_post)->with('customer',$customer);
    }

    public function account_settings($customer_id){
        
        $category_post = CategoryPost::orderBy('category_post_id','ASC')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $customer = Customer::find($customer_id);
    	
    	return view('pages.checkout.account_settings')->with('category',$cate_product)->with('category_post',$category_post)->with('customer',$customer);
    }

    public function update_information(Request $request,$customer_id){
  
        $data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	
        if($request->customer_password == $data['customer_password']){
            $data['customer_password'] = $request->customer_password;
        }else{
            $data['customer_password']= md5($request->customer_password);
        }
        $get_image = $request->file('customer_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/Avata',$new_image);
                    $data['customer_image'] = $new_image;
                    DB::table('tbl_customers')->where('customer_id',$customer_id)->update($data);
                    
                    return Redirect::to('account-information/'.$customer_id);
        }
            
        DB::table('tbl_customers')->where('customer_id',$customer_id)->update($data);
        
        return Redirect::to('account-information/'.$customer_id);
       
    }

    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	if($result){
    		Session::put('customer_id',$result->customer_id);
			Session::put('customer_name',$result->customer_name);
    		return Redirect::to('/checkout');
    	}else{
			
    		return redirect()->back()->with('error','Tài khoản hoặc mật khẩu không đúng!');
    	}
    }

    //End Front End


}
