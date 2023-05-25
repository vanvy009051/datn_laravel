@extends('frontend.master')
@section('title', 'Trang chủ')
@section('main')

@yield('home_page')

<!-- SECTION -->
<div class="section" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Có thể bạn sẽ thích</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li><a href="{{ URL::to('shop') }}">Xem thêm >></a></li>
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
                                        <img id="wishlist_product_image-{{ $product_fea->product_id }}" src="{{asset('public/uploads/products/' . $product_fea->thumbnail)}}" style="height:263px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <span class="sale">-30%</span>
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
                                        <input type="hidden" value="{{ $product_fea->thumbnail }}" class="ajax_cart_product_image_{{ $product_fea->product_id }}">
                                        <input type="hidden" id="wishlist_product_price-{{ $product_fea->product_id }}" value="{{ $product_fea->price }}" class="ajax_cart_product_price_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="{{ $product_fea->product_quantity }}" class="ajax_cart_product_quantity_{{ $product_fea->product_id }}">
                                        <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product_fea->product_id }}">
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" type="button" data-id="{{ $product_fea->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:800px;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-12">
                                        <div id="product_quick_view_image"></div>
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-12">
                                        <div class="product-infomation">
                                            <h5 class="modal-title" id="product_quick_view_title"></h5>
                                            <span style="display: flex; flex-direction:column; gap:8px;">
                                                <span id="product_quick_view_price" class="product-price"></span>
                                                <div class="product-quanlity">
                                                    <!-- <label>Quantity:</label> -->
                                                    <input name="qty" type="hidden" min="1" value="1" />
                                                    <input name="product_id_hidden" type="hidden" value="" />
                                                </div>
                                                <form>
                                                    {{csrf_field()}}
                                                    <div id="product_quick_view_value"></div>
                                                    <div id="product_quick_view_button" class="add-to-cart"></div>
                                                </form>
                                            </span>
                                            <p><b>Tình trạng:</b> Còn hàng</p>
                                            <p><b>Điều kiện:</b> Mới</p>
                                            <p><b>Mô tả: </b></p>
                                            <p id="product_quick_view_desc"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->

    @endsection