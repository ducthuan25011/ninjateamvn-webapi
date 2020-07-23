@php
	$layout = Session::get("theme_active");
	if($layout == "" || $layout == 1){
		$layout = "";
	}else{
		$layout = 1;
	}
@endphp
@extends('layout.layout'.$layout)
@section("title")
{{__('setting')}}
@endsection
@section("content")
<div class="card">
	<div class="card-header">
		<h4 class="card-title">{{__('remove_duplicate')}}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body">
			<div class="row row-padding-5 align-items-center">
				<div class="col-sm-12 col-md-7 col-lg-6 col-xl-5">
					Nhập số lượng uid cần loại bỏ. Giới hạn 4000 UID 1 lần
				</div>
				<div class="col-md-2">
					<input class="form-control" type="number" value="2000" id="number_data_remove" placeholder="Nhập số lượng"/>
				</div>
				<div class="col-md-2">
					<button class="btn btn-sm btn-danger" id="btn_remove_duplicate"><i class="fa fa-trash"></i> {{__("delete")}}</button>
				</div>
			</div>
			<div class="row row-padding-5 align-items-center" id="status_remove"></div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h4 class="card-title">{{ __('setting') }}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body" style="padding-top:0px !important;">
			<div class="container">
				<div class="row row-padding">
					<div class="col-sm-6">
						{{ __('allow_register') }}
					</div>
					@php
						$register_yes = "checked";
						$register_no = "checked";
						if($register == 1){
							$register_no = "";
						}else{
							$register_yes = "";
						}
					@endphp
					<div class="col-sm-6"  style="display: inherit;">
						<div class="custom-control custom-radio" style="padding-right: 20px;">
						<input type="radio" class="custom-control-input register" name="register" id="register_yes" value="1" {{$register_yes}}/>
							<label class="custom-control-label" for="register_yes">{{__('allow_yes')}}</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input register" name="register" id="register_no" value="0" {{$register_no}} />
							<label class="custom-control-label" for="register_no">{{__('allow_no')}}</label>
						</div>
					</div>
					<div class="col-sm-6 hidden">
						{{__('allow_save_media')}}
					</div>
					@php
						$download_yes = "checked";
						$download_no = "checked";
						if($download == 1){
							$download_no = "";
						}else{
							$download_yes = "";
						}
					@endphp
					<div class="col-sm-6 hidden">
						<div class="custom-control custom-radio" style="padding-right: 20px;">
							<input type="radio" class="custom-control-input download" name="download" id="download_yes" value="1" {{$download_yes}} />
							<label class="custom-control-label" for="download_yes">{{__('allow_yes')}}</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input download" name="download" id="download_no" value="0" {{$download_no}} />
							<label class="custom-control-label" for="download_no">{{__('allow_no')}}</label>
						</div>
					</div>
					<div class="col-sm-6 hidden">
						{{__('allow_download_image')}}
					</div>
					@php
						$download_image_yes = "checked";
						$download_image_no = "checked";
						if($download_image == 1){
							$download_image_no = "";
						}else{
							$download_image_yes = "";
						}
					@endphp
					<div class="col-sm-6 hidden">
						<div class="custom-control custom-radio" style="padding-right: 20px;">
							<input type="radio" class="custom-control-input download_image" name="download_image" id="download_image_yes" value="1" {{$download_image_yes}}>
							<label class="custom-control-label" for="download_image_yes">{{__('allow_yes')}}</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input download_image" name="download_image" id="download_image_no" value="0" {{$download_image_no}} />
							<label class="custom-control-label" for="download_image_no">{{__('allow_no')}}</label>
						</div>
					</div>
					<div class="col-sm-6 hidden">
						{{__('allow_download_video')}}
					</div>
					@php
						$download_video_yes = "checked";
						$download_video_no = "checked";
						if($download_video == 1){
							$download_video_no = "";
						}else{
							$download_video_yes = "";
						}
					@endphp
					<div class="col-sm-6 hidden">
						<div class="custom-control custom-radio" style="padding-right: 20px;">
							<input type="radio" class="custom-control-input download_video" name="download_video" id="download_video_yes" value="1" {{$download_video_yes}}>
							<label class="custom-control-label" for="download_video_yes">{{__('allow_yes')}}</label>
						</div>
						<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input download_video" name="download_video" id="download_video_no" value="0"  {{$download_video_no}}/>
							<label class="custom-control-label" for="download_video_no">{{__('allow_no')}}</label>
						</div>
					</div>
					<div class="col-12">
						<button class="btn btn-sm btn-primary" id="btn_update_setting"><i class="fa fa-save"></i> {{__('update')}}</button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h4 class="card-title">{{__('account')}}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body" style="padding-top:0px !important;">
			<div class="row row-padding align-items-center">
				<div class="col-sm-2 col-lg-1">
				{{__('email')}}
				</div>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="txt_email_register" placeholder="{{__('placeholder_email')}}">
				</div>
				<div class="col-sm-3">
					<button class="btn btn-sm btn-primary" id="btn_register_account">
						<i class="fa fa-save"></i> {{__('register')}}
					</button>	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h4 class="card-title">{{__('list_account')}}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body" style="padding-top:0px !important;">
			<div class="row row-padding">
				<div class="col-12">
					<button class="btn btn-sm btn-danger" id="delete_all">
						<i class="fa fa-trash"></i> {{__('delete_all')}}
					</button>
					<button class="btn btn-sm btn-success" id="lock_all">
						<i class="fa fa-lock"></i> {{__('lock_all')}}
					</button>
					<button class="btn btn-sm btn-primary" id="unlock_all">
						<i class="fa fa-unlock"></i> {{__('unlock_all')}}
					</button>
					<button class="btn btn-sm btn-warning" id="reset_all">
						<i class="fa fa-refresh"></i> {{__('reset_all')}}
					</button>
				</div>
				<div class="col-12">
					<table class="table table-hover table-bordered" id="table_list_user">
						<thead>
							<tr>
								<th width="3%" rowspan="2">
									{{ check_all("table_list_user_checkbox") }}
								</th>
								<th>{{__('email')}}</th>
								<th width="17%" rowspan="2">{{__('password')}}</th>
								<th width="12%">{{__('status')}}</th>
								<th width="15%" rowspan="2">{{__('log_in')}}</th>
								<th width="12%" rowspan="2">{{__('action')}}</th>
							</tr>
							<tr>
								<th><input type="search" placeholder="Email" class="column_search form-control" /></th>
								<th style="border-right-width: 1px;"><input type="search" placeholder="{{__('status')}}" class="column_search form-control" /></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section("javascript")
<script type="text/javascript" src="{{ asset('js/lib/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/lib/datatables_custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/js/javascript/setting.js?t='.time()) }}"></script>
@endsection