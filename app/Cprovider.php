<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cprovider extends Model
{
    //
    protected $fillable = ['name'];

    public function greetingaudios()
    {
        return $this->hasMany('App\Greetingaudio');  
    }
}
