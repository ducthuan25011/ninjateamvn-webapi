<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'tb_package';
    public $timestamps = false;
    protected $fillable = ["id", "name", "price", "time", "number_account"];
}
