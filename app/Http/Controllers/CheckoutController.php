<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Http\Controllers\CartController;
use App\Models\Cities;
use App\Models\Provinces;
use App\Models\Towns;
use App\Models\ShippingFee;
use App\Models\Shipping;
use App\Models\Orders;
use App\Models\Order_Details;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

session_start();

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $user_id = Session::get('user_id');
        if ($user_id) {
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout')->send();
        }
    }

    public function login_checkout()
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->get();
        return view('pages.checkout.login_checkout')->with('category', $category);
    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['fullname'] = $request->fullname_cko;
        $data['email'] = $request->email_sign_cko;
        $data['phone'] = $request->phone_cko;
        $data['address'] = $request->address_cko;
        $data['password'] = md5($request->pwd_sign_cko);
        $data['role_id'] = 2;

        $customer_id = DB::table('users')->insertGetID($data);

        Session::put('user_id', $customer_id);
        Session::put('user_name', $request->fullname_cko);

        return Redirect('/checkout');
    }

    public function check_customer(Request $request)
    {
        $user_email = $request->email_checkout;
        $user_password = md5($request->email_password);

        $result = DB::table('users')->where('users.email', $user_email)->where('users.password', $user_password)->first();

        if ($result) {
            Session::put('user_name', $result->fullname);
            Session::put('user_id', $result->id);
            return Redirect::to('/checkout');
        } else {
            Session::put('message', 'Email or password is incorrect. Please try again.');
            return Redirect::to('/login-checkout');
        }
    }

    public function checkout()
    {
        $this->AuthLogin();
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->get();
        $cities = Cities::orderby('matp', 'ASC')->get();
        return view('frontend.checkout')->with('category', $category)->with('cities', $cities)->with('brand', $brand);
    }

    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->fullname_shipping;
        $data['shipping_email'] = $request->email_shipping;
        $data['shipping_phone'] = $request->phone_number_shipping;
        $data['shipping_address'] = $request->address_shipping;
        $data['shipping_notes'] = $request->note_shipping;
        $data['created_at'] = date('Y-m-d H:i:s');

        $shipping_id = DB::table('shippings')->insertGetID($data);

        Session::put('shipping_id', $shipping_id);
        return Redirect('/payment');
    }

    public function payment()
    {
        $this->AuthLogin();
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->get();
        return view('pages.checkout.payment')->with('category', $category)->with('brand', $brand);
    }

    public function place_order(Request $request)
    {
        // insert payment method
        $data = array();
        $data['payment_method'] = $request->payment;
        $data['payment_status'] = 'Pending';
        $payment_id = DB::table('payments')->insertGetID($data);

        // insert order
        $order_data = array();
        $order_data['user_id'] = Session::get('user_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_status'] = 'Pending';
        $order_data['order_total'] = Cart::total();
        $order_data['created_at'] = date('Y-m-d H:i:s');
        $order_id = DB::table('orders')->insertGetID($order_data);

        // insert order details
        $content = Cart::content();
        $order_detail_data = array();
        foreach ($content as $product) {
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $product->id;
            $order_detail_data['product_name'] = $product->name;
            $order_detail_data['quanlity'] = $product->qty;
            $order_detail_data['product_price'] = $product->price;
            DB::table('order__details')->insert($order_detail_data);
        }

        if ($data['payment_method'] == 1) {
            echo 'Thanh toán bằng chuyển khoản';
        } elseif ($data['payment_method'] == 2) {
            echo 'Thanh toán bằng mã Momo';
        } elseif ($data['payment_method'] == 3) {
            echo 'Thanh toán bằng Paypal';
        } else {
            Cart::destroy();
            return view('pages.checkout.handcash');
        }


        // return Redirect('/payment');
    }

    public function manager_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.fullname')
            ->orderby('orders.order_id', 'ASC')->get();
        $manager_order = view('backend.admin.manager_order')->with('all_order', $all_order);
        return view('backend.admin.layout')->with('backend.admin.manager_order', $manager_order);
    }

    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order__details', 'order__details.order_id', '=', 'orders.order_id')
            ->join('shippings', 'shippings.shipping_id', '=', 'orders.shipping_id')
            ->where('orders.order_id', '=', $order_id)
            ->select('orders.*', 'users.*', 'order__details.*', 'shippings.*')->first();
        // echo '<pre>';
        // print_r($order_by_id);
        // echo '</pre>';
        $view_order = view('backend.admin.view_order')->with('order_by_id', $order_by_id);
        return view('backend.admin.layout')->with('backend.admin.view_order', $view_order);
    }

    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == true) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Provinces::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-----Chọn quận huyện-----</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->province_name . '</option>';
                }
            } else {
                $select_town = Towns::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>-----Chọn xã phường-----</option>';
                foreach ($select_town as $to => $town) {
                    $output .= '<option value="' . $town->xaid . '">' . $town->town_name . '</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $fee_ship = ShippingFee::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();

            if ($fee_ship) {
                $count_feeship = $fee_ship->count();
                if ($count_feeship > 0) {
                    foreach ($fee_ship as $key => $fee) {
                        Session::put('fee', $fee->fee_price);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 0);
                    Session::save();
                }
            }
        }
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        // Get Coupon
        if ($data['order_coupon'] == 'Không có') {
            $coupon_mail = 'Không có';
        } else {
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon_mail = $coupon->coupon_code;
        }

        // Get Shipping
        $shipping = new Shipping();
        $shipping->shipping_name = $data['fullname_shipping'];
        $shipping->shipping_address = $data['address_shipping'];
        $shipping->shipping_phone = $data['phone_number_shipping'];
        $shipping->shipping_email = $data['email_shipping'];
        $shipping->shipping_notes = $data['note_shipping'];
        $shipping->shipping_pm_method = $data['shipping_pm_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        // Order
        $order = new Orders();
        $order->user_id = Session::get('user_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $order->order_code = $checkout_code;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->save();

        // Order Details
        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_detail = new Order_Details();
                $order_detail->order_code = $checkout_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->product_name = $cart['product_name'];
                $order_detail->quanlity = $cart['product_qty'];
                $order_detail->product_price = $cart['product_price'];
                $order_detail->product_coupon = $data['order_coupon'];
                $order_detail->product_feeship = $data['order_fee'];
                $order_detail->save();
            }
        }

        // Send email confirmation
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "Đơn hàng xác nhận ngày " . $now;
        $user = User::find(Session::get('user_id'));
        $data['email'][] = $user->email;

        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart_email) {
                $cart_array[] = array(
                    'product_name' => $cart_email['product_name'],
                    'product_price' => $cart_email['product_price'],
                    'product_qty' => $cart_email['product_qty'],
                );
            }
        }

        $shipping_array = array(
            'shipping_name' => $data['fullname_shipping'],
            'shipping_email' => $data['email_shipping'],
            'shipping_phone' => $data['phone_number_shipping'],
            'shipping_address' => $data['address_shipping'],
            'shipping_notes' => $data['note_shipping'],
            'shipping_pm_method' => $data['shipping_pm_method']
        );

        // Lấy coupon code
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $checkout_code
        );

        Mail::send(
            'pages.mail.mail_order',
            (['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail]),
            function ($message) use ($title_email, $data) {
                $message->to($data['email'])->subject($title_email); //send this mail with subject
                $message->from('nguyenvanvy1509@gmail.com', $title_email); //send from this mail
            }
        );
        Session::put('message-order-success', 'Bạn đã đặt hàng thành công. Kiểm tra email của bạn!');
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('success_paypal');
        Session::forget('total_pp');
    }

    public function thanh_toan_vnpay(Request $request)
    {
        $data = $request->all();
        $code_vnpay = rand(0000, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:81/DATN_ELaravel/checkout";
        $vnp_TmnCode = "M631HV06"; //Mã website tại VNPAY 
        $vnp_HashSecret = "LSBFUMIVPQIPJJTFRIWCGLXHIEELVWEV"; //Chuỗi bí mật

        $vnp_TxnRef = $code_vnpay; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán đơn hàng test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];

        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
        Session::put('vnpay-payment', 'Thanh toán thành công, vui lòng xác nhận đơn hàng!');
        Session::put('success_vnpay', true);
    }
}
