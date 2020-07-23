<!DOCTYPE html>
<html lang="{{Session::get('lang') ? Session::get('lang'):'vi'}}" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="asset/images/logo.png" />
	<meta name="viewport" content="width=device-width">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield("title")</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/app_old.css')}}">
	@yield("css")
	<script src="{{ asset('js/lib/vendors.min.js') }}"></script>
	<script src="{{ asset('js/app/custom.js') }}"></script>
	<script src="{{ asset('js/app/app.js?t='.time()) }}"></script>
</head>
<style>
	.navigation>li.active>a {
	    font-weight: bold !important;
	}
	.menu-title{
		text-transform: capitalize;
	}
	table thead th{
		text-transform: capitalize;
	}
	.item-children{
		margin-left: 6%;
	}
</style>
<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar app-contacts  fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">
	<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
		<div class="navbar-wrapper">
			<div class="navbar-header">
				<ul class="nav navbar-nav flex-row">
					<li class="nav-item mobile-menu d-lg-none mr-auto">
						<a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a>
					</li>
					<li class="nav-item mr-auto">
						<a class="navbar-brand" href="{{ asset('') }}">
							<img class="brand-logo" src="/asset/images/logo.png">
							<h2 class="brand-text">{{ __('Nuôi nich') }}</h2>
						</a>
					</li>
					<li class="nav-item d-none d-lg-block nav-toggle">
						<a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
							<i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i>
						</a>
					</li>
					<li class="nav-item d-lg-none">
						<a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
							<i class="fa fa-ellipsis-v"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="navbar-container content">
				<div class="collapse navbar-collapse" id="navbar-mobile">
					<ul class="nav navbar-nav mr-auto float-left">
						<li class="nav-item d-none d-md-block">
							<a class="nav-link nav-link-expand" href="#">
								<i class="ficon ft-maximize"></i>
							</a>
						</li>
					</ul>
					<ul class="nav navbar-nav float-right">
						<li class="dropdown dropdown-user nav-item">
							<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
								<span class="avatar avatar-online">
									<div class="avatar badge-danger d-flex align-items-center justify-content-center text-uppercase font-weight-bold" style="height: 30px;color:white;">
										@php
											$email = Session::get("email");
											$email_short = substr($email,0,1);
											echo $email_short;
										@endphp
									</div>
									<i></i>
								</span>
								<span class="user-name">{{Session::get("email")}}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item hidden" href="">
									<i class="fa fa-key"></i>{{ __('change_pass') }}
								</a>
								<a class="dropdown-item" href="{{ asset('logout') }}">
									<i class="ft-power"></i>{{ __('log_out') }}
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
		<div class="main-menu-content">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="navigation-header">
					<span>Quản lý</span>
					<i class="ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
				</li>
				<li class="nav-item item-children">
					<a href="{{ route('customer') }}">
						<i class="fa fa-edit"></i>
						<span class="menu-title" data-i18n="">Tài khoản</span>
					</a>
				</li>
				<li class="nav-item item-children">
					<a href="{{ route('package') }}">
						<i class="fa fa-edit"></i>
						<span class="menu-title" data-i18n="">Gói</span>
					</a>
				</li>
				<li class="nav-item item-children">
					<a href="{{ route('coupon') }}">
						<i class="fa fa-edit"></i>
						<span class="menu-title" data-i18n="">Khuyến mại</span>
					</a>
				</li>
				<li class="nav-item item-children">
					<a href="{{ route('sale') }}">
						<i class="fa fa-edit"></i>
						<span class="menu-title" data-i18n="">Sale</span>
					</a>
				</li>
				<li class="nav-item item-children">
					<a href="{{ route('account') }}">
						<i class="fa fa-edit"></i>
						<span class="menu-title" data-i18n="">Tài khoản Facebook</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="modal_loadding_data" class="d-none" style="position: fixed;top: 0;left: 0;width: 100%;height: 100vh;z-index: 99999999;">
		<div style="height: 100%;background-color: aliceblue;opacity: 0.9;z-index: 999999999;display: flex;">
			<div style="margin: auto;">
				<div style="width: 100%;text-align: center;">
					<i class="fa fa-spinner fa-spin fa-4x text-primary"></i>
				</div>	
				<div style="width: 100%;text-align: center;font-weight: bold;" id="text_modal_loadding">
					{{ __('action_loadding') }}
				</div>	
			</div>
		</div>
	</div>
	<div id="modal_thongbao" class="d-none" style="position: fixed;top: 0;left: 0;width: 100%;height: 100vh;z-index: 99999999;">
		<div style="height: 100%;z-index: 999999999;display: flex;opacity: 0.9;background-color: currentColor;">
			<div style="margin: auto;border-radius: 10px;padding:10px;">
				<div style="width: 100%;text-align: center;font-weight: bold;color: white" id="text_modal_loadding">
					<i class="fa fa-4x " id="icon_modal_thongbao"></i>&nbsp; <font id="modal_body_thongbao"></font>
				</div>	
			</div>
		</div>
	</div>
	<div class="modal fade centered-modal" tabindex="-1" role="dialog" id="modal_confirm" data-backdrop="static" style="z-index:9999999;opacity: 0.9;background: currentColor;">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header" id="modal_header_confirm">
					<h6 class="modal-title" id="title_modal_confirm">{{ __('notication') }} <i class="fa fa-exclamation"></i></h6>
				</div>
				<div class="modal-body text-center" id="modal_body_confirm">
					
				</div>
				<div class="modal-footer justify-content-center" id="modal_footer_confirm" style="padding: 0.5rem">
					<button type="button" class="btn btn-sm btn-primary" id="btn_modal_confirm"></button>
					<button type="button" class="btn btn-sm btn-dark" id="btn_modal_close_confirm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;{{ __('close') }} <font id="time_auto_close"></font></button>
				</div>
			</div>
		</div>
	</div>
	<div class="app-content content">
		<div class="content-wrapper">
			@yield("content")
		</div>
	</div>

	<script src="{{ asset('js/lib/jquery.flot.min.js') }}"></script>
	<script src="{{ asset('js/lib/jquery.flot.pie.js') }}"></script>
	<script src="{{ asset('js/lib/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('js/lib/toastr.min.js') }}"></script>
	<script src="{{ asset('js/lib/jquery.base64.min.js') }}"></script>
	<script src="{{ asset('js/lib/icheck.min.js') }}"></script>
	<script src="{{ asset('js/lib/app-menu.min.js') }}"></script>
	<script src="{{ asset('js/lib/app.min.js') }}"></script>
	<script src="{{ asset('js/lib/customizer.min.js') }}"></script>
	<script src="{{ asset('js/lib/checkbox-radio.min.js') }}"></script>
	<script src="{{ asset('js/lib/datetime/datetimepicker.full.min.js') }}"></script>
	<script src="{{ asset('js/lib/select2/select2.min.js') }}"></script>
	<script src='{{ asset("js/lib/filesave.js")}}'></script>
	@yield("javascript")
</body>
</html>