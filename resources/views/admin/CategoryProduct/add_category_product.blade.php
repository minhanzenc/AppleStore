@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/all-category-product')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" name="category_product_slug" class="form-control" id="convert_slug" placeholder="Tên danh mục" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh danh mục</label>
                            <input type="file" name="category_product_image" class="form-control" data-validation="required" data-validation-error-msg="Vui lòng thêm hình ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_product_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection