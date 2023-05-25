<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;

session_start();

class CartController extends Controller
{
    // Show Cart Quantity
    public function show_cart_quantity()
    {
        if (Session::get('cart')) {
            $cart = count(Session::get('cart'));
            if ($cart > 0) {
                echo $cart;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    // Ajax Cart
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['ajax_cart_pro_id']) {
                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $val['session_id'],
                        'product_name' => $val['product_name'],
                        'product_id' => $val['product_id'],
                        'product_image' => $val['product_image'],
                        'product_qty' => $val['product_qty'] + $data['ajax_cart_pro_qty'],
                        'product_price' => $val['product_price'],
                    );
                    Session::put('cart', $cart);
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['ajax_cart_pro_name'],
                    'product_id' => $data['ajax_cart_pro_id'],
                    'product_image' => $data['ajax_cart_pro_img'],
                    'product_qty' => $data['ajax_cart_pro_qty'],
                    'product_quantity' => $data['ajax_cart_pro_quantity'],
                    'product_price' => $data['ajax_cart_pro_price']
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['ajax_cart_pro_name'],
                'product_id' => $data['ajax_cart_pro_id'],
                'product_image' => $data['ajax_cart_pro_img'],
                'product_qty' => $data['ajax_cart_pro_qty'],
                'product_quantity' => $data['ajax_cart_pro_quantity'],
                'product_price' => $data['ajax_cart_pro_price']
            );
            Session::put('cart', $cart);
        }
        Session::save();
    }

    public function show_cart_ajax()
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->get();
        return view('pages.cart.cart_ajax')->with('category', $category)->with('brand', $brand);
    }

    public function update_cart_ajax(Request $request)
    {
        $data_update = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            $message = '';
            foreach ($data_update['ajax_quantity'] as $key => $qty) {
                $i = 0;
                foreach ($cart as $session => $value) {
                    $i++;
                    if ($value['session_id'] == $key && $qty < $cart[$session]['product_quantity']) {
                        $cart[$session]['product_qty'] = $qty;
                        $message .= '<div class="alert alert-success">' . $i . '. Cập nhật số lượng: ' . $cart[$session]['product_name'] . ' thành công</div>';
                    } elseif ($value['session_id'] == $key && $qty > $cart[$session]['product_quantity']) {
                        $message .= '<div class="alert alert-danger">' . $i . '. Cập nhật số lượng: ' . $cart[$session]['product_name'] . ' thất bại bởi vì số lượng đặt hàng lớn hơn số lượng có trong kho của cửa hàng.</div>';
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back()->with('error', 'Cập nhật giỏ hàng thất bại');
        }
    }

    public function delete_cart_ajax($session_id)
    {
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if ($cart == true) {
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xoá giỏ hàng thành công');
        } else {
            return redirect()->back()->with('error', 'Xoá giỏ hàng thất bại');
        }
    }

    public function del_all_product_cart_ajax()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');
            return redirect()->back()->with('message', 'Xoá tất cả sản phẩm khỏi giỏ hàng thành công');
        }
    }

    // Cart Plugin
    public function add_to_cart(Request $request)
    {
        // $product_id = $request->product_id_hidden;
        // $quantity = $request->qty;

        // $product_info = DB::table('products')->where('product_id', $product_id)->first();

        // $data['id'] = $product_info->product_id;
        // $data['name'] = $product_info->title;
        // $data['qty'] = $quantity;
        // $data['price'] = $product_info->price;
        // $data['weight'] = '123';
        // $data['options']['image'] = $product_info->thumbnail;

        // Cart::add($data);
        // Cart::setGlobalTax(0);

        // Cart::destroy();
        // return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->get();
        return view('pages.cart.show_cart')->with('category', $category)->with('brand', $brand);
    }

    public function delete_cart_item($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_qty(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->quantity;

        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
