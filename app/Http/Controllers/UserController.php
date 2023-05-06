<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class UserController extends Controller
{
    public function user_dashboard(Request $request)
    {
        $user_email = $request->user_email;
        $user_password = md5($request->user_password);

        $result = DB::table('users')->where('email', $user_email)->where('password', $user_password)->first();

        if ($result) {
            Session::put('user_name', $result->fullname);
            Session::put('user_id', $result->id);
            Session::put('user_role', $result->role_id);
            return Redirect::to('/');
        } else {
            Session::put('message', 'Email or password is incorrect. Please try again.');
            return Redirect::to('/login');
        }
    }

    public function user_sign_up(Request $request)
    {
        $data = array();
        $data['fullname'] = $request->user_name;
        $data['email'] = $request->user_email;
        $data['address'] = $request->user_address;
        $data['password'] = md5($request->user_password);
        $data['role_id'] = 2;

        DB::table('users')->insert($data);
        // Session::put('message', 'Đăng ký tài khoản thành công');
        return Redirect::to('/login');
    }

    public function user_logout()
    {
        // $this->AuthLogin();
        Session::put('user_name', null);
        Session::put('user_id', null);
        return Redirect::to('/');
    }
}
