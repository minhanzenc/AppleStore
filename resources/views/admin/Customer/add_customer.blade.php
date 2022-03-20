@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm khách hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-customer')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-customer')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                        @endif
                        </div>
                        <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Họ tên khách hàng</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
                            {!! $errors->first('customer_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Địa chỉ email</label>
                            <input type="text" name="customer_email" class="form-control" placeholder="Địa chỉ email" value="{{ old('customer_email') }}" >
                            {!! $errors->first('customer_email', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('customer_phone') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại" value="{{ old('customer_phone') }}">
                            {!! $errors->first('customer_phone', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('customer_password') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="customer_password" class="form-control" placeholder="Mật khẩu" >
                            {!! $errors->first('customer_password', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <button type="submit" value="submit" name="add_customer" class="btn btn-info">Thêm khách hàng</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection