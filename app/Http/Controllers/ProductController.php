<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

session_start();

class ProductController extends Controller
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

    public function add_product()
    {
        $this->AuthLogin();
        $cate = DB::table('categories')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->orderby('brand_id', 'DESC')->get();
        return view('backend/admin.add_product')->with('cate', $cate)->with('brand', $brand);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->orderby('products.product_id', 'ASC')->get();
        $manager_product = view('backend/admin.all_product')->with('all_product', $all_product);
        return view('backend/admin.layout')->with('backend/admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_id'] = $request->category_name;
        $data['brand_id'] = $request->brand_name;
        $data['title'] = $request->product_name;
        $data['price'] = $request->product_price;
        $data['product_description'] = $request->product_desc;
        $data['product_slug'] = ($data['product_slug'] == '') ? Str::slug($data['title'], '-') : Str::slug($request->product_slug, '-');
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products', $new_image);
            $data['thumbnail'] = $new_image;
            DB::table('products')->insert($data);
            Session::put('message', 'Added product successfully');
            return Redirect::to('/all-product');
        }

        $data['thumbnail'] = '';
        DB::table('products')->insert($data);
        Session::put('message', 'Added product successfully');
        return Redirect::to('/all-product');
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('products')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('products')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $category = DB::table('categories')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->orderby('brand_id', 'DESC')->get();

        $edit_product = DB::table('products')->where('product_id', $product_id)->get();
        $manager_product = view('backend/admin.edit_product')->with('edit_product', $edit_product)->with('category', $category)->with('brand', $brand);
        return view('backend/admin.layout')->with('backend/admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_id'] = $request->category_name;
        $data['brand_id'] = $request->brand_name;
        $data['title'] = $request->product_name;
        $data['price'] = $request->product_price;
        $data['product_description'] = $request->product_desc;
        $data['product_slug'] = ($data['product_slug'] == '') ? Str::slug($data['title'], '-') : Str::slug($request->product_slug, '-');
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/products', $new_image);
            $data['thumbnail'] = $new_image;
            DB::table('products')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Updated product successfully');
            return Redirect::to('/all-product');
        }

        DB::table('products')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('products')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoá sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    // end function backend product

    public function product_detail($product_id)
    {
        $category = DB::table('categories')->orderby('category_id', 'DESC')->get();
        $brand = DB::table('brands')->orderby('brand_id', 'DESC')->get();
        $product_detail = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.product_id', $product_id)->get();

        foreach ($product_detail as $key => $value) {
            $category_id = $value->category_id;
        }

        $product_related = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.category_id', $category_id)->get();

        return view('pages.product_detail')->with('category', $category)->with('brand', $brand)->with('product_detail', $product_detail)->with('product_related', $product_related);
    }
}
