<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MONotification extends Model
{
    protected $fillable = ['msisdn', 'text', 'request', 'response'];

}
