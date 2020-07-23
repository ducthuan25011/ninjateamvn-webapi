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

class PackageController extends Controller
{	
	function add_package($request){
		$data = new Package;
		$data->name = $request->name;
		$data->price = $request->price;
		$data->time = $request->time;
		$data->number_account = $request->number_account;
		$data->save();
		echo "ok";
	}
	function load_package($request){
		$package = Package::orderby("id", "DESC")->get();
		echo $package;
	}
	function action_package($request){
		Package::whereIn("id", $request->id)->delete();
		echo "ok";
	}
	function update_package($request){
		Package::where("id", $request->id)
				->update(["name" => $request->name, "price" => $request->price,
						"time" => $request->time, "number_account" => $request->number_account ]);
		echo "ok";
	}
    function Package(Request $request){
        $op = $request->op;
        switch ($op) {
        	case "add_package":
                $this->add_package($request);
            break;
            case "load_package":
                $this->load_package($request);
            break;
            case "action_package":
                $this->action_package($request);
            break;
            case "update_package":
                $this->update_package($request);
            break;
            default:
                # code...
            break;
        }
    }
}
