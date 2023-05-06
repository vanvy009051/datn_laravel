@extends('frontend.master')
@section('title', 'Trang chủ')
@section('main')

@yield('home_page')

<!-- SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                            <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                            <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                            <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <?php
                                $feature_product = Session::get('feature_product');
                                ?>
                                @foreach($feature_product as $key => $product_fea)
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('public/uploads/products/' . $product_fea->thumbnail)}}" style="height:263px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product_fea->category_name }}</p>
                                        <h3 class="product-name" style="height:30px;"><a href="{{URL::to('/chi-tiet-san-pham/' .$product_fea->product_id)}}">{{ $product_fea->title }}</a></h3>
                                        <h4 class="product-price">{{ number_format($product_fea->price).' '.'VNĐ' }}</h4>
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
                                    <form>
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{ $product_fea->product_id }}" class="ajax_cart_product_id_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->title }}" class="ajax_cart_product_name_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->thumbnail }}" class="ajax_cart_product_image_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->price }}" class="ajax_cart_product_price_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product_fea->product_id }}">
                                        <div class="add-to-cart">
                                            <button type="button" class="add-to-cart-btn" data-id="{{ $product_fea->product_id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                <div id="slick-nav-2" class="products-slick-nav">a</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->

    @endsection