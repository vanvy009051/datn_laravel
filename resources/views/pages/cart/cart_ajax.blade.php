@extends('layout')
@section('title', 'Giỏ hàng')
@section('home_page')

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li><a href="{{URL::to('/shop')}}">Sản phẩm</a></li>
                @foreach($category as $key => $value)
                <li><a href="{{URL::to('/category/' . $value->category_id )}}">{{ $value->category_name }}</a></li>
                @endforeach
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- SECTION -->
<section id="cart_items px-3">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" style="margin-bottom: 40px;">
            <table class="table table-condensed">
                <form action="{{URL::to('/update-cart-ajax')}}" method="POST">
                    @csrf
                    @if(Session::get('cart') == true)
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="price">Đơn giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền mặt hàng</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('message'))
                        {!! session()->get('message') !!}
                        @elseif(session()->has('error'))
                        {{ session()->get('error') }}
                        @endif
                        @php
                        $total = 0;
                        @endphp
                        @foreach(Session::get('cart') as $key => $cart)
                        @php
                        $subtotal = $cart['product_price']*$cart['product_qty'];
                        $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="cart_product">
                                <a href="{{URL::to('/chi-tiet-san-pham/' .$cart['product_id'])}}"><img src="{{asset('public/uploads/products/' .$cart['product_image'])}}" width="80" height="80" alt=""></a>
                            </td>
                            <td class="cart_description" style="padding-top:36px;">
                                <h4><a href="{{URL::to('/chi-tiet-san-pham/' .$cart['product_id'])}}">{{ $cart['product_name'] }}</a></h4>
                            </td>
                            <td class="cart_price" style="padding-top:36px;">
                                <p>{{ number_format($cart['product_price']) . ' ' . 'VNĐ' }}</p>
                            </td>
                            <td class="cart_quantity" style="padding-top:30px;">
                                <div class="cart_quantity_button">
                                    <input style="padding:4px 6px;width:100px;text-align:center;" class="cart_quantity_input" type="number" min="1" name="ajax_quantity[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}">
                                </div>
                            </td>
                            <td class="cart_total" style="padding-top:36px;">
                                <p class="cart_total_price">{{ number_format($subtotal) . ' ' . 'VNĐ' }}</p>
                            </td>
                            <td class="cart_delete" style="padding-top:36px;">
                                <a onclick="return confirm('Bạn có chắc chắn sản phẩm này không?')" class="cart_quantity_delete" href="{{URL::to('/delete-product-cart-ajax/' .$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <input type="submit" value="Cập nhật" name="update_cart_qty" class="btn btn-success btn-md">
                                <a href="{{URL::to('/del-all-product-cart-ajax')}}" class="btn btn-danger btn-md">Xoá tất cả</a>
                                @if(Session::get('coupon'))
                                <a href="{{URL::to('/unset-coupon-ajax')}}" class="btn btn-danger btn-md">Delete coupon code</a>
                                @endif
                            </td>
                        </tr>
                </form>
                <tr>
                    <td colspan="6">
                        <div class="col-sm-6 choose-cart__item">
                            <div class="total_area choose-cart__total">
                                <ul>
                                    <li><b>Tạm tính:</b> <span>{{ number_format($total) . ' ' . 'VNĐ' }}</span></li>
                                    <li><b>Phí VAT:</b> <span>{{ number_format($total*10/100) . ' ' . 'VNĐ' }}</span></li>
                                    @if(Session::get('coupon'))
                                    <li><b>Giảm giá:</b>
                                        @foreach(Session::get('coupon') as $key => $coupon)
                                        @if($coupon['coupon_condition']==1)
                                        <span>
                                            @php
                                            $coupon_discount = $total*$coupon['coupon_percent']/100;
                                            echo number_format($coupon_discount, 0) . ' VNĐ';
                                            @endphp
                                        </span>
                                        @elseif($coupon['coupon_condition']==2)
                                        <span>
                                            @php
                                            $coupon_discount = $coupon['coupon_percent'];
                                            echo number_format($coupon_discount, 0) . ' VNĐ';
                                            @endphp
                                        </span>
                                        @endif
                                        @endforeach
                                    </li>
                                    @endif
                                    @if(Session::get('fee'))
                                    <li><b>Phí vận chuyển:</b> <span>{{ number_format(Session::get('fee')) }} VNĐ</span></li>
                                    @else
                                    <li><b>Phí vận chuyển:</b> <span>0 VNĐ</span></li>
                                    @endif
                                    @if(Session::get('coupon'))
                                    <li><b>Tổng trước giảm:</b> <span>{{ number_format($total + $total*10/100) . ' ' . 'VNĐ' }}</span></li>
                                    <li><b>Tổng sau giảm:</b> <span>{{ number_format($total + $total*10/100 - $coupon_discount) . ' ' . 'VNĐ' }}</span></li>
                                    @else
                                    <li><b>Tổng thanh toán:</b> <span>{{ number_format($total + $total*10/100) . ' ' . 'VNĐ' }}</span></li>
                                    @endif
                                </ul>
                                @if(session()->has('success_coupon'))
                                <div class="alert alert-success" style="margin-bottom:0;">
                                    {{ session()->get('success_coupon') }}
                                </div>
                                @elseif(session()->has('error_coupon'))
                                <div class="alert alert-danger" style="margin-bottom:0;">
                                    {{ session()->get('error_coupon') }}
                                </div>
                                @endif

                                @if(Session::get('cart'))
                                <form action="{{URL::to('/check-coupon')}}" method="POST" style="display: flex; align-items:center;">
                                    {{ csrf_field() }}
                                    <input type="text" style="width: 100%;" name="coupon_code" id="couponId" class="form-control" placeholder="Nhập mã giảm giá">
                                    <input type="submit" value="Áp dụng" name="check_coupon" class="btn btn-success" style="padding: 6px 24px; margin-left:8px;">
                                </form>
                                @if(Session::get('user_id'))
                                <a href="{{URL::to('/checkout')}}" class="primary-btn btn-md">Thanh toán</a>
                                @else
                                <a href="{{URL::to('/login-checkout')}}" class="primary-btn btn-md">Thanh toán</a>
                                @endif
                                @endif

                                <!-- <?php
                                        //$user_id = Session::get('user_id');
                                        //$customer_id = Session::get('customer_id');
                                        //$shipping_id = Session::get('shipping_id');

                                        //if (($user_id != NULL && $customer_id != NULL) && $shipping_id == NULL) { 
                                        ?>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                                        <?php // } elseif ($user_id != NULL || $customer_id == NULL && $shipping_id == NULL) { 
                                        ?>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                                        <?php // } elseif ($user_id != NULL && $customer_id != NULL && $shipping_id != NULL) { 
                                        ?>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                                        <?php
                                        // } else { 
                                        ?>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                                            <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                                        <?php
                                        // }
                                        ?> -->

                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                @else
                <center>
                    <img src="{{asset('public/frontend/electro-master/img/empty-cart.png')}}" width="60%" height="50%" alt="Chưa có sản phẩm trong giỏ hàng">
                    <h4>Chưa có sản phẩm nào trong giỏ hàng.</h4>
                    <a href="{{URL::to('/shop')}}" class="primary-btn">Shopping now</a>
                </center>
                @endif
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<!-- SECTION -->

<section id="do_action">

</section><!--/#do_action-->

@endsection