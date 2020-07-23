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
        #table_account_filter label{
            display: inline-flex;
        }
    </style>
@endsection
@section("content")
<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title">Danh sách tài khoản Facebook liên kết</h4>
    </div>
    <hr/>
    <div class="card-content collapse show">
        <div class="card-body">
        <div style="display: flex;margin-bottom: 10px">
            <button class="col-2 btn btn-sm btn-danger delete_all"><i class="fa fa-trash"></i> Xóa tất cả</button>
        </div>
            <div class="row row-padding align-items-center">
                <table name="table" class="table table-hover table-bordered nowrap" id="table_account">
                <thead>
                    <tr>
                        <th width="4%">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="table_account_checkbox">
                                <label class="custom-control-label" for="table_account_checkbox"></label>
                            </div>
                        </th>
                        <th width="4%">Stt</th>
                        <th width="5%">Uid</th>
                        <th width="5%">Tên</th>
                        <th width="2%">Email</th>
                        <th width="5%">Tên khách hàng</th>
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
<script type="text/javascript" src="/asset/js/javascript/account.js?t='.time()"></script>
@endsection