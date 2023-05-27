<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Comments;
use App\Models\Ratings;

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

    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = Comments::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function list_comments()
    {
        $comment = Comments::with('product')->orderby('comment_status', 'ASC')->get();
        return view('backend.comments.all_comments')->with(compact('comment'));
    }

    public function send_comments(Request $request)
    {
        $comment = new Comments();
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_text = $request->comment_text;
        $comment->comment_user_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_text = $comment_text;
        $comment->comment_status = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment->created_at = now();
        $comment->save();
    }

    public function load_comments(Request $request)
    {
        $product_id = $request->product_id;
        $output = '';
        $comment = Comments::where('comment_product_id', $product_id)->where('comment_status', 1)->get();
        foreach ($comment as $key => $comm) {
            $output .= '            
            <div class="row d-flex-center" style="background:#e6e6e6; padding: 24px 0; border-radius:20px; margin: 16px 0;">
            <div class="col-md-2">                
                <img width="100px" height="80px" style="padding-left: 12px" src="http://localhost:81/DATN_Elaravel/public/backend/web/images/2.png" alt="">
            </div>
            <div class="col-md-10 d-flex-center">
            <ul class="profile-reviews" style="margin-bottom: 12px;">
                <li><a href=""><i class="fa fa-user"></i>' . $comm->comment_user_name . '</a></li>
                <li><a href=""><i class="fa fa-clock-o"></i>' . $comm->created_at . '</a></li>
            </ul>
            <p>' . $comm->comment_text . '</p>
            </div>
        </div>';
        }
        echo $output;
    }

    public function quick_view(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $output['product_name'] = $product->title;
        $output['product_price'] = number_format($product->price);
        $output['product_description'] = $product->product_description;
        $output['product_thumbnail'] = '<div><img width="100%" src="http://localhost:81/DATN_ELaravel/public/uploads/products/' . $product->thumbnail . '"></div>';
        $output['quick_view_button'] = '
        <button class="add-to-cart-btn-quick primary-btn" type="button" data-id_product="' . $product->product_id . '"><i class="fa fa-shopping-cart"></i> add to cart</button>';

        $output['product_quick_view_value'] = '
        <input type="hidden" value="' . $product->product_id . '" class="ajax_cart_product_id_' . $product->product_id . '">
        <input type="hidden" value="' . $product->title . '" class="ajax_cart_product_name_' . $product->product_id . '">
        <input type="hidden" value="' . $product->thumbnail . '" class="ajax_cart_product_image_' . $product->product_id . '">
        <input type="hidden" value="' . $product->price . '" class="ajax_cart_product_price_' . $product->product_id . '">
        <input type="hidden" value="1" class="ajax_cart_product_qty_' . $product->product_id . '">';
        echo json_encode($output);
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
            ->where('products.product_status', '=', '1')
            ->orderby('products.product_id', 'ASC')
            ->paginate(12);
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
        $data['product_cost'] = $request->product_cost;
        $data['product_quantity'] = $request->product_qty;
        $data['product_description'] = $request->product_desc;
        $data['product_slug'] = $request->product_slug == '' ? Str::slug($data['title'], '-') : Str::slug($request->product_slug, '-');
        $data['product_status'] = $request->product_status;
        $data['product_sold'] = 0;

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
        $data['product_cost'] = $request->product_cost;
        $data['product_quantity'] = $request->product_qty;
        $data['product_description'] = $request->product_desc;
        $product_slug = Str::slug($data['title'], '-');
        $data['product_slug'] = $request->category_slug == '' ? $product_slug : Str::slug($request->product_slug, '-');
        $data['product_status'] = $request->product_status;
        $product_sold = Product::where('product_id', $product_id)->get();
        $data['product_sold'] = $product_sold->product_sold;
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

        $rating = Ratings::where('product_id', $product_id)->avg('rate_star');
        $rating = round($rating);

        return view('pages.product_detail')->with('category', $category)->with('brand', $brand)
            ->with('product_detail', $product_detail)->with('product_related', $product_related)->with('rating', $rating);
    }

    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Ratings();
        $rating->product_id = $data['product_id'];
        $rating->rate_star = $data['index'];
        $rating->save();
        echo 'done';
    }
}
