@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <a href="{{URL::to('/lien-he')}}" class="title_info">Đi đến trang thông tin apple store <i class="far fa-arrow-alt-circle-right"></i></a>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                @foreach($contact as $key => $cont)
                    <form role="form" action="{{URL::to('/update-info/'.$cont->info_id)}}" method="post"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">   
                            @if(session('success'))
                                    <div class="alert alert-success">{!! session('success') !!}</div>
                            @endif    
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thông tin liên hệ</label>
                            <textarea style="resize: none" rows="8" class="form-control"
                                name="info_contact" id="ckeditor1" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">{{$cont->info_contact}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="info_map" id="exampleInputPassword1" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">{{$cont->info_map}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh logo</label>
                            <input type="file" name="info_image" class="form-control" id="exampleInputEmail1" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                            <img src="{{url('/public/uploads/Contact/'.$cont->info_logo)}}" height="100" width="100">
                        </div>
                        <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin</button>
                    </form>

                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection