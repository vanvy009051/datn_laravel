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
                        <h3>Bộ sưu tập<br>{{$brand->brand_name}}</h3>
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
                    <?php
                    $keyword = Session::get('keywords');
                    ?>
                    <h3 class="title">Kết quả tìm kiếm của <?php echo '"' . $keyword . '"'; ?></h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @foreach($search_product as $key => $product)
                    <div class="col-md-4 col-lg-4">
                        <div class="product">
                            <div class="product-img">
                                <img id="wishlist_product_image-{{ $product->product_id }}" src="{{asset('public/uploads/products/' . $product->thumbnail)}}" style="width:100%;height:360px;object-fit:contain;" alt="">
                                <div class="product-label">
                                    <!-- <span class="sale">-30%</span> -->
                                    <span class="new">Mới</span>
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
                                <input type="hidden" value="{{ $product->thumbnail }}" class="ajax_cart_product_image_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_quantity }}" class="ajax_cart_product_quantity_{{ $product->product_id }}">
                                <input type="hidden" id="wishlist_product_price-{{ $product->product_id }}" value="{{ $product->price }}" class="ajax_cart_product_price_{{ $product->product_id }}">
                                <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product->product_id }}">
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn" type="button" data-id="{{ $product->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SECTION -->

@endsection