<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Coupon;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class ApiSaleController 
{   
    function load_sale($request){
        $data = Sale::select("tb_sale.id", "tb_customer.email", "tb_customer.name", "tb_customer.status", "tb_sale.start_time",
                            "tb_sale.end_time", "tb_sale.price", "tb_sale.total_money","tb_sale.status", "tb_sale.note", 
                            "tb_package.name as package_name", "tb_package.time", "tb_package.number_account",
                            "tb_coupon.name as coupon_name", "tb_coupon.discount", "tb_coupon.type")
                    ->join("tb_customer", "tb_sale.customer_id", "=", "tb_customer.id")
                    ->join("tb_package", "tb_sale.package_id", "=", "tb_package.id")
                    ->leftjoin("tb_coupon", "tb_sale.coupon_id", "=", "tb_coupon.id");

        if (isset($request->key_word)) {
            $data = $data->where("tb_customer.email", "like", "%".$request->key_word."%");
        }
        if (isset($request->package_id) && $request->package_id != '') {
            $data = $data->where("tb_package.id", $request->package_id);
        }
        if (isset($request->status) && $request->status != '') {
            $data = $data->where("tb_sale.status", $request->status);
        }
        if (isset($request->coupon_id) && $request->coupon_id != '') {
            $data = $data->where("tb_coupon.id", $request->coupon_id);
        }
        if (isset($request->offset)) {
            $data = $data->where("tb_sale.id", "<", $request->offset);
        }
        $data = $data->orderby("tb_sale.id", "DESC")->limit(10);
        $data = $data->get();
        return $data;
    }
    function add_sale($request){
        $package = Package::where('id', $request->package_id)->first();
        $data = new Sale;
        $data->customer_id = $request->customer_id;
        $data->package_id = $request->package_id;
        $data->price = $package->price;
        if (isset($request->coupon_id)) {
            $sale = Sale::where("customer_id", $request->customer_id)
                        ->where("coupon_id", $request->coupon_id)
                        ->first();
            if (isset($sale)) {
                return "Mã Khuyến mại đã được dùng. Vui lòng chọn mã khuyến mại khác";
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
                    return "Mã khuyến mại đã hết hạn.Vui lòng chọn mã khuyến mại khác";
                }
            }
        }else {
            $data->total_money = $package->price;
        }
        $sale_lastest = Sale::where("customer_id", $request->customer_id)
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
        $data->save();
        return "Gia hạn thành công";
    }
    function update_sale($request){
        $data = Sale::where("id", $request->id)->first();
        $package = Package::where('id', $request->package_id)->first();
        $price = $package->price;
        $coupon_id = NULL;
        if (isset($request->coupon_id)) {
            $sale = Sale::where("customer_id", $request->customer_id)
                        ->where("coupon_id", $request->coupon_id)
                        ->where("id" , "!=", $request->id)
                        ->first();
            if (isset($sale)) {
                return "Mã Khuyến mại đã được dùng. Vui lòng chọn mã khuyến mại khác";
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
                    return "Mã khuyến mại đã hết hạn.Vui lòng chọn mã khuyến mại khác";
                }
            }
        }else {
            $total_money = $price;
        }
        $money = $total_money - $data->total_money;
        $start_time = $data->start_time;
        $end_time = $start_time + ($package->time * 86400);
        Sale::where("id", $request->id)->update(["package_id" => $request->package_id, "start_time" => $start_time, "end_time" => $end_time,
                                                "price" => $price, "coupon_id" => $coupon_id, "total_money" => $total_money, "note" => $request->note]);
        return "Cập nhật thành công/ Giá chênh lệch: ". number_format($money);
    }
    
    function action_sale($request){
        Sale::where("id", $request->id)->update(["status" => $request->action]);
        $sale_lastest = Sale::where("customer_id", $request->customer_id)
                            ->where("end_time", ">", time())
                            ->where("status", "unlock")
                            ->orderby("id", "ASC")
                            ->first();
        if ($request->action == "lock") {
            if (isset($sale_lastest)) {
                $package = Package::where("id", $sale_lastest->package_id)->first();
                if (isset($package)) {
                    Sale::where("id", $sale_lastest->id)->update(["start_time" => time(), "end_time" => (time() + ($package->time * 86400))]);
                }
            }
        }
        return $request->action. " thành công";
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
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
