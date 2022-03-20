@extends('layout')
@section('content')

<div class="category_product_title">
    <p>Danh mục sản phẩm</p>
</div>
<div class="category_product">
    @foreach($category as $key => $cate)
    <a href="{{asset(URL::to('/product-list/'.$cate->category_product_slug))}}">
        <div class="category_product_item">
            <img width="100%" src="{{asset('public/uploads/categoryproduct/'.$cate->category_product_image)}}">
            <p>
                {{$cate->category_product_name}}
            </p>
        </div>
    </a>
    @endforeach
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="category_product_title">
            <p>sản phẩm mới</p>
        </div>
    </div>
</div>
<div class="row product__filter">
    @foreach($all_product_new as $key => $product)
    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6  mix new-arrivals">
        <a class="heart" type="button" id="{{$product->product_id}}" onclick="add_wistlist(this.id);">
            <i class="far fa-heart"></i>
        </a>
        <div class="product__item">
            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/product/'.$product->product_slug)}}">
                <div class="product__item__pic set-bg"
                    data-setbg="{{URL::to('public/uploads/product/'.$product->product_image)}}">

                    @if($product->product_status==2)
                    <span class="label">
                        Mới
                    </span>
                    @elseif($product->product_status==1)
                    <span class="label">
                        Khuyến mãi
                    </span>
                    @else
                    @endif

                    @if($product->product_quantity==0)
                    <div class="product_sold_out">
                        <p>Sold out</p>
                    </div>
                    @else
                    @endif
                </div>

            </a>
            <form>
                {{ csrf_field() }}
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                <input type="hidden" id="wishlist_productname{{$product->product_id}}"
                    value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_quantity}}"
                    class="cart_product_quantity_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_image}}"
                    class="cart_product_image_{{$product->product_id}}">

                <input type="hidden" id="wishlist_productprice{{$product->product_id}}"
                    value="{{number_format($product->product_price,0,',','.')}}₫">

                <input type="hidden" value="{{$product->product_price}}"
                    class="cart_product_price_{{$product->product_id}}">

                <img id="wishlist_productimage{{$product->product_id}}"
                    src="{{URL::to('public/uploads/product/'.$product->product_image)}}" style="display:none;" />

                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                <div class="product__item__text">
                    <h6>{{$product->product_name}}</h6>
                    @if($product->product_quantity>0)
                    <a type="button" data-id_product="{{$product->product_id}}" name="add-to-cart"
                        class="add-cart add-to-cart">+ Thêm vào giỏ hàng</a>
                    @else
                    <a>SOLD OUT</a>
                    @endif
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5>{{number_format($product->product_price,0,',','.')}}₫</h5>
                    <div class="product__color__select">
                        <label for="pc-1">
                            <input type="radio" id="pc-1">
                        </label>
                        <label class="active black" for="pc-2">
                            <input type="radio" id="pc-2">
                        </label>
                        <label class="grey" for="pc-3">
                            <input type="radio" id="pc-3">
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="category_product_title">
            <p>sản phẩm khuyến mãi</p>
        </div>
    </div>
</div>
<div class="row product__filter">
    @foreach($all_product_sale as $key => $product)
    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
        <a class="heart" type="button" id="{{$product->product_id}}" onclick="add_wistlist(this.id);">
            <i class="far fa-heart"></i>
        </a>
        <div class="product__item">
            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/product/'.$product->product_slug)}}">
                <div class="product__item__pic set-bg"
                    data-setbg="{{URL::to('public/uploads/product/'.$product->product_image)}}">
                    @if($product->product_status==2)
                    <span class="label">
                        Mới
                    </span>
                    @elseif($product->product_status==1)
                    <span class="label">
                        Khuyến mãi
                    </span>
                    @else
                    @endif
                </div>
            </a>
            <form>
                {{ csrf_field() }}
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                <input type="hidden" id="wishlist_productname{{$product->product_id}}"
                    value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_quantity}}"
                    class="cart_product_quantity_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_image}}"
                    class="cart_product_image_{{$product->product_id}}">

                <input type="hidden" id="wishlist_productprice{{$product->product_id}}"
                    value="{{number_format($product->product_price,0,',','.')}}₫">

                <input type="hidden" value="{{$product->product_price}}"
                    class="cart_product_price_{{$product->product_id}}">

                <img id="wishlist_productimage{{$product->product_id}}"
                    src="{{URL::to('public/uploads/product/'.$product->product_image)}}" style="display:none;" />

                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                <div class="product__item__text">
                    <h6>{{$product->product_name}}</h6>
                    <a type="button" data-id_product="{{$product->product_id}}" name="add-to-cart"
                        class="add-cart add-to-cart">+ Thêm vào giỏ hàng</a>

                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5> {{number_format($product->product_price).'₫'}}</h5>
                    <div class="product__color__select">
                        <label for="pc-1">
                            <input type="radio" id="pc-1">
                        </label>
                        <label class="active black" for="pc-2">
                            <input type="radio" id="pc-2">
                        </label>
                        <label class="grey" for="pc-3">
                            <input type="radio" id="pc-3">
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection