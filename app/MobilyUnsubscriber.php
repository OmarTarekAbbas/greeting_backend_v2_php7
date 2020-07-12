<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilyUnsubscriber extends Model
{
    protected $fillable = ['msisdn', 'notificationId', 'status'];

}
