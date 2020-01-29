<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreetingimgOperator extends Model
{
    protected $table = 'greetingimg_operator';
    protected $fillable = ['operator_id','greetingimg_id','popular_count'];
}
