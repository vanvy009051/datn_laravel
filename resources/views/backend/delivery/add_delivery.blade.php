@extends('backend/admin.layout')
@section('title', 'Add delivery')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add delivery
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
                    <form>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="city">Thành phố</label>
                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                <option>-----Chọn tỉnh thành phố-----</option>
                                @foreach($cities as $key => $city)
                                <option value="{{ $city->matp }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="province">Quận huyện</label>
                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                <option>-----Chọn quận huyện-----</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="town">Xã/Thị trấn</label>
                            <select name="town" id="town" class="form-control input-sm m-bot15 town">
                                <option>-----Chọn xã phường-----</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Shipping fee</label>
                            <input type="text" name="shipping_fee" class="form-control shipping-fee" id="exampleInputSlug">
                        </div>
                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Add shipping fee</button>
                    </form>
                </div>

                <div id="load-delivery">

                </div>
            </div>
        </section>
    </div>
</div>

@endsection