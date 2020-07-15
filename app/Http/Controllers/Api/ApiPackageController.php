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


class ApiPackageController 
{   
    function load_package($request){
        $data = Package::query();
        if (isset($request->key_word)) {
            $data = $data->where("name", "like", "%".$request->key_word."%");
        }
        if (isset($request->offset)) {
            $data = $data->where("id", "<", $request->offset);
        }
        $data = $data->orderby("id", "DESC")->limit(10);
        $data = $data->get();
        return $data;
    }
    function add_package($request){
        $check_exist = Package::where("name", $request->name)->first();
        if (isset($check_exist)) {
            return "Gói đã tồn tại";
        } else {
            $data = new Package;
            $data->name = $request->name;
            $data->price = $request->price;
            $data->time = $request->time;
            $data->number_account = $request->number_account;
            $data->save();
            return "Thêm thành công";
        }
    }
    function update_package($request){
        Package::where("id", $request->id)
                ->update(["name" => $request->name, "price" => $request->price,
                            "time" => $request->time, "number_account" => $request->number_account]);
        return "Cập nhật thành công";
    }
    function delete_package($request){
        Package::where("id", $request->id)->delete();
        return "Xóa thành công";
    }
    function Package(Request $request){
        $op = $request->op;
        switch ($op) {
            case 'load_package':
                $data = $this->load_package($request);
            break;
            case 'add_package':
                $data = $this->add_package($request);
            break;
            case 'update_package':
                $data = $this->update_package($request);
            break;
            case 'delete_package':
                $data = $this->delete_package($request);
            break;
            default:
                $data = 'exception';
            break;
        }
        $data_account = ['status' => 200, 'message' => $data];
        return response()->json($data_account);
    }
}
