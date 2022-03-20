@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục bài viết
            </header>
            <a href="{{URL::to('/list-category-post')}}" class="btn btn-info edit">Quản lý</a>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-post/'.$category_post->category_post_id)}}"
                        method="post">
                        {{csrf_field()}}
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="category_post_name" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();"
                                value="{{$category_post->category_post_name}}" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục bài viết</label>
                            <input type="text" name="category_post_slug" class="form-control" id="convert_slug"
                                placeholder="Tên danh mục" value="{{$category_post->category_post_slug}}"
                                data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                            <textarea name="category_post_desc" style="resize:none" rows=8 class="form-control"
                                id="exampleInputPassword1" placeholder="Mô tả danh mục">
                                {{$category_post->category_post_desc}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_post_status" class="form-control m-bot15">
                                @if($category_post->category_post_status==1)
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                @else
                                <option value="1">Hiển thị</option>
                                <option selected value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="edit_category_post" class="btn btn-info">Cập nhật danh mục bài
                            viết</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection