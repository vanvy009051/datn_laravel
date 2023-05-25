@extends('backend/admin.layout')
@section('title', 'Edit Coupons')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Coupons
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
                    @foreach ($edit_coupon as $key => $coupon)
                    <form role="form" action="{{URL::to('/update-coupon/'.$coupon->coupon_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputQty">Coupon Quanlity</label>
                            <input type="text" name="coupon_num" value="{{ $coupon->coupon_num }}" class="form-control" id="exampleInputQty">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Coupon Name</label>
                            <input type="text" name="coupon_name" value="{{ $coupon->coupon_name }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCode">Coupon Code</label>
                            <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control" id="exampleInputCode">
                        </div>
                        <div class="form-group">
                            <label for="">Coupon condition</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">------Select------</option>
                                <option value="1">Percentage discount</option>
                                <option value="2">Discount by money</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPercent">Coupon percent or Coupon money</label>
                            <input type="text" name="coupon_percent" value="{{ $coupon->coupon_percent }}" class="form-control" id="exampleInputPercent">
                        </div>
                        <button type="submit" name="update_coupon" class="btn btn-info">Update coupon</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>

@endsection