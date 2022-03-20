<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ValidateController;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Slider;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
session_start();

class CustomerController extends Controller
{
    //Admin
    // $Validate_Controller = new ValidateController;

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
    	return view('admin.Customer.add_customer');
    }
    
    public function list_customer(){
        $this->AuthLogin();

        $all_customer = Customer::orderBy('customer_id','DESC')->get();
    	
    	return view('admin.Customer.list_customer')->with(compact('all_customer'));
    }

    public function save_customer(Request $request){
        $this->AuthLogin();
        $this->checkCustomer($request);

    	$data = $request->all();
        $customer = new Customer();
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_image='';
        $email = $customer->customer_email;

        $check = Customer::where('customer_email',$email)->exists();
        if($check)
        {
            return Redirect()->back()->with('error','Email đã được đăng ký.Vui lòng chọn email khác')->withInput();
        }
        
        $customer->save();

    	return Redirect()->back()->with('success','Thêm khách hàng thành công');
    }
    
    public function edit_customer($customer_id){
        $this->AuthLogin();

        $all_customer = Customer::find($customer_id);
        
        return view('admin.Customer.edit_customer')->with(compact('all_customer'));
    }
    public function update_customer(Request $request,$customer_id){
        $this->AuthLogin();
        $this->checkCustomerAdmin($request);
        
        $data = $request->all();
        $customer = Customer::find($customer_id);
    	$customer->customer_name = $data['customer_name'];
        
        $customer->customer_phone = $data['customer_phone'];
        if($customer->customer_password==$data['customer_password']){
            $customer->customer_password = $data['customer_password'];
        }else{
            $customer->customer_password = md5($data['customer_password']);
        }
        
        $customer->save();

    	return Redirect::to('/list-customer')->with('success','Cập nhật thông tin khách hàng thành công');
    }
    public function delete_customer($customer_id){
        $this->AuthLogin();
        $customer = Customer::find($customer_id);
        $customer->delete();

        return Redirect()->back()->with('success','Xóa khách hàng thành công');
    }
    //End Admin



    //Front End    

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

    public function add_customer(Request $request){

        $this->checkCustomer($request);

    	$data = $request->all();
        $customer = new Customer();
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_image='';
        $email = $customer->customer_email;

        $check = Customer::where('customer_email',$email)->exists();
        if($check)
        {
            return redirect('create-customer') -> with('error','Email đã được đăng ký.Vui lòng chọn email khác')->withInput();
        }
        $customer->save();
            
        Session::put('customer_id',$customer->customer_id);
    	Session::put('customer_name',$customer->customer_name);
        Session::put('customer_phone',$customer->customer_phone);
        Session::put('customer_image',$customer->customer_image);
        return Redirect::to('/checkout');
        
    }

    public function account_information($customer_id){
        
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

        $customer = Customer::find($customer_id);
    	
    	return view('pages.checkout.account_information')->with('category',$cate_product)->with('category_post',$category_post)->with('customer',$customer);
    }

    public function account_settings($customer_id){
        
        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
        $customer = Customer::find($customer_id);
    	
    	return view('pages.checkout.account_settings')->with('category',$cate_product)->with('category_post',$category_post)->with('customer',$customer);
    }

    public function delete_avata($customer_id){
        $customer = Customer::find($customer_id);
        $customer_image = $customer->customer_image;
        if($customer_image){
            unlink('public/uploads/avata/'.$customer_image);
        }
        $customer->customer_image='';
        $customer->save();
        
        return Redirect::to('/account-settings/'.$customer_id);
    }

    public function update_information(Request $request,$customer_id){
  
        $this->checkCustomerAdmin($request);

        $data = $request->all();
        $customer = Customer::find($customer_id);
    	$customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        if($customer->customer_password==$data['customer_password']){
            $customer->customer_password = $data['customer_password'];
        }else{
            $customer->customer_password = md5($data['customer_password']);
        }
        $customer_image = $customer->customer_image;
        $get_image = $request->file('customer_image');
        
        if($get_image){
            if($customer->customer_image!=''){
            $customer_image_old = $customer->customer_image;
            $path = 'public/uploads/avata/'.$customer_image;
            unlink($path);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/avata',$new_image);
            $customer->customer_image=$new_image;
            $customer->save();
            Session::put('customer_image',$customer->customer_image);
            return Redirect::to('/account-information/'.$customer_id);

            }else{
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/avata',$new_image);
            $customer->customer_image=$new_image;
            $customer->save();
            Session::put('customer_image',$customer->customer_image);
            return Redirect::to('/account-information/'.$customer_id);
            }
        }
        $customer->customer_image =  $customer_image;
        $customer->save();
        Session::put('customer_image',$customer->customer_image);
        return Redirect::to('/account-information/'.$customer_id)->with('success','Cập nhật thông tin thành công');
       
    }

    public function logout_checkout(){
    	Session::flush('customer_id');
        
    	return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	if($result){
    		Session::put('customer_id',$result->customer_id);
			Session::put('customer_name',$result->customer_name);
            Session::put('customer_phone',$result->customer_phone);
            Session::put('customer_image',$result->customer_image);
            Session::put('customer_email',$result->customer_email);
    		return Redirect::to('/checkout');
    	}else{
			
    		return redirect()->back()->with('error','Tài khoản hoặc mật khẩu không đúng!');
    	}
    }

    //End Front End

    //Validation
    public function checkCustomer(Request $request){
        $this-> validate($request,
        [
            'customer_name' => 'required',
            'customer_email' => 'required|email|unique:users,email',
            'customer_phone' => 'required|numeric|digits_between:10,10',
            'customer_password' => 'required|min:8',
        ],
        [
            'customer_name.required' =>'Vui lòng điền họ và tên',
            'customer_email.required' =>'Vui lòng điền email',
            'customer_phone.required' =>'Vui lòng điền số điện thoại',
            'customer_password.required' =>'Vui lòng điền mật khẩu',
            'customer_email.email' =>'Vui lòng kiểm tra lại email',
            'customer_phone.digits_between' =>'Vui lòng kiểm tra lại số điện thoại',
            'customer_phone.numeric' =>'Vui lòng kiểm tra lại số điện thoại',
            'customer_password.min' =>'Mật khẩu phải lớn hơn 8 ký tự',
            
        ]);
    }

    public function checkCustomerAdmin(Request $request){
        $this-> validate($request,
        [
            'customer_name' => 'required',
            'customer_phone' => 'required|numeric|digits_between:10,10',
            'customer_password' => 'required|min:8',
        ],
        [
            'customer_name.required' =>'Vui lòng điền họ và tên',
            'customer_password.required' =>'Vui lòng điền mật khẩu', 
            'customer_phone.required' =>'Vui lòng điền số điện thoại',
            'customer_phone.digits_between' =>'Vui lòng kiểm tra lại số điện thoại',
            'customer_phone.numeric' =>'Vui lòng kiểm tra lại số điện thoại',
            'customer_password.min' =>'Mật khẩu phải lớn hơn 8 ký tự',
            
        ]);
    }

}
