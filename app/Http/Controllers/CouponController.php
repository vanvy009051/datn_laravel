<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
use DB;

session_start();

class CouponController extends Controller
{
    public function AuthLogin()
    {
        $id = Session::get('user_id');
        if ($id) {
            return Redirect::to('/admin/dashboard');
        } else {
            return Redirect::to('/admin-login')->send();
        }
    }

    public function add_coupon()
    {
        $this->AuthLogin();
        return view('backend.coupons.add_coupon');
    }

    public function list_coupon()
    {
        $this->AuthLogin();
        $all_coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('backend.coupons.all_coupon')->with(compact('all_coupon'));
    }

    public function save_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_num = $data['coupon_num'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_percent = $data['coupon_percent'];
        $coupon->save();

        return redirect('/list-coupon')->with('message', 'Add coupon successfully');
    }

    public function edit_coupon($coupon_id)
    {
        $this->AuthLogin();
        $edit_coupon = DB::table('coupons')->where('coupons.coupon_id', $coupon_id)->get();
        return view('backend.coupons.edit_coupon')->with(compact('edit_coupon'));
    }

    public function update_coupon(Request $request, $coupon_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_num = $data['coupon_num'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_percent = $data['coupon_percent'];
        $coupon->save();

        Coupon::where('coupons.coupon_id', $coupon_id)->update($data);
        Session::put('message', 'Cập nhật mã giảm giá thành công');
        return Redirect::to('/list-coupon');
    }

    public function delete_coupon($coupon_id)
    {
        $this->AuthLogin();
        Coupon::where('coupons.coupon_id', $coupon_id)->delete();
        Session::put('message', 'Xoá mã giảm giá thành công');
        return redirect('/list-coupon');
    }

    public function unset_coupon_code()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xoá mã khuyến mãi thành công');
        }
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupons.coupon_code', $data['coupon_code'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_available = 0;
                    if ($is_available == 0) {
                        $co[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_percent' => $coupon->coupon_percent,
                            'coupon_condition' => $coupon->coupon_condition,
                        );
                        Session::put('coupon', $co);
                    }
                } else {
                    $co[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_percent' => $coupon->coupon_percent,
                        'coupon_condition' => $coupon->coupon_condition,
                    );
                    Session::put('coupon', $co);
                }
                Session::save();
                return redirect()->back()->with('success_coupon', 'Đã áp dụng mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error_coupon', 'Mã giảm giá không tồn tại');
        }
    }
}
