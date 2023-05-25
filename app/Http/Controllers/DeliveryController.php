<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Provinces;
use App\Models\Towns;
use App\Models\ShippingFee;

class DeliveryController extends Controller
{
    public function add_delivery(Request $request)
    {
        $cities = Cities::orderby('matp', 'ASC')->get();
        return view('backend.delivery.add_delivery')->with(compact('cities'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == true) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Provinces::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-----Chọn quận huyện-----</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->province_name . '</option>';
                }
            } else {
                $select_town = Towns::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>-----Chọn xã phường-----</option>';
                foreach ($select_town as $to => $town) {
                    $output .= '<option value="' . $town->xaid . '">' . $town->town_name . '</option>';
                }
            }
        }
        echo $output;
    }

    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $ship_fee = new ShippingFee();
        $ship_fee->fee_matp = $data['city'];
        $ship_fee->fee_maqh = $data['province'];
        $ship_fee->fee_xaid = $data['town'];
        $ship_fee->fee_price = $data['fee'];
        $ship_fee->save();
    }

    public function select_feeshipping()
    {
        $feeship = ShippingFee::orderby('fee_id', 'asc')->get();
        $output = '';
        $output .=
            '<div class="table-responsive" style="margin-top:24px;">        
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th>Phí vận chuyển</th>
                    </tr>
                </thead>
                <tbody>
                ';
        foreach ($feeship as $key => $fee) {
            $output .= '
                    <tr>
                        <td>' . $fee->city->city_name . '</td>
                        <td>' . $fee->province->province_name . '</td>
                        <td>' . $fee->town->town_name . '</td>
                        <td contenteditable class="fee-ship-edit" data-feeid="' . $fee->fee_id . '">' . number_format($fee->fee_price) . ' VNĐ' . '</td>
                    </tr>';
        }
        $output .= '
                </tbody>
            </table>
        </div>';
        echo $output;
    }

    public function update_feeshipping(Request $request)
    {
        $data = $request->all();
        $ship_fee = ShippingFee::find($data['fee_ship_id']);
        $fee_value_new = rtrim($data['fee_value'], ',');
        $ship_fee->fee_price = $fee_value_new;
        $ship_fee->save();
    }
}
