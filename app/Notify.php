<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Notify extends Model
{
    
    protected $table = 'notify' ;

    protected $fillable = [
        'complete_url',
        'action' ,
        'msisdn' ,
        'status' 
        
    ];
   
}
