@extends('backend/admin.layout')
@section('title', 'Chỉnh sửa sản phẩm')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="" style="color:green; display:block;width:100%;">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    @foreach($edit_product as $key => $product)
                    <form role="form" action="{{URL::to('/update-product/' . $product->product_id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{ $product->title }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputQty">Số lượng</label>
                            <input type="text" name="product_qty" value="{{ $product->product_quantity }}" class="form-control" id="exampleInputQty">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">Đường dẫn</label>
                            <input type="text" name="product_slug" value="{{ $product->product_slug }}" class="form-control" id="exampleInputSlug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Giá bán</label>
                            <input type="text" name="product_price" value="{{ $product->price }}" class="form-control" id="exampleInputPrice">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCost">Giá gốc</label>
                            <input type="text" name="product_cost" value="{{ $product->product_cost }}" class="form-control" id="exampleInputCost">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputImage">Hình ảnh</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputImage">
                            <img src="{{URL::to('public/uploads/products/'. $product->thumbnail)}}" width="100" height="100" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô tả sản phẩm</label>
                            <textarea style="resize:none;" rows="5" class="form-control" name="product_desc" id="exampleInputDesc">{{ $product->product_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select name="category_name" class="form-control input-sm m-bot15">
                                @foreach($category as $key => $cate)
                                @if($cate->category_id == $product->category_id)
                                <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @else
                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <select name="brand_name" class="form-control input-sm m-bot15">
                                @foreach($brand as $key => $brand)
                                @if($brand->brand_id == $product->brand_id)
                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @else
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
    <!-- <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Horizontal Forms
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-danger">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div> -->
</div>

@endsection