<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Coupon;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class SaleController extends Controller
{
    function load_sale($request){
    	$data = Sale::select("tb_customer.email", "tb_package.name as package_name", "tb_sale.start_time", "tb_sale.end_time", 
    						"tb_sale.price", "tb_coupon.name as coupon_name", "tb_sale.total_money", "tb_sale.status", "tb_sale.note",
    						"tb_sale.package_id", "tb_sale.coupon_id", "tb_sale.id")
    				->join("tb_customer", "tb_sale.customer_id", "=", "tb_customer.id")
    				->join("tb_package", "tb_sale.package_id", "=", "tb_package.id")
    				->leftjoin("tb_coupon", "tb_sale.coupon_id", "=", "tb_coupon.id")
    				->orderby("tb_sale.id", "DESC")
    				->get();
    	echo $data;
    }
     function add_sale($request){
     	$status = "Lưu thành công";
        $package = Package::where('id', $request->package_id)->first();
        $data = new Sale;
        $customer = Customer::where("email", $request->email)->first();
        if (isset($customer)) {
        	$customer_id = $customer->id;
        	$data->customer_id = $customer_id;
        } else {
        	$status = "Email nhập chưa đúng";
        }
        if (isset($customer_id)) {
	        $data->package_id = $request->package_id;
	        $data->price = $package->price;
	        if (isset($request->coupon_id) && $request->coupon_id != 0) {
	            $sale = Sale::where("customer_id", $customer_id)
	                        ->where("coupon_id", $request->coupon_id)
	                        ->first();
	            if (isset($sale)) {
	                $status = "Mã Khuyến mại đã được dùng. Vui lòng chọn mã khuyến mại khác";
	            } else {
	                $coupon = Coupon::where("id", $request->coupon_id)->where("end_time", ">", time())->first();
	                if (isset($coupon)) {
	                    $data->coupon_id = $request->coupon_id;
	                    if ($coupon->type == "percent") {
	                        $data->total_money = $data->price * (100-$coupon->discount) / 100;
	                    } else {
	                        $total_money = $data->price - $coupon->discount;
	                        $data->total_money = $total_money > 0 ? $total_money : 0;
	                    }
	                } else {
	                    $status = "Mã khuyến mại đã hết hạn.Vui lòng chọn mã khuyến mại khác";
	                }
	            }
	        }else {
	            $data->total_money = $package->price;
	        }
	        $sale_lastest = Sale::where("customer_id", $customer_id)
	                            ->where("end_time", ">", time())
	                            ->where("status", "unlock")
	                            ->orderby("id", "DESC")
	                            ->first();
	        if (isset($sale_lastest)) {
	            $data->start_time = $sale_lastest->end_time;
	            $data->end_time = ($sale_lastest->end_time + ($package->time * 86400));
	        } else {
	            $data->start_time = time();
	            $data->end_time = (time() + ($package->time * 86400));
	        }
	        $data->note = $request->note;
        }
        if ($status == "Lưu thành công") {
        	$data->save();
        }
        echo $status;
    }
    function update_sale($request){
    	$status = "Cập nhật thành công";
        $data = Sale::where("id", $request->id)->first();
        $package = Package::where('id', $request->package_id)->first();
        $price = $package->price;
        $coupon_id = NULL;
        if (isset($request->coupon_id) && $request->coupon_id != 0) {
            $sale = Sale::where("customer_id", $request->customer_id)
                        ->where("coupon_id", $request->coupon_id)
                        ->where("id" , "!=", $request->id)
                        ->first();
            if (isset($sale)) {
                $status = "Mã Khuyến mại đã được dùng. Vui lòng chọn mã khuyến mại khác";
            } else {
                $coupon = Coupon::where("id", $request->coupon_id)->where("end_time", ">", time())->first();
                if (isset($coupon)) {
                    $coupon_id = $request->coupon_id;
                    if ($coupon->type == "percent") {
                        $total_money = $price * (100-$coupon->discount) / 100;
                    } else {
                        $total_money = ($price - $coupon->discount) > 0 ? ($price - $coupon->discount) : 0;
                    }
                } else {
                    $status = "Mã khuyến mại đã hết hạn.Vui lòng chọn mã khuyến mại khác";
                }
            }
        }else {
            $total_money = $price;
        }
        if ($status == "Cập nhật thành công") {
	        $money = $total_money - $data->total_money;
	        $start_time = $data->start_time;
	        $end_time = $start_time + ($package->time * 86400);
	        Sale::where("id", $request->id)->update(["package_id" => $request->package_id, "start_time" => $start_time, "end_time" => $end_time,
	                                                "price" => $price, "coupon_id" => $coupon_id, "total_money" => $total_money, "note" => $request->note]);
	        $status = "Cập nhật thành công/ Giá chênh lệch: ". number_format($money);
        }
        echo $status;
    } 
    function action_sale($request){
    	foreach ($request->id as $key => $value) {
       		Sale::where("id", $value)->update(["status" => $request->action]);
    		if ($request->action == "lock") {
    			$sale = Sale::where("id", $value)->first(); 
		        $sale_lastest = Sale::where("customer_id", $sale->customer_id)
		                            ->where("end_time", ">", time())
		                            ->where("status", "unlock")
		                            ->orderby("id", "ASC")
		                            ->first();
		 	    if (isset($sale_lastest)) {
	    	        $package = Package::where("id", $sale_lastest->package_id)->first();
	            	if (isset($package)) {
	          	    	Sale::where("id", $sale_lastest->id)->update(["start_time" => time(), "end_time" => (time() + ($package->time * 86400))]);
	               	}
	            }
		    }
    	}
    	echo "ok";
    }
    function Sale(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_sale':
                $data = $this->load_sale($request);
            break;
            case 'add_sale':
                $data = $this->add_sale($request);
            break;
            case 'update_sale':
                $data = $this->update_sale($request);
            break;
            case 'action_sale':
                $data = $this->action_sale($request);
            break;
            default:
                $data = 'exception';
            break;
        }
    }
}
