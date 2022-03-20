@extends('layout_not_slider')
@section('content')

<section class="breadcrumb-blog set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Sản phẩm yêu thích</h2>
            </div>
        </div>
    </div>
</section>

<div class="wistlist-title">
    <div class="container">
        <h6 class=""> ĐỪNG ĐÁNH MẤT DANH SÁCH YÊU THÍCH CỦA BẠN.</h6>
    </div>
</div>

<section class="checkout">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12 col-md-6">

                    <h6 class="coupon__code"><span class="icon_tag_alt"></span>Tạo một tài khoản ngay hôm nay hoặc đăng
                        nhập để lưu Danh sách yêu thích của bạn <a href="{{URL::to('/create-customer')}}">ĐĂNG KÝ</a>.
                        Hoặc bạn đã có tài khoản <a href="{{URL::to('/login-checkout')}}">ĐĂNG NHẬP</a></h6>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">

    <div class="row" id="row_wishlist"> </div>

</div>



@endsection