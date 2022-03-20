@extends('layout_not_slider')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sự cố tài khoản</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{URL::to('/login-checkout')}}">Đăng nhập</a>
                        <span>Sự cố tài khoản</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="checkout spad" id="form">
    <div class="container">
        <div class="checkout__form">
			<form action="{{url('/reset-new-pass')}}" method="POST">
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
                        @php
                        $token = $_GET['token'];
                        $email = $_GET['email'];
                        @endphp
                        <h4 class="checkout__title">Gặp sự cố đăng nhập?</h4>
                        <div class="checkout__input">
                            <p>Điền mật khẩu mới.</p>
                            <input type="hidden" name="email" value="{{$email}}" />
                            <input type="hidden" name="token" value="{{$token}}" />
                            <input type="password" name="password_account" placeholder="Điền mật khẩu mới" />
                        </div>
                        <div class="checkout__input">
                            <button type="submit" class="site-btn"><i class="fas fa-sign-in-alt"></i> Tiếp tục</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection