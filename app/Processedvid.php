<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processedvid extends Model
{
    //
    protected $fillable = ['processedimg_id','path','FID'];

    public function Processedimg()
    {
        return $this->belongsTo('App\Processedimg');
    }
}
