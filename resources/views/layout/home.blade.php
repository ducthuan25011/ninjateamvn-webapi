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
				 		<input type="text" class="form-control" name="txt_email" id="email">
				 	</div>
				 	<div class="col-4">
				 		<div class="theme">Mật khẩu</div>
				 		<input type="password" class="form-control" name="txt_password" id="password">
				 	</div>
				 	<div class="col-4">
				 		<div class="theme">Số điện thoại</div>
				 		<input type="number" class="form-control" name="txt_phone" id="phone">
				 	</div>
				</div>
				<div class="col-12" style="display: flex;">
				 	<div class="col-4">
				 		<div class="theme">Tên</div>
				 		<input type="text" class="form-control" name="txt_name" id="name">
				 	</div>
				 	<div class="col-4">
				 		<div class="theme">Email người giới thiệu</div>
				 		<input type="text" class="form-control" name="txt_referral" id="referral">
				 	</div>
				 	<div class="col-4">
				 		<div class="theme">Trạng thái</div>
				 		<select class="form-control custom-select" id="status">
				 			<option value="lock">Khóa</option>
				 			<option value="unlock" selected>Không khóa</option>
				 		</select>
				 	</div>
				</div>
				<div class="col-12" style="display: flex;">
				 	<div class="col-4">
				 		<div class="theme">Chỉ định làm admin</div>
				 		<select class="form-control custom-select" id="is_admin">
				 			<option value="1">Có</option>
				 			<option value="0" selected>Không</option>
				 		</select>
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
			<div class="row row-padding align-items-center">
				
			</div>
		</div>
	</div>
</div>
@endsection
@section("javascript")
<script type="text/javascript" src="/asset/js/javascript/customer.js?t='.time()"></script>
@endsection