<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Category extends Model
{
    //
    use Translatable;

    protected $table = 'categories';

    protected $fillable = ['title'];

    public function occasions()
    {
        return $this->hasMany('App\Occasion');
    }
}



//App\Category::create(['title'=>'مناسبات دينية']);
