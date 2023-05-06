@extends('backend/admin.layout')
@section('title', 'Edit Product')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Product
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
                            <label for="exampleInputName">Product name</label>
                            <input type="text" name="product_name" value="{{ $product->title }}" class="form-control" id="exampleInputName" placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Product slug</label>
                            <input type="text" name="product_slug" value="{{ $product->product_slug }}" class="form-control" id="exampleInputName" placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Price</label>
                            <input type="text" name="product_price" value="{{ $product->price }}" class="form-control" id="exampleInputName" placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputName">
                            <img src="{{URL::to('public/uploads/products/'. $product->thumbnail)}}" width="100" height="100" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Product description</label>
                            <textarea style="resize:none;" rows="5" class="form-control" name="product_desc" id="exampleInputDesc">{{ $product->product_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
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
                            <label for="">Brand</label>
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
                            <label for="">Display</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Update product</button>
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