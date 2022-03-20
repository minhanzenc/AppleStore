@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif
        <div class="table-responsive">

            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Danh mục sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Sô lượng sản phẩm trong kho</th>
                        <th>Hình sản phẩm</th>
                        <th>Thư viện hình sản phẩm</th>
                        <th>Giá gốc sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Tình trạng</th>
                        <th>Hiển thị</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key =>$pro)
                    <tr>
                        <td>{{ $pro -> category_product -> category_product_name}}</td>
                        <td>{{ $pro -> product_id }}</td>
                        <td>{{ $pro -> product_name }}</td>
                        <td>{{ $pro->product_quantity }}</td>
                        <td><img class="img-fluid" src="public/uploads/product/{{ $pro -> product_image }}" alt=""></td>
                        <td><a href="{{URL::to('/add-gallery/'.$pro -> product_id)}}">Thư viện ảnh</a></td>
                        <td>{{number_format($pro -> product_cost,0,',','.')}}₫</td>
                        <td>{{number_format($pro -> product_price,0,',','.')}}₫</td>
                        <td>
                            <span class="text-ellipsis">
                                @if($pro -> product_status==2)
                                Mới
                                @elseif($pro -> product_status==1)
                                Khuyến mãi
                                @else
                                Trống
                                @endif
                            </span>
                        </td>
                        
                        <!-- <td>{!! $pro -> product_desc !!}</td>
                        <td>
                            <textarea rows="4" cols="10">
                                {{ $pro -> product_content }}
                            </textarea>
                        </td> -->
                        <td>
                            <span class="text-ellipsis">
                                <?php
                                    if($pro -> product_active==1){
                                ?>
                                <a href="{{URL::to('/active-product/'.$pro -> product_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                <?php
                                    }else{
                                ?>
                                <a href="{{URL::to('/unactive-product/'.$pro -> product_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                <?php        
                                    }
                                ?>
                            </span>
                        </td>
                        <td>
                            <!-- <a href="{{URL::to('/add-product')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-product/'.$pro -> product_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')"
                                href="{{URL::to('delete-product/'.$pro -> product_id)}}" class="active style-edit"
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