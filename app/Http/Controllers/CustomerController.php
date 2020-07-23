<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Package;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
	function cou_customer($request) {
		$referral = 0;
		if ($request->referral != "") {
			$refer = Customer::where("email", $request->referral)
					->first();
			if (isset($refer)) {
				$referral = $refer->id;
			}
		}
        $data = new Customer;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone = $request->phone;
        $data->name = $request->name;
        $data->referral = $referral;
        $data->is_admin = $request->is_admin;
        $data->status = $request->status;
        $data->save();
		echo "ok";
	}

    function update_customer($request){
        $referral = 0;
        if ($request->referral != "") {
            $refer = Customer::where("email", $request->referral)
                    ->first();
            if (isset($refer)) {
                $referral = $refer->id;
            }
        }
        if ($request->password != "") {
            Customer::where('id', $request->id)
                    ->update(["email"=>$request->email, "phone" => $request->phone,
                            "name" => $request->name, "referral" => $referral, 
                            "is_admin" => $request->is_admin, "status" => $request->status, "password" => Hash::make($request->password)]);
        } else {
            Customer::where('id', $request->id)
                    ->update(["email"=>$request->email, "phone" => $request->phone,
                            "name" => $request->name, "referral" => $referral, 
                            "is_admin" => $request->is_admin, "status" => $request->status]);
        }
        echo "ok";
    }
    function load_customer($request){
        $data = Customer::orderby("id", "DESC");
        if (isset($request->is_admin)) {
        	$data = $data->where("is_admin", $request->is_admin);
        }
        if (isset($request->status)) {
            $data = $data->where("status", $request->status);
        }
        $data = $data->get();
        echo $data;
    }

    function action_customer($request){
    	Customer::whereIn("id", $request->id)
    			->update(["status" => $request->action]);
    	echo "ok";
    }
    function load_referral($request){
    	$data = Customer::where("id", $request->id)->first();
    	if (isset($data)) {
    		echo $data->email;
    	}else {echo ""; }
    }
    function Customer(Request $request){
        $op = $request->op;
        switch ($op) {
            case "cou_customer":
                $this->cou_customer($request);
            break;
            case "load_customer":
                $this->load_customer($request);
            break;
            case "action_customer":
                $this->action_customer($request);
            break;
            case "load_referral":
                $this->load_referral($request);
            break;
            case "update_customer":
                $this->update_customer($request);
            break;

            default:
                # code...
            break;
        }
    }
}
