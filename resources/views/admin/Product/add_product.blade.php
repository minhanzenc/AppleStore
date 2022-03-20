@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/all-product')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhà cung cấp</label>
                            <select name="producer_id" class="form-control m-bot15">
                                @foreach($all_producer as $key =>$producer)
                                <option value="{{$producer->producer_id}}">{{$producer->producer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_product_id" class="form-control m-bot15">
                                @foreach($cate_product as $key =>$cate)
                                <option value="{{$cate->category_product_id}}">{{$cate->category_product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tình trạng</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="2">Mới</option>
                                <option value="1">Khuyến mãi</option>
                                <option value="0">Trống</option>
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('product_name') }}">
                                {!! $errors->first('product_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control" id="convert_slug" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('product_slug') }}">
                                {!! $errors->first('product_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_quantity') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" name="product_quantity" class="form-control" data-validation="number"
                                data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" value="{{ old('product_quantity') }}">
                                {!! $errors->first('product_quantity', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_image') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" data-validation="required" data-validation-error-msg="Vui lòng thêm hình ảnh" value="{{ old('product_image') }}">
                            {!! $errors->first('product_image', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá gốc sản phẩm</label>
                            <input type="text" name="product_cost" class="form-control price_format" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" value="{{ old('product_cost') }}">
                                {!! $errors->first('product_cost', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control price_format" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin(Phải là số)" value="{{ old('product_price') }}">
                                {!! $errors->first('product_price', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <!--  -->

                        <div class="form-group {{ $errors->has('product_desc') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Tóm tắt sản phẩm</label>
                            <textarea name="product_desc" class="form-control" id="ckeditor1">
                            {{ old('product_desc') }}
                            </textarea>
                            {!! $errors->first('product_desc', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_content') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea name="product_content" style="resize:none" class="form-control" id="ckeditor2" >
                            {{ old('product_content') }}
                            </textarea>
                            {!! $errors->first('product_content', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_parameter') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Thông số kỹ thuật</label>
                            <textarea name="product_parameter" class="form-control" id="ckeditor3">
                            {{ old('product_parameter') }}
                            </textarea>
                            {!! $errors->first('product_parameter', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_active" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection