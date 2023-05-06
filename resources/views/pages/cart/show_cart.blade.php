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
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            ?>

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
                    @foreach($content as $item => $item_details)
                    <tr>
                        <td class="cart_product">
                            <a href="{{URL::to('/chi-tiet-san-pham/' .$item_details->id)}}"><img src="{{asset('public/uploads/products/' .$item_details->options->image)}}" width="80" height="80" alt=""></a>
                        </td>
                        <td class="cart_description" style="padding-top:14px;">
                            <h4><a href="{{URL::to('/chi-tiet-san-pham/' .$item_details->id)}}">{{$item_details->name}}</a></h4>
                        </td>
                        <td class="cart_price" style="padding-top:14px;">
                            <p>{{ number_format($item_details->price, 0) . ' ' . 'VNĐ' }}</p>
                        </td>
                        <td class="cart_quantity" style="padding-top:8px;">
                            <div class="cart_quantity_button">
                                <form action="{{ URL::to('/update-cart-qty') }}" method="POST">
                                    {{csrf_field()}}
                                    <input style="padding:4px 6px;width:100px;text-align:center;" class="cart_quantity_input" type="number" min="1" name="quantity" value="{{ $item_details->qty }}">
                                    <input type="hidden" value="{{ $item_details->rowId }}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="Update" name="update_cart_qty" class="btn btn-success btn-md">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total" style="padding-top:14px;">
                            <p class="cart_total_price">
                                <?php
                                $total = $item_details->price * $item_details->qty;
                                echo number_format($total) . ' ' . 'VNĐ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete" style="padding-top:14px;">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart-item/'. $item_details->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<!-- SECTION -->

<section id="do_action">
    <div class="container">
        <!-- <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div> -->
        <div class="row cart-info">
            <!-- <div class="col-sm-6 choose-cart__item">
                <div class="chose_area">
                    <ul class="user_option choose-cart__option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info choose-cart__info">
                        <li class="single_field choose-cart__field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        </li>
                        <li class="single_field choose-cart__field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field choose-cart__field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update choose-cart__update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out choose-cart__continue" href="">Continue</a>
                </div>
            </div> -->
            <div class="col-sm-6 choose-cart__item">
                <div class="total_area choose-cart__total">
                    <ul>
                        <li><b>Cart Sub Total:</b> <span>{{ Cart::priceTotal(0) . ' ' . 'VNĐ' }}</span></li>
                        <li><b>Eco Tax:</b> <span>{{ Cart::tax(0) . ' ' . 'VNĐ' }}</span></li>
                        <li><b>Shipping Cost:</b> <span>Free</span></li>
                        <li><b>Total:</b> <span>{{ Cart::total(0) . ' ' . 'VNĐ' }}</span></li>
                    </ul>

                    <?php
                    $user_id = Session::get('user_id');
                    $customer_id = Session::get('customer_id');
                    $shipping_id = Session::get('shipping_id');

                    if (($user_id != NULL && $customer_id != NULL) && $shipping_id == NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <?php } elseif ($user_id != NULL || $customer_id == NULL && $shipping_id == NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/checkout') }}">Check Out</a>
                    <?php } elseif ($user_id != NULL && $customer_id != NULL && $shipping_id != NULL) { ?>
                        <a class="btn btn-danger check_out" href="{{ URL::to('/payment') }}">Check Out</a>
                    <?php
                    } else { ?>
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