<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
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

    public function insert_coupon(){
    	return view('admin.Coupon.insert_coupon');
    }
    
    public function insert_coupon_code(Request $request){
        $this->AuthLogin();
        $this->checkCoupon($request);

    	$data = $request->all();
    	$coupon = new Coupon;
        $coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $name = $coupon->coupon_code;

        $check = Coupon::where('coupon_code',$name)->exists();
        if($check)
        {
            return Redirect()->back()->with('error','Mã khuyến mãi đã tồn tại, Vui lòng kiểm tra lại.')->withInput();
        }
    	$coupon->save();

        return Redirect::to('insert-coupon')->with('success','Thêm mã khuyến mãi thành công');

    }

    public function unactive_coupon($coupon_id){
        $this->AuthLogin();
        Coupon::where('coupon_id',$coupon_id)->update(['coupon_status'=>1]);
     
        return redirect()->back()->with('success','Kích hoạt mã khuyến mãi');

    }
    public function active_coupon($coupon_id){
        $this->AuthLogin();
        Coupon::where('coupon_id',$coupon_id)->update(['coupon_status'=>0]);
        
        return redirect()->back()->with('success','Khóa mã khuyến mãi');
    }

    public function list_coupon(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.Coupon.list_coupon')->with(compact('coupon','today'));
    }

    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	
        return Redirect::to('list-coupon')->with('success','Xóa mã khuyến mãi thành công');
    }

    //User
    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('success','Xóa mã khuyến mãi thành công');
        }
	}

    //Validation
    public function checkCoupon(Request $request){
        $this-> validate($request,
        [
            'coupon_code' => 'required',
            'coupon_name' => 'required',
            'coupon_number' => 'required|numeric',
            'coupon_time' => 'required',
            'coupon_date_start' => 'required',
            'coupon_date_end' => 'required',
        ],
        [
            'coupon_code.required' =>'Vui lòng điền mã khuyến mãi',
            'coupon_name.required' =>'Vui lòng điền tên mã khuyến mãi',
            'coupon_number.required' =>'Vui lòng điền thông tin là số',
            'coupon_time.required' =>'Vui lòng điền số lượng mã',
            'coupon_date_start.required' =>'Vui lòng điền ngày bắt đầu',
            'coupon_date_end.required' =>'Vui lòng điền kết thúc',
            'coupon_number.numeric' =>'Vui lòng điền thông tin là số',
            
        ]);
    }

}
