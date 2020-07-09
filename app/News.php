<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  protected $table = 'news' ;

  protected $fillable = [
      'title',
      'description' ,
      'occasion_id' ,
      'published_date',
      'image'
  ];

  public function setImageAttribute($value){
    $img_name = time().rand(0,999).'.'.$value->getClientOriginalExtension();
    $value->move(base_path('/uploads/akgbar/news/image'),$img_name);
    $this->attributes['image']= $img_name ;
  }

  public function getImageAttribute($value)
  {
    return $value ? url('/uploads/akgbar/news/image/'.$value) : $value;
  }

  public function occasion() {
    return $this->belongsTo('App\Occasion');
  }

}
