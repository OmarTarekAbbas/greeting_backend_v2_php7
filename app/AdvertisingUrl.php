<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class AdvertisingUrl extends Model
{
    
    protected $table = 'advertising_urls' ;

    protected $fillable = [
        'adv_url',
        'transaction_id' ,
        'msisdn' ,
        'operatorId' ,
		'operatorName' ,
        'publisherId_macro',
        'ads_compnay_name',
        'status',
        'transaction_id'
        
    ];
   
}
