<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Slider;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Statistic;
use Carbon\Carbon;
use PDF;
use Mail;
use Session;
use DB;

class OrderController extends Controller
{
    public function manage_order(){
    	$order = Order::orderby('created_at','DESC')->get();
       
    	return view('admin.manage_order')->with(compact('order'));
    }

	public function delete_order_code(Request $request ,$order_code){
		$order = Order::where('order_code',$order_code)->first();
		$order->delete();
		
        return Redirect()->back()->with('success','Xóa đơn hàng thành công');

	}
	public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request){
		//Update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();

		//send mail confirm
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
		$title_mail = "Đơn hàng đã đặt được xác nhận".' '.$now;
		$customer = Customer::where('customer_id',$order->customer_id)->first();
		$data['email'][] = $customer->customer_email;

		foreach($data['order_product_id'] as $key => $product){
			$product_mail = Product::find($product);
			foreach($data['quantity'] as $key2 => $qty){
				if($key==$key2){
					$cart_array[] = array(
						'product_name' => $product_mail['product_name'],
						'product_price' => $product_mail['product_price'],
						'product_qty' => $qty
					);

				}
			}
		}

		$details = OrderDetails::where('order_code',$order->order_code)->first();
		if($details->product_coupon != 'no'){
			$coupon_mail = $details->product_coupon;
		}else{
			$coupon_mail = 'Không sử dụng mã';
		}
		
		$fee_ship_mail = $details->product_fee_ship;
		$shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
		$shipping_array = array(
			'customer_name' => $customer->customer_name,
			'shipping_name' => $shipping->shipping_name,
			'shipping_email' => $shipping->shipping_email,
			'shipping_phone' => $shipping->shipping_phone,
			'shipping_address' => $shipping->shipping_address,
			'shipping_notes' => $shipping->shipping_notes,
			'shipping_method' => $shipping->shipping_method,
			'fee_ship' => $fee_ship_mail
		);
		//Lấy mã giảm giá, Lấy coupon code
		$ordercode_mail = array(
			'coupon_code' => $coupon_mail,
			'order_code' => $details->order_code
		);

		Mail::send('admin.Mail.confirm_order',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
				$message->to($data['email'])->subject($title_mail);//send this mail with subject
				$message->from($data['email'],$title_mail);//send from this mail
		});

		//Order date
		$order_date = $order->order_date;	
		$statistic = Statistic::where('order_date',$order_date)->get();
		if($statistic){
			$statistic_count = $statistic->count();	
		}else{
			$statistic_count = 0;
		}	

		if($order->order_status==2){
			$total_order = 0;
			$sales = 0;
			$profit = 0;
			$quantity = 0;
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				$product_price = $product->product_price;
				$product_cost = $product->product_cost;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				foreach($data['quantity'] as $key2 => $qty){
					if($key==$key2){
						$pro_remain = $product_quantity - $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold + $qty;
						$product->save();
						//Update doanh thu
						$quantity+=$qty;
						$total_order+=1;
						$sales+=$product_price*$qty;
						$profit = $sales - ($product_cost*$qty);
					}
				}
			}
			//update doanh số DATABASE
			if($statistic_count>0){
				$statistic_update = Statistic::where('order_date',$order_date)->first();
				$statistic_update->sales = $statistic_update->sales + $sales;
				$statistic_update->profit =  $statistic_update->profit + $profit;
				$statistic_update->quantity =  $statistic_update->quantity + $quantity;
				$statistic_update->total_order = $statistic_update->total_order + $total_order;
				$statistic_update->save();
			}else{

				$statistic_new = new Statistic();
				$statistic_new->order_date = $order_date;
				$statistic_new->sales = $sales;
				$statistic_new->profit =  $profit;
				$statistic_new->quantity =  $quantity;
				$statistic_new->total_order = $total_order;
				$statistic_new->save();
			}
		}elseif($order->order_status!=2 && $order->order_status!=3){
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
					if($key==$key2){
						$pro_remain = $product_quantity + $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold - $qty;
						$product->save();
					}
				}
			}
		}


	}

    public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}

		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
       
        $city = City::where('matp',$shipping->matp)->first();
        $province = Province::where('maqh',$shipping->maqh)->first();
        $wards = Wards::where('maxp',$shipping->maxp)->first();

		foreach($order_details as $key => $order_d){
			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status','city','province','wards'));

	}

    public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}

    public function print_order_convert($checkout_code){
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			
		}

		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
       
        $city = City::where('matp',$shipping->matp)->first();
        $province = Province::where('maqh',$shipping->maqh)->first();
        $wards = Wards::where('maxp',$shipping->maxp)->first();

		$order_details = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
		
		foreach($order_details as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
			width: 100%;
		}
		.table-styling{
			width: 100%;
			border:1px solid #000;
			border-collapse: collapse;
			font-weight: 200;
		}
		
		.table-styling thead tr th{
			border:1px solid #000;
		}
		.table-styling tbody tr th{
			font-weight: 300;
			border:1px solid #000;
		}
		p{
			font-weight: 600;
		}
		.title{
			width:100%;
			height: 50px;
			margin-bottom:-30px;
		}
		.title h4{
			width:30%;
			float:left;
			font-size: 30px;
		}
		.title h5{
			width:40%;
			float: left;
			text-align: center;
			margin-top:5px;
			font-weight:400;
			font-size: 15px;
		}
		.title p{
			width:30%;
			float: right;
			text-align: center;
			font-size: 13px;
			margin-top:5px;
			font-weight:400;
		}
		.title_a{
			clear: both;
		}
		.title_a h2{
			text-align: center;
		}
		.title_a h5{
			margin-top:-26px;
			text-align: center;
			font-weight:400;
		}
		.content{
			width:100%;
			font-weight:200;
		}
		.content_left{
			float: left;
			width:55%;
			font-weight:200;
		}
		.content_right{
			float: right;
			width:45%;
			font-weight:200;
		}
		span{
			font-weight:200;
		}
		.signal{
			width:100%;
			margin-top:80px;
		}
		.signal p{
			font-weight:200;
		}

		</style>
		<div class="title">
			<h4>Apple Store</h4>
			<h5>Hóa đơn bán hàng</h5>
			<p>'.$now.'<br>81 Dã Tượng, Q8</p>
		</div>
		<div class="title_a">
			<h2>PHIẾU GIAO HÀNG</h2>
			<h5>(Kiêm phiếu bảo hành)</h5>
		</div>
		<div class="content">
			<div class="content_left">
				<h5>Tên khách hàng: '.$shipping->shipping_name.'</h5>
				<h5>Số điện thoại: '.$shipping->shipping_phone.'</h5>
				<h5>Email: '.$shipping->shipping_email.'</h5>
			</div>
			<div class="content_right">
			<h5>Ngày lập hóa đơn: '.$now.'</h5>
			<h5>Mã hóa đơn: '.$checkout_code.'</h5>
			<h5>Loại tiền: VNĐ</h5>
			</div>
		</div>
		
		<p>Thông tin đơn hàng:</p>				
			<table class="table-styling">
				<thead>
					<tr>
						<th>Stt</th>
						<th>Sản phẩm</th>
						<th>Số lượng</th>
						<th>Đơn giá</th>
						<th>Thành tiền</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
			
				$fee_ship=0;
                $total = 0;
				$i=0;

				foreach($order_details as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;
					$i++;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'Không dùng mã';
					}		

		$output.='		
					<tr>
						<th>'.$i.'</th>
						<th>'.$product->product_name.'</th>
						<th>'.$product->product_sales_quantity.'</th>
						<th>'.number_format($product->product_price,0,',','.').'₫'.'</th>
						<th>'.number_format($subtotal,0,',','.').'₫'.'</th>
						<th>'.$shipping->shipping_notes.'</th>					
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}
				if($shipping->shipping_method == 0){
					$shipping_method='Chuyển khoản';
				}else{
					$shipping_method='Tiền mặt';
				}

				
		$output.= '<tr>
			<th colspan="6">
				<p>Mã giảm giá: <span>'.$product_coupon.'</p>
			</th>
		</tr>
		<tr>
				<th colspan="6">
					<p>Giảm giá: <span>'.$coupon_echo.'</p>
                    <p>Phí vận chuyển: <span>'.number_format($product->product_fee_ship,0,',','.').'₫</p>
					<p>Thanh toán: <span>'.number_format($total_coupon + $product->product_fee_ship,0,',','.').'₫'.'</p>
					<p>Hình thức thanh toán: <span>'.$shipping_method.'</p>
				</th>
		</tr>';
		$output.='				
				</tbody>
			
		</table>
		<p></p>
		<table>
			<thead>
				<tr>
					<th width="500px">Người lập phiếu</th>
					<th width="200px">Người nhận</th>
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
		<div class="signal">
				<p>Huỳnh Quốc Dương</p>
		</div>';


		return $output;

	}
    
}