@extends('layout_not_slider')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Cập nhật thông tin tài khoản</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Cập nhật thông tin tài khoản</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/update-information/'.$customer->customer_id)}}" method="POST"
                enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 centered">
                        <h6 class="checkout__title">Cập nhật thông tin tài khoản</h6>
                        <div class="checkout__input_avata">
                            <p>Ảnh đại diện<span>*</span></p>
                            @if($customer->customer_image=='')
                                <input type="file" id="upload" name="customer_image" hidden />
                                <label for="upload"><i class="fas fa-pen"></i> Thêm ảnh đại diện</label>
                            @else
                            <div class="avata">
                                <img class="inbox-avatar"
                                    src="{{asset('public/uploads/avata/'.$customer->customer_image)}}" alt=""
                                    name="customer_image">
                            </div>
                            <div class="option">
                                <div class="float-left">
                                    <input type="file" id="upload" name="customer_image" hidden />
                                    <label for="upload"><i class="fas fa-pen"></i> Thay đổi</label>
                                </div>
                                <div class="float-right">
                                    <a onclick="return confirm('Bạn có chắc muốn xóa ảnh đại diện?')"
                                        href="{{URL::to('delete-avata/'.$customer -> customer_id)}}" class=""
                                        ui-toggle-class=""><i class="far fa-trash-alt"></i> Xóa
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="checkout__input {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="customer_name" placeholder="Điền họ và tên" value="{{$customer->customer_name}}">
                            {!! $errors->first('customer_name', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ email<span>*</span></p>
                            <input type="text" name="customer_email" placeholder="Điền địa chỉ email(@gmail.com)" value="{{$customer->customer_email}}" disabled>
                        </div>
                        <div class="checkout__input {{ $errors->has('customer_phone') ? 'has-error' : ''}}">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="customer_phone" placeholder="Điền số điện thoại" value="{{$customer->customer_phone}}">
                            {!! $errors->first('customer_phone', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('customer_password') ? 'has-error' : ''}}">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="customer_password" placeholder="Điền mật khẩu" value="{{$customer->customer_password}}">
                            {!! $errors->first('customer_password', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input">
                            <button type="submit" name="update_information" class="site-btn"><i class="fa fa-cog"></i>  
                                Cập nhật thông tin tài khoản</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection