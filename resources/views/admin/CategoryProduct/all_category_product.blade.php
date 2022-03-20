@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
        </div>
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{!! session('error') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Slug danh mục</th>
                        <th>Hình danh mục</th>
                        <th>Hiển thị</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <style type="text/css">
                #category_order .ui-state-highlight {
                    padding: 24px;
                    background-color: #ffffcc;
                    border: 1px dotted #ccc;
                    cursor: move;
                    margin-top: 12px;
                }
                </style>
                <tbody id="category_order">
                    @foreach($all_category_product as $key =>$cate_pro)
                    <tr id="{{$cate_pro->category_product_id}}">
                        <td>{{$cate_pro -> category_product_name}}</td>
                        <td>{{ $cate_pro->category_product_slug }}</td>
                        <td><img class="img-category-product"
                                src="public/uploads/categoryproduct/{{ $cate_pro -> category_product_image }}" alt="">
                        </td>
                        <!-- <td>
                            @if($cate_pro -> category_product_parent == 0)
                            Danh mục cha
                            @else
                            @foreach($category_product as $key => $category_sub_product)
                            @if($category_sub_product -> category_product_id == $cate_pro -> category_product_parent)
                            {{$category_sub_product -> category_product_name}}
                            @endif
                            @endforeach
                            @endif
                        </td> -->
                        <td><span class="text-ellipsis">
                                @if($cate_pro -> category_product_status==1)

                                <a href="{{URL::to('/active-category-product/'.$cate_pro -> category_product_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                @else
                                <a href="{{URL::to('/unactive-category-product/'.$cate_pro -> category_product_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                @endif
                            </span></td>
                        <td>
                            <!-- <a href="{{URL::to('/add-category-product')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-category-product/'.$cate_pro -> category_product_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục sản phẩm thì sản phẩn thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-category-product/'.$cate_pro -> category_product_id)}}"
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