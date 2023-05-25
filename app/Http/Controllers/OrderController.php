<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\ShippingFee;
use App\Models\Shipping;
use App\Models\Orders;
use App\Models\Order_Details;
use App\Models\User;
use App\Models\Statisticals;
use Session;
use App\Models\Product;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PDF;

session_start();

class OrderController extends Controller
{
    public function manager_order()
    {
        $all_order = Orders::orderby('created_at', 'ASC')->paginate(12);
        return view('backend.admin.manager_order')->with(compact('all_order'));
    }

    public function delete_order($order_code)
    {
        // $this->AuthLogin();
        DB::table('orders')->where('orders.order_code', $order_code)
            ->delete();
        DB::table('order__details')->where('order__details.order_code', $order_code)->delete();
        Session::put('message', 'Xoá đơn hàng thành công');
        return Redirect::to('/manager-order');
    }

    public function view_order($order_code)
    {
        // $order_details = Order_Details::with('product')->where('order_code', $order_code)->get();
        $all_order = Orders::where('order_code', $order_code)->get();
        foreach ($all_order as $order => $value) {
            $user_id = $value->user_id;
            $shipping_id = $value->shipping_id;
        }
        $customer = User::where('id', $user_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details = Order_Details::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details as $key => $detail) {
            $pro_coupon = $detail->product_coupon;
        }
        if ($pro_coupon != 'Không có') {
            $coupon = Coupon::where('coupon_code', $pro_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_percent = $coupon->coupon_percent;
        } else {
            $coupon_condition = 2;
            $coupon_percent = 0;
        }

        return view('backend.admin.view_order')->with(compact('order_details', 'customer', 'shipping', 'coupon_condition', 'coupon_percent', 'all_order'));
    }

    public function update_order_quantity(Request $request)
    {
        // update order
        $data = $request->all();
        $order = Orders::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        // Order date in Statisticals Model
        $order_date = $order->order_date;
        $statiscals = Statisticals::where('order_date', $order_date)->get();
        if ($statiscals) {
            $count_statis = $statiscals->count();
        } else {
            $count_statis = 0;
        }

        if ($order->order_status == 2) {

            // insert into Statiscals Model
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;

            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_sold = $product->product_sold;
                $product_price = $product->price;
                $product_cost = $product->product_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $product_remain = $product_qty - $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();

                        // Update doanh thu trong bảng Statisticals
                        $quantity += $qty;
                        $total_order += 1;
                        $sales += $product_price * $qty;
                        $profit = $sales - ($product_cost * $qty);
                    }
                }
            }

            if ($count_statis > 0) {
                $update_statis = Statisticals::where('order_date', $order_date)->first();
                $update_statis->sales = $update_statis->sales + $sales;
                $update_statis->profit = $update_statis->profit + $profit;
                $update_statis->quantity = $update_statis->quantity + $quantity;
                $update_statis->total_order = $update_statis->total_order + $total_order;
                $update_statis->save();
            } else {
                $new_statis = new Statisticals();
                $new_statis->order_date = $order_date;
                $new_statis->sales = $sales;
                $new_statis->profit = $profit;
                $new_statis->quantity = $quantity;
                $new_statis->total_order = $total_order;
                $new_statis->save();
            }
        }

        // Gửi email xác nhận đang giao hàng
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "Đơn hàng đã được cửa hàng của chúng tôi xác xác nhận ngày " . $now;
        $user = User::find(Session::get('user_id'));
        $data['email'][] = $user->email;

        // Lấy sản phẩm để gửi vào email
        foreach ($data['order_product_id'] as $key => $product) {
            $product_email = Product::find($product);
            foreach ($data['quantity'] as $key2 => $qty) {
                if ($key == $key2) {
                    $cart_array[] = array(
                        'product_name' => $product_email->title,
                        'product_price' => $product_email->price,
                        'product_qty' => $qty
                    );
                }
            }
        }

        // Lấy phí vận chuyển
        $detail = Order_Details::where('order_code', $order->order_code)->first();

        $fee_ship = $detail->product_feeship;
        $coupon_mail = $detail->product_coupon;

        $shipping = Shipping::where('shipping_id', $order->shipping_id)->first();
        $shipping_array = array(
            'fee_ship' => $fee_ship,
            'user_name' => $user->fullname,
            'shipping_name' => $shipping->shipping_name,
            'shipping_email' => $shipping->shipping_email,
            'shipping_phone' => $shipping->shipping_phone,
            'shipping_address' => $shipping->shipping_address,
            'shipping_notes' => $shipping->shipping_notes,
            'shipping_pm_method' => $shipping->shipping_pm_method
        );

        // Lấy coupon code
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $detail->order_code
        );

        Mail::send(
            'pages.mail.confirmed_order',
            ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail],
            function ($message) use ($title_email, $data) {
                $message->to($data['email'])->subject($title_email); //send this mail with subject
                $message->from('nguyenvanvy1509@gmail.com', $title_email); //send from this mail
            }
        );
    }

    public function lich_su_hang()
    {
        if (!Session::get('user_id')) {
            return redirect('user-login')->with('message', 'Vui lòng đăng nhập để xem lịch sử mua hàng');
        } else {
            $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
            $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
            $get_user_order = Orders::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->paginate(10);
            return view('pages.history.order_history')->with(compact('get_user_order', 'category', 'brand'));
        }
    }

    public function xem_lich_su_hang($order_code)
    {
        if (!Session::get('user_id')) {
            return redirect('user-login')->with('message', 'Vui lòng đăng nhập để xem lịch sử mua hàng');
        } else {
            $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
            $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
            $get_user_order = Orders::where('user_id', Session::get('user_id'))->orderby('created_at', 'DESC')->paginate(10);

            // Xem lịch sử đơn hàng
            $all_order = Orders::where('order_code', $order_code)->first();
            $user_id = $all_order->user_id;
            $shipping_id = $all_order->shipping_id;
            $order_status = $all_order->order_status;

            $customer = User::where('id', $user_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details = Order_Details::with('product')->where('order_code', $order_code)->get();
            foreach ($order_details as $key => $detail) {
                $pro_coupon = $detail->product_coupon;
            }
            if ($pro_coupon != 'Không có') {
                $coupon = Coupon::where('coupon_code', $pro_coupon)->first();
                $coupon_condition = $coupon->coupon_condition;
                $coupon_percent = $coupon->coupon_percent;
            } else {
                $coupon_condition = 2;
                $coupon_percent = 0;
            }

            // compact('order_details', 'customer', 'shipping', 'coupon_condition', 'coupon_percent', 'all_order')

            return view('pages.history.detail_history')->with(compact('get_user_order', 'category', 'brand', 'order_details',  'customer', 'shipping', 'coupon_condition', 'coupon_percent', 'all_order'));
        }
    }

    public function in_don_hang($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->inDonHang($checkout_code));
        return $pdf->stream();
    }

    public function inDonHang($checkout_code)
    {
        $all_order = Orders::where('order_code', $checkout_code)->get();
        foreach ($all_order as $order => $value) {
            $user_id = $value->user_id;
            $shipping_id = $value->shipping_id;
        }
        $customer = User::where('id', $user_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_details = Order_Details::with('product')->where('order_code', $checkout_code)->get();
        foreach ($order_details as $key => $detail) {
            $pro_coupon = $detail->product_coupon;
        }
        if ($pro_coupon != 'Không có') {
            $coupon = Coupon::where('coupon_code', $pro_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_percent = $coupon->coupon_percent;
        } else {
            $coupon_condition = 2;
            $coupon_percent = 0;
        }

        $output = '';

        $output .=
            '<style>
            body {
                font-family: DejaVu sans;
            }
            .table-styling {
                border-collapse: collapse;
            }
            table, th, td {
                width: 100%;
                border: 1px solid;
                text-align: center;
            }
            </style>
            <p><center>Website bán laptop online ELECTRO</center></p>
            <p>Kính gửi: ' . $customer->fullname . '</p>
            <p>ELECTRO xin gửi lời cám ơn đến Quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi.</p>
            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table-styling">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>';
        $output .= '<tr>
                                <td>' . $customer->fullname . '</td>
                                <td>' . $customer->phone . '</td>
                                <td>' . $customer->email . '</td>
                            </tr>';

        $output .= '</tbody>
                        </table>

                        <p>Thông tin vận chuyển</p>
                        </table>
                        <table class="table-styling">
                            <thead>
                                <tr>
                                    <th>Tên người nhận</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>';
        $output .= '<tr>
                                <td>' . $shipping->shipping_name . '</td>
                                <td>' . $shipping->shipping_address . '</td>
                                <td>' . $shipping->shipping_phone . '</td>
                                <td>' . $shipping->shipping_email . '</td>
                                <td>' . $shipping->shipping_notes . '</td>
                            </tr>';

        $output .= '</tbody>
                        </table>

                        <p>Thông tin đơn hàng</p>
                        </table>
                        <table class="table-styling">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>';
        $total = 0;
        foreach ($order_details as $key => $product) {
            $subtotal = $product->product_price * $product->quanlity;
            $total += $subtotal;
            $output .= '<tr>
                                <td>' . $product->product_name . '</td>
                                <td>' . number_format($product->product_price) . ' VNĐ</td>
                                <td>' . $product->quanlity . '</td>
                                <td>' . number_format($product->product_price * $product->quanlity) . ' VNĐ</td>
                            </tr>
                            ';
        }
        $coupon_price = 0;
        if ($coupon_condition == 1) {
            $coupon_price = $total * $coupon_percent / 100;
        } elseif ($coupon_condition == 2) {
            $coupon_price = $coupon_percent;
        } else {
            $coupon_price = 'Không có';
        }

        $output .= '<tr>
                    <td colspan="3" style="dispaly: flex; flex:1;text-align:right; padding-right: 8px; float:right;">Tổng tiền chưa phí: <br>
                    Phí ship: <br>
                    Giảm giá: <br>
                    Tổng thanh toán: 
                    </td>
                    <td style="text-align:left; padding-left: 4px;">' . number_format($total, 0) . ' VNĐ<br>
                    ' . number_format($product->product_feeship, 0) . ' VNĐ<br>
                    ' . number_format($coupon_price) . ' VNĐ<br>
                    ' . number_format($total + $product->product_feeship, 0) . ' VNĐ
                    </td>
        </tr>';
        $output .= '</tbody>
                        </table>
                    </div>
                </div>
            </div>';
        return $output;
    }

    public function huy_don_hang(Request $request)
    {
        $data = $request->all();
        $order = Orders::where('order_code', $data['id'])->first();
        $order->order_destroy = $data['lyDo'];
        $order->order_status = 3;
        $order->save();
    }
}
