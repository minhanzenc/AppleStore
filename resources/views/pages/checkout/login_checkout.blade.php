@extends('layout_not_slider')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng nhập</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/login-customer')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {!! session()->get('success') !!}
                        </div>
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                        @endif
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Bạn chưa có mã khuyến mãi? <a href="{{URL::to('/create-customer')}}">Đăng ký ngay</a> để nhận mã khuyến mãi.</h6>
                        <h4 class="checkout__title">Đăng nhập</h4>
                        <div class="checkout__input">
                            <p>Tên đăng nhập hoặc email<span>*</span></p>
                            <input type="text" name="email_account" placeholder="Điền tên tài khoản hoặc Email" />
                        </div>
                        <div class="checkout__input">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="password_account" placeholder="Điền mật khẩu" />

                        </div>
                        <div class="checkout__input">
                            <button type="submit" class="site-btn"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
                        </div>
                        <div class="checkout__input_login">
                            <p><a href="{{URL::to('/iforgot')}}"><i class="fas fa-cogs"></i> Quên tài khoản hoặc
                                    mật khẩu?</a> </p>
                        </div>
                        <div class="checkout__input">
                            <p><a href="{{URL::to('/create-customer')}}"><i class="fas fa-user-plus"></i> Tạo tài khoản
                                    mới.</a> </p>
                        </div>
                        <div class="checkout__input">
                            <a href="{{url('login-customer-google')}}">
                                <img width="10%" alt="Đăng nhập bằng tài khoản google"
                                    src="{{asset('public/frontend/img/gg.png')}}">
                            </a>
                            <!-- <a href="{{url('login-facebook-customer')}}">
                                <img width="10%" alt="Đăng nhập bằng tài khoản facebook"
                                    src="{{asset('public/frontend/img/fb.png')}}">
                            </a> -->
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection