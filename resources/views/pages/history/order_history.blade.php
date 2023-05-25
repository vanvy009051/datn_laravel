@extends('layout')
@section('title', 'Lịch sử mua hàng')
@section('home_page')

<div class="container" style="margin-top: 36px;">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Lịch sử mua hàng
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="" style="padding-left:14px;color:green;display:block;width:100%;">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <?php
                $message = Session::get('message-order-success');
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
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
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($get_user_order as $key => $order)
                        <tr>
                            <td><i>{{$key + 1}}</i></td>
                            <td>{{ $order->order_code }}</td>
                            <td>
                                @if($order->order_status == 1)
                                Đơn hàng mới
                                @elseif($order->order_status == 2)
                                Đã xử lý
                                @else
                                Đã huỷ
                                @endif
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td style="display: flex; align-items: center;">
                                <a href="{{URL::to('/xem-don-hang/'.$order->order_code)}}" style="font-size:18px; margin-right: 6px;" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"> Xem đơn hàng</i></a>
                                @if($order->order_status == 1)
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-times text-active"> Huỷ đơn hàng</i></button>
                                @elseif($order->order_status == 2)
                                <button style="font-size:18px;" class="btn btn-dark btn-sm" disabled><i class="fa fa-times text-active"> Không huỷ được</i></button>
                                @else
                                <button style="font-size:18px;" class="btn btn-dark btn-sm" disabled><i class="fa fa-times text-active"> Đã huỷ đơn</i></button>
                                @endif

                                <!-- Trigger the modal with a button -->
                                <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <form>
                                            @csrf
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Lý do huỷ đơn hàng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea name="" class="ly-do-huy-don" required id="" rows="5" style="resize:none; width:100%; padding:12px;" placeholder="Lý do huỷ đơn hàng..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                                    <button type="button" id="{{ $order->order_code }}" onclick="huyDonHang(this.id)" class="btn btn-primary">Gửi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <!-- <td style="display: flex; gap:12px; align-items:center;">
                            <a onclick="return confirm('Bạn có chắc chắn xoá danh mục này không?')" href="{{URL::to('/delete-order/'.$order->order_code)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"> Delete order</i></a>
                        </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row" style="display:flex; justify-content:center;">
                    {{$get_user_order}}
                </div>
            </footer>
        </div>
    </div>
</div>

@endsection