<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use Session;
use Socialite;
// use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Socials;
use Validator, Redirect, Response, File;
use App\Models\Statisticals;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Orders;

session_start();

class AdminController extends Controller
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

    public function login()
    {
        return view('backend/admin.login');
    }

    public function dashboard()
    {
        $this->AuthLogin();
        $product_donut = Product::all()->count();
        $order_donut = Orders::all()->count();
        $user_donut = User::where('role_id', 2)->count();
        return view('backend.admin.dashboard')->withView('backend.admin.layout')->with(compact('product_donut', 'order_donut', 'user_donut'));
    }

    public function show_dashboard(Request $request)
    {
        // $this->AuthLogin();
        $user_email = $request->user_email;
        $user_password = md5($request->user_password);

        $result = DB::table('users')->where('users.email', $user_email)->where('users.password', $user_password)
            ->where('users.role_id', '1')->first();

        if ($result) {
            Session::put('user_name', $result->fullname);
            Session::put('user_id', $result->id);
            return Redirect::to('/admin/dashboard');
        } else {
            Session::put('message', 'Email or password is incorrect. Please try again.');
            return Redirect::to('/admin-login');
        }
    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin-login');
    }

    // User manager

    public function add_user()
    {
        $this->AuthLogin();
        return view('backend.account.add_account');
    }

    public function all_user()
    {
        $this->AuthLogin();
        $all_users = DB::table('users')->get();
        $manager_user = view('backend.account.all_account')->with('all_users', $all_users);

        // echo '<pre>';
        // print_r($all_users);
        // echo '</pre>';
        return view('backend.admin.layout')->with('backend.account.all_account', $manager_user);
    }

    public function save_user(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['fullname'] = $request->user_name;
        $data['phone'] = $request->user_phone;
        $data['email'] = $request->user_email;
        $data['address'] = $request->user_address;
        $data['password'] = md5($request->user_password);
        $data['role_id'] = $request->user_role;

        DB::table('users')->insert($data);
        Session::put('message', 'Added user successfully');
        return Redirect::to('/all-user');
    }

    public function edit_user($user_id)
    {
        $this->AuthLogin();
        $edit_user = DB::table('users')->where('users.id', $user_id)->get();
        $manager_user = view('backend.account.edit_account')->with('edit_user', $edit_user);
        return view('backend.admin.layout')->with('backend.account.edit_account', $manager_user);
    }

    public function update_user(Request $request, $user_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['fullname'] = $request->user_name;
        $data['phone'] = $request->user_phone;
        $data['email'] = $request->user_email;
        $data['address'] = $request->user_address;
        $data['password'] = md5($request->user_password);
        $data['role_id'] = $request->user_role;
        DB::table('users')->where('users.id', $user_id)->update($data);
        Session::put('message', 'Cập nhật user thành công');
        return Redirect::to('/all-user');
    }

    public function delete_user($user_id)
    {
        $this->AuthLogin();
        DB::table('users')->where('users.id', $user_id)->delete();
        Session::put('message', 'Xoá user thành công');
        return Redirect::to('/all-user');
    }

    // Login Facebook
    public function login_facebook($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Socials::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = User::where('id', $account->user_id)->first();
            Session::put('user_name', $account_name->fullname);
            Session::put('user_id', $account_name->id);
        } else {

            $hieu = new Socials([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
            ]);

            $orang = User::where('email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = User::create([
                    'fullname' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'address' => '',
                    'role_id' => 2
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = User::where('id', $account->user_id)->first();

            Session::put('user_name', $account_name->fullname);
            Session::put('user_id', $account_name->id);
        }
        return redirect('/')->with('message', 'Đăng nhập Admin thành công');
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statisticals::whereBetween('order_date', [$from_date, $to_date])->orderby('order_date', 'ASC')->get();
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = Statisticals::whereBetween('order_date', [$sub7days, $now])->orderby('order_date', 'asc')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = Statisticals::whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderby('order_date', 'asc')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = Statisticals::whereBetween('order_date', [$dauthangnay, $now])->orderby('order_date', 'asc')->get();
        } else {
            $get = Statisticals::whereBetween('order_date', [$sub365days, $now])->orderby('order_date', 'asc')->get();
        }

        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dates_order()
    {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(40)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statisticals::whereBetween('order_date', [$sub30days, $now])->orderby('order_date', 'asc')->get();

        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
