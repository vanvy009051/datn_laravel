<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Suppliers;

session_start();

class SupplierController extends Controller
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

    public function add_ncc()
    {
        $this->AuthLogin();
        return view('backend.suppliers.add_ncc');
    }

    public function all_ncc()
    {
        $this->AuthLogin();
        $all_ncc = DB::table('suppliers')->get();
        $manager_ncc = view('backend.suppliers.all_ncc')->with('all_ncc', $all_ncc);
        return view('backend.admin.layout')->with('backend.suppliers.all_ncc', $manager_ncc);
    }

    public function save_ncc(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['name'] = $request->suppliers_name;
        $data['email'] = $request->suppliers_email;
        $data['address'] = $request->suppliers_address;
        $data['phone_number'] = $request->suppliers_phone;
        $data['description'] = $request->suppliers_desc;
        $data['supplier_slug'] = ($request->suppliers_slug == '') ? Str::slug($data['name'], '-') : Str::slug($request->suppliers_slug, '-');

        DB::table('suppliers')->insert($data);
        Session::put('message', 'Thêm nhà cung cấp thành công');
        return Redirect::to('/list-ncc');
    }

    public function edit_ncc($ncc_id)
    {
        $this->AuthLogin();
        $edit_ncc = DB::table('suppliers')->where('suppliers.supplier_id', $ncc_id)->get();
        $manager_ncc = view('backend.suppliers.edit_ncc')->with('edit_ncc', $edit_ncc);
        return view('backend.admin.layout')->with('backend.suppliers.edit_brand', $manager_ncc);
    }

    public function update_ncc(Request $request, $ncc_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['name'] = $request->suppliers_name;
        $data['email'] = $request->suppliers_email;
        $data['address'] = $request->suppliers_address;
        $data['phone_number'] = $request->suppliers_phone;
        $data['description'] = $request->suppliers_desc;
        $data['supplier_slug'] = ($request->suppliers_slug == '') ? Str::slug($data['name'], '-') : Str::slug($request->suppliers_slug, '-');

        DB::table('suppliers')->where('suppliers.supplier_id', $ncc_id)->update($data);
        Session::put('message', 'Cập nhật nhà cung cấp thành công');
        return Redirect::to('/list-ncc');
    }

    public function delete_ncc($ncc_id)
    {
        $this->AuthLogin();
        DB::table('suppliers')->where('suppliers.supplier_id', $ncc_id)->delete();
        Session::put('message', 'Xoá nhà cung cấp thành công');
        return Redirect::to('/list-ncc');
    }
}
