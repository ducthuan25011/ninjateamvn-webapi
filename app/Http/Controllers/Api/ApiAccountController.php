<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Package;
use App\Facebook;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class ApiAccountController 
{   
    function load_account($request){
        $data = Facebook::select("tb_facebook.id", "tb_facebook.uid", "tb_facebook.name", "tb_facebook.token", "tb_customer.name")
                        ->join("tb_customer", "tb_facebook.customer_id", "=", "tb_customer.id");
        if (isset($request->customer_id) && $request->customer_id != "") {
            $data = $data->where("tb_facebook.customer_id", $request->customer_id);
        }
        $data = $data->get();
        return $data;
    }
    function add_account($request){
        $count_used = Facebook::where("customer_id", $request->customer_id)->count();
        $count = Package::select("number_account")
                    ->where("id", $request->package_id)
                    ->first();
        if (isset($count) && $count->number_account > $count_used) {
            $check_exist = Facebook::where("customer_id", $request->customer_id)
                                    ->where("uid", $request->uid)
                                    ->first();
            if (isset($check_exist)) {
                return "Tài khoản đã tồn tại";
            }
            $data = new Facebook;
            $data->uid = $request->uid;
            $data->name = $request->name;
            $data->token = $request->token;
            $data->customer_id = $request->customer_id;
            $data->save();
            return "Thêm thành công";
        } else {
            return "Số lượng tài khoản đã vượt quá số lượng đăng kí trong gói";
        }
    }
    function delete_account($request){
        Facebook::where("id", $request->id)->delete();
        return "Xóa tài khoản thành công";
    }
    function Account(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_account':
                $data = $this->load_account($request);
            break;
            case 'add_account':
                $data = $this->add_account($request);
            break;
            case 'delete_account':
                $data = $this->delete_account($request);
            break;
            default:
                $data = 'exception';
            break;
        }
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
