<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'imi_subscribers';

    protected $fillable = ['msisdn','serviceId','requestId'] ;
}
