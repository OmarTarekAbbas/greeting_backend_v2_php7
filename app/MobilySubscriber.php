<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilySubscriber extends Model
{
    protected $fillable = ['msisdn', 'notificationId', 'status'];

}
