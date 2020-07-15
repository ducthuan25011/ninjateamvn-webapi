<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $table = 'tb_facebook';
    public $timestamps = false;
    protected $fillable = ["id", "uid", "name", "token", "customer_id"];
}
