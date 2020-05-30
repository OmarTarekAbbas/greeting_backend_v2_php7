<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImiUnsubscriber extends Model
{
    protected $fillable = ['msisdn','serviceId','requestId'] ;
}
