<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - @yield('title')</title>

    <!-- <link rel="stylesheet" href="{{asset('/public/frontend/electro-master/css/contact.css')}}"> -->
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link rel="icon" href="{{asset('public/frontend/electro-master/img/Electro.png')}}" />

    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/sweetalert.css')}}" />
    <!-- <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/lightgallery.css')}}" /> -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/lightslider.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/prettify.css')}}" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/bootstrap.min.css')}}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/slick.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/slick-theme.css')}}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/nouislider.min.css')}}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('public/frontend/electro-master/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/style.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/detail-product.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/cart.css')}}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="tel:335588195"><i class="fa fa-phone"></i> +84 335588195</a></li>
                    <li><a href="mailto:nguyenvanvy1509@gmail.com"><i class="fa fa-envelope-o"></i> nguyenvanvy1509@gmail.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 245 Lê Thanh Nghị</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <?php
                    $user_id = Session::get('user_id');
                    $customer_id = Session::get('customer_id');
                    $name = Session::get('user_name');

                    if ($user_id == NULL && $customer_id == NULL) { ?>
                        <li><a href="{{URL::to('/user-login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng Nhập</a></li>
                        <li><a href="{{URL::to('/sign-up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng Ký</a></li>
                    <?php
                    } else { ?>
                        <li><a href="#"><i class="fa fa-user-o"></i> Hi! <?php echo $name; ?></a></li>
                        <li><a href="{{URL::to('/lich-su-don-hang')}}"><i class="fa fa-history" aria-hidden="true"></i> Lịch sử đơn hàng</a></li>
                        <li><a href="{{URL::to('/user-logout')}}"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{URL::to('/')}}" class="logo">
                                <img src="{{asset('public/frontend/electro-master/img/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="{{URL::to('/search')}}" method="POST">
                                {{ csrf_field() }}
                                <!-- <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="1">Category 01</option>
                                    <option value="1">Category 02</option>
                                </select> -->
                                <input name="keyword" class="input w-100" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px" placeholder="Nhập từ khoá bạn muốn tìm...">
                                <button type="submit" class="search-btn">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a data-toggle="modal" data-target="#myModal2" style="cursor: pointer;">
                                    <i class="fa fa-heart-o"></i>
                                    <span>SP Yêu Thích</span>
                                    <div class="qty sp-yt-qty"></div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <!-- <div class="dropdown" style="cursor:pointer;">
                                <a href="{{ URL::to('/show-cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ Cart::count() }}</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{('public/frontend/img/product01.png')}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{('public/frontend/img/product02.png')}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="dropdown">
                                <a href="{{ URL::to('/cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng</span>
                                    <div class="qty qty-cart-count">0</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @if(Session::get('cart'))
                                        @foreach(Session::get('cart') as $key => $cart)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{asset('public/uploads/products/' .$cart['product_image'])}}" alt="{{$cart['product_name']}}">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="{{URL::to('/chi-tiet-san-pham/'.$cart['product_id'])}}">{{$cart['product_name']}}</a></h3>
                                                <h4 class="product-price">Số lượng: <span class="qty" style="font-weight:bold;">{{$cart['product_qty']}}</span></h4>
                                            </div>
                                            <a class="delete" href="{{URL::to('/delete-product-cart-ajax/' .$cart['session_id'])}}"><i class="fa fa-close"></i></a>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="product-widget">
                                            <!-- <div class="product-img"> -->
                                            <img width="100%" height="100%" src="{{asset('public/frontend/electro-master/img/empty-cart.png')}}" alt="Chưa có sản phẩm trong giỏ hàng">
                                            <!-- </div> -->
                                            <p style="text-align: center; font-weight:bold;">Chưa có sản phẩm nào trong giỏ hàng</p>
                                        </div>
                                        @endif
                                    </div>
                                    @if(Session::get('cart'))
                                    @php
                                    $subtotal = $cart['product_price']*$cart['product_qty'];
                                    @endphp
                                    <div class="cart-summary">
                                        <small><strong>{{$cart['product_qty']}} SP được chọn</strong></small>
                                        <h5>SUBTOTAL: {{number_format($subtotal)}} VNĐ</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{URL::to('/cart')}}">Xem giỏ hàng</a>
                                        <a href="{{URL::to('/checkout')}}">Thanh toán <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->


    <!-- CONTAINER -->
    @yield('main')
    <!-- /CONTAINER -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Đăng ký để nhận những thông tin mới nhất từ chúng tôi</p>
                        <form>
                            <input class="input" type="email" placeholder="Nhập email của bạn">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Đăng ký</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Về chúng tôi</h3>
                            <p>Electro là một cửa hàng về đồ công nghệ.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>245 Lê Thanh Nghị</a></li>
                                <li><a href="tel:0335588195"><i class="fa fa-phone"></i>+84 335588195</a></li>
                                <li><a href="mailto:nguyenvanvy1509@gmail.com"><i class="fa fa-envelope-o"></i>nguyenvanvy1509@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Danh mục</h3>
                            <ul class="footer-links">
                                <li><a href="{{ URL::to('/shop') }}">Cửa hàng</a></li>
                                <li><a href="{{ URL::to('/category/2') }}">Máy tính</a></li>
                                <li><a href="{{ URL::to('/category/1') }}">Điện thoại</a></li>
                                <li><a href="{{ URL::to('/category/3') }}">Bàn phím</a></li>
                                <li><a href="{{ URL::to('/category/4') }}">Tai nghe</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Thông tin về chúng tôi</h3>
                            <ul class="footer-links">
                                <li><a href="#">Về Electro</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Chính sách riêng tư</a></li>
                                <li><a href="{{URL::to('/term-and-conditions')}}">Điền khoản & Điều kiện</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Dịch vụ</h3>
                            <ul class="footer-links">
                                <li><a href="#">Tài khoản của bạn</a></li>
                                <li><a href="#">Xem giỏ hàng</a></li>
                                <li><a href="#">SP yêu thích</a></li>
                                <li><a href="#">Giúp đỡ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This
                            template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- Modal -->
        <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">SẢN PHẨM YÊU THÍCH</h4>
                    </div>

                    <div class="modal-body">
                        <div id="row-wishlist" class="row">
                        </div>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div>
        <!-- modal -->
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{asset('public/frontend/electro-master/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/slick.min.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/nouislider.min.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/sweetalert.min.js')}}"></script>
    <!-- <script src="{{asset('public/frontend/electro-master/js/lightgallery.min.js')}}"></script> -->
    <script src="{{asset('public/frontend/electro-master/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/electro-master/js/prettify.js')}}"></script>
    <script type="text/javascript">
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 4
        });
    </script>

    <!-- <script type="text/javascript">
        $('.brand-filter').click(function() {
            var brand = [],
                tempArr = [];
            $.each($("[data-filter='brand']:checked"), function() {
                tempArr.push($(this).val());
            });
            tempArr.reverse();
            if (tempArr.length !== 0) {
                brand += '?brand=' + tempArr.toString();
            }
            window.location.href = brand
        });
    </script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            loadComment();

            function loadComment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/load-comments",
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#show-comment').html(data);
                    },
                });
            }

            $('.button-submit-reivews').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_text = $('.comment_text').val();
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/send-comments",
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_text: comment_text,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment-success').html('<div class="alert alert-success">Thêm bình luận thành công, bình luận của bạn sẽ được duyệt sớm!</div>');
                        loadComment();
                        $('#comment-success').fadeOut(3000);
                        $('.comment_name').val('');
                        $('.comment_text').val('');
                    },
                });
            });
        });
    </script>

    <script type="text/javascript">
        // show cart quantity
        showCartQuantity();

        function showCartQuantity() {
            $.ajax({
                url: "http://localhost:81/DATN_ELaravel/show-cart-quantity",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                success: function(data) {
                    $('.qty-cart-count').text(data);
                },
            });
        }

        $(document).ready(function() {

            $('.add-to-cart-btn').click(function() {
                var product_id = $(this).data('id');
                var ajax_cart_pro_id = $('.ajax_cart_product_id_' + product_id).val();
                var ajax_cart_pro_name = $('.ajax_cart_product_name_' + product_id).val();
                var ajax_cart_pro_img = $('.ajax_cart_product_image_' + product_id).val();
                var ajax_cart_pro_price = $('.ajax_cart_product_price_' + product_id).val();
                var ajax_cart_pro_quantity = $('.ajax_cart_product_quantity_' + product_id).val();
                var ajax_cart_pro_qty = $('.ajax_cart_product_qty_' + product_id).val();
                var _token = $('input[name="_token"]').val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (parseInt(ajax_cart_pro_qty) > parseInt(ajax_cart_pro_quantity)) {
                    swal({
                        title: "Bạn đã đặt lớn hơn số hàng có trong kho.",
                        text: "Hãy liên hệ với chúng tôi để đặt hàng số lượng lớn bạn nhé!",
                        type: "warning",
                        // showCancelButton: true,
                        // cancelButtonText: "Xem tiếp",
                        confirmButtonText: "Ok",
                        // confirmButtonClass: "btn-success",
                        closeOnConfirm: false
                    });
                } else {
                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/add-cart-ajax",
                        method: 'post',
                        data: {
                            'ajax_cart_pro_id': ajax_cart_pro_id,
                            'ajax_cart_pro_name': ajax_cart_pro_name,
                            'ajax_cart_pro_img': ajax_cart_pro_img,
                            'ajax_cart_pro_price': ajax_cart_pro_price,
                            'ajax_cart_pro_qty': ajax_cart_pro_qty,
                            'ajax_cart_pro_quantity': ajax_cart_pro_quantity,
                            '_token': _token
                        },
                        success: function() {
                            swal({
                                    title: "Add to cart successfully",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    type: "success",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonText: "Go to cart",
                                    confirmButtonClass: "btn-success",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/cart')}}";
                                },
                                showCartQuantity()
                            );
                        },
                    });
                }

            });
        });
    </script>

    <!-- Add to cart in quick view -->
    <script type="text/javascript">
        $(document).on('click', '.add-to-cart-btn-quick', function() {
            var product_id = $(this).data('id_product');
            var ajax_cart_pro_id = $('.ajax_cart_product_id_' + product_id).val();
            var ajax_cart_pro_name = $('.ajax_cart_product_name_' + product_id).val();
            var ajax_cart_pro_img = $('.ajax_cart_product_image_' + product_id).val();
            var ajax_cart_pro_price = $('.ajax_cart_product_price_' + product_id).val();
            var ajax_cart_pro_quantity = $('.ajax_cart_product_quantity_' + product_id).val();
            var ajax_cart_pro_qty = $('.ajax_cart_product_qty_' + product_id).val();
            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "http://localhost:81/DATN_ELaravel/add-cart-ajax",
                method: 'post',
                data: {
                    'ajax_cart_pro_id': ajax_cart_pro_id,
                    'ajax_cart_pro_name': ajax_cart_pro_name,
                    'ajax_cart_pro_img': ajax_cart_pro_img,
                    'ajax_cart_pro_price': ajax_cart_pro_price,
                    'ajax_cart_pro_qty': ajax_cart_pro_qty,
                    'ajax_cart_pro_quantity': ajax_cart_pro_quantity,
                    '_token': _token
                },
                success: function() {
                    swal({
                            title: "Thêm giỏ hàng thành công",
                            text: "Bạn có thể xem tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            type: "success",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonText: "Đến giỏ hàng",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false
                        },
                        showCartQuantity()
                    );
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.quick-view').click(function() {
                var product_id = $(this).data('id_product');
                // var ajax_cart_pro_id = $('.ajax_cart_product_id_' + product_id).val();
                // var ajax_cart_pro_name = $('.ajax_cart_product_name_' + product_id).val();
                // var ajax_cart_pro_img = $('.ajax_cart_product_image_' + product_id).val();
                // var ajax_cart_pro_price = $('.ajax_cart_product_price_' + product_id).val();
                // var ajax_cart_pro_qty = $('.ajax_cart_product_qty_' + product_id).val();
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/quick-view",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        product_id: product_id,
                        '_token': _token
                    },
                    success: function(data) {
                        $('#product_quick_view_title').html(data.product_name);
                        $('#product_quick_view_id').html(data.product_id);
                        $('#product_quick_view_price').html(data.product_price);
                        $('#product_quick_view_image').html(data.product_thumbnail);
                        $('#product_quick_view_desc').html(data.product_description);
                        $('#product_quick_view_value').html(data.product_quick_view_value);
                        $('#product_quick_view_button').html(data.quick_view_button);
                    },
                });
            });
        });
    </script>

    <!-- Ajax thêm SP yêu thích -->
    <script type="text/javascript">
        // localStorage.clear();

        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();

                for (i = 0; i < data.length; i++) {
                    var id = data[i].id;
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row-wishlist').append('<div class="row" style="margin-bottom: 4px;"><div class="col-3 col-md-3 col-lg-3"><img width="100%" src="' + image + '" /></div><div class="col-md-8 col-8 col-lg-8"><p>' + name + '</p><p>' + price + ' VNĐ</p><a href="' + url + '">Mua ngay</a></div><div><a class="xoa-yt-sp" data-id="' + id + '"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');
                    // swal("Thành công!", "Yêu thích SP thành công <3", "success");
                }

                $('.sp-yt-qty').text(data.length);
            } else {
                $('#row-wishlist').append('<p>Bạn chưa thêm SP yêu thích</p>');
                $('.sp-yt-qty').text(0);
            }
        }

        view();

        function add_wishlist(id) {
            var id = id;
            var name = document.getElementById('wishlist_product_name-' + id).value;
            var price = document.getElementById('wishlist_product_price-' + id).value;
            var image = document.getElementById('wishlist_product_image-' + id).src;
            var url = document.getElementById('wishlist_product_url-' + id).href;

            var newItem = {
                id,
                name,
                price,
                image,
                url
            }

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            });

            if (matches.length) {
                alert('Bạn đã yêu thích SP, không thể thêm được nữa!');
            } else {
                old_data.push(newItem);
                $('#row-wishlist').append('<div class="row"><div class="col-3 col-md-3 col-lg-3"><img width="100%" src="' + newItem.image + '" /></div><div class="col-md-8 col-8 col-lg-8"><p>' + newItem.name + '</p><p>' + newItem.price + '</p><a href="' + newItem.url + '">Mua ngay</a></div><div><a class="xoa-yt-sp" data-id="' + newItem.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');
                swal("Thành công!", "Yêu thích SP thành công <3", "success");
            }

            localStorage.setItem('data', JSON.stringify(old_data));
        }

        $('.xoa-yt-sp').on('click', function() {
            var id = $(this).data('id');
            var data = JSON.parse(localStorage.getItem('data'));

            data.forEach(function(item, index) {
                if (id == item.id) {
                    data.splice(index, 1);
                }
            });

            localStorage.setItem('data', JSON.stringify(data));
        });

        // demSLSPYT();
    </script>

    <!-- Sắp xếp, lọc theo tên -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort-store').on('change', function() {
                var url = $(this).val();
                // alert(url);

                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    <script type="text/javascript">
        function removeBackground(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }

        // Hover chuột khi đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');

            removeBackground(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        // Khi không hover chuột
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var rating = $(this).data('rating');

            removeBackground(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        // Click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data('index');
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "http://localhost:81/DATN_ELaravel/insert-rating",
                method: 'POST',
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        swal({
                            title: "Cảm ơn bạn đã đánh giá sản phẩm!",
                            text: "",
                            type: "success",
                            confirmButtonText: "Ok",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false
                        });
                    } else {
                        swal({
                            title: "Đánh giá thất bại!",
                            text: "",
                            type: "error",
                            confirmButtonText: "Ok",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false
                        });
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        function huyDonHang(id) {
            var id = id;
            var lyDo = $('.ly-do-huy-don').val();
            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "http://localhost:81/DATN_ELaravel/huy-don-hang",
                method: 'POST',
                data: {
                    id: id,
                    lyDo: lyDo,
                    _token: _token
                },
                success: function(data) {
                    swal({
                        title: "Bạn đã huỷ đơn hàng thành công!",
                        text: "",
                        type: "success",
                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn-success",
                        closeOnConfirm: false
                    });
                }
            });
            window.setTimeout(() => {
                location.reload();
            }, 2000);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'town';
                }

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/select-delivery-home",
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
            $('.cal_shipping-order').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.town').val();
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (matp == "-----Chọn tỉnh thành phố-----" && maqh == "-----Chọn quận huyện-----" && xaid == "-----Chọn xã phường-----") {
                    swal({
                        title: "Thêm phí vận chuyển thành công!",
                        text: "",
                        type: "success",
                        confirmButtonText: "Ok",
                        confirmButtonClass: "btn-success",
                        closeOnConfirm: false
                    });
                } else {
                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/calculate-fee",
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send-order').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                swal({
                        title: "Bạn hãy xác nhận đặt hàng?",
                        text: "Chi tiết đơn hàng sẽ được gửi vào email của bạn.",
                        type: "warning",
                        showCancelButton: true,
                        // confirmButtonClass: "btn-danger",
                        confirmButtonText: "Đặt hàng",
                        cancelButtonText: "Huỷ",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var fullname_shipping = $('#fullname_shipping').val();
                            var email_shipping = $('#email_shipping').val();
                            var phone_number_shipping = $('#phone_number_shipping').val();
                            var address_shipping = $('#address_shipping').val();
                            var note_shipping = $('#note_shipping').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var shipping_pm_method = $('.payment_select').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: "http://localhost:81/DATN_ELaravel/confirm-order",
                                method: 'POST',
                                data: {
                                    fullname_shipping: fullname_shipping,
                                    email_shipping: email_shipping,
                                    phone_number_shipping: phone_number_shipping,
                                    address_shipping: address_shipping,
                                    note_shipping: note_shipping,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_pm_method: shipping_pm_method,
                                    _token: _token
                                },
                                success: function() {
                                    swal("Thành công!", "Đặt hàng thành công <3", "success");
                                },
                            });
                            window.setTimeout(function() {
                                window.location.href = 'http://localhost:81/DATN_ELaravel/lich-su-don-hang';
                            }, 6000);
                        } else {
                            swal("Huỷ", "Đặt hàng không thành công!", "error");
                        }
                    }
                );
            });
        });
    </script>
    <!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
    <!-- <script>
        paypal.Button.render({

            // Set your environment

            env: 'sandbox', // sandbox | production

            // Specify the style of the button

            style: {
                label: 'checkout', // checkout | credit | pay | buynow | generic
                size: 'responsive', // small | medium | large | responsive
                shape: 'pill', // pill | rect
                color: 'gold' // gold | blue | silver | black
            },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create

            client: {
                sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            // Wait for the PayPal button to be clicked

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
                                total: '0.01',
                                currency: 'USD'
                            }
                        }]
                    }
                });
            },

            // Wait for the payment to be authorized by the customer

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }

        }, '#paypal-button-container');
    </script> -->
</body>

</html>