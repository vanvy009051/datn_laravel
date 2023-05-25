<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="background:#222;border-radius:16px;padding: 24px 120px;">
        <div class="col-md-12">
            <div class="row" style="background:#fff; color:#222; padding:15px;">
                <div class="col-md-6 text-center" style="font-weight:bold;font-size:30px;">
                    <h4>Electro Shop Inc</h4>
                </div>
                <div class="col-md-6">
                    <p>Chào bạn<strong style="text-decoration: underline;">{{ $shipping_array['user_name'] }}</strong></p>
                </div>
                <div class="col-md-12">
                    <p style="font-size: 17px;">Bạn đã đặt hàng trên website <a href="http://localhost:81/DATN_ELaravel/">Electro Shop</a> với những thông tin như sau:</p>
                    <h4 style="text-transform: uppercase;">Thông tin đơn hàng</h4>
                    <p>Mã đơn hàng: <strong style="text-transform: uppercase;">{{ $code['order_code'] }}</strong></p>
                    <p>Mã khuyến mãi áp dụng: <strong style="text-transform: uppercase;">{{ $code['coupon_code'] }}</strong></p>
                    <p>Dịch vụ: <strong>Đặt hàng trực tuyến tại <a href="http://localhost:81/DATN_ELaravel/">Electro Shop</a></strong></p>
                    <h4 style="text-transform: uppercase;">Thông tin người nhận:</h4>
                    <p>Email:
                        @if($shipping_array['shipping_email'] == '')
                        Không có
                        @else
                        <span>{{ $shipping_array['shipping_email'] }}</span>
                        @endif
                    </p>
                    <p style="text-transform: uppercase;">Họ và tên người gửi:
                        @if($shipping_array['shipping_name'] == '')
                        Không có
                        @else
                        <span>{{ $shipping_array['shipping_name'] }}</span>
                        @endif
                    </p>
                    <p>Địa chỉ nhận hàng:
                        @if($shipping_array['shipping_address'] == '')
                        Không có
                        @else
                        <span>{{ $shipping_array['shipping_address'] }}</span>
                        @endif
                    </p>
                    <p>Số điện thoại:
                        @if($shipping_array['shipping_phone'] == '')
                        Không có
                        @else
                        <span>{{ $shipping_array['shipping_phone'] }}</span>
                        @endif
                    </p>
                    <p>Ghi chú:
                        @if($shipping_array['shipping_notes'] == '')
                        Không có
                        @else
                        <span>{{ $shipping_array['shipping_notes'] }}</span>
                        @endif
                    </p>
                    <p>Hình thức thanh toán:
                        @if($shipping_array['shipping_pm_method'] == 0)
                        Chuyển khoản
                        @else
                        Thanh toán bằng tiền mặt
                        @endif
                    </p>
                    <p>Nếu thông tin người nhận hàng không đúng chúng tôi sẽ liên hệ với người đặt hàng để trả đơn hàng đã đặt.</p>
                    <h4>Sản phẩm đã được chúng tôi xác nhận</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sub_total = 0;
                            $total = 0;
                            @endphp

                            @foreach($cart_array as $key => $cart)
                            @php
                            $sub_total = $cart['product_price']*$cart['product_qty'];
                            $total += $sub_total;
                            @endphp
                            <tr>
                                <td>{{ $cart['product_name'] }}</td>
                                <td>{{ number_format($cart['product_price']) }} VNĐ</td>
                                <td>{{ $cart['product_qty'] }}</td>
                                <td>{{ number_format($sub_total) }} VNĐ</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">Phí vận chuyển: {{ number_format($shipping_array['fee_ship']) }} VNĐ</td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">Tổng tiền thanh toán: {{ number_format($total + $shipping_array['fee_ship']) }} VNĐ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>Xem lại lịch sử mua hàng của bạn: <a target="_blank" href="{{ URL::to('/lich-su-don-hang') }}">Lịch sử đơn hàng</a></p>
                <p style="color:fff;">Mọi thông tin chi tiết liên hệ tại website: <a href="http://localhost:81/DATN_ELaravel/" target="_blank">Electro Shop</a> hoặc liên hệ qua số điện thoại 0335588195. Xin cảm ơn quý khách đã đặt hàng.</p>
                <p style="text-align:center;color:#fff;">Đây là email tự động. Quý khách vui lòng không trả lời email này</p>
            </div>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>