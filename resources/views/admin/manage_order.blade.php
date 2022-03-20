@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
        </div>

        <div class="table-responsive">
            @if(session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Mã đơn hàng</th>
                        <th>Thời gian đặt</th>
                        <th>Tình trạng đơn hàng</th>
                        <th style="width:30px;">Xem đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($order as $key => $ord)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $ord->order_code }}</td>
                        <td>{{ $ord->created_at }}</td>
                        <td>@if($ord->order_status==1)
                            <span style="color: #0071e3;">Đơn hàng mới</span>
                            @elseif($ord->order_status==2)
                            <span style="color: #27c24c;">Đã xử lý</span>
                            @else
                            <span style="color: #e53637;">Hủy đơn hàng</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection