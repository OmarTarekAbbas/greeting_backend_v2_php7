<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msisdnorange extends Model
{
    protected $fillable = ['msisdn','contract_id','operatorCode','final_status','pincode','status','subscribe_type'];
}
