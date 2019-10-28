<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //    
    protected $table = 'categories';

    protected $fillable = ['title'];

    public function occasions()
    {
        return $this->hasMany('App\Occasion');
    }
}



//App\Category::create(['title'=>'مناسبات دينية']);
