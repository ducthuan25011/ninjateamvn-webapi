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


class ApiCustomerController 
{   
    function load_customer($request){
        $data = Customer::query();
        if (isset($request->is_admin)) {
            $data = $data->where("is_admin", $request->is_admin);
        }
        if (isset($request->status)) {
            $data = $data->where("status", $request->status);
        }
        if (isset($request->offset)) {
            $data = $data->where("id", "<", $request->offset);
        }
        if (isset($request->key_word)) {
            // $data = $data->where("name", "like", "%".$request->key_word."%");
            $data = $data->where("email", "like", "%".$request->key_word."%");
        }

        $data = $data->orderby("id", "DESC")->limit(10);
        $data = $data->get();
        return $data;
    }
    function create_customer($request){
        $check_exist = Customer::where("email", $request->email)->first();
        if (isset($check_exist)) {
            return "email đã tồn tại";
        } else {
            $data = new Customer;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->phone = $request->phone;
            $data->name = $request->name;
            $data->referral = $request->referral;
            $data->is_admin = $request->is_admin;
            $data->status = $request->status;
            $data->save();
            return "Thêm thành công";
        }
    }
    function update_customer($request){
        if (isset($request->password) && $request->password != ''){
            Customer::where("id", $request->id)
                ->update(["email" => $request->email, "password" => Hash::make($request->password),
                            "phone" => $request->phone, "name" => $request->name,
                            "is_admin" => $request->is_admin, "status" => $request->status]);
        } else{
           Customer::where("id", $request->id)
                    ->update(["email" => $request->email,
                            "phone" => $request->phone, "name" => $request->name,
                            "is_admin" => $request->is_admin, "status" => $request->status]);
        }
        return "Cập nhật thành công";
    }

    function Customer(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_customer':
                $data = $this->load_customer($request);
            break;
            case 'create_customer':
                $data = $this->create_customer($request);
            break;
            case 'update_customer':
                $data = $this->update_customer($request);
            break;
            default:
                $data = 'exception';
            break;
        }
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
