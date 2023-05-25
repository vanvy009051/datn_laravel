@extends('backend/admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý đơn hàng
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
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_order as $key => $order)
                    <tr>
                        <td><i>{{$key + 1}}</i></td>
                        <td>{{ $order->order_code }}</td>
                        <td>
                            @if($order->order_status == 1)
                            <span class="text-warning">Đơn hàng mới</span>
                            @elseif($order->order_status == 2)
                            <span class="text-success">Đã xử lý - Đã giao hàng</span>
                            @else
                            <span class="text-danger">Đã huỷ đơn</span>
                            @endif
                        </td>
                        <td><span class="text-ellipsis">{{$order->created_at}}</span></td>
                        <td style="display: flex; gap:12px; align-items:center;">
                            <a href="{{URL::to('/view-order/'.$order->order_code)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"> View order</i></a>
                            <a onclick="return confirm('Bạn có chắc chắn xoá danh mục này không?')" href="{{URL::to('/delete-order/'.$order->order_code)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"> Delete order</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row" style="display:flex; justify-content:center;">
                {{$all_order}}
            </div>
        </footer>
    </div>
</div>

@endsection