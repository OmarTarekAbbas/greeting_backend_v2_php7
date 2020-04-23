<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptInNotification extends Model
{
    protected $fillable = ['msisdn', 'text', 'request', 'response'];
}
