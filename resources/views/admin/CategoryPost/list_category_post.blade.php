@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý danh mục bài viết
        </div>

        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên danh mục bài viết</th>
                        <th>Slug danh mục bài viết</th>
                        <th>Hiển thị</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category_post as $key =>$cate_post)
                    <tr>
                        <td>{{$cate_post -> category_post_name}}</td>
                        <td>{{$cate_post->category_post_slug}}</td>
                        <td><span class="text-ellipsis">
                                <?php
                            if($cate_post -> category_post_status==1){
                        ?>
                                <a href="{{URL::to('/active-category-post/'.$cate_post ->category_post_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                <?php
                            }else{
                        ?>
                                <a href="{{URL::to('/unactive-category-post/'.$cate_post ->category_post_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                <?php        
                            }
                        ?>
                            </span></td>
                        <td>
                            <!-- <a href="{{URL::to('/add-category-post')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-category-post/'.$cate_post -> category_post_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục tin tức thì tin túc thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-category-post/'.$cate_post -> category_post_id)}}"
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