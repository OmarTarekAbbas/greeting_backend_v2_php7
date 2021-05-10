<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostbackRequest extends Model
{
  protected $table = "postback_requests";
  protected $fillable = ['req', 'response', 'msisdn','notification_id','status','operator_id','click_id'];
}
