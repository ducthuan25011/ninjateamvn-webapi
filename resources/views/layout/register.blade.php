
<!DOCTYPE html>
<html class="loading" lang="vi" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/app.css')}}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
	<meta name="viewport" content="width=device-width">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{__('register')}}</title>
	<style type="text/css">
		.form-login {
		    width: 90%;
		}
		@media (min-width: 992px) {
			.form-login{
				width: 45%;
			}
		}
		@media (min-width: 992px) {
			.form-login{
				width: 450px;
			}
		}
		.content-wrapper{
			background-image: linear-gradient(to right,#1AB0C3 0,#5AD9E9 100%);
    		background-repeat: repeat-x;
		}
	</style>
</head>
<body>
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="d-flex align-items-center justify-content-center " style="height: 100vh;">
				<div class="card form-login">
					<div class="card-header border-0" style="padding:0.5rem !important;">
						<div class="card-title text-center">
							<div ><img class="w-50" src="{{ asset('images/logo.jpg') }}" alt="NinjaTeam">
							</div>
						</div>
					</div>
					<div class="card-content">
						<div class="card-body pt-0">
							<fieldset id="thongbao" style='text-align: center;font-weight: bold'></fieldset>
							<fieldset class="form-group floating-label-form-group">
								<label for="txt_user_name">{{__('email')}}</label>
								<input type="text" class="form-control" id="txt_user_name" placeholder="{{__('email')}}">
							</fieldset>
							<fieldset class="form-group floating-label-form-group mb-1">
								<label for="txt_user_password">{{__('password')}}</label>
								<input type="password" class="form-control" id="txt_user_password" placeholder="{{__('password')}}">
							</fieldset>
							<fieldset class="form-group floating-label-form-group mb-1">
								<label for="txt_user_repassword">{{__('passsword_confirm')}}</label>
								<input type="password" class="form-control" id="txt_user_repassword" placeholder="{{__('passsword_confirm')}}">
							</fieldset>
							<button type="button" class="btn btn-outline-primary btn-block" id="btn_register"><i class="fa fa-signal"></i> {{__('register')}}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('js/lib/vendors.min.js') }}"></script>
	<script src="{{asset('js/app/custom.js') }}"></script>
	<script src="{{asset('js/app/app.js') }}"></script>
	<script src="{{asset('asset/js/javascript/login.js?t='.time()) }}"></script>
</body>
</html>