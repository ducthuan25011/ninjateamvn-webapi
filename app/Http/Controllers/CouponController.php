<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Coupon;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class CouponController extends Controller
{	
	function add_coupon($request) {
		$data = new Coupon;
		$data->name = $request->name;
		$data->discount = $request->discount;
		$data->start_time = $request->start_time;
		$data->end_time = $request->end_time;
		$data->type = $request->type;
		$data->save();
		echo "ok";
	}
	function load_coupon($request){
		$data = Coupon::orderby("id", "DESC");
        if (isset($request->expire)) {
            $data = $data->where("end_time", ">", time());
        }
        $data = $data->get();
		echo $data;
	}
	function action_coupon($request){
		Coupon::whereIn("id", $request->id)->delete();
		echo "ok";
	}
	function update_coupon($request){
        Coupon::where("id", $request->id)
                ->update(["name" => $request->name, "discount" => $request->discount,
                            "start_time" => $request->start_time, "end_time" => $request->end_time, "type" => $request->type]);
        echo "Cập nhật thành công";
    }
    function Coupon(Request $request){
        $op = $request->op;
        switch ($op) {
        	case "add_coupon":
                $this->add_coupon($request);
            break;
            case "load_coupon":
                $this->load_coupon($request);
            break;
            case "action_coupon":
                $this->action_coupon($request);
            break;
            case "update_coupon":
                $this->update_coupon($request);
            break;
            default:
                # code...
            break;
        }
    }
}
