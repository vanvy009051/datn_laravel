@extends('layout')
@section('title', 'Đăng nhập thanh toán')
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

<section id="form"><!--form-->
    <div class="container">
        <div class="row form-checkout-login">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Login to your account</h2>
                    <form action="{{URL::to('/check-customer')}}" class="checkout-login" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="email_checkout" placeholder="Enter email" />
                        <input type="password" name="email_password" placeholder="Enter password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default primary-btn">Login</button>
                    </form>
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="" style="color:red; display:block;width:100%;">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or text-or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST" class="checkout-signup">
                        {{ csrf_field() }}
                        <input type="text" name="fullname_cko" placeholder="Fullname" required />
                        <input type="text" name="address_cko" placeholder="Address" required />
                        <input type="text" name="phone_cko" placeholder="Phone Number" required />
                        <input type="email" name="email_sign_cko" placeholder="Email Address" required />
                        <input type="password" name="pwd_sign_cko" placeholder="Password" required />
                        <button type="submit" class="btn btn-default primary-btn">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection