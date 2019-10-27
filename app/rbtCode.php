<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rbtCode extends Model
{
    //
    protected $table = 'rbt_codes';
    protected $fillable = ['audio_id','operator_id','code'];

    
}

