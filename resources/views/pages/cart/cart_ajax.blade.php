@extends('layout_not_slider')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ hàng của bạn</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Giỏ hàng của bạn</span>
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
                                        <h5>{{number_format($cart['product_price'],0,',','.')}}₫</h5>
                                    </div>
                                </td>
                                <form action="{{url('/update-cart')}}" method="POST">
                                    {{csrf_field()}}
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <!-- <input class="cart_quantity_input" type="number" min="1"
                                                    name="cart_qty[{{$cart['session_id']}}]"
                                                    value="{{$cart['product_qty']}}"> -->
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
                                <td class="cart__close">
                                    <a class="cart_quantity_delete"
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
                            <a href="{{URL::to('/')}}"><i class="fas fa-cart-plus"></i> Tiếp tục mua sản
                                phẩm</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart__discount">
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Tạm tính: <span>{{number_format($total,0,',','.')}}₫</span></li>
                        @if(Session::get('coupon'))

                        <li>
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition']==1)
                            Loại mã giảm giá:<span>{{$cou['coupon_number']}}%</span>

                            @php
                            $total_coupon = ($total*$cou['coupon_number'])/100;
                            @endphp

                        <li>Tổng tiền:<span>{{number_format($total-$total_coupon,0,',','.')}}₫</span></li>

                        @elseif($cou['coupon_condition']==2)
                        Loại mã giảm giá :<span>{{number_format($cou['coupon_number'],0,',','.')}}₫</span>

                        @php
                        $total_coupon = $total - $cou['coupon_number'];
                        @endphp

                        <li>Tổng tiền :<span>{{number_format($total_coupon,0,',','.')}}₫</span></li>


                        @endif
                        @endforeach
                        </li>
                        @else
                        <li>Giảm Giá :<span>0₫</span></li>
                        <li>Tổng tiền :<span>{{number_format($total,0,',','.')}}₫</span></li>
                        @endif
                    </ul>
                    @if(Session::get('coupon'))
                    <a class="primary-btn update" href="{{url('/unset-coupon')}}"><i class="fas fa-times-circle"></i>
                        Xóa mã
                        khuyến mãi</a>
                    @endif

                    @if(Session::get('customer_id'))
                    <a class="primary-btn check_out" href="{{URL::to('/checkout')}}"><i class="fab fa-amazon-pay"></i>
                        Thanh
                        toán</a>
                    @else
                    <a class="primary-btn check_out" href="{{URL::to('/login-checkout')}}"><i
                            class="fab fa-amazon-pay"></i>
                        Thanh toán</a>
                    @endif

                </div>
            </div>
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