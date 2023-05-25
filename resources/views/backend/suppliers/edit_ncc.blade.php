@extends('backend/admin.layout')
@section('title', 'Sửa nhà cung cấp')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa nhà cung cấp
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
                    @foreach ($edit_ncc as $key => $ncc)
                    <form role="form" action="{{URL::to('/update-brand/'.$ncc->supplier_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Tên</label>
                            <input type="text" name="suppliers_name" value="{{ $ncc->name }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" name="suppliers_email" value="{{ $ncc->email }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Địa chỉ</label>
                            <input type="text" name="suppliers_address" value="{{ $ncc->address }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Số điện thoại</label>
                            <input type="text" name="suppliers_phone" value="{{ $ncc->phone_number }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">Đường dẫn</label>
                            <input type="text" name="suppliers_slug" value="{{ $ncc->supplier_slug }}" class="form-control" id="exampleInputSlug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Mô tả</label>
                            <textarea style="resize:none;" rows="5" class="form-control" name="suppliers_desc" id="exampleInputDesc">{{ $ncc->description }}</textarea>
                        </div>
                        <button type="submit" name="update_ncc" class="btn btn-info">Cập nhật</button>
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