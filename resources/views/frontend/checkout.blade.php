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
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Checkout</li>
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
                    <form action="{{URL::to('/save-checkout')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="section-title">
                            <h3 class="title">Billing address</h3>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input id="fullname" class="input" type="text" name="fullname_shipping" required placeholder="Fullname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="input" type="email" name="email_shipping" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input id="phone_number" class="input" type="tel" name="phone_number_shipping" required placeholder="Phone number">
                        </div>
                        <div class="form-group">
                            <label for="address">Shipping to</label>
                            <input id="address" class="input" type="text" name="address_shipping" required placeholder="Shipping Address">
                        </div>
                        <!-- Order notes -->
                        <div class="form-group">
                            <label for="order_notes">Shipping Notes</label>
                            <textarea id="order_notes" class="input" rows="5" style="resize: none;" name="note_shipping" placeholder="Order Notes"></textarea>
                        </div>
                        <input type="submit" name="payment" class="primary-btn" value="Countinue to payment">
                    </form>
                    <!-- /Order notes -->
                </div>
                <!-- /Billing Details -->
            </div>
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection