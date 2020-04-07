<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Occasion extends Model
{
    //
    use Translatable;


    protected $table = 'occasions';
    protected $fillable = ['title','category_id','image','slider','parent_id','occasion_RDate','occasion_EXDate'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function greetingimgs()
    {
        return $this->hasMany('App\Greetingimg');
    }

    public function generatedurls(){
        return $this->hasMany('App\Generatedurl');
    }

    public function greetingaudios()
    {
        return $this->hasMany('App\Greetingaudio');
    }

    public function sub_occasions()
    {
      return $this->hasMany('App\Occasion','parent_id','id');
    }

    public function occasion()
    {
      return $this->belongsTo('App\Occasion','parent_id','id');
    }
}

//App\Occasion::create(['title'=>'عيد الفطر','category_id'=>1]);
