@extends('backend/admin.layout')
@section('title', 'Danh sách nhà cung cấp')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách nhà cung cấp
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="" style="padding-left:14px;color:green;display:block;width:100%;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_ncc as $key => $ncc)
                    <tr>
                        <td>{{ $ncc->name }}</td>
                        <td>{{ $ncc->email }}</td>
                        <td>{{ $ncc->phone_number }}</td>
                        <td>{{ $ncc->address }}</td>
                        <td>{{ $ncc->description }}</td>
                        <td>
                            <a href="{{URL::to('/edit-ncc/'.$ncc->supplier_id)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc chắn xoá danh mục này không?')" href="{{URL::to('/delete-ncc/'.$ncc->supplier_id)}}" style="font-size:20px;" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection