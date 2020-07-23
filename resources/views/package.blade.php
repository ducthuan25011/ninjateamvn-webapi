@extends('layout.layout')
@section("title")
{{__('home')}}
@endsection
@section("css")
    <style type="text/css">
        .width-30{
            width: 30px;
            padding-left: 5px;
            margin-right: 7px;
        }
        .font-20{
            font-size: 20px;
        }
        #table_package_filter label{
            display: inline-flex;
        }
    </style>
@endsection
@section("content")
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Thêm gói</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row row-padding align-items-center">
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Tên gói</div>
                        <input type="text" class="form-control" id="txt_name" name="name">
                    </div>
                    <div class="col-4">
                        <div class="theme">Giá</div>
                        <input type="number" min="0" class="form-control" id="txt_price" name="price">
                    </div>
                    <div class="col-4">
                        <div class="theme">Thời gian (ngày)</div>
                        <input type="number" min="0" class="form-control" id="txt_time" name="time">
                    </div>
                </div>
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Số lượng tài khoản quản lý</div>
                        <input type="number" class="form-control" id="txt_number_account" name="number_account">
                    </div>
                </div>
                <div class="col-12" style="display: flex;margin-top: 10px">
                    <div class="col-4">
                        <button class="btn btn-sm btn-primary add_package"><i class="fa fa-trash"></i>&nbsp;Lưu gói</button>
                        <button class="btn btn-sm btn-primary edit_package hidden" data-id = ""><i class="fa fa-trash"></i>&nbsp;Sửa gói</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Danh sách gói</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
        <div style="display: flex;margin-bottom: 10px">
            <button class="col-2 btn btn-sm btn-danger delete_all"><i class="fa fa-trash"></i> Xóa tất cả</button>
        </div>
            <div class="row row-padding align-items-center">
                <table name="table" class="table table-hover table-bordered nowrap" id="table_package">
                <thead>
                    <tr>
                        <th width="4%">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="table_package_checkbox">
                                <label class="custom-control-label" for="table_package_checkbox"></label>
                            </div>
                        </th>
                        <th width="4%">Stt</th>
                        <th width="10%">Tên gói</th>
                        <th width="5%">Giá</th>
                        <th width="2%">Thời gian</th>
                        <th width="5%">Số tài khoản</th>
                        <th width="4%">Thao tác</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section("javascript")
<script type="text/javascript" src="{{ asset('js/lib/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/datatables_custom.js') }}"></script>
<script type="text/javascript" src="/asset/js/javascript/package.js?t='.time()"></script>
@endsection