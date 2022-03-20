@extends('layout_not_slider')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{URL::to('/cart')}}">Giỏ hàng</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
@if(Session::get('cart')==true)
@php
$total = 0;
$fee_ship=0;
@endphp

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {!! session()->get('success') !!}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {!! session()->get('error') !!}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">

                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Session::get('cart') as $key => $cart)
                            @php
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                            @endphp
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
                                            width="90" alt="{{$cart['product_name']}}">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$cart['product_name']}}</h6>
                                        <h5>{{number_format($cart['product_price'],0,',','.').'₫'}}</h5>
                                    </div>
                                </td>
                                <form action="{{url('/update-cart')}}" method="POST">
                                    {{csrf_field()}}
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <select name="cart_qty[{{$cart['session_id']}}] update_qty"
                                                    class="form-control cart_quantity_input"
                                                    onchange="this.form.submit()">
                                                    @for($i=1 ; $i<=10 ;$i++)
                                                    <option {{$cart['product_qty'] == $i ? 'selected' : ''}} value="{{$i}}">
                                                        {{$i}}
                                                    </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </form>
                                <td class="cart__price">{{number_format($subtotal,0,',','.')}}₫</td>
                                <td class="cart__close"><a class="cart_quantity_delete"
                                        href="{{url('/del-product/'.$cart['session_id'])}}"><i
                                            class="far fa-window-close"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{URL::to('/')}}">
                                <i class="fas fa-cart-plus"></i> Tiếp tục tìm kiếm sản phẩm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @if(Session::get('coupon'))
                @else
                <div class="cart__discount">
                    <h6>Mã khuyến mãi</h6>
                    <form method="POST" action="{{url('/check-coupon')}}" class="couponform">
                        {{csrf_field()}}
                        <input type="text" class="coupon-input" name="coupon" placeholder="Nhập mã giảm giá">
                        <button type="submit" class="btn btn-default"><i class="fas fa-ticket-alt"></i> Áp dụng</button>
                    </form>
                </div>
                @endif
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Tạm tính: <span>{{number_format($total,0,',','.')}}₫</span></li>
                        @if($total>=15000000)
                        <li>Phí vận chuyển: <span style="color:#10a702;">Miễn phí giao hàng</span></li>
                        @else
                        @php
                        $fee_ship=30000;
                        @endphp
                        <li>Phí vận chuyển: <span>{{number_format($fee_ship,0,',','.')}}₫</span></li>
                        @endif

                        @if(Session::get('coupon'))
                        <li>
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition']==1)
                            Loại mã giảm giá:<span>{{$cou['coupon_number']}}%</span>

                            @php
                            $total_coupon = ($total * $cou['coupon_number'])/100;
                            @endphp

                        <li>Tổng tiền:<span>{{number_format($total - $total_coupon + $fee_ship,0,',','.')}}₫</span></li>

                        @elseif($cou['coupon_condition']==2)
                        Loại mã giảm giá :<span>{{number_format($cou['coupon_number'],0,',','.')}}₫</span>

                        @php
                        $total_coupon = $total - $cou['coupon_number'];
                        @endphp

                        <li>Tổng tiền :<span>{{number_format($total_coupon + $fee_ship,0,',','.')}}₫</span></li>

                        @endif
                        @endforeach
                        </li>
                        @else
                        <li>Giảm Giá :<span>0₫</span></li>
                        <li>Tổng tiền :<span>{{number_format($total + $fee_ship,0,',','.')}}₫</span></li>
                        @endif
                    </ul>
                    @if(Session::get('coupon'))
                    <a class="primary-btn update" href="{{url('/unset-coupon')}}"><i class="fas fa-times-circle"></i>
                        Xóa mã
                        khuyến mãi</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <h6 class="checkout__title">Điền thông tin gửi hàng</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ và tên<span>*</span></p>
                                    <input type="text" name="shipping_name" class="shipping_name"
                                        placeholder="Điền họ và tên" value="{{Session::get('customer_name')}}"
                                        data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="shipping_phone" class="shipping_phone"
                                        placeholder="Điền số điện thoại" value="{{Session::get('customer_phone')}}"
                                        data-validation="number" data-validation-error-msg="Vui Lòng điền thông tin">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="email" name="shipping_email" class="shipping_email"
                                placeholder="Email (Vui lòng điền email để nhận hoá đơn VAT)" value="{{Session::get('customer_email')}}"
                                data-validation="email" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn tỉnh / thành phố<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city"
                                    data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                        <option value="">--Chọn tỉnh / thành phố--</option>
                                        @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_thanhpho}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận / huyện<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="province" id="province"
                                        class="form-control input-sm m-bot15 province choose"
                                        data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                        <option value="">--Chọn quận / huyện--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã / phường<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards"
                                    data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                        <option value="">--Chọn xã / phường--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input type="text" name="shipping_address" class="shipping_address"
                                        placeholder="Địa chỉ" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn hình thức thanh toán<span
                                    style="color:#e53637;">*</span></label>
                            <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                <option value="1">Tiền mặt</option>
                                <option value="0">Chuyển khoản</option>
                            </select>
                        </div>

                        @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                        @endforeach
                        @else
                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                        @endif

                        @if($total>=15000000)
                        <input type="hidden" name="order_fee_ship" class="order_fee_ship" value="0">
                        @else
                        <input type="hidden" name="order_fee_ship" class="order_fee_ship" value="30000">
                        @endif

                    </div>

                    <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <div class="checkout__order__products">
                                <p>Ghi chú đơn hàng<span style="color:#e53637;">*</span></p>
                                <textarea name="shipping_notes" class="shipping_notes"
                                    placeholder="Ghi chú đơn hàng của bạn (Không bắt buộc)" rows="10" cols="42"
                                    style="resize: none;"></textarea>
                            </div>
                            <button type="button" name="send_order " class="site-btn send_order"><i
                                    class="fas fa-share-square"></i> Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@else

<div class="container text-center">
    <div class="cart-empty">
        <i class="fas fa-cart-plus"></i>
        <p>Giỏ hàng của bạn trống.</p>
        <h5>Trả lại hàng miễn phí.</h5>
        <h4><a href="{{URL::to('/')}}"><i class="fas fa-arrow-circle-left"></i> VỀ TRANG CHỦ</a></h4>
        <h5></h5>
    </div>
</div>

<div class="chat-wrapper">
    <div class="container ">
        <p>Khi cần trợ giúp vui lòng gọi <span>0917889558</span> hoặc <span>0943705326</span> (7h30 - 22h)</p>
    </div>
</div>

<div class="container text-center">
    <div class="container-shop">
        <div class="container-img">
        </div>
        <div class="container-shop-text">
            <h2>Sản phẩm mới</h2>
            <p>Kiểm tra các phụ kiện mới nhất.</p>
            <h4><a href="{{URL::to('/store')}}">Shop <i class="fas fa-angle-right"></i></a></h4>
        </div>
    </div>
</div>

@endif
@endsection