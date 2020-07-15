<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Coupon;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;


class ApiCouponController 
{   
    function load_coupon($request){
        $data = Coupon::query();
        if (isset($request->key_word)) {
            $data = $data->where("name", "like", "%".$request->key_word."%");
        }
        if (isset($request->offset)) {
            $data = $data->where("id", "<", $request->offset);
        }
        if (isset($request->expired)) {
            if ($request->expired == 1) {
                $data = $data->where("end_time", "<", time());
            } else {
                $data = $data->where("end_time", ">", time());
            }
        }
        $data = $data->orderby("id", "DESC")->limit(10);
        $data = $data->get();
        return $data;
    }
    function add_coupon($request){
        $check_exist = Coupon::where("name", $request->name)->first();
        if (isset($check_exist)) {
            return "Coupon đã tồn tại";
        } else {
            $data = new Coupon;
            $data->name = $request->name;
            $data->discount = $request->discount;
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            $data->type = $request->type;
            $data->save();
            return "Thêm thành công";
        }
    }
    function update_coupon($request){
        Coupon::where("id", $request->id)
                ->update(["name" => $request->name, "discount" => $request->discount,
                            "start_time" => $request->start_time, "end_time" => $request->end_time, "type" => $request->type]);
        return "Cập nhật thành công";
    }
    function delete_coupon($request){
        Coupon::where("id", $request->id)->delete();
        return "Xóa thành công";
    }
    function Coupon(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_coupon':
                $data = $this->load_coupon($request);
            break;
            case 'add_coupon':
                $data = $this->add_coupon($request);
            break;
            case 'update_coupon':
                $data = $this->update_coupon($request);
            break;
            case 'delete_coupon':
                $data = $this->delete_coupon($request);
            break;
            default:
                $data = 'exception';
            break;
        }
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
