@extends('backend/admin.layout')
@section('title', 'Thêm nhà cung cấp')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhà cung cấp
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
                    <form role="form" action="{{URL::to('/save-ncc')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Tên</label>
                            <input type="text" name="suppliers_name" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" name="suppliers_email" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Địa chỉ</label>
                            <input type="text" name="suppliers_address" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Số điện thoại</label>
                            <input type="text" name="suppliers_phone" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">Đường dẫn</label>
                            <input type="text" name="suppliers_slug" class="form-control" id="exampleInputSlug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô tả</label>
                            <textarea style="resize:none;" rows="5" class="form-control" name="suppliers_desc" id="exampleInputDesc"></textarea>
                        </div>
                        <button type="submit" name="add_supplier" class="btn btn-info">Thêm NCC</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection