@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục bài viết
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-category-post')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-post')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="category_post_name" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();" data-validation="required"
                                 data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục bài viết</label>
                            <input type="text" name="category_post_slug" class="form-control" id="convert_slug"
                                placeholder="Tên danh mục" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_post_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_post" class="btn btn-info">Thêm danh mục bài
                            viết</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection