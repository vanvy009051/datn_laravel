@extends('backend/admin.layout')
@section('title', 'Add Coupon')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Coupon
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
                    <form role="form" action="{{URL::to('/save-coupon')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputNum">Coupon quanlity</label>
                            <input type="text" name="coupon_num" class="form-control" id="exampleInputNum" placeholder="Nhập số lượng mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Coupon name</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputName" placeholder="Nhập tên mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCode">Coupon code</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputCode" placeholder="Nhập mã giảm giá">
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
                            <input type="text" name="coupon_percent" class="form-control" id="exampleInputPercent">
                        </div>
                        <button type="submit" name="add_coupon" class="btn btn-info">Add coupon</button>
                    </form>
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