<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptoutNotification extends Model
{
    protected $fillable = ['msisdn', 'text', 'request', 'response'];
}
