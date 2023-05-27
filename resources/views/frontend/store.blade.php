@extends('frontend.master')
@section('title', 'Sản phẩm')
@section('main')

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="{{ (request()->is('shop')) ? 'active' : '' }}"><a href="{{URL::to('/shop')}}">Sản phẩm</a></li>
                @foreach($category as $key => $category)
                <li class="{{ (request()->is('/category/$category->category_id')) ? 'active' : '' }}"><a href="{{URL::to('/category/' . $category->category_id )}}">{{ $category->category_name }}</a></li>
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
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Danh mục</h3>
                    <div class="checkbox-filter">
                        @foreach($category_name as $key => $value)
                        <div class="input-checkbox">
                            <input type="checkbox" id="category-{{ $value->category_id }}">
                            <label for="category-{{ $value->category_id }}">
                                <span></span>
                                {{ $value->category_name }}
                                <!-- <small>(120)</small> -->
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <!-- <div class="aside">
                    <h3 class="aside-title">Lọc theo giá</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <div class="input-number price-min">
                            <input id="price-min" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input id="price-max" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                </div> -->
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Thương hiệu</h3>
                    <div class="checkbox-filter">
                        @foreach($brand as $key2 => $brand)
                        <div class="input-checkbox">
                            <input type="checkbox" class="brand-filter" name="brand-filter" data-filter="brand" value="{{$brand->brand_id}}" id="brand-{{$brand->brand_id}}">
                            <label for="brand-{{$brand->brand_id}}">
                                <span></span>
                                {{$brand->brand_name}}
                                <!-- <small>(578)</small> -->
                            </label>
                        </div>
                        @endforeach
                        <?php
                        $brand_id = [];
                        $brand_arr = [];
                        if (isset($_GET['brand'])) {
                            $brand_id = $_GET['brand'];
                        } else {
                            $brand_id = $brand->brand_id . ",";
                        }
                        $brand_arr = explode(",", $brand_id);
                        ?>
                    </div>
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sắp xếp theo:
                            <form>
                                @csrf
                                <select name="sort" id="sort-store" class="input-select">
                                    <option value="{{ Request::url() }}?sort_by=none">Lọc theo</option>
                                    <option value="{{ Request::url() }}?sort_by=all">Tất cả</option>
                                    <option value="{{ Request::url() }}?sort_by=tang_dan">Giá tăng dần</option>
                                    <option value="{{ Request::url() }}?sort_by=giam_dan">Giá giảm dần</option>
                                    <option value="{{ Request::url() }}?sort_by=a_z">A đến Z</option>
                                    <option value="{{ Request::url() }}?sort_by=z_a">Z đến A</option>
                                </select>
                            </form>
                        </label>

                        <!-- <label>
                            Show:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label> -->
                    </div>
                    <ul class="store-grid">
                        <li class="active"><i class="fa fa-th"></i></li>
                        <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <!-- product -->
                    @foreach($all_product as $product)
                    <div class="clearfix visible-sm visible-xs"></div>
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img id="wishlist_product_image-{{ $product->product_id }}" src="{{asset('public/uploads/products/'.$product->thumbnail)}}" style="width:100%;height:360px;object-fit:contain;" alt="">
                                <div class="product-label">
                                    <!-- <span class="sale">-30%</span> -->
                                    <span class="new">Mới</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $product->category_name }}</p>
                                <h3 class="product-name"><a id="wishlist_product_url-{{ $product->product_id }}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">{{ $product->title }}</a></h3>
                                <h4 class="product-price">{{ number_format($product->price). ' ' . 'VNĐ' }}</h4>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-btns">
                                    <button class="add-to-wishlist" onclick="add_wishlist(this.id);" id="{{ $product->product_id }}"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
                                    <button type="button" class="quick-view" data-toggle="modal" data-target="#quickView" data-id_product="{{ $product->product_id }}"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                                </div>
                            </div>
                            <form>
                                {{csrf_field()}}
                                <input type="hidden" value="{{ $product->product_id }}" class="ajax_cart_product_id_{{ $product->product_id }}">
                                <input type="hidden" id="wishlist_product_name-{{ $product->product_id }}" value="{{ $product->title }}" class="ajax_cart_product_name_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->thumbnail }}" class="ajax_cart_product_image_{{ $product->product_id }}">
                                <input type="hidden" id="wishlist_product_price-{{ $product->product_id }}" value="{{ $product->price }}" class="ajax_cart_product_price_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_quantity }}" class="ajax_cart_product_quantity_{{ $product->product_id }}">
                                <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $product->product_id }}">
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn" type="button" data-id="{{ $product->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                    <!-- /product -->
                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div style="margin-top: 48px;">
                    {{$all_product}}
                </div>
                <!-- <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div> -->
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
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
                                        <!-- <label>Số lượng:</label> -->
                                        <input name="qty" type="number" min="1" value="1" />
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
<!-- /SECTION -->


@endsection