@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thuộc tính
            </header>
            <a href="{{URL::to('/list-category-post')}}" class="btn btn-info edit">Quản lý</a>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-attribute')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thuộc tính</label>
                            <input type="text" name="attribute_name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá trị</label>
                            <input type="color" name="attribute_value">
                        </div>

                        <button type="submit" name="add_attribute" class="btn btn-info">Thêm thuộc tính</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection