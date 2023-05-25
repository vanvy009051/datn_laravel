@extends('backend/admin.layout')
@section('title', 'Liệt kê sản phẩm')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="" style="padding-left:14px;color:green;display:block;width:100%;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Hình ảnh</th>
                        <th>Tên SP</th>
                        <th>Giá bán</th>
                        <th>Giá gốc</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Hành động</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key => $product)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td><img src="public/uploads/products/{{ $product->thumbnail }}" width="100" height="100" alt=""></td>
                        <td>{{ $product->title }}</td>
                        <td>{{ number_format($product->price) }} VNĐ</td>
                        <td>{{ number_format($product->product_cost) }} VNĐ</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>
                            <span class="text-ellipsis">
                                <?php
                                if ($product->product_status == 0) {
                                ?>
                                    <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-eye-slash"></span></a>
                                <?php
                                } else {
                                ?>
                                    <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-eye"></span></a>
                                <?php
                                }
                                ?>
                            </span>
                        </td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->brand_name }}</td>
                        <td>
                            <a href="{{URL::to('/edit-product/'.$product->product_id)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc chắn xoá danh mục này không?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                {{$all_product}}
            </div>
        </footer>
    </div>
</div>

@endsection