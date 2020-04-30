<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charging extends Model
{
    protected $table = 'chargings' ;

    protected $fillable = [
        'serviceId',
        'msisdn' ,
        'deductedAmount' 
        
    ];
}
