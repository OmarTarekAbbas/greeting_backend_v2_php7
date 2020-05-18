<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timweSubscriber extends Model
{
    protected $fillable = ['msisdn','serviceId','requestId'] ;
}
