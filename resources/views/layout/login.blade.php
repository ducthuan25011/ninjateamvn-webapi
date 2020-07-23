
<!DOCTYPE html>
<html lang="{{Session::get('lang')?Session::get('lang'):'vi'}}" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/app.css')}}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/images/logo.png') }}" />
	<meta name="viewport" content="width=device-width">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{__('log_in')}}</title>
</head>
<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page  pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title text-center">
												<img class="w-50" src="{{ asset('asset/images/logo.jpg') }}" alt="NinjaTeam">
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
												<fieldset id="thongbao" style='text-align: center;font-weight: bold'></fieldset>
												<div class="form-group mb-50">
													<label class="text-bold-600" for="txt_user_name">{{__("email")}}</label>
													<input type="email" class="form-control" id="txt_user_name" placeholder="{{__("email")}}">
												</div>
												<div class="form-group">
													<label class="text-bold-600" for="txt_user_password">Mật khẩu</label>
													<input type="password" class="form-control" id="txt_user_password" placeholder="{{__("password")}}">
												</div>
												<div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
													<div class="text-left">
													</div>
												</div>
												<button type="button" id="btn_login" class="btn btn-primary glow w-100 position-relative">Đăng nhập<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
									<img class="img-fluid" src="{{asset("asset/images/login.png")}}" alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{asset('js/lib/vendors.min.js') }}"></script>
    <script src="{{asset('js/lib/LivIconsEvo.tools.min.js') }}"></script>
    <script src="{{asset('js/lib/LivIconsEvo.defaults.min.js') }}"></script>
    <script src="{{asset('js/lib/LivIconsEvo.min.js') }}"></script>
    <script src="{{asset('js/lib/vertical-menu-light.min.js') }}"></script>
    <script src="{{asset('js/lib/app-menu.min.js') }}"></script>
    <script src="{{asset('js/lib/app.min.js') }}"></script>
    <script src="{{asset('js/lib/components.min.js') }}"></script>
    <script src="{{asset('js/lib/footer.min.js') }}"></script>
	<script src="{{asset('js/app/custom.js') }}"></script>
	<script src="{{asset('js/app/app.js') }}"></script>
	<script src="{{asset('asset/js/javascript/login.js?t='.time()) }}"></script>
</body>
</html>