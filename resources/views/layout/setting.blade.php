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
		<h4 class="card-title">{{ __('delete_all') }}</h4>
	</div>
	<div class="card-content collapse show">
		<div class="card-body" style="padding-top:0px !important;">
			<button class="btn btn-sm btn-danger" id="btn_delete_all"><i class="fa fa-trash"></i> {{__("delete_all")}}</button>
		</div>
	</div>
</div>
@endsection
@section("javascript")
<script>
	$("#btn_delete_all").click(function(){
		if(check_yes_no == 0){
			yes_or_no(config_site.yes_or_no_delete_all,this);
			return false;
		}
		open_loadding(config_site.deleting);
    	$.ajax({
			url:domain+"Setting_fanpage",
			type:'POST',
			data:{
				op:"delete_all_data",
				_token:_token
			},
		}).done(function(data){
			close_loadding();
			thongbao(config_site.complete,"success");
		});
	});
</script>
@endsection