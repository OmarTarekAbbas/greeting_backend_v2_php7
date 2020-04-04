<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusChange extends Model
{
    protected $table = 'statuschanges' ;

    protected $fillable = [
        'serviceId',
        'subscContractId',
        'statusId',
        'statusChangeDesc'
        
    ];
}
