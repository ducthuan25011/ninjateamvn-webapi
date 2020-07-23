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
        #table_sale_filter label{
            display: inline-flex;
        }
    </style>
@endsection
@section("content")
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Thêm Sale</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row row-padding align-items-center">
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Email tài khoản</div>
                        <input list="brow" class="form-control" id="txt_email" name="email">
                        <datalist class="list-customer" id="brow">
                        </datalist>  
                    </div>
                    <div class="col-4">
                        <div class="theme">Gói</div>
                        <input list="brow-pack" class="form-control" id="txt_package" name="package">
                        <datalist class="list-package" id="brow-pack">
                        </datalist> 
                    </div>
                    <div class="col-4">
                        <div class="theme">Khuyến mại</div>
                        <input list="brow-coupon" class="form-control" id="txt_coupon" name="coupon">
                        <datalist class="list-coupon" id="brow-coupon">
                        </datalist> 
                    </div>
                </div>
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Ghi chú</div>
                        <textarea class="form-control height-100" id="txt_note" placeholder="Note"></textarea>
                    </div>
                </div>
                <div class="col-12" style="display: flex;margin-top: 10px">
                    <div class="col-4">
                        <button class="btn btn-sm btn-primary add_sale"><i class="fa fa-trash"></i>&nbsp;Lưu sale</button>
                        <button class="btn btn-sm btn-primary edit_sale hidden" data-id = ""><i class="fa fa-trash"></i>&nbsp;Sửa sale</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Danh sách sale</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
        <div style="display: flex;margin-bottom: 10px">
            <button class="col-2 btn btn-sm btn-danger action_all" data-action= "lock"><i class="fa fa-trash"></i> Khóa tất cả</button>
            <button class="col-2 btn btn-sm btn-primary action_all" data-action= "unlock" style="margin-left: 10px"><i class="fa fa-trash"></i> Mở khóa tất cả</button>
        </div>
            <div class="row row-padding align-items-center">
                <table name="table" class="table table-hover table-bordered nowrap" id="table_sale">
                <thead>
                    <tr>
                        <th width="4%">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="table_sale_checkbox">
                                <label class="custom-control-label" for="table_sale_checkbox"></label>
                            </div>
                        </th>
                        <th width="2%">Stt</th>
                        <th width="10%">Email</th>
                        <th width="5%">Gói</th>
                        <th width="5%">Bắt đầu</th>
                        <th width="5%">Kết thúc</th>
                        <th width="5%">Giá</th>
                        <th width="5%">Khuyến mại</th>
                        <th width="5%">Tổng tiền</th>
                        <th width="5%">Trạng thái</th>
                        <th width="5%">Ghi chú</th>
                        <th width="5%">Hết hạn</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/lib/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/datatables_custom.js') }}"></script>
<script type="text/javascript" src="/asset/js/javascript/sale.js?t='.time()"></script>
@endsection