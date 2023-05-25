@extends('backend.admin.layout')
@section('title', 'Tổng quan')
@section('admin_content')

<div class="container-fluid">
    <div class="row">
        <p class="title_thongke" style="text-transform: uppercase; font-size: 24px; text-align:center; padding: 16px 0; font-weight: bold;">
            Thống kê doanh số đơn hàng
        </p>
        <form autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2" style="transform: translateY(85%);">
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
            </div>
            <div class="col-md-2">
                <p>Lọc theo:
                    <select class="dashboard-filter form-control">
                        <option>-----Chọn-----</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">1 tháng trước</option>
                        <option value="thangnay">Tháng này</option>
                        <option value="365ngay">1 năm qua</option>
                    </select>
                </p>
            </div>
        </form>

        <div class="col-md-12">
            <div id="my-first-chart" style="height:300px;"></div>
        </div>
        <div class="col-md-12">
            <p style="text-transform: uppercase; font-size: 24px; text-align:center; padding: 16px 0; font-weight: bold;">Thống kê tổng sản phẩm, tổng đơn hàng</p>
            <div id="donut-example" style="height:300px;"></div>
        </div>
    </div>
</div>

@endsection