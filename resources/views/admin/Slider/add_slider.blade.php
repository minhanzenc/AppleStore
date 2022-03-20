@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Slider
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-slider')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-slider')}}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @if(session('success'))
                            <div class="alert alert-success">{!! session('success') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slide</label>
                            <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1"
                                placeholder="Slide" data-validation="required"
                                data-validation-error-msg="Vui lòng thêm hình ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả slider</label>
                            <textarea style="resize: none" id="ckeditor3" class="form-control" name="slider_desc"
                                id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="slider_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>

                            </select>
                        </div>

                        <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection