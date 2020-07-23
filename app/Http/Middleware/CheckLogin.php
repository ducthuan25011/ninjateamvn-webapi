<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use Route;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $email = Session::get('email');
        $route = $request->route()->getName();
        if($email == "" || $email == null){
            $method = $request->method();
            if($method == "POST" || $method == "post"){
                if($route != "Login" && $route != ""){
                    echo json_encode(array("error"=>0,"success"=>false,"messenger"=>__("error-0")));
                    die;
                }
            }else{
                if($route != "login" && $route != ""){
                    return redirect('login');
                }
            }
        }else{
            if($route == "logout"){
                return redirect('logout');
            }
        }
        return $next($request);
    }
}
