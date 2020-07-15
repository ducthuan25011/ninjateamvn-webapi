<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'tb_sale';
    public $timestamps = false;
    protected $fillable = ["id", "customer_id", "package_id", "start_time", "end_time", "price", "coupon_id", "total_money", "status", "note"];
}
