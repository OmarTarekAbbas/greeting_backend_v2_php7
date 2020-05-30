<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImiNotification extends Model
{
    protected $fillable = ['link','msisdn', 'svcid', 'channel', 'action', 'status', 'Nextrenewaldate', 'TransactionID'] ;
}
