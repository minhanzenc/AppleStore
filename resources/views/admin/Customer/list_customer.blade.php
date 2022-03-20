@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê khách hàng
        </div>
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Mã khách hàng</th>
                        <th>Họ tên khách hàng</th>
                        <th>Địa chỉ email</th>
                        <th>Số điện thoại</th>
                        <th>Mật khẩu</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_customer as $key =>$ctm)
                    <tr>
                        <td>{{$ctm -> customer_id}}</td>
                        <td>{{$ctm -> customer_name}}</td>
                        <td>{{$ctm -> customer_email}}</td>
                        <td>{{$ctm -> customer_phone}}</td>
                        <td>{{$ctm -> customer_password}}</td>
                        <td>
                            <!-- <a href="{{URL::to('/add-customer-admin')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-customer/'.$ctm -> customer_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-customer/'.$ctm -> customer_id)}}" class="active style-edit"
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