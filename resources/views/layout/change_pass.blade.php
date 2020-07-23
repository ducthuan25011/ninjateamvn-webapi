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
{{__('change_pass')}}
@endsection
@section("css")
@section("content")
<div class="card" style="">
	<div class="card-header">
		<h4 class="card-title">{{ __('change_pass') }}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body">
			<div style="width: 50%;margin: auto;">
				<div class="row row-padding match-height">
					<div class="col-sm-4">
						{{ __('pass_old') }}
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="txt_pass_old">				
					</div>
					<div class="col-sm-4">
						{{ __('pass_new') }}
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="txt_pass_new">				
					</div>
					<div class="col-sm-12">
						<button class="btn btn-sm btn-primary" id="btn_active_pass">
							<i class="fa fa-save"></i> {{ __('update') }}
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section("javascript")
<script type="text/javascript" src="{{ asset('asset/js/javascript/login.js?t='.time()) }}"></script>
@endsection
