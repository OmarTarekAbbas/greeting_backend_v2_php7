<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenewalNotification extends Model
{
    protected $fillable = ['msisdn', 'text', 'request', 'response'];
}
