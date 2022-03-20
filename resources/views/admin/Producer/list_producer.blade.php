@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê nhà cung cấp
        </div>
        <!--  -->
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{!! session('error') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Mã nhà cung cấp</th>
                        <th>Tên nhà cung cấp</th>
                        <th>Hiển thị</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_producer as $key =>$producer)
                    <tr>
                        <td>{{$producer -> producer_id}}</td>
                        <td>{{$producer -> producer_name}}</td>
                        <td>
                            <span class="text-ellipsis">
                                @if($producer -> producer_status==1)
                                <a href="{{URL::to('/active-producer/'.$producer -> producer_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                @else
                                <a href="{{URL::to('/unactive-producer/'.$producer -> producer_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                @endif

                            </span>
                        </td>

                        <td>
                            <!-- <a href="{{URL::to('/add-producer')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-producer/'.$producer -> producer_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Nhà cung cấp sản phẩm thuộc Nhà cung cấp cũng sẽ bị xóa. Bạn có chắc muốn xóa nhà cung cấp?')"
                                href="{{URL::to('delete-producer/'.$producer -> producer_id)}}"
                                class="active style-edit" ui-toggle-class="">
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