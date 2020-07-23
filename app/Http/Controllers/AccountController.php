<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Customer;
use App\Package;
use App\Facebook;
use App\Sale;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function load_account($request){
        $data = Facebook::select("tb_facebook.id", "tb_facebook.uid", "tb_facebook.name", "tb_facebook.token", "tb_customer.email", "tb_customer.name as customer_name")
                        ->join("tb_customer", "tb_facebook.customer_id", "=", "tb_customer.id")
                        ->get();
        echo $data;
    }
    function action_account($request){
    	Facebook::whereIn("id", $request->id)->delete();
    	echo "ok";
    }
    function Account(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_account':
                $data = $this->load_account($request);
            break;
            case 'action_account':
                $data = $this->action_account($request);
            break;
            default:
                $data = 'exception';
            break;
        }
    }
}
