<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Customer;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function adminlogin(){
        if(Session::has('email') && Session::get('email') !=""){
            return redirect()->route("home");
        }else{
            return view("layout.login");
        }
    }

    function login(Request $request){
    	$status = "Server lỗi";
        $account = Customer::where("email", $request->email)
        					->where("is_admin", 1)
                        ->first();
        if (isset($account)) {
            if ($account->status == "lock") {
                $status = "Tài khoản tạm thời bị khóa. Vui lòng liên hệ hỗ trợ để mở khóa";
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
                	Session::put('email', $request->email);
                	Session::put('phone', $account->phone);
                	Session::put('name', $account->name);
                	Session::put('status', $account->status);
                	Session::put('package_id', $sale->package_id);
                	Session::put('package_name', $sale->name);
                	Session::put('start_time', $sale->start_time);
                	Session::put('end_time', $sale->end_time);
                	Session::put('number_account', $sale->number_account);
                    $status = "success";
                } else{
                    $status = "Gói chưa được đăng kí hoặc đã hết hạn. Vui lòng liên hệ hỗ trợ";
                }
            } else {
                $status = 'email hoặc mật khẩu không đúng';
            }                  
        } else {
            $status = "email chưa đăng kí tài khoản. Vui lòng liên hệ hỗ trợ";
        }
        echo $status;
    }
}
