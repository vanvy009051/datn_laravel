@extends('backend/admin.layout')
@section('title', 'Edit Category')
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
                    @foreach ($edit_cate as $key => $cate)
                    <form role="form" action="{{URL::to('/update-category/'.$cate->category_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" name="category_name" value="{{ $cate->category_name }}" class="form-control" id="exampleInputName" placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSlug">Slug</label>
                            <input type="text" name="category_slug" value="{{ $cate->category_slug }}" class="form-control" id="exampleInputSlug" placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDesc">Category description</label>
                            <textarea style="resize:none;" rows="5" class="form-control" name="category_desc" id="exampleInputDesc" placeholder="Category description">{{ $cate->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Display</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <button type="submit" name="update_category" class="btn btn-info">Update category</button>
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