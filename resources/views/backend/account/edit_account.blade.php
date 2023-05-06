@extends('backend/admin.layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Edit Category
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
                    @foreach ($edit_user as $key => $user)
                    <form role="form" action="{{URL::to('/update-user/'.$user->id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" name="user_name" value="{{ $user->fullname }}" class="form-control" id="exampleInputName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="text" name="user_email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone">Phone</label>
                            <input type="text" name="user_phone" value="{{ $user->phone }}" class="form-control" id="exampleInputPhone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="user_address" value="{{ $user->address }}" class="form-control" id="exampleInputAddress">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="text" name="user_password" value="{{ $user->password }}" class="form-control" id="exampleInputPassword">
                        </div>
                        <div class="form-group">
                            <label for="">Authentication</label>
                            <select name="user_role" class="form-control input-sm m-bot15">
                                <option value="1">Admin</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <button type="submit" name="update_category" class="btn btn-info">Update user</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>

@endsection