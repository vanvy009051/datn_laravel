<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

session_start();

class BrandController extends Controller
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

    public function add_brand()
    {
        $this->AuthLogin();
        return view('backend/admin.add_brand');
    }

    public function all_brand()
    {
        $this->AuthLogin();
        $all_brand = DB::table('brands')->get();
        $manager_brand = view('backend/admin.all_brand')->with('all_brand', $all_brand);
        return view('backend/admin.layout')->with('backend/admin.all_brand', $manager_brand);
    }

    public function save_brand(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['description'] = $request->brand_desc;
        $data['status'] = $request->brand_status;
        $brand_slug = Str::slug($data['brand_name'], '-');
        $data['brand_slug'] = ($request->brand_slug == '') ? $brand_slug : Str::slug($request->brand_slug, '-');

        DB::table('brands')->insert($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    public function unactive_brand($brand_id)
    {
        $this->AuthLogin();
        DB::table('brands')->where('brand_id', $brand_id)->update(['status' => 0]);
        Session::put('message', 'Không kích hoạt danh mục thành công');
        return Redirect::to('/all-brand');
    }

    public function active_brand($brand_id)
    {
        $this->AuthLogin();
        DB::table('brands')->where('brand_id', $brand_id)->update(['status' => 1]);
        Session::put('message', 'Kích hoạt danh mục thành công');
        return Redirect::to('/all-brand');
    }

    public function edit_brand($brand_id)
    {
        $this->AuthLogin();
        $edit_brand = DB::table('brands')->where('brand_id', $brand_id)->get();
        $manager_brand = view('backend/admin.edit_brand')->with('edit_brand', $edit_brand);
        return view('backend/admin.layout')->with('backend/admin.edit_brand', $manager_brand);
    }

    public function update_brand(Request $request, $brand_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['description'] = $request->brand_desc;
        $data['status'] = $request->brand_status;
        $brand_slug = Str::slug($data['brand_name'], '-');
        $data['brand_slug'] = ($request->brand_slug == '') ? $brand_slug : Str::slug($request->brand_slug, '-');

        DB::table('brands')->where('brands.brand_id', $brand_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    public function delete_brand($brand_id)
    {
        $this->AuthLogin();
        DB::table('brands')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Xoá thương hiệu thành công');
        return Redirect::to('/all-brand');
    }

    // end function admin

    public function show_brand_home($brand_id)
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
        $brand_by_id = DB::table('brands')
            ->join('products', 'products.brand_id', '=', 'brands.brand_id')
            ->where('products.brand_id', '=', $brand_id)->get();

        $brand_name = DB::table('brands')->where('brands.brand_id', '=', $brand_id)->limit(1)->get();

        return view('pages.show_brand')->with('brand', $brand)->with('category', $category)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
