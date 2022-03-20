@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm bài viết
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-post')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data" id="post">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Điền tên bài viết"
                                id="slug" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('post_title') }}">
                                {!! $errors->first('post_title', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" placeholder="Điền slug bài viết"
                                id="convert_slug" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('post_slug') }}">
                                {!! $errors->first('post_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control" data-validation="required" data-validation-error-msg="Vui lòng thêm hình ảnh" value="{{ old('post_image') }}">
                            {!! $errors->first('post_image', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('post_desc') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea name="post_desc" class="form-control" rows="3" placeholder="Điền tóm tắt bài viết" style="resize:none">
                            {{ old('post_desc') }}
                            </textarea>
                            {!! $errors->first('post_desc', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea name="post_content" style="resize:none" class="form-control" id="ckeditor2"
                                placeholder="Điền nội dung bài viết" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin">
                                {{ old('post_content') }}
                            </textarea>
                            {!! $errors->first('post_content', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control m-bot15">
                                @foreach($cate_post as $key =>$cate)
                                <option value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_post" class="btn btn-info">Thêm bài viết</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection