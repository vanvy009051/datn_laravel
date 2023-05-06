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
                <li class="active"><a href="{{URL::to('/')}}">Home</a></li>
                <li><a href="{{URL::to('/shop')}}">Shop</a></li>
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
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" style="margin-bottom: 40px;">
            <form action="{{URL::to('/update-cart-ajax')}}" method="POST">
                @csrf
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
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
                            <td class="cart_description" style="padding-top:14px;">
                                <h4><a href="{{URL::to('/chi-tiet-san-pham/' .$cart['product_id'])}}">{{ $cart['product_name'] }}</a></h4>
                            </td>
                            <td class="cart_price" style="padding-top:14px;">
                                <p>{{ number_format($cart['product_price']) . ' ' . 'VNĐ' }}</p>
                            </td>
                            <td class="cart_quantity" style="padding-top:8px;">
                                <div class="cart_quantity_button">
                                    <input style="padding:4px 6px;width:100px;text-align:center;" class="cart_quantity_input" type="number" min="1" name="ajax_quantity[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}">
                                </div>
                            </td>
                            <td class="cart_total" style="padding-top:14px;">
                                <p class="cart_total_price">{{ number_format($subtotal) . ' ' . 'VNĐ' }}</p>
                            </td>
                            <td class="cart_delete" style="padding-top:14px;">
                                <a class="cart_quantity_delete" href="{{URL::to('/delete-product-cart-ajax/' .$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="submit" value="Update" name="update_cart_qty" class="btn btn-success btn-md">
                <a href="{{URL::to('/del-all-product-cart-ajax')}}" class="btn btn-danger btn-md">Delete all product</a>
            </form>
        </div>
        <div class="col-sm-6 choose-cart__item">
            <div class="total_area choose-cart__total">
                <ul>
                    <li><b>Cart Sub Total:</b> <span>{{ number_format($total) . ' ' . 'VNĐ' }}</span></li>
                    <li><b>Eco Tax:</b> <span>{{ number_format($total*10/100) . ' ' . 'VNĐ' }}</span></li>
                    <li><b>Shipping Cost:</b> <span>Free</span></li>
                    <li><b>Total:</b> <span>{{ number_format($total+$total*10/100) . ' ' . 'VNĐ' }}</span></li>
                </ul>

                <?php
                $user_id = Session::get('user_id');
                $customer_id = Session::get('customer_id');
                $shipping_id = Session::get('shipping_id');

                if (($user_id != NULL && $customer_id != NULL) && $shipping_id == NULL) { ?>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                <?php } elseif ($user_id != NULL || $customer_id == NULL && $shipping_id == NULL) { ?>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                <?php } elseif ($user_id != NULL && $customer_id != NULL && $shipping_id != NULL) { ?>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                <?php
                } else { ?>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                    <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
<!-- SECTION -->

<section id="do_action">
    <div class="container">
        <div class="row cart-info">
            <div class="col-sm-6 choose-cart__item">
                <div class="total_area choose-cart__total">
                    <ul>
                        <li><b>Cart Sub Total:</b> <span>{{ number_format($total) . ' ' . 'VNĐ' }}</span></li>
                        <li><b>Eco Tax:</b> <span>{{ number_format($total*10/100) . ' ' . 'VNĐ' }}</span></li>
                        <li><b>Shipping Cost:</b> <span>Free</span></li>
                        <li><b>Total:</b> <span>{{ number_format($total+$total*10/100) . ' ' . 'VNĐ' }}</span></li>
                    </ul>

                    <?php
                    $user_id = Session::get('user_id');
                    $customer_id = Session::get('customer_id');
                    $shipping_id = Session::get('shipping_id');

                    if (($user_id != NULL && $customer_id != NULL) && $shipping_id == NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <?php } elseif ($user_id != NULL || $customer_id == NULL && $shipping_id == NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <?php } elseif ($user_id != NULL && $customer_id != NULL && $shipping_id != NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                    <?php
                    } else { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection