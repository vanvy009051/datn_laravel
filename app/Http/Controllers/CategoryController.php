<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

session_start();

class CategoryController extends Controller
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

    public function add_category()
    {
        $this->AuthLogin();
        return view('backend/admin.add_category');
    }

    public function all_category()
    {
        $this->AuthLogin();
        $all_cate = DB::table('categories')->get();
        $manager_cate = view('backend/admin.all_category')->with('all_cate', $all_cate);
        return view('backend/admin.layout')->with('backend/admin.all_category', $manager_cate);
    }

    public function save_category(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['description'] = $request->category_desc;
        $data['status'] = $request->category_status;

        // if ($data['category_slug'] == '') {
        //     $data['category_slug'] = $cate_slug;
        //     DB::table('categories')->insert($data);
        //     Session::put('message', 'Thêm danh mục thành công');
        //     return Redirect::to('/all-category');
        // }

        // $data['category_slug'] = Str::slug($request->category_slug, '-');
        $cate_slug = Str::slug($data['category_name'], '-');
        $data['category_slug'] = ($request->category_slug == '') ? $cate_slug : Str::slug($request->category_slug, '-');
        DB::table('categories')->insert($data);
        Session::put('message', 'Thêm danh mục thành công');
        return Redirect::to('/all-category');
    }

    public function unactive_category($category_id)
    {
        $this->AuthLogin();
        DB::table('categories')->where('category_id', $category_id)->update(['status' => 0]);
        Session::put('message', 'Không kích hoạt danh mục thành công');
        return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
        $this->AuthLogin();
        DB::table('categories')->where('category_id', $category_id)->update(['status' => 1]);
        Session::put('message', 'Kích hoạt danh mục thành công');
        return Redirect::to('/all-category');
    }

    public function edit_category($category_id)
    {
        $this->AuthLogin();
        $edit_cate = DB::table('categories')->where('category_id', $category_id)->get();
        $manager_cate = view('backend/admin.edit_category')->with('edit_cate', $edit_cate);
        return view('backend/admin.layout')->with('backend/admin.edit_category', $manager_cate);
    }

    public function update_category(Request $request, $category_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['description'] = $request->category_desc;
        $data['status'] = $request->category_status;
        $cate_slug = Str::slug($data['category_name'], '-');
        $data['category_slug'] = ($request->category_slug == '') ? $cate_slug : Str::slug($request->category_slug, '-');


        DB::table('categories')->where('category_id', $category_id)->update($data);
        Session::put('message', 'Cập nhật danh mục thành công');
        return Redirect::to('/all-category');
    }

    public function delete_category($category_id)
    {
        $this->AuthLogin();
        DB::table('categories')->where('category_id', $category_id)->delete();
        Session::put('message', 'Xoá danh mục thành công');
        return Redirect::to('/all-category');
    }

    // End function admin pages

    public function show_category_home($category_id)
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
        $category_by_id = DB::table('categories')
            ->join('products', 'products.category_id', '=', 'categories.category_id')
            ->where('products.category_id', '=', $category_id)->get();
        $category_name = DB::table('categories')->where('categories.category_id', '=', $category_id)->limit(1)->get();

        return view('pages.show_category')->with('brand', $brand)->with('category', $category)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
}
