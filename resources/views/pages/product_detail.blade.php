@extends('layout')
@section('title', 'Chi tiết sản phẩm')
@section('home_page')

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

<div class="section">
    <div class="container">
        <div class="row">
            @foreach($product_detail as $key => $detail_pro)
            <div class="product-detail">
                <div class="col-md-5 col-lg-5 col-12">
                    <div class="product-image">
                        <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" alt="">
                    </div>
                    <div id="similar-product" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active" style="display:flex;">
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="150" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="150" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="150" height="100" alt=""></a>
                            </div>
                            <!-- <div class="item" style="display:flex;">
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                            </div>
                            <div class="item" style="display:flex;">
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                                <a href=""><img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="100" height="100" alt=""></a>
                            </div> -->
                        </div>

                        <!-- Controls -->
                        <!-- <a class="left item-control" href="#similar-product" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right item-control" href="#similar-product" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a> -->
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-12">
                    <div class="product-infomation">
                        <h2 class="product-title">{{ $detail_pro->title }}</h2>
                        <form action="{{URL::to('/add-to-cart')}}" method="POST">
                            {{ csrf_field() }}
                            <span style="display: flex; flex-direction:column; gap:8px;">
                                <span class="product-price">{{ number_format($detail_pro->price). ' ' . 'VNĐ' }}</span>
                                <div class="product-quanlity">
                                    <label>Quantity:</label>
                                    <input name="qty" type="number" min="1" value="1" />
                                    <input name="product_id_hidden" type="hidden" value="{{ $detail_pro->product_id }}" />
                                </div>
                                <button type="submit" class="btn btn-fefault cart add-to-cart__button">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                        </form>
                        <p><b>Availability:</b> In Stock</p>
                        <p><b>Condition:</b> New</p>
                        <p class="product-brand"><b>Brand: </b>{{ $detail_pro->brand_name }}</p>
                        <p class="product-brand"><b>Category: </b>{{ $detail_pro->category_name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#details" data-toggle="tab">Description</a></li>
                        <!-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li> -->
                        <!-- <li><a href="#tag" data-toggle="tab">Tag</a></li> -->
                        <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="details">
                        <div class="col-sm-12 col-lg-12 col-md-12 reviews-tab">
                            <p>{{ $detail_pro->product_description }}</p>
                        </div>
                    </div>

                    <!-- <div class="tab-pane fade" id="companyprofile">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="300" height="300" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="tab-pane fade active in" id="reviews">
                        <div class="col-sm-12 reviews-tab">
                            <ul class="profile-reviews">
                                <li><a href=""><i class="fa fa-user"></i>Văn Vỹ</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>30 APRIL 2023</a></li>
                            </ul>
                            <p class="review-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p style="font-size: 18px;"><b>Write Your Review</b></p>

                            <form action="#" class="form-reviews">
                                <span class="mail-text">
                                    <input type="text" placeholder="Your Name" />
                                    <input type="email" placeholder="Email Address" />
                                </span>
                                <textarea name="" rows="5" class="description-reviews"></textarea>
                                <div class="rating d-flex-center">
                                    <b>Rating: </b>
                                    <img src="{{asset('public/frontend/electro-master/img/rating.png')}}" width="100px" height="100%" alt="" />
                                </div>
                                <button type="button" class="btn btn-default pull-right button-submit-reivews">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->
        </div>
        @endforeach

        <div class="row">
            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">Recommended Items</h2>
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel">
                        <div class="item active">
                            @foreach($product_related as $key => $related)
                            <div class="col-sm-4">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('public/uploads/products/' . $related->thumbnail)}}" style="height:360px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $related->category_name }}</p>
                                        <h3 class="product-name" style="height:30px;"><a href="{{URL::to('/chi-tiet-san-pham/' .$related->product_id)}}">{{ $related->title }}</a></h3>
                                        <h4 class="product-price">{{ number_format($related->price).' '.'VNĐ' }}</h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <form action="">
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- <div class="item">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="300" height="300" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="300" height="300" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('public/frontend/electro-master/img/product01.png')}}" width="300" height="300" alt="" />
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a> -->
                </div>
            </div><!--/recommended_items-->
        </div>
    </div>
</div>

@endsection