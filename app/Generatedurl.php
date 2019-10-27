<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generatedurl extends Model
{
    //
    protected $fillable = ['operator_id','occasion_id','img','audio','video','UID','url_occasion_text','url_occasion_image'];

    public function occasion(){
        return $this->belongsTo('App\Occasion');
    }

    public function operator(){
        return $this->belongsTo('App\Operator');
    }
}
