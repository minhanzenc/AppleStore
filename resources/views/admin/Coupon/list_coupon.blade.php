@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê mã khuyến mãi
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên mã khuyến mãi</th>
                        <th>Mã khuyến mãi</th>
                        <th>Số lượng khuyến mãi</th>
                        <th>Điều kiện khuyến mãi</th>
                        <th>Thành tiền / %</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Trạng thái</th>
                        <th>Hết hạn</th>
                        <th>Gửi mã</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                    <tr>
                        <td>{{ $cou->coupon_name }}</td>
                        <td>{{ $cou->coupon_code }}</td>
                        <td>{{ $cou->coupon_time }}</td>
                        <td>
                            <span class="text-ellipsis">
                                <?php
                              if($cou->coupon_condition==1){
                              ?>
                                Giảm theo %
                                <?php
                              }else{
                              ?>
                                Giảm theo tiền
                                <?php
                              }
                              ?>
                            </span>
                        </td>
                        <td>
                            <span class="text-ellipsis">
                                @if($cou->coupon_condition==1)
                                Giảm {{$cou->coupon_number}} %
                                @else
                                Giảm {{number_format($cou->coupon_number).'₫'}}
                                @endif
                            </span>
                        </td>
                        <td>{{ $cou->coupon_date_start }}</td>
                        <td>{{ $cou->coupon_date_end }}</td>
                        <td>
                            <span class="text-ellipsis">
                                @if($cou->coupon_status==1)
                                <a href="{{URL::to('/active-coupon/'.$cou -> coupon_id)}}"><span style="color:green">Đang kích hoạt</span></a>
                                @else
                                <a href="{{URL::to('/unactive-coupon/'.$cou -> coupon_id)}}"><span
                                style="color:red">Đã khóa</span></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            @if($cou->coupon_date_end>=$today)
                            <span style="color:green">Còn hạn</span>
                            @else
                            <span style="color:red">Đã hết hạn</span>
                            @endif
                        </td>
                        <td>
                            <p>
                                <a href="{{url('/send-coupon-vip', [ 
                                'coupon_time'=> $cou->coupon_time,
                                'coupon_condition'=> $cou->coupon_condition,
                                'coupon_number'=> $cou->coupon_number,
                                'coupon_code'=> $cou->coupon_code])}}"
                                class="btn btn-primary" style="margin:5px 0;">
                                    Gửi mã khách vip
                                </a>
                            </p>
                            <p>
                                <a href="{{url('/send-coupon-regular',[ 
                                'coupon_time'=> $cou->coupon_time,
                                'coupon_condition'=> $cou->coupon_condition,
                                'coupon_number'=> $cou->coupon_number,
                                'coupon_code'=> $cou->coupon_code])}}" class="btn btn-default">
                                    Gửi mã khách thường
                                </a>
                            </p>
                        </td>
                        <td>
                            <a href="{{URL::to('/insert-coupon')}}" class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-plus"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa mã này?')"
                                href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection