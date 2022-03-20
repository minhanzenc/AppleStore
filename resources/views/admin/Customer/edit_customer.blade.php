@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin khách hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-customer')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-customer/'.$all_customer->customer_id)}}"
                        method="post">
                        {{csrf_field()}}
                        
                        <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Họ tên khách hàng</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Enter email" value="{{$all_customer->customer_name}}">
                            {!! $errors->first('customer_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        
                        <div class="form-group {{ $errors->has('customer_phone') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại" value="{{$all_customer->customer_phone}}">
                            {!! $errors->first('customer_phone', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('customer_password') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="customer_password" class="form-control" placeholder="Mật khẩu" value="{{$all_customer->customer_password}}">
                            {!! $errors->first('customer_password', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <button type="submit" name="edit_customer" class="btn btn-info">Cập nhật thông tin khách
                            hàng</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection