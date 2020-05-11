<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timweUnsubscriber extends Model
{
    protected $fillable = ['msisdn','serviceId','requestId'] ;
}
