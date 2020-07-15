<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tb_customer';
    public $timestamps = false;
    protected $fillable = ["id", "email", "password", "phone", "name", "referral", "is_admin", "status"];
}
