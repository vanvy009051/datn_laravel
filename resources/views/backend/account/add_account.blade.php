@extends('backend/admin.layout')
@section('title', 'Add User')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add User
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
                    <form role="form" action="{{URL::to('/save-user')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Fullname</label>
                            <input type="text" name="user_name" class="form-control" id="exampleInputName" placeholder="Enter your fullname">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="text" name="user_email" class="form-control" id="exampleInputEmail" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Phone number</label>
                            <input type="text" name="user_phone" class="form-control" id="exampleInputPhone" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="user_address" class="form-control" id="exampleInputAddress" placeholder="Enter your address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="text" name="user_password" class="form-control" id="exampleInputPassword" value="<?php echo Str::random(10) ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Authentication</label>
                            <select name="user_role" class="form-control input-sm m-bot15">
                                <option value="1">Admin</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <button type="submit" name="add_user" class="btn btn-info">Save user</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection