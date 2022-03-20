@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê Banner
        </div>
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Mã slider</th>
                        <th>Tên slide</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Tình trạng</th>
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_slide as $key => $slider)
                    <tr>
                        <td>{{ $slider->slider_id }}</td>
                        <td>{{ $slider->slider_name }}</td>
                        <td><img src="public/uploads/slider/{{ $slider->slider_image }}" height="150" width="520"></td>
                        <td>
                            <textarea rows="4" cols="10">
                            {{ $slider->slider_desc }}
                            </textarea>
                        </td>
                        <td><span class="text-ellipsis">
                                @if($slider->slider_status==1)
                                <a href="{{URL::to('/active-slider/'.$slider->slider_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                @else
                                <a href="{{URL::to('/unactive-slider/'.$slider->slider_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                @endif
                            </span></td>
                        <td>
                            <!-- <a href="{{URL::to('/add-slider')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-slider/'.$slider -> slider_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')"
                                href="{{URL::to('/delete-slider/'.$slider->slider_id)}}" class="active styling-edit"
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