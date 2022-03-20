<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
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
