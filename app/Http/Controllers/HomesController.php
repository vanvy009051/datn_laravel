<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomesController extends Controller
{
    // Home Page
    public function index()
    {
        $category = DB::table('categories')->where('status', '1')->orderby('category_id', 'DESC')->limit(5)->get();
        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
        $all_product = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.product_status', '1')
            ->orderby('products.product_id', 'DESC')
            ->get();

        $feature_product = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.product_status', '1')
            ->orderby('products.product_id', 'ASC')
            ->get();

        Session::put('feature_product', $feature_product);

        return view('pages.home')->with('brand', $brand)->with('category', $category)->with('all_product', $all_product)->with('feature_product', $feature_product);
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function signup()
    {
        return view('frontend.signup');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function shop()
    {

        $category = DB::table('categories')->where('categories.status', '1')->orderby('categories.category_id', 'DESC')->get();
        $category_name = DB::table('categories')->where('categories.status', '1')->orderby('categories.category_id', 'DESC')->get();

        $brand = DB::table('brands')->where('brands.status', '1')->orderby('brands.brand_id', 'DESC')->get();
        $all_product = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.product_status', '1')
            ->orderby('products.product_id', 'DESC')->limit(15)
            ->get();

        // $all_product = DB::table('products')
        //     ->join('categories', 'categories.category_id', '=', 'products.category_id')
        //     ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
        //     ->orderby('products.product_id', 'ASC')->get();
        return view('frontend.store')->with('brand', $brand)->with('category', $category)
            ->with('category_name', $category_name)->with('all_product', $all_product);
    }

    public function show_search(Request $request)
    {
        $keywords = $request->keyword;
        $category = DB::table('categories')->where('categories.status', '1')->orderby('categories.category_id', 'DESC')->get();
        $category_name = DB::table('categories')->where('categories.status', '1')->orderby('categories.category_id', 'DESC')->get();

        $brand = DB::table('brands')->where('status', '1')->orderby('brand_id', 'DESC')->limit(3)->get();
        $search_product = DB::table('products')
            ->join('categories', 'categories.category_id', '=', 'products.category_id')
            ->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->where('products.product_status', '1')->where('title', 'like', '%' . $keywords . '%')
            ->orwhere('categories.category_name', 'like', '%' . $keywords . '%')
            ->orwhere('brands.brand_name', 'like', '%' . $keywords . '%')->get();
        Session::put('keywords', $keywords);
        return view('pages.search')->with('brand', $brand)->with('category', $category)
            ->with('category_name', $category_name)->with('search_product', $search_product);
    }
}
