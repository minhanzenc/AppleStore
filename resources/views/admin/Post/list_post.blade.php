@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê bài viết
        </div>

        <div class="form-group">
            @if(session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
        </div>
        <div class="table-responsive">

            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên bài viết</th>
                        <th>Slug bài viết</th>
                        <th>Hình sản phẩm</th>
                        <th>Danh mục bài viết</th>
                        <!-- <th style="table-layout: fixed;">Tóm tắt bài viết</th>
                        <th style="table-layout: fixed;">Nội dung bài viết</th> -->
                        <th>Hiển thị</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_post as $key =>$post)
                    <tr>
                        <td>{{ $post -> post_title }}</td>
                        <td>{{ $post -> post_slug }}</td>
                        <td><img class="img-fluid" src="{{asset('public/uploads/post/'.$post -> post_image)}}" alt="">
                        </td>
                        <td>{{ $post -> category_post -> category_post_name}}</td>
                        <td>
                            <span class="text-ellipsis">
                                @if($post -> post_status==1)
                                <a href="{{URL::to('/active-post/'.$post -> post_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                @else

                                <a href="{{URL::to('/unactive-post/'.$post -> post_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            <!-- <a href="{{URL::to('/add-post')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-post/'.$post -> post_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa bài viết?')"
                                href="{{URL::to('delete-post/'.$post -> post_id)}}" class="active style-edit"
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