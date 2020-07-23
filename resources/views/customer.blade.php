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
        #table_customer_filter label{
            display: inline-flex;
        }
    </style>
@endsection
@section("content")
<div class="card hidden">
    <div class="card-header pb-0">
        <h4 class="card-title">{{__("setting")}}</h4>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <div><a target="_blank" href="https://chrome.google.com/webstore/detail/ublock-origin/cjpalhdlnbpafiamejdnhcphjbkeiagm?hl=vi">Addon "uBlock Origin"</a></div>
            <div><a target="_blank" href="https://chrome.google.com/webstore/detail/ublock-origin/cjpalhdlnbpafiamejdnhcphjbkeiagm?hl=vi">Addon "Allow CORS: Access-Control-Allow-Origin
                "</a></div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Thêm tài khoản</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row row-padding align-items-center">
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Email</div>
                        <input type="text" class="form-control" id="txt_email" name="email">
                        <label class="warning hidden" style="color: red">Email chưa đúng định dạng</label>
                    </div>
                    <div class="col-4">
                        <div class="theme">Mật khẩu&nbsp;&nbsp;<i class="fa fa-eye" id="view_password"></i></div>
                        <input type="password" class="form-control" id="txt_password" name="password">
                    </div>
                    <div class="col-4">
                        <div class="theme">Số điện thoại</div>
                        <input type="number" class="form-control" id="txt_phone" name="phone">
                    </div>
                </div>
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Tên</div>
                        <input type="text" class="form-control" id="txt_name" name="name">
                    </div>
                    <div class="col-4">
                        <div class="theme">Email người giới thiệu</div>
                        <input type="text" class="form-control" id="txt_referral" name="referral">
                    </div>
                    <div class="col-4">
                        <div class="theme">Trạng thái</div>
                        <select class="form-control custom-select" id="select_status">
                            <option value="unlock">Không khóa</option>
                            <option value="lock">Khóa</option>
                        </select>
                    </div>
                </div>
                <div class="col-12" style="display: flex;">
                    <div class="col-4">
                        <div class="theme">Chỉ định làm admin</div>
                        <select class="form-control custom-select" id="select_admin">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                </div>
                <div class="col-12" style="display: flex;margin-top: 10px">
                    <div class="col-4">
                        <button class="btn btn-sm btn-primary add_customer"><i class="fa fa-trash"></i>Lưu tài khoản</button>
                        <button class="btn btn-sm btn-primary edit_customer hidden" data-id=""><i class="fa fa-trash"></i>Sửa tài khoản</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Danh sách tài khoản</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
        <div style="display: flex;margin-bottom: 10px">
            <button class="col-2 btn btn-sm btn-danger action_all" data-action="lock"><i class="fa fa-trash"></i> Khóa tất cả</button>
            <button style="margin-left: 10px;" class="col-2 btn btn-sm btn-primary action_all" data-action="unlock"><i class="fa fa-trash"></i> Mở khóa tất cả</button>
        </div>
            <div class="row row-padding align-items-center">
                <table name="table" class="table table-hover table-bordered nowrap" id="table_customer">
                <thead>
                    <tr>
                        <th width="4%">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="table_customer_checkbox">
                                <label class="custom-control-label" for="table_customer_checkbox"></label>
                            </div>
                        </th>
                        <th width="4%">Stt</th>
                        <th width="5%">Email</th>
                        <th width="10%">Tên</th>
                        <th width="5%">Số điện thoại</th>
                        <th width="2%">Người giới thiệu</th>
                        <th width="5%">Admin</th>
                        <th width="5%">Trạng thái</th>
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
<script type="text/javascript" src="/asset/js/javascript/customer.js?t='.time()"></script>
@endsection