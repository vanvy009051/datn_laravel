<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Electro - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/web/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/web/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/web/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/web/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/web/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/web/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/web/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/web/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/web/js/morris.js')}}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/admin/dashboard')}}" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/web/images/2.png')}}">
                            <span class="username"><?php $name = Session::get('user_name');
                                                    echo $name; ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ admin</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
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
                            <a class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="{{URL::to('/admin/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-category')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-category')) ? 'active' : '' }}" href="{{URL::to('/add-category')}}">Thêm danh mục</a></li>
                                <li><a class="{{ (request()->is('all-category')) ? 'active' : '' }}" href="{{URL::to('/all-category')}}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-brand')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-brand')) ? 'active' : '' }}" href="{{URL::to('/add-brand')}}">Thêm thương hiệu</a></li>
                                <li><a class="{{ (request()->is('all-brand')) ? 'active' : '' }}" href="{{URL::to('/all-brand')}}">Liệt kê thương hiệu</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-product')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-product')) ? 'active' : '' }}" href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a class="{{ (request()->is('all-product')) ? 'active' : '' }}" href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('manager-order')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('manager-order')) ? 'active' : '' }}" href="{{URL::to('/manager-order')}}">Quản lý đơn hàng</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-coupon')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Khuyến mãi</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-coupon')) ? 'active' : '' }}" href="{{URL::to('/add-coupon')}}">Thêm mới</a></li>
                                <li><a class="{{ (request()->is('list-coupon')) ? 'active' : '' }}" href="{{URL::to('/list-coupon')}}">Liệt kê khuyến mãi</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-user')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Tài khoản khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-user')) ? 'active' : '' }}" href="{{URL::to('/add-user')}}">Thêm mới</a></li>
                                <li><a class="{{ (request()->is('all-user')) ? 'active' : '' }}" href="{{URL::to('/all-user')}}">Liệt kê tài khoản</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a class="{{ (request()->is('delivery')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('delivery')) ? 'active' : '' }}" href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a class="{{ (request()->is('list-comments')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('list-comments')) ? 'active' : '' }}" href="{{URL::to('/list-comments')}}">Quản lý bình luận</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a class="{{ (request()->is('*-ncc')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Nhà cung cấp</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-ncc')) ? 'active' : '' }}" href="{{URL::to('/add-ncc')}}">Thêm nhà cung cấp</a></li>
                                <li><a class="{{ (request()->is('list-ncc')) ? 'active' : '' }}" href="{{URL::to('/list-ncc')}}">Danh sách nhà cung cấp</a></li>
                            </ul>
                        </li>
                        <!-- <li class="sub-menu">
                            <a class="{{ (request()->is('*-ncc')) ? 'active' : '' }}" href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý tồn kho</span>
                            </a>
                            <ul class="sub">
                                <li><a class="{{ (request()->is('add-ncc')) ? 'active' : '' }}" href="{{URL::to('/add-ncc')}}">Nhập hàng</a></li>
                                <li><a class="{{ (request()->is('list-ncc')) ? 'active' : '' }}" href="{{URL::to('/list-ncc')}}"> </a></li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
                <!-- sidebar menu end-->
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
                    <p>© 2023 Admin. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
            <!--main content end-->
        </section>
        <script src="{{asset('public/backend/web/js/bootstrap.j')}}s"></script>
        <script src="{{asset('public/backend/web/js/jquery.dcjqaccordion.2.7.js')}}"></script>
        <script src="{{asset('public/backend/web/js/scripts.js')}}"></script>
        <script src="{{asset('public/backend/web/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('public/backend/web/js/jquery.nicescroll.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src="{{asset('public/backend/web/js/jquery.scrollTo.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <!-- morris JavaScript -->

        <script type="text/javascript">
            $(document).ready(function() {
                chart30daysorder();
                var chart = new Morris.Bar({
                    element: 'my-first-chart',
                    lineColors: ['#819C79', '#FC8710', '#FF6541', '#A4ADD3', '#766B56'],
                    pointFillColors: ['#FFFFFF'],
                    pointStrokeColors: ['black'],
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    parseTime: false,
                    xkey: 'period',
                    ykeys: ['order', 'sales', 'profit', 'quantity'],
                    labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
                });

                function chart30daysorder() {
                    var _token = $('input[name="_token"]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/dates-order",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            _token: _token
                        },
                        success: function(data) {
                            chart.setData(data);
                        }
                    });
                }

                $('.dashboard-filter').change(function() {
                    var dashboard_value = $(this).val();
                    var _token = $('input[name="_token"]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/dashboard-filter",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            dashboard_value: dashboard_value,
                            _token: _token
                        },
                        success: function(data) {
                            chart.setData(data);
                        }
                    });
                });

                $('#btn-dashboard-filter').click(function() {
                    var _token = $('input[name="_token"]').val();
                    var from_date = $('#datepicker').val();
                    var to_date = $('#datepicker2').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/filter-by-date",
                        method: "POST",
                        dataType: "json",
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            _token: _token
                        },
                        success: function(data) {
                            chart.setData(data);
                        },
                    });
                });
            });
        </script>

        <script type="text/javascript">
            $(function() {
                $('#datepicker').datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                    duration: "slow"
                });

                $('#datepicker2').datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
                    duration: "slow"
                });
            });
        </script>

        <script type="text/javascript">
            $('.order-detail-update').change(function() {
                var order_status = $(this).val();
                var order_id = $(this).children(":selected").attr('id');
                var _token = $('input[name="_token"]').val();

                var quantity = [];
                $("input[name='product_sales_quantity']").each(function() {
                    quantity.push($(this).val());
                });

                var order_product_id = [];
                $("input[name='order_product_id']").each(function() {
                    order_product_id.push($(this).val());
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/update-order-quantity",
                    method: 'POST',
                    data: {
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id,
                        _token: _token
                    },
                    success: function(data) {
                        alert("Cập nhật trạng thái xử lý đơn hàng thành công!");
                        location.reload();
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $('.comment_accept_btn').click(function() {
                var comment_status = $(this).data('comment_status');
                var comment_id = $(this).data('comment_id');
                var comment_product_id = $(this).attr('id');
                var _token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (comment_status == 1) {
                    var alert = 'Duyệt bình luận thành công';
                } else {
                    var alert = 'Từ chối bình luận';
                }

                $.ajax({
                    url: "http://localhost:81/DATN_ELaravel/allow-comment",
                    method: 'POST',
                    data: {
                        comment_status: comment_status,
                        comment_id: comment_id,
                        comment_product_id: comment_product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#notify-comment').html('<div class="alert alert-success">' + alert + '</div>');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                fetch_delivery();

                function fetch_delivery() {
                    var _token = $('input[name="_token"]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/select-feeshipping",
                        method: 'POST',
                        data: {
                            _token: _token
                        },
                        success: function(data) {
                            $('#load-delivery').html(data);
                        }
                    });
                };

                $(document).on('blur', '.fee-ship-edit', function() {
                    var fee_ship_id = $(this).data('feeid');
                    var fee_value = $(this).text();
                    var _token = $('input[name="_token"]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/update-feeshipping",
                        method: 'POST',
                        data: {
                            fee_ship_id: fee_ship_id,
                            fee_value: fee_value,
                            _token: _token
                        },
                        success: function(data) {
                            fetch_delivery();
                        }
                    });
                });

                $('.add_delivery').click(function() {
                    var city = $('.city').val();
                    var province = $('.province').val();
                    var town = $('.town').val();
                    var fee = $('.shipping-fee').val();
                    var _token = $('input[name="_token"]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "http://localhost:81/DATN_ELaravel/insert-delivery",
                        method: 'POST',
                        data: {
                            city: city,
                            province: province,
                            town: town,
                            fee: fee,
                            _token: _token
                        },
                        success: function(data) {
                            fetch_delivery();
                        }
                    });
                });

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
                        url: "http://localhost:81/DATN_ELaravel/select-delivery",
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
                Morris.Donut({
                    element: 'donut-example',
                    resize: true,
                    colors: [
                        '#E0F7FA',
                        '#00ACC1',
                        '#006064'
                    ],
                    labelColor: "#000", // text color
                    backgroundColor: '#333333', // border color
                    data: [{
                            label: "Sản phẩm",
                            value: <?php echo $product_donut ?>
                        },
                        {
                            label: "Đơn hàng",
                            value: <?php echo $order_donut ?>
                        },
                        {
                            label: "Khách hàng",
                            value: <?php echo $user_donut ?>
                        }
                    ]
                });
            });
        </script>

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
        <script type="text/javascript" src="{{asset('public/backend/web/js/monthly.js')}}"></script>
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