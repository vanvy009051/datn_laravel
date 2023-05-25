@extends('layout')
@section('home_page')

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="{{ (request()->is('/shop')) ? 'active' : '' }}"><a href="{{URL::to('/shop')}}">Sản phẩm</a></li>
                @foreach($category as $key => $value)
                <li><a href="{{URL::to('category/' . $value->category_id )}}">{{ $value->category_name }}</a></li>
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
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            @foreach($brand as $key => $brand)
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{asset('./public/frontend/electro-master/img/shop01.png')}}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Bộ sưu tập<br> {{$brand->brand_name}}</h3>
                        <a href="{{URL::to('/brand/' . $brand->brand_id)}}" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản phẩm mới nhất</h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @foreach($all_product as $key => $product)
                                <div class="product">
                                    <div class="product-img">
                                        <img id="wishlist_product_image-{{ $product->product_id }}" src="{{asset('public/uploads/products/' . $product->thumbnail)}}" style="height:263px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <!-- <span class="sale">-30%</span> -->
                                            <span class="new">MỚI</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category_name }}</p>
                                        <h3 class="product-name" style="height:30px;"><a id="wishlist_product_url-{{ $product->product_id }}" href="{{URL::to('/chi-tiet-san-pham/' .$product->product_id)}}">{{ $product->title }}</a></h3>
                                        <h4 class="product-price">{{ number_format($product->price).' '.'VNĐ' }}</h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist" onclick="add_wishlist(this.id);" id="{{ $product->product_id }}"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
                                            <!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> -->
                                            <button type="button" class="quick-view" data-toggle="modal" data-target="#quickView" data-id_product="{{ $product->product_id }}"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                                        </div>
                                    </div>
                                    <form>
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{ $product->product_id }}" class="ajax_cart_product_id_{{ $product->product_id }}">
                                        <input type="hidden" id="wishlist_product_name-{{ $product->product_id }}" value="{{ $product->title }}" class="ajax_cart_product_name_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->product_quantity }}" class="ajax_cart_product_quantity_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->thumbnail }}" class="ajax_cart_product_image_{{ $product->product_id }}">
                                        <input type="hidden" id="wishlist_product_price-{{ $product->product_id }}" value="{{ $product->price }}" class="ajax_cart_product_price_{{ $product->product_id }}">
                                        <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product->product_id }}">
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" type="button" data-id="{{ $product->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Ngày</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Giờ</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Phút</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Giây</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">khuyến mãi hấp dẫn tuần này</h2>
                    <p>Giảm giá 50%</p>
                    <a class="primary-btn cta-btn" href="{{URL::to('/shop')}}">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản phẩm tiêu biểu</h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-3">
                                @foreach($feature_product as $key => $product_fea)
                                <div class="product">
                                    <div class="product-img">
                                        <img id="wishlist_product_image-{{ $product_fea->product_id }}" src="{{asset('public/uploads/products/' . $product_fea->thumbnail)}}" style="height:263px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <!-- <span class="sale">-30%</span> -->
                                            <span class="new">MỚI</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product_fea->category_name }}</p>
                                        <h3 class="product-name" style="height:30px;"><a id="wishlist_product_url-{{ $product_fea->product_id }}" href="{{URL::to('/chi-tiet-san-pham/' .$product_fea->product_id)}}">{{ $product_fea->title }}</a></h3>
                                        <h4 class="product-price">{{ number_format($product_fea->price).' '.'VNĐ' }}</h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist" onclick="add_wishlist(this.id);" id="{{ $product_fea->product_id }}"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
                                            <!-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> -->
                                            <button type="button" class="quick-view" data-toggle="modal" data-target="#quickView" data-id_product="{{ $product_fea->product_id }}"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                                        </div>
                                    </div>
                                    <form>
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{ $product_fea->product_id }}" class="ajax_cart_product_id_{{ $product_fea->product_id }}">
                                        <input type="hidden" id="wishlist_product_name-{{ $product_fea->product_id }}" value="{{ $product_fea->title }}" class="ajax_cart_product_name_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->product_quantity }}" class="ajax_cart_product_quantity_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->thumbnail }}" class="ajax_cart_product_image_{{ $product_fea->product_id }}">
                                        <input type="hidden" id="wishlist_product_price-{{ $product_fea->product_id }}" value="{{ $product_fea->price }}" class="ajax_cart_product_price_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product_fea->product_id }}">
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" type="button" data-id="{{ $product_fea->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->

@endsection