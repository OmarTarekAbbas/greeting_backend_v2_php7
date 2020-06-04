<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respo extends Model
{
    protected $table = 'response';

    protected $fillable = [
        'complete_url',
        'respons',
        'op',
    ];
}
