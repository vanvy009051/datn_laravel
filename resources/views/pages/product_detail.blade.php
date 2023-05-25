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

<div class="section">
    <div class="container">
        <div class="row">
            @foreach($product_detail as $key => $detail_pro)
            <div class="product-detail">
                <div class="col-md-5 col-lg-5 col-12">
                    <!-- <div class="product-image">
                        <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" alt="">
                    </div> -->
                    <div id="similar-product" class="carousel slide" data-ride="carousel">
                        <ul id="lightSlider">
                            <li data-thumb="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}">
                                <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" />
                            </li>
                            <li data-thumb="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}">
                                <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" />
                            </li>
                            <li data-thumb="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}">
                                <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" />
                            </li>
                            <li data-thumb="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}">
                                <img src="{{asset('public/uploads/products/' . $detail_pro->thumbnail)}}" width="100%" height="100%" />
                            </li>
                        </ul>
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
                                    <label>Số lượng:</label>
                                    <input name="qty" class="ajax_cart_product_qty_{{ $detail_pro->product_id }}" type="number" min="1" value="1" />
                                    <input name="product_id_hidden" type="hidden" value="{{ $detail_pro->product_id }}" />
                                </div>
                                <form>
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{ $detail_pro->product_id }}" class="ajax_cart_product_id_{{ $detail_pro->product_id }}">
                                    <input type="hidden" value="{{ $detail_pro->product_quantity }}" class="ajax_cart_product_quantity_{{ $detail_pro->product_id }}">
                                    <input type="hidden" value="{{ $detail_pro->title }}" class="ajax_cart_product_name_{{ $detail_pro->product_id }}">
                                    <input type="hidden" value="{{ $detail_pro->thumbnail }}" class="ajax_cart_product_image_{{ $detail_pro->product_id }}">
                                    <input type="hidden" value="{{ $detail_pro->price }}" class="ajax_cart_product_price_{{ $detail_pro->product_id }}">
                                    <!-- <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $detail_pro->product_id }}"> -->
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn primary-btn" type="button" data-id="{{ $detail_pro->product_id }}"><i class="fa fa-shopping-cart"></i> Thêm giỏ hàng</button>
                                    </div>
                                </form>
                                <!-- <button type="submit" class="btn btn-fefault cart add-to-cart__button">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button> -->
                            </span>
                        </form>
                        <p><b>Tình trạng:</b> Còn hàng</p>
                        <p><b>Điều kiện:</b> Mới</p>
                        <p class="product-brand"><b>Thương hiệu: </b>{{ $detail_pro->brand_name }}</p>
                        <p class="product-brand"><b>Danh mục: </b>{{ $detail_pro->category_name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                        <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="details">
                        <div class="col-sm-12 col-lg-12 col-md-12 reviews-tab">
                            <p>{!! $detail_pro->product_description !!}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade active in" id="reviews">
                        <div class="col-sm-12 reviews-tab">
                            <form>
                                @csrf
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value=" {{ $detail_pro->product_id }} ">
                                <div id="show-comment"></div>
                            </form>
                            <p style="font-size: 18px;"><b>Viết đánh giá của bạn</b></p>

                            <ul class="list-inline">
                                @for ($count = 1; $count <= 5; $count++) @php if($count <=$rating){ $color='color:#ffcc00;' ; } else { $color='color:#ccc;' ; } @endphp <li title="Đánh giá sao" id="{{ $detail_pro->product_id }}-{{ $count }}" data-index="{{ $count }}" data-product_id="{{ $detail_pro->product_id }}" data-rating="{{ $rating }}" class="rating" style="cursor:pointer; {{ $color }} font-size:30px;">&#9733;</li>
                                    @endfor
                            </ul>

                            <form action="#" class="form-reviews">
                                <span class="mail-text">
                                    <input type="text" class="comment_name" placeholder="Your Name" />
                                    <!-- <input type="email" placeholder="Email Address" /> -->
                                </span>
                                <textarea name="comment_text" rows="5" class="description-reviews comment_text"></textarea>
                                <button type="button" class="btn btn-default pull-right button-submit-reivews">
                                    Bình luận
                                </button>
                                <div id="comment-success"></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->
        </div>
        @endforeach

        <div class="row">
            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">Sản phẩm liên quan</h2>
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel">
                        <div class="item active">
                            @foreach($product_related as $key => $related)
                            <div class="col-sm-4">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('public/uploads/products/' . $related->thumbnail)}}" style="height:360px; width:100%;object-fit:contain;" alt="">
                                        <div class="product-label">
                                            <!-- <span class="sale">-30%</span> -->
                                            <span class="new">Mới</span>
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
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">so sánh</span></button>
                                            <button type="button" class="quick-view" data-toggle="modal" data-target="#quickView" data-id_product="{{ $related->product_id }}"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                                        </div>
                                    </div>
                                    <form>
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{ $related->product_id }}" class="ajax_cart_product_id_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->title }}" class="ajax_cart_product_name_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->thumbnail }}" class="ajax_cart_product_image_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->product_quantity }}" class="ajax_cart_product_quantity_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->price }}" class="ajax_cart_product_price_{{ $related->product_id }}">
                                        <input type="hidden" value="1" class="ajax_cart_product_qty_{{ $related->product_id }}">
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" type="button" data-id="{{ $related->product_id }}"><i class="fa fa-shopping-cart"></i> thêm giỏ hàng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!--/recommended_items-->
        </div>
    </div>
</div>

@endsection