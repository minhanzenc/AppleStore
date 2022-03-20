@extends('layout_not_slider')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng ký</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{URL::to('/login-checkout')}}">Đăng nhập</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/add-customer')}}" method="POST" enctype="multipart/form-data" id="form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 centered">
                       
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                        @endif

                        <div class="checkout__input  {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="customer_name" placeholder="Điền họ và tên" value="{{ old('customer_name') }}">
                            {!! $errors->first('customer_name', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input  {{ $errors->has('customer_email') ? 'has-error' : ''}}">
                            <p>Địa chỉ email<span>*</span></p>
                            <input type="text" name="customer_email" placeholder="Điền địa chỉ email(@gmail.com)" value="{{ old('customer_email') }}">
                            {!! $errors->first('customer_email', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input  {{ $errors->has('customer_phone') ? 'has-error' : ''}}">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="customer_phone" placeholder="Điền số điện thoại" value="{{ old('customer_phone') }}">
                            {!! $errors->first('customer_phone', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('customer_password') ? 'has-error' : ''}}">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="customer_password" placeholder="Điền mật khẩu" >
                            {!! $errors->first('customer_password', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input">
                            <button type="submit" value="submit" class="site-btn"><i class="fas fa-user-plus"></i> Đăng ký</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection