<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImiRequests extends Model
{
    protected $table = 'imi_requests';
    protected $fillable = ['header','request', 'response', 'type'] ;
}
