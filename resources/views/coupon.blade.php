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
        #table_coupon_filter label{
            display: inline-flex;
        }
    </style>
@endsection
@section("content")
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Thêm khuyến mại</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row row-padding align-items-center">
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Tên khuyến mại</div>
                        <input type="text" class="form-control" id="txt_name" name="name">
                    </div>
                    <div class="col-4">
                        <div class="theme">Giảm giá</div>
                        <input type="number" min="0" class="form-control" id="txt_discount" name="discount">
                    </div>
                    <div class="col-4">
                        <div class="theme">Loại</div>
                        <select class="form-control custom-select" id="select_type">
                            <option value="vnd">vnd</option>
                            <option value="percent">%</option>
                        </select>
                    </div>
                </div>
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Thời gian bắt đầu</div>
                        <input type="text" class="form-control datetimepicker" id="txt_start_time" name="start_time">
                    </div>
                     <div class="col-4">
                        <div class="theme">Thời gian kết thúc</div>
                        <input type="text" class="form-control datetimepicker" id="txt_end_time" name="end_time">
                    </div>
                </div>
                <div class="col-12" style="display: flex;margin-top: 10px">
                    <div class="col-4">
                        <button class="btn btn-sm btn-primary add_coupon"><i class="fa fa-trash"></i>&nbsp;Lưu khuyến mại</button>
                        <button class="btn btn-sm btn-primary edit_coupon hidden" data-id = ""><i class="fa fa-trash"></i>&nbsp;Sửa khuyến mại</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Danh sách khuyến mại</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
        <div style="display: flex;margin-bottom: 10px">
            <button class="col-2 btn btn-sm btn-danger delete_all"><i class="fa fa-trash"></i> Xóa tất cả</button>
        </div>
            <div class="row row-padding align-items-center">
                <table name="table" class="table table-hover table-bordered nowrap" id="table_coupon">
                <thead>
                    <tr>
                        <th width="4%">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="table_coupon_checkbox">
                                <label class="custom-control-label" for="table_coupon_checkbox"></label>
                            </div>
                        </th>
                        <th width="4%">Stt</th>
                        <th width="10%">Tên khuyến mại</th>
                        <th width="5%">Giảm giá</th>
                        <th width="2%">Loại</th>
                        <th width="5%">Bắt đầu</th>
                        <th width="5%">Kết thúc</th>
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
<script type="text/javascript" src="{{ asset('js/lib/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/datatables_custom.js') }}"></script>
<script type="text/javascript" src="/asset/js/javascript/coupon.js?t='.time()"></script>
<script src="public/asset/js/lib/datetime/datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(".datetimepicker").datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            mask: true,
            dayOfWeekStart: 1,
            readonly: true,
        }).attr('readonly', false);
</script>
@endsection