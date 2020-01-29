<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processedimg extends Model
{
    //
    protected $fillable = ['greetingimg_id','path','FID'];

    public function greetingimg()
    {
        return $this->belongsTo('App\Greetingimg');
    }

    public function Processedvids()
    {
        return $this->hasMany('App\Processedvid');
    }
}
