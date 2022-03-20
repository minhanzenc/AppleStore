@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã khuyến mãi
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-coupon')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                            <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                            <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('coupon_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên mã khuyến mãi</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1"
                                data-validation="required" data-validation-error-msg="Vui lòng điền thông tin"
                                value="{{ old('coupon_name') }}">
                                {!! $errors->first('coupon_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('coupon_code') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Mã khuyến mãi</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1"
                                data-validation="required" data-validation-error-msg="Vui lòng điền thông tin"
                                value="{{ old('coupon_code') }}">
                                {!! $errors->first('coupon_code', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('coupon_time') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Số lượng khuyến mãi</label>
                            <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1"
                                data-validation="number" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)"
                                value="{{ old('coupon_time') }}">
                                {!! $errors->first('coupon_time', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Điều kiện khuyến mãi</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15" id="select_attribute">
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>

                            </select>
                        </div>
                        <div class="form-group value1 {{ $errors->has('coupon_number') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nhập % giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="v1"
                            data-validation="length" data-validation-length="max2" data-validation-error-msg="Vui lòng điền số nhỏ hơn 100%">
                            {!! $errors->first('coupon_number', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group value2 {{ $errors->has('coupon_number') ? 'has-error' : ''}}" style="display:none;">
                            <label for="exampleInputPassword1">Nhập số tiền giảm</label>
                            <input type="text" name="" class="form-control" id="v2" value="" data-validation="length" data-validation-length="min4" data-validation-error-msg="Vui lòng điền số tiền lớn hơn 1000₫)">
                            {!! $errors->first('coupon_number', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('coupon_date_start') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Ngày bắt đầu</label>
                            <input type="text" name="coupon_date_start" class="form-control" id="start_coupon"
                            data-validation="required" data-validation-error-msg="Vui lòng điền thông tin"
                            value="{{ old('coupon_date_start') }}">
                            {!! $errors->first('coupon_date_start', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('coupon_date_end') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Ngày kết thúc</label>
                            <input type="text" name="coupon_date_end" class="form-control" id="end_coupon"
                            data-validation="required" data-validation-error-msg="Vui lòng điền thông tin"
                            value="{{ old('coupon_date_end') }}">
                            {!! $errors->first('coupon_date_end', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã khuyến mãi</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection