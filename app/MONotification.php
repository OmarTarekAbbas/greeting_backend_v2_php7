<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MONotification extends Model
{
    protected $table = 'mobily_notifications';
    protected $fillable = ['msisdn', 'text', 'request', 'response', 'type'];

}
