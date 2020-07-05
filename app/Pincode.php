<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
  protected $fillable = ['msisdn','pincode','expire_date_time'];
}
