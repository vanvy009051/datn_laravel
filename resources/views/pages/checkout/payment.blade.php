@extends('frontend.master')
@section('title','Thanh Toán' )
@section('main')

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
                <h3 class="breadcrumb-header">Payment</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Payment</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->


<div class="section">
    <div class="container">
        <div class="row">
            <form action="{{URL::to('/place-order')}}" method="POST">
                {{ csrf_field() }}
                <!-- Order Details -->
                <div class="col-md-12 order-details">
                    <div class="section-title text-center">
                        <?php
                        //$shipping_id = Session::get('shipping_id');
                        ?>
                        <h3 class="title">Your Order</h3>
                    </div>
                    <?php
                    $content = Cart::content();
                    ?>
                    <!-- <h4 class="title">Your Order ID is #<?php //echo $shipping_id 
                                                                ?></h4> -->
                    <div class="order-summary">
                        <div>
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>SUBTOTAL</strong></div>
                                <div><strong>Quanlity</strong></div>
                            </div>
                        </div>
                        @foreach($content as $item => $item_details)
                        <div class="order-products">
                            <div class="order-col">
                                <div style="width:466px;">{{ $item_details->name }}</div>
                                <div>{{ number_format($item_details->price, 0) . ' ' . 'VNĐ' }}</div>
                                <div>{{ $item_details->qty }}</div>
                            </div>
                        </div>
                        @endforeach
                        <div class="order-col">
                            <div>Shiping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div style="width:fit-content;"><strong class="order-total">{{ Cart::total(0) . ' ' . 'VNĐ' }}</strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <h3>Payment Method</h3>
                        <div class="input-radio">
                            <input type="radio" name="payment" value="1" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p>Chuyển tiền qua tài khoản ngân hàng với nội dung <strong>"Thanh toán đơn hàng {ID}"</strong> với <strong>ID</strong> là <strong>Your Order ID.</strong>
                                    <br><strong>1013879302</strong>
                                    <br><strong>Vietcombank</strong>
                                    <br><strong>NGUYEN VAN VY</strong>
                                </p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" value="2" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Momo Payment
                            </label>
                            <div class="caption">
                                <img style="border-radius: 20px;" src="{{asset('public/frontend/electro-master/img/momo.jpg')}}" width="150" height="150" alt="">
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" value="3" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" value="4" id="payment-4">
                            <label for="payment-4">
                                <span></span>
                                Cash On Delivery
                            </label>
                            <div class="caption">
                                <p>Thanh toán khi nhận hàng</p>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="{{URL::to('/term-and-conditions')}}">terms & conditions</a>
                            </label>
                        </div>
                        <input type="submit" name="place_order" value="Place Order" class="primary-btn order-submit">
                    </div>
                </div>
            </form>
            <!-- /Order Details -->
        </div>
    </div>
</div>

@endsection