<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Http\Controllers\CartController;

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
        return view('frontend.checkout')->with('category', $category);
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
}
