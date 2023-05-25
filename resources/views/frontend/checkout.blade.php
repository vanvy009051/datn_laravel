@extends('frontend.master')
@section('title','Thông tin đặt hàng' )
@section('main')

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
                <li><a href="{{URL::to('/category/' .$value->category_id)}}">{{ $value->category_name }}</a></li>
                @endforeach
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section" style="padding: 36px 0;">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <!-- Billing Details -->
                <div class="billing-details">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="" style="color:green; display:block;width:100%;">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>

                    @if(Session::get('vnpay-payment'))
                    <div class="alert alert-success" style="margin-bottom:0;">
                        {{Session::get('vnpay-payment')}}
                    </div>
                    @endif

                    @if(\Session::has('error-paypal'))
                    <div class="alert alert-danger">{{ \Session::get('error-paypal') }}</div>
                    {{ \Session::forget('error-paypal') }}
                    @endif
                    @if(\Session::has('success-paypal'))
                    <div class="alert alert-success">{{ \Session::get('success-paypal') }}</div>
                    {{ \Session::forget('success-paypal') }}
                    @endif
                    <!-- <form>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="city">Thành phố</label>
                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                <option>-----Chọn tỉnh thành phố-----</option>
                                @foreach($cities as $key => $city)
                                <option value="{{ $city->matp }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="province">Quận huyện</label>
                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                <option>-----Chọn quận huyện-----</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="town">Xã/Thị trấn</label>
                            <select name="town" id="town" class="form-control input-sm m-bot15 town">
                                <option>-----Chọn xã phường-----</option>
                            </select>
                        </div>
                        <input type="button" name="cal_shipping" class="primary-btn cal_shipping-order" value="Tính phí vận chuyển">
                    </form> -->
                    <!-- action="{{URL::to('/save-checkout')}}" method="POST" style="margin-bottom: 24px;" -->
                    <form style="margin-bottom: 24px; border-top: 1px solid #ccc;">
                        {{ csrf_field() }}
                        <div class="section-title">
                            <h3 class="title">Địa chỉ thanh toán</h3>
                        </div>
                        <div class="form-group">
                            <label for="fullname_shipping">Họ và tên</label>
                            <input id="fullname_shipping" class="input fullname_shipping" type="text" name="fullname_shipping" required>
                        </div>
                        <div class="form-group">
                            <label for="email_shipping">Email</label>
                            <input id="email_shipping" class="input email_shipping" type="email" name="email_shipping" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number_shipping">Số điện thoại</label>
                            <input id="phone_number_shipping" class="input phone_number_shipping" type="tel" name="phone_number_shipping" required>
                        </div>
                        <div class="form-group">
                            <label for="address_shipping">Vận chuyển đến</label>
                            <input id="address_shipping" class="input address_shipping" type="text" name="address_shipping" required>
                        </div>
                        <!-- Order notes -->
                        <div class="form-group">
                            <label for="note_shipping">Ghi chú</label>
                            <textarea id="note_shipping" class="input note_shipping" rows="5" style="resize: none;" name="note_shipping" required></textarea>
                        </div>

                        @if(Session::get('fee'))
                        <input type="hidden" name="order_fee" class="order_fee" value="{{ Session::get('fee') }}">
                        @else
                        <input type="hidden" name="order_fee" class="order_fee" value="0">
                        @endif

                        @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{ $cou['coupon_code'] }}">
                        @endforeach
                        @else
                        <input type="hidden" name="order_coupon" class="order_coupon" value="Không có">
                        @endif

                        <div class="form-group">
                            <label for="payment_select">Chọn hình thức thanh toán</label>
                            @if(!Session::get('success_paypal') == true && !Session::get('success_vnpay'))
                            <select name="payment_select" id="payment_select" class="payment_select form-control input-sm m-bot15">
                                <option value="0">Chuyển khoản ngân hàng</option>
                                <option value="1">Trả tiền mặt</option>
                            </select>
                            @elseif(Session::get('success_paypal') == true && !Session::get('success_vnpay'))
                            <select name="payment_select" id="payment_select" class="payment_select form-control input-sm m-bot15">
                                <option value="2">Đã thanh toán bằng Paypal</option>
                            </select>
                            @elseif(!Session::get('success_paypal') == true && Session::get('success_vnpay'))
                            <select name="payment_select" id="payment_select" class="payment_select form-control input-sm m-bot15">
                                <option value="3">Đã thanh toán bằng VNPAY</option>
                            </select>
                            @endif
                        </div>
                        <input type="button" name="payment" class="primary-btn send-order" value="Xác nhận đơn hàng">
                    </form>
                    <!-- /Order notes -->
                </div>
                <!-- /Billing Details -->
            </div>

            <div class="col-md-12">
                <div class="table-responsive cart_info" style="margin-bottom: 40px;">
                    <table class="table table-condensed">
                        <form action="{{URL::to('/update-cart-ajax')}}" method="POST">
                            @csrf
                            @if(Session::get('cart') == true)
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Hình ảnh</td>
                                    <td class="description">Tên SP</td>
                                    <td class="price">Đơn giá</td>
                                    <td class="quantity">Số lượng</td>
                                    <td class="total">Tổng giá SP</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @elseif(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
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
                                            <input readonly style="padding:4px 6px;width:100px;text-align:center;" <?php if (Session::get('success_paypal') == true) { ?> readonly <?php } ?> class="cart_quantity_input" type="number" min="1" name="ajax_quantity[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}">
                                        </div>
                                    </td>
                                    <td class="cart_total" style="padding-top:36px;">
                                        <p class="cart_total_price">{{ number_format($subtotal) . ' ' . 'VNĐ' }}</p>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- <tr>
                                    <td colspan="6">
                                        <input type="submit" value="Update" name="update_cart_qty" class="btn btn-success btn-md">
                                        <a href="{{URL::to('/del-all-product-cart-ajax')}}" class="btn btn-danger btn-md">Delete all product</a>
                                        @if(Session::get('coupon'))
                                        <a href="{{URL::to('/unset-coupon-ajax')}}" class="btn btn-danger btn-md">Delete coupon code</a>
                                        @endif
                                    </td>
                                </tr> -->
                        </form>
                        <tr>
                            <td colspan="6" style="padding-top: 48px;">
                                <div class="col-sm-12 choose-cart__item">
                                    <div class="total_area choose-cart__total" style="margin-bottom: 24px;">
                                        <ul>
                                            <li><b>Tạm tính:</b> <span>{{ number_format($total) . ' ' . 'VNĐ' }}</span></li>
                                            <li><b>Thuế VAT:</b> <span>{{ number_format($total*10/100) . ' ' . 'VNĐ' }}</span></li>
                                            @if(Session::get('coupon'))
                                            <li><b>Coupon Discount:</b>
                                                @foreach(Session::get('coupon') as $key => $coupon)
                                                @if($coupon['coupon_condition']==1)
                                                <span>
                                                    @php
                                                    $coupon_discount = $total*$coupon['coupon_percent']/100;
                                                    echo 'Giảm ' .number_format($coupon_discount, 0) . ' VNĐ';
                                                    @endphp
                                                </span>
                                                @elseif($coupon['coupon_condition']==2)
                                                <span>
                                                    @php
                                                    $coupon_discount = $coupon['coupon_percent'];
                                                    echo 'Giảm ' .number_format($coupon_discount, 0) . ' VNĐ';
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
                                            @if(!Session::get('coupon') && Session::get('fee'))
                                            <li><b>Tổng tiền: </b> <span>{{ number_format($total + $total*10/100 + Session::get('fee')) . ' ' . 'VNĐ' }}</span></li>
                                            @elseif(Session::get('coupon') && !Session::get('fee'))
                                            <li><b>Total after discount: </b> <span>{{ number_format($total + $total*10/100 - $coupon_discount) . ' ' . 'VNĐ' }}</span></li>
                                            <li><b>Tổng tiền: </b> <span>{{ number_format($total + $total*10/100 - $coupon_discount) . ' ' . 'VNĐ' }}</span></li>
                                            @elseif(Session::get('coupon') && Session::get('fee'))
                                            <li><b>Total after discount: </b> <span>{{ number_format($total + $total*10/100 - $coupon_discount) . ' ' . 'VNĐ' }}</span></li>
                                            <li><b>Tổng tiền: </b> <span>{{ number_format($total + $total*10/100 - $coupon_discount + Session::get('fee')) . ' ' . 'VNĐ' }}</span></li>
                                            @elseif(!Session::get('coupon') && !Session::get('fee'))
                                            <li><b>Tổng tiền: </b> <span>{{ number_format($total + $total*10/100) . ' ' . 'VNĐ' }}</span></li>
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



                                        <!-- @if(Session::get('cart'))
                                        <form action="{{URL::to('/check-coupon')}}" method="POST" style="display: flex; align-items:center;">
                                            {{ csrf_field() }}
                                            <input type="text" style="width: 100%;" name="coupon_code" id="couponId" class="form-control" placeholder="Enter coupon code">
                                            <input type="submit" value="Apply" name="check_coupon" class="btn btn-success" style="padding: 6px 24px; margin-left:8px;">
                                        </form>
                                        <a class="btn btn-danger primary-btn" href="{{ URL::to('/checkout') }}">Check Out</a>
                                        @endif -->

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
                                    <div class="col-12" style="margin-bottom: 12px;">
                                        <?php
                                        $total_VND = $total + $total * 0.1;
                                        $total_PP = round($total_VND / 23083, 2);
                                        \Session::put('total_pp', $total_PP);
                                        ?>
                                        @if(!Session::get('success_paypal') == true)
                                        <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Thanh toán Paypal</a>
                                        @endif
                                    </div>
                                    @if(!Session::get('success_paypal') == true)
                                    <form action="{{ URL::to('/thanh-toan-vnpay') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total_vnpay" value="{{ $total_VND }}">
                                        <button class="btn btn-primary m-3" name="redirect">Thanh toán VNPAY</button>
                                    </form>
                                    @endif
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
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection