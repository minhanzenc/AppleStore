@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thư viện ảnh
            </header>
            <a href="{{URL::to('/all-product')}}" class="btn btn-info edit">Quản lý</a>
            <div class="panel-body">
                <div class="position-center">

                    <div class="form-group">
                    @if(session('success'))
                        <div class="alert alert-success">{!! session('success') !!}</div>
                    @endif
                    </div>
                    <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                                <span id="error_gallery"></span>
                            </div>
                            <div class="col-md-4" >
                                <input type="submit" name="upload" value="Tải ảnh" class="btn btn-success ">
                            </div>
                            
                        </div>
                        </form>

                    <input class="pro_id" type="hidden" name="pro_id" value="{{$pro_id}}">
                    <form>
                    {{csrf_field()}}
                        <div id="gallery_load">
                                   
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>
    </div>
</div>
@endsection