@extends('backend/admin.layout')
@section('title', 'List Comments')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            List Comments
        </div>
        <div id="notify-comment" style="margin-top:12px; padding: 0 12px;"></div>
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
                        <th>Duyệt</th>
                        <th>Customer Name</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Product</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $key => $comm)
                    <tr>
                        <td>
                            @if($comm->comment_status == 0)
                            <input type="button" data-comment_status="1" data-comment_id="{{ $comm->comment_id }}" id="{{ $comm->comment_product_id }}" class="btn btn-success comment_accept_btn" value="Accept">
                            @else
                            <input type="button" data-comment_status="0" data-comment_id="{{ $comm->comment_id }}" id="{{ $comm->comment_product_id }}" class="btn btn-danger comment_accept_btn" value="Deny">
                            @endif
                        </td>
                        <td>{{ $comm->comment_user_name }}</td>
                        <td>{{ $comm->comment_text }}</td>
                        <td>{{ $comm->created_at }}</td>
                        <td><a href="{{ URL::to('/chi-tiet-san-pham/'.$comm->product->product_id) }}" target="_blank">{{ $comm->product->title }}</a></td>
                        <td>
                            <a href="" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc chắn xoá danh mục này không?')" href="" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection