<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimWe extends Model
{
  protected $fillable = ['api_request','payload','response','type','header'] ;
}
