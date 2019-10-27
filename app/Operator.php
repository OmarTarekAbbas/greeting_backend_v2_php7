<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    //
    protected $fillable = ['name','route','country_id','rbt_sms','close'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function greetingimgs()
    {
        return $this->belongsToMany('App\Greetingimg');
    }

    public function greetingaudios()
    {
        return $this->belongsToMany('App\Greetingaudio');
    }

    public function generatedurls(){
        return $this->hasMany('App\Generatedurl');
    }
}

//App\Operator::create(['name'=>'Vodafone','route'=>"vfegy",'country_id'=>1]);
