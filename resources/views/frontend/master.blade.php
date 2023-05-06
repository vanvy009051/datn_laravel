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

    <link type="text/css" rel="stylesheet" href="{{asset('public/frontend/electro-master/css/sweetalert.css')}}" />
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
                        <li><a href="{{URL::to('/user-login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a></li>
                        <li><a href="{{URL::to('/sign-up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a></li>
                    <?php
                    } else { ?>
                        <li><a href="#"><i class="fa fa-user-o"></i> Hi! <?php echo $name; ?></a>
                        </li>
                        <li><a href="{{URL::to('/user-logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
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
                                <input name="keyword" class="input w-100" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px" placeholder="Search here">
                                <button type="submit" class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">0</div>
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
                            <div class="dropdown" style="cursor:pointer;">
                                <a href="{{ URL::to('/cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">0</div>
                                </a>
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
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
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
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>245 Lê Thanh Nghị</a></li>
                                <li><a href="tel:0335588195"><i class="fa fa-phone"></i>+84 335588195</a></li>
                                <li><a href="mailto:nguyenvanvy1509@gmail.com"><i class="fa fa-envelope-o"></i>nguyenvanvy1509@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="{{URL::to('/term-and-conditions')}}">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
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
        <!-- /bottom footer -->

        <?php

        $cart = Session::get('cart');
        echo '<pre>';
        print_r($cart);
        echo '</pre>';

        ?>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function() {
                var product_id = $(this).data('id');
                var ajax_cart_pro_id = $('.ajax_cart_product_id_' + product_id).val();
                var ajax_cart_pro_name = $('.ajax_cart_product_name_' + product_id).val();
                var ajax_cart_pro_img = $('.ajax_cart_product_image_' + product_id).val();
                var ajax_cart_pro_price = $('.ajax_cart_product_price_' + product_id).val();
                var ajax_cart_pro_qty = $('.ajax_cart_product_qty_' + product_id).val();
                var _token = $('input[name="token"]').val();

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
                        '_token': _token
                    },
                    success: function() {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng ",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán ",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp ",
                                confirmButtonClass: "btn-success ",
                                confirmButtonText: "Đi đến giỏ hàng ",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/cart')}}";
                            });
                    },
                });
            });
        });
    </script>
</body>

</html>