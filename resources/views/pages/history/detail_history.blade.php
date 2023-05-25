@extends('layout')
@section('title', 'Lịch sử chi tiết đơn hàng')
@section('home_page')

<div class="container" style="margin-top: 36px;">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>
                    Thông tin khách hàng
                </strong>
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
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->fullname }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
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
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_notes }}</td>
                            <td>
                                @if($shipping->shipping_pm_method == 0)
                                Chuyển khoản qua ngân hàng
                                @elseif($shipping->shipping_pm_method == 1)
                                Thanh toán bằng tiền mặt
                                @else
                                Đã thanh toán bằng Paypal
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
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
                            <th>Tên sản phẩm</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng đặt hàng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Ngày đặt hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($order_details as $key => $detail)
                        @php
                        $sub_total = $detail->product_price*$detail->quanlity;
                        $total += $sub_total;
                        @endphp
                        <tr>
                            <td><i>{{ $key + 1 }}</i></td>
                            <td>{{ $detail->product_name }}</td>
                            <td>
                                @if($detail->product_coupon != 'Không có')
                                {{$detail->product_coupon}}
                                @else
                                Không có
                                @endif
                            </td>
                            <td>
                                <div style="display:flex; gap: 4px;">
                                    <input type="text" readonly min="1" value="{{ $detail->quanlity }}" name="product_sales_quantity">
                                    <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
                                    <!-- <button class="btn btn-success" name="update_quantity_inven">Cập nhật</button> -->
                                </div>
                            </td>
                            <td>{{ number_format($detail->product_price, 0) . ' ' . 'VNĐ' }}</td>
                            <td>{{ number_format($sub_total) . ' ' . 'VNĐ' }}</td>
                            <td><span class="text-ellipsis">{{ $detail->created_at }}</span></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="2"><strong style="color:red; font-size:20px">
                                    @php
                                    $coupon_price = 0;
                                    @endphp
                                    @if($coupon_condition == 1)
                                    @php
                                    $coupon_price = $total*$coupon_percent/100
                                    @endphp
                                    Giảm: {{number_format($coupon_price)}} VNĐ
                                    @else
                                    @php
                                    $coupon_price = $coupon_percent;
                                    @endphp
                                    Giảm: {{number_format($coupon_price)}} VNĐ
                                    @endif
                                </strong>
                            </td>
                            @php
                            $fee_ship = 0;
                            @endphp
                            @foreach($order_details as $num => $order_fee_ship)
                            @php
                            $fee_ship = $order_fee_ship->product_feeship;
                            @endphp
                            @endforeach
                            <td colspan="2"><strong style="color:red; font-size:20px">
                                    Phí vận chuyển: {{number_format($fee_ship)}} VNĐ
                                </strong>
                            </td>
                            <td colspan="2"><strong style="color:green; font-size:20px">
                                    Tổng tiền: {{number_format($total - $coupon_price + $fee_ship)}} VNĐ
                                </strong>
                            </td>
                            <input type="hidden" value="{{ $coupon_price }}" name="coupon-price__confirm-email" class="coupon-price__confirm-email">
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection