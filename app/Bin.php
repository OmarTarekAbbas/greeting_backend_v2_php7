<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    protected $fillable = ['bin','msisdn_id','end_time'];

    public function msisdn()
    {
    	return $this->belongsTo('App\Msisdn');
    }
}
