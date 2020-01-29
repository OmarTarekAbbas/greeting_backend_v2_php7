<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticBody extends Model
{
    protected $table = 'static_bodies';
    protected $fillable = ['id', 'language_id', 'static_translation_id','body','created_at','updated_at'];

}
