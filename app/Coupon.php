<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'tb_coupon';
    public $timestamps = false;
    protected $fillable = ["id", "name", "discount", "start_time", "end_time", "type"];
}
