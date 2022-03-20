<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" /> -->
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- //font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/fontawesome-free-5.15.4-web/css/all.css')}}">

    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline  12 June’13</p>
                                        </div>
                                                <span class="notification-pie-chart pull-right" data-percent="45">
                                        <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-envelope"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                    <span class="subject">
                                    <span class="from">Jonathan Smith</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <span class="username">
                                <?php
                                $name=Session::get('admin_name');
                                if($name){
                                    echo $name;
                                }
                            ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="far fa-chart-bar"></i>
                                <span>Thống kê doanh thu</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{URL::to('/information')}}">
                                <i class="fa fa-info-circle"></i>
                                <span>Thông tin Apple Store</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{URL::to('/manage-order')}}">
                                <i class="fas fa-file-alt"></i>
                                <span>Quản lý đơn hàng</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{URL::to('/comment')}}">
                                <i class="fas fa-comments"></i>
                                <span>Quản lý bình luận</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span>Danh sách khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-customer-admin')}}">
                                        <i class="fas fa-user-plus"></i> Thêm khách hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-customer')}}">
                                        <i class="fas fa-list-ol"></i> Quản lý khách hàng
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="far fa-building"></i>
                                <span>Danh sách nhà cung cấp</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-producer')}}">
                                        <i class="far fa-plus-square"></i> Thêm nhà cung cấp
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-producer')}}">
                                        <i class="far fa-list-alt"></i> Quản lý nhà cung cấp
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="far fa-list-alt"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-category-product')}}">
                                        <i class="far fa-plus-square"></i> Thêm danh mục sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/all-category-product')}}">
                                        <i class="far fa-list-alt"></i> Quản lý danh mục sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thuộc tính</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-attribute')}}">Thêm thuộc tính</a></li>
                                <li><a href="{{URL::to('/list-attribute')}}">Quản lý thuộc tính</a></li>

                            </ul>
                        </li> -->

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fab fa-apple"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-product')}}">
                                        <i class="far fa-plus-square"></i> Thêm sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/all-product')}}">
                                        <i class="far fa-list-alt"></i> Quản lý sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fas fa-ticket-alt"></i>
                                <span>Mã khuyến mãi</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/insert-coupon')}}">
                                        <i class="far fa-plus-square"></i> Thêm mã khuyến mãi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-coupon')}}">
                                        <i class="far fa-list-alt"></i> Quản lý mã khuyến mãi
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fas fa-th"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-category-post')}}">
                                        <i class="far fa-plus-square"></i> Thêm danh mục bài viết
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-category-post')}}">
                                        <i class="far fa-list-alt"></i> Quản lý danh mục bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fab fa-blogger-b"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-post')}}">
                                        <i class="far fa-plus-square"></i> Thêm bài viết
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-post')}}">
                                        <i class="far fa-list-alt"></i> Quản lý bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-picture-o"></i>
                                <span>Slider</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{URL::to('/add-slider')}}">
                                        <i class="far fa-plus-square"></i> Thêm slider
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('/list-slider')}}">
                                        <i class="far fa-list-alt"></i> Quản lý slider
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('admin_content')


            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery-validation.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


    <script type="text/javascript">
        $('#select_attribute').change(function(event){
            var _ip = $('#select_attribute').val();
            if(_ip == '2'){
                $('.value2').show();
                $('#v2').attr({
                    name: 'coupon_number',
                });
                $('.value1').hide();
                $('#v1').attr({
                    name: '',
                });
            }else{
                $('.value1').show();
                $('#v1').attr({
                    name: 'coupon_number',
                });
                $('.value2').hide();
                $('#v2').attr({
                    name: '',
                });
            }
        });
    </script>


    <script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
    </script>

    <script type="text/javascript">
    $( function() {
        $( "#start_coupon" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"dd/mm/yy",
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
            duration: "slow"
        });
        $( "#end_coupon" ).datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"dd/mm/yy",
            dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
            duration: "slow"
        });
    });
    </script>

    <script type="text/javascript">
    function ChangeToSlug() {
        var slug;

        //Lấy text từ thẻ input title 
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('fast');
            }, 3000);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#category_order').sortable({
                placeholder: 'ui-state-highlight',
                update  : function(event, ui)
                {
                    var page_id_array = new Array();
                    var _token = $('input[name="_token"]').val();

                    $('#category_order tr').each(function(){
                        page_id_array.push($(this).attr("id"));
                    });
                    
                    $.ajax({
                            url:"{{url('/arrange-category')}}",
                            method:"POST",
                            data:{page_id_array:page_id_array,_token:_token},
                            success:function(data)
                            {
                                alert(data);
                            }
                    });
                }
            });
        });
    </script>


    <script type="text/javascript">
    $(document).ready(function() {
        load_gallery();

        function load_gallery() {
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url: "{{url('/select-gallery')}}",
                method: "POST",
                data: {
                    pro_id: pro_id,
                    _token: _token
                },
                success: function(data) {
                    $('#gallery_load').html(data);
                }
            });
        }

        $('#file').change(function() {
            var error = '';
            var files = $('#file')[0].files;

            if (files.length > 8) {
                error += '<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
            } else if (files.length == '') {
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            } else if (files.size > 2000000) {
                error += '<p>File ảnh không được lớn hơn 2MB</p>';
            }

            if (error == '') {

            } else {
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                return false;
            }

        });

        $(document).on('blur', '.edit_gal_name', function() {
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/update-gallery-name')}}",
                method: "POST",
                data: {
                    gal_id: gal_id,
                    gal_text: gal_text,
                    _token: _token
                },
                success: function(data) {
                    load_gallery();
                    $('#error_gallery').html(
                        '<div class="alert alert-success centered">Cập nhật tên hình ảnh thành công</div>'
                    );
                }
            });
        });

        $(document).on('click', '.delete-gallery', function() {
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                $.ajax({
                    url: "{{url('/delete-gallery')}}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<div class="alert alert-success centered">Xóa hình ảnh thành công</div>'
                        );
                    }
                });
            }
        });

        $(document).on('change', '.file_image', function() {
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-" + gal_id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
            form_data.append("gal_id", gal_id);
            $.ajax({
                url: "{{url('/update-gallery')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    load_gallery();
                    $('#error_gallery').html(
                        '<div class="alert alert-success centered">Cập nhật hình ảnh thành công</div>'
                    );
                }
            });
        });
    });
    </script>

    <script type="text/javascript">
        $('.comment_duyet_btn').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            if(comment_status==1){
                var alert = 'Thay đổi thành duyệt thành công';
            }else{
                var alert = 'Thay đổi thành không duyệt thành công';
            }
            $.ajax({
                    url:"{{url('/allow-comment')}}",
                    method:"POST",

                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        comment_status:comment_status,
                        comment_id:comment_id,
                        comment_product_id:comment_product_id
                    },
                    success:function(data){
                        location.reload();
                    $('#notify_comment').html('<div class="alert alert-success">'+alert+'</div>');

                    }
                });
        });
        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_'+comment_id).val();
            var comment_product_id = $(this).data('product_id');
          
            $.ajax({
                    url:"{{url('/reply-comment')}}",
                    method:"POST",

                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        comment:comment,
                        comment_id:comment_id,
                        comment_product_id:comment_product_id
                        },
                    success:function(data){
                        $('.reply_comment_'+comment_id).val('');
                    $('#notify_comment').html('<div class="alert alert-success">Trả lời bình luận thành công</div>');

                    }
                });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

    <script type="text/javascript">
        $.validate({   
        });
    </script>

    <script>
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
    CKEDITOR.replace('ckeditor4');
    </script>

    <script type="text/javascript">
    $('.order_details').change(function() {
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //Lấy ra số lượng
        quantity = [];
        $("input[name='product_sales_quantity']").each(function() {
            quantity.push($(this).val());
        });
        //Lấy ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function() {
            order_product_id.push($(this).val());
        });
        j = 0;
        for (i = 0; i < order_product_id.length; i++) {
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                j = j + 1;
                if (j == 1) {
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_' + order_product_id[i]).css('background', '#000');
            }
        }
        if (j == 0) {
            $.ajax({
                url: '{{url('/update-order-qty')}}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_status: order_status,
                    order_id: order_id,
                    quantity: quantity,
                    order_product_id: order_product_id
                },
                success: function(data) {
                    alert('Thay đổi tình trạng đơn hàng thành công');
                    location.reload();
                }
            });
        }
    });
    </script>

    <script type="text/javascript">
    $('.update_quantity_order').click(function() {
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_' + order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/update-qty')}}',
            method: 'POST',
            data: {
                _token: _token,
                order_product_id: order_product_id,
                order_qty: order_qty,
                order_code: order_code
            },
            // dataType:"JSON",
            success: function(data) {
                alert('Cập nhật số lượng thành công');
                location.reload();
            }
        });

    });
    </script>

    <!-----------------Revenue Statistics------------------>

    <script type="text/javascript">
        $( function() {
            $( "#datepicker" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
                duration: "slow"
            });
            $( "#datepicker2" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
                duration: "slow"
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
            chart60daysorder();
            var chart = new Morris.Bar({
                element: 'chart',
                //option chart
                lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#6932a8'],
                    parseTime: false,
                    hideHover: 'auto',
                    xkey: 'period',
                    ykeys: ['order','sales','profit','quantity'],
                    labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
                });
            function chart60daysorder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/days-order')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{_token:_token},
                    
                    success:function(data){
                        chart.setData(data);
                    }   
                });
            }

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            // alert(dashboard_value);
            $.ajax({
                url:"{{url('/dashboard-filter')}}",
                method:"POST",
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token},
                success:function(data){
                    chart.setData(data);
                }   
            });
        });

        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url:"{{url('/filter-by-date')}}",
                method:"POST",
                dataType:"JSON",
                data:{
                    from_date:from_date,
                    to_date:to_date,
                    _token:_token
                },
                success:function(data){
                    chart.setData(data);
                }   
            });
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
            var donut = Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#a8328e',
                '#61a1ce',
                '#ce8f61',
                '#f5b942',
                '#4842f5'
                
            ],
            labelColor:"#cccccc", // text color
            backgroundColor: '#333333', // border color
            data: [
                {label:"Sản phẩm", value:{{ $app_product }}},
                {label:"Bài viết", value:{{ $app_post }}},
                {label:"Đơn hàng", value:{{ $app_order }}},
                {label:"Khách hàng", value:{{ $app_customer }}} 
            ]
            });
        
    });
    </script>


    <!----------------End Revenue Statistics----------------->

    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->
    <script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }

        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
            behaveLikeLine: true,
            gridEnabled: false,
            gridLineColor: '#dddddd',
            axes: true,
            resize: true,
            smooth: true,
            pointSize: 0,
            lineWidth: 0,
            fillOpacity: 0.85,
            data: [{
                    period: '2015 Q1',
                    iphone: 2668,
                    ipad: null,
                    itouch: 2649
                },
                {
                    period: '2015 Q2',
                    iphone: 15780,
                    ipad: 13799,
                    itouch: 12051
                },
                {
                    period: '2015 Q3',
                    iphone: 12920,
                    ipad: 10975,
                    itouch: 9910
                },
                {
                    period: '2015 Q4',
                    iphone: 8770,
                    ipad: 6600,
                    itouch: 6695
                },
                {
                    period: '2016 Q1',
                    iphone: 10820,
                    ipad: 10924,
                    itouch: 12300
                },
                {
                    period: '2016 Q2',
                    iphone: 9680,
                    ipad: 9010,
                    itouch: 7891
                },
                {
                    period: '2016 Q3',
                    iphone: 4830,
                    ipad: 3805,
                    itouch: 1598
                },
                {
                    period: '2016 Q4',
                    iphone: 15083,
                    ipad: 8977,
                    itouch: 5185
                },
                {
                    period: '2017 Q1',
                    iphone: 10697,
                    ipad: 4470,
                    itouch: 2038
                },

            ],
            lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });


    });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
    </script>
    <!-- //calendar -->
</body>

</html>