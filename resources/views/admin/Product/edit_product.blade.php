@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/all-product')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
    
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-product/'.$all_product->product_id)}}" method="post"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhà cung cấp</label>
                            <select name="producer_id" class="form-control m-bot15">
                                @foreach($all_producer as $key =>$producer)
                                <option {{$all_product->producer_id == $producer->producer_id ? 'selected' : ''}}
                                    value="{{$producer->producer_id}}">{{$producer->producer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_product_id" class="form-control m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                <option {{$all_product->category_product_id == $cate->category_product_id ? 'selected' : ''}}
                                    value="{{$cate->category_product_id}}">{{$cate->category_product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tình trạng</label>
                            <select name="product_status" class="form-control m-bot15">
                                @if($all_product->product_status==2)
                                    <option selected value="2">Mới</option>
                                    <option value="1">Khuyến mãi</option>
                                    <option value="0">Trống</option>
                                @elseif($all_product->product_status==1)
                                    <option value="2">Mới</option>
                                    <option selected value="1">Khuyến mãi</option>
                                    <option value="0">Trống</option>
                                @else
                                    <option value="2">Mới</option>
                                    <option value="1">Khuyến mãi</option>
                                    <option selected value="0">Trống</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$all_product->product_name}}" name="product_name"
                                class="form-control" placeholder="Enter email" id="slug" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin">
                                {!! $errors->first('product_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control" id="convert_slug"
                                value="{{$all_product->product_slug}}" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin">
                                {!! $errors->first('product_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_quantity') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control"  value="{{$all_product->product_quantity}}" data-validation="number" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" >
                            {!! $errors->first('product_quantity', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img class="img-fluid"
                                src="{{asset('public/uploads/product/'.$all_product->product_image)}}" alt="">
                        </div>
                        <div class="form-group {{ $errors->has('product_cost') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá gốc sản phẩm</label>
                            <input type="text" value="{{$all_product->product_cost}}" name="product_cost" class="form-control price_format" id="exampleInputEmail1" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" >
                            {!! $errors->first('product_cost', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" value="{{$all_product->product_price}}" name="product_price" class="form-control price_format" id="exampleInputEmail1" placeholder="Giá sản phẩm" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" >
                            {!! $errors->first('product_price', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_desc') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Tóm tắ sản phẩm</label>
                            <textarea name="product_desc" class="form-control" id="ckeditor3">{{$all_product->product_desc}}
                            </textarea>
                            {!! $errors->first('product_desc', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_content') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea name="product_content" class="form-control" id="ckeditor4">{{$all_product->product_content}}
                            </textarea>
                            {!! $errors->first('product_content', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_parameter') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Thông số kỹ thuật</label>
                            <textarea name="product_parameter"class="form-control" id="ckeditor2" placeholder="Mô tả nội dung sản phẩm" id="ckeditor1">{{$all_product->product_parameter}}
                            </textarea>
                            {!! $errors->first('product_parameter', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
            
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_active" class="form-control m-bot15">
                                @if($all_product->product_active==1)
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option selected value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="edit_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection