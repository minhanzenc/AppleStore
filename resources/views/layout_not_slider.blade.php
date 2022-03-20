<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apple Store</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}" type="text/css">
    <!-- <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}" type="text/css"> -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/fontawesome-free-5.15.4-web/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/lightslider.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/prettify.css')}}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <!-- <a href="#">Sign in</a>
                <a href="#">FAQs</a> -->
            </div>
            
            @if(Session::has('customer_id'))  
            <div class="offcanvas__top__hover">
                <span>
                @if(Session::get('customer_image')!='')
                    <img src="{{asset('public/uploads/avata/'.Session::get('customer_image'))}}" alt="">
                @else
                    <i class="far fa-user-circle"></i>
                @endif
                    {{Session::get('customer_name')}}
                    <i class="arrow_carrot-down"></i>
                </span>
                <ul>
                    <a href="{{URL::to('/account-information/'.Session::get('customer_id'))}}">
                        <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                    </a>
                    <a href="{{URL::to('/account-settings/'.Session::get('customer_id'))}}">
                        <li><i class="fa fa-cog"></i> Cài đặt tài khoản</li>
                    </a>
                    <a href="{{URL::to('/logout-checkout')}}">
                        <li><i class="fas fa-sign-out-alt"></i> Đăng xuất</li>
                    </a>
                </ul>
            </div>
            @else
            <div class="offcanvas__top__hover">
                <span><i class="far fa-user-circle"></i> Tài khoản
                    <i class="arrow_carrot-down"></i>
                </span>
                <ul>
                    <a href="{{URL::to('/login-checkout')}}">
                        <li><i class="fas fa-sign-in-alt"></i> Đăng nhập</li>
                    </a>
                    <a href="{{URL::to('/create-customer')}}">
                        <li><i class="fas fa-user-plus"></i> Đăng ký</li>
                    </a>
                </ul>
            </div>
            @endif
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{asset('public/frontend/img/icon/search.png')}}" alt=""></a>
            <a href="{{URL::to('/wistlist')}}"><img src="{{asset('public/frontend/img/icon/heart.png')}}" alt=""></a>
            <a href="{{URL::to('/cart')}}">
                <img src="{{asset('public/frontend/img/icon/cart.png')}}" alt="">
                <div class="count-cart-products"></div>
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Miễn phí vận chuyển với đơn hàng trên 15.000.000₫.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Miễn phí vận chuyển với đơn hàng trên 15.000.000₫.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <!-- <a href="#">Sign in</a>
                                <a href="#">FAQs</a> -->
                            </div>

                            @if(Session::has('customer_id'))
                            <div class="header__top__hover">
                                <span>
                                @if(Session::get('customer_image')!='')
                                    <img src="{{asset('public/uploads/avata/'.Session::get('customer_image'))}}" alt="">
                                @else
                                    <i class="far fa-user-circle"></i>
                                @endif
                                    {{Session::get('customer_name')}}
                                    <i class="arrow_carrot-down"></i>
                                </span>
                                <ul>
                                    <a href="{{URL::to('/account-information/'.Session::get('customer_id'))}}">
                                        <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                                    </a>
                                    <a href="{{URL::to('/account-settings/'.Session::get('customer_id'))}}">
                                        <li><i class="fa fa-cog"></i> Cài đặt tài khoản</li>
                                    </a>
                                    <a href="{{URL::to('/logout-checkout')}}">
                                        <li><i class="fas fa-sign-out-alt"></i> Đăng xuất</li>
                                    </a>
                                </ul>
                            </div>
                            @else
                            <div class="header__top__hover">
                                <span><i class="far fa-user-circle"></i> Tài khoản
                                    <i class="arrow_carrot-down"></i>
                                </span>
                                <ul>
                                    <a href="{{URL::to('/login-checkout')}}">
                                        <li><i class="fas fa-sign-in-alt"></i> Đăng nhập</li>
                                    </a>
                                    <a href="{{URL::to('/create-customer')}}">
                                        <li><i class="fas fa-user-plus"></i> Đăng ký</li>
                                    </a>

                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{URL::to('/')}}"><i class="fab fa-apple"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{URL::to('/')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/store')}}">Sản phẩm</a>
                                <ul class="dropdown">
                                    @foreach($category as $key => $cate)
                                            <li><a
                                                    href="{{asset(URL::to('/product-list/'.$cate->category_product_slug))}}">{{$cate->category_product_name}}</a>
                                            </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="{{URL::to('/blog-list')}}">Tin tức</a>
                                <ul class="dropdown">
                                    @foreach($category_post as $key => $cate_post)
                                    <li><a
                                            href="{{asset(URL::to('/blogs/'.$cate_post->category_post_slug))}}">{{$cate_post->category_post_name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="{{asset('public/frontend/img/icon/search.png')}}" alt=""></a>
                        <a href="{{URL::to('/wistlist')}}"><img src="{{asset('public/frontend/img/icon/heart.png')}}" alt=""></a>
                        <a href="{{URL::to('/cart')}}">
                            <img src="{{asset('public/frontend/img/icon/cart.png')}}" alt="">
                            <div class="count-cart-products"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Product Section Begin -->

    @yield('content')

    <!-- Product Section End -->


    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{URL::to('/')}}"><i class="fab fa-apple"></i>  </a>
                            <span>Store Online</span>
                        </div>
                        <p>Khách hàng là trọng tâm của mô hình kinh doanh độc đáo của chúng tôi, bao gồm cả thiết kế.</p>
                        <a href="#"><img src="{{asset('public/frontend/img/payment.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Sản phẩm</h6>
                        <ul>
                        @foreach($category as $key => $cate)                           
                                <li><a href="{{asset(URL::to('/product-list/'.$cate->category_product_slug))}}">
                                    {{$cate->category_product_name}}</a>
                                </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Tin tức</h6>
                        <ul>
                        @foreach($category_post as $key => $cate_post)
                            <li><a href="{{asset(URL::to('/blogs/'.$cate_post->category_post_slug))}}">{{$cate_post->category_post_name}}</a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Liên hệ với chúng tôi</h6>
                        <div class="footer__newslatter">
                            <p>Hãy là người đầu tiên biết về hàng mới xuất hiện, xem sách, bán hàng và quảng cáo!</p>
                            <form action="#">
                                <input type="text" placeholder="Email của bạn">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                            document.write(new Date().getFullYear());
                            </script>-2020
                            All rights reserved | This template is made with <i class="far fa-heart"></i> by <a href="https://colorlib.com" target="_blank">Quốc Dương</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="{{URL::to('/search')}}" method="POST" autocomplete="off" class="search-model-form">
                {{csrf_field()}}
                <div class="input_container">
                    <img src="{{asset('public/frontend/img/icon/search-icon.svg')}}" class="input_img">
                    <input type="text" id="keywords" id="search-input" name="keywords_submit" placeholder="Tìm kiếm sản phẩm" class="input">
                </div>
                <div id="search_ajax"></div>
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- scrollUp -->
    <a id="button"></a>
    <!-- scrollUp End -->

    <!-- Js Plugins -->
    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!-- <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script> -->
    <script src="{{asset('public/frontend/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('public/frontend/js/mixitup.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery-validation.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/delete_wistlists.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/add_wistlists.min.js')}}"></script>
    


    <script type="text/javascript">
        $.validate({   
        });
    </script>
    
    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();

            if(query != ''){
                var _token = $('input[name="_token"]').val();

                $.ajax({
                url:"{{url('/autocomplete-ajax')}}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                $('#search_ajax').fadeIn();  
                    $('#search_ajax').html(data);
                }
                });

            }else{

                $('#search_ajax').fadeOut();  
            }
        });

        $(document).on('click', '.li_search_ajax', function(){  
            $('#keywords').val($(this).text());  
            $('#search_ajax').fadeOut();  
        }); 
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('fast');
            }, 3000);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:5,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
        });
    </script>

    
    <script type="text/javascript">
    $(document).ready(function() {
        count_cart_products();
        function  count_cart_products() {
            $.ajax({
                url:'{{url('/count-cart-products')}}',
                method:"GET",
                success:function(data){
                    $('.count-cart-products').html(data);
                }
            });
        }
        $('.add-to-cart').click(function() {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                swal("Thêm giỏ hàng không thành công", "Vui lòng nhập số lượng nhỏ hơn "+ cart_product_quantity, "error");
            } else {

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                        cart_product_quantity: cart_product_quantity
                    },
                    success: function() {

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/cart')}}";
                        });
                        count_cart_products();
                    }

                });
            }

        });
    });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            load_comment();

            function load_comment(){
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{url('/load-comment')}}",
                method:"POST",
                data:{product_id:product_id, _token:_token},
                success:function(data){
                
                    $('#comment_show').html(data);
                }
                });
            }
            $('.send-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{url('/send-comment')}}",
                method:"POST",
                data:{
                    product_id:product_id,
                    comment_name:comment_name,
                    comment_content:comment_content,
                     _token:_token
                     },
                success:function(data){
                    
                    $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                    load_comment();
                    $('#notify_comment').fadeOut(9000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                }
                });
            });
        });
    </script>

    <script type="text/javascript">
    function remove_background(product_id){
        for(var count = 1; count <= 5; count++)
        {
        $('#'+product_id+'-'+count).css('color', '#ccc');
        }
    }
    //Hover chuột đánh giá sao
   $(document).on('mouseenter', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        remove_background(product_id);
        for(var count = 1; count<=index; count++)
        {
        $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });
   //Nhả chuột ko đánh giá
   $(document).on('mouseleave', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        var rating = $(this).data("rating");
        remove_background(product_id);
        for(var count = 1; count<=rating; count++)
        {
        $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
        });
    //Click đánh giá sao
    $(document).on('click', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{url('insert-rating')}}",
        method:"POST",
        data:{
            index:index,
            product_id:product_id,
            _token:_token
        },
        success:function(data)
        {
            if(data == 'done')
            {
            alert("Bạn đã đánh giá "+index +" trên 5");
            }
            else
            {
            alert("Lỗi đánh giá");
            }
        }
    });
          
    });
</script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: "{{url('/select-delivery-home')}}",
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });
    });
    </script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('.send_order').click(function() {
            swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Mua hàng",

                    cancelButtonText: "Đóng",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var shipping_name = $('.shipping_name').val();
                        var shipping_email = $('.shipping_email').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_coupon = $('.order_coupon').val();
                        var order_fee_ship = $('.order_fee_ship').val();
                        var city = $('.city').val();
                        var province = $('.province').val();
                        var wards = $('.wards').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data: {
                                shipping_email: shipping_email,
                                shipping_name: shipping_name,
                                shipping_address: shipping_address,
                                shipping_phone: shipping_phone,
                                shipping_notes: shipping_notes,
                                _token: _token,
                                order_coupon: order_coupon,
                                order_fee_ship: order_fee_ship,
                                city: city,
                                province: province,
                                wards: wards,
                                shipping_method: shipping_method
                            },
                            success: function() {
                                swal("Đơn hàng",
                                    "Đơn hàng của bạn đã được gửi thành công",
                                    "success");
                            }
                        });
                        window.setTimeout(function() {
                            location.reload();
                        }, 6000);
                    } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, Vui lòng hoàn tất đơn hàng", "error");
                    }
            });
        });
    });
    </script>
</body>

</html>