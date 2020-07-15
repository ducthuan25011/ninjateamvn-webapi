<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;


class ApiLoginController 
{   
    function check_login($request){
        $account = Customer::where("email", $request->email)
                        ->first();
        if (isset($account)) {
            if ($account->status == "lock") {
                return "Tài khoản tạm thời bị khóa. Vui lòng liên hệ hỗ trợ để mở khóa";
            }
            if (Hash::check($request->password, $account->password)) {
                $sale = Sale::select("tb_sale.start_time", "tb_sale.end_time","tb_package.id as package_id", "tb_package.name", "tb_package.number_account", "tb_package.time")
                            ->join("tb_package", "tb_sale.package_id", "=", "tb_package.id")
                            ->where('customer_id', $account->id)
                            ->where("tb_sale.status", "unlock") 
                            ->where("tb_sale.end_time" , ">", time())
                            ->orderby("tb_sale.id", "ASC")
                            ->first();
                if (isset($sale)) {
                    $account->package_id = $sale->package_id;
                    $account->package_name = $sale->name;
                    $account->start_time = $sale->start_time;
                    $account->end_time = $sale->end_time;
                    $account->number_account = $sale->number_account;
                    return $account;
                } else{
                    return "Gói chưa được đăng kí hoặc đã hết hạn. Vui lòng liên hệ hỗ trợ";
                }
            } else {
                return 'email hoặc mật khẩu không đúng';
            }                  
        } else {
            return "email chưa đăng kí tài khoản. Vui lòng liên hệ hỗ trợ";
        }
    }

    function Login(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'login':
                $data = $this->check_login($request);
            break;
            default:
                $data = 'exception';
            break;
        }
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
