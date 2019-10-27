<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Greetingaudio extends Model
{
    //
    protected $fillable = ['title','path','occasion_id','cprovider_id','RDate','EXDate','rbt','notification','featured'];

    public function occasion()
    {
        return $this->belongsTo('App\Occasion');
    }

    public function operators()
    {
        return $this->belongsToMany('App\Operator')->withTimestamps();
        /*
          withTimestamps() with many to many  relation :
          when create new greeding audio and then in edit assign one or more operators
          the relation is many to many as greeting audio can has more operators and
           any operator can has more greeding audio
          so we have a pivot table "join"   "greetingaudio_operator"

          - If you want your pivot table to have automatically maintained created_at and updated_at timestamps,
            use the withTimestamps method on the many to many relationship

         * ex: when  use  withTimestamps() , the records in "greetingaudio_operator"  table are like

           70	8	2016-02-07 16:19:28	2016-02-07 16:19:28
           70	12	2016-02-07 16:19:28	2016-02-07 16:19:28


         *  ex: when not use  withTimestamps() , the records in "greetingaudio_operator"  table are like [the created_at and updated_at are  0000-00-00 00:00:00 ]
         72	8	0000-00-00 00:00:00	0000-00-00 00:00:00
         72	12	0000-00-00 00:00:00	0000-00-00 00:00:00



         - link:
         http://stackoverflow.com/questions/25726602/timestamps-are-not-updating-while-attaching-data-in-pivot-table

         https://laravel.com/docs/5.1/eloquent-relationships#many-to-many

        */
    }

    public  function getOperatorListAttribute()
    {
        return $this->operators->pluck('id')->all();
    }

    public function cprovider()
    {
        return $this->belongsTo('App\Cprovider');
    }

     // make query on model
    // this query mean --- we get all greeting audio that their start date is today or befor and end date is today or later
    public function scopePublished($query){
        $query->where('RDate','<=',Carbon::now()->format('Y-m-d'))->where('EXDate','>=',Carbon::now()->format('Y-m-d'));
    }

    public function scopePublishedocc($query,$OccID){
        $query->where('RDate','<=',Carbon::now()->format('Y-m-d'))->where('EXDate','>=',Carbon::now()->format('Y-m-d'))->where('occasion_id','=',$OccID);
    }
    public function scopePublishedRbt($query){
        $query->where('rbt',1)->where('RDate','<=',Carbon::now()->format('Y-m-d'))->where('EXDate','>=',Carbon::now()->format('Y-m-d'));
    }
    public function scopePublishedNotification($query){
        $query->where('notification',1)->where('RDate','<=',Carbon::now()->format('Y-m-d'))->where('EXDate','>=',Carbon::now()->format('Y-m-d'));
    }
    public function scopeRbt($query){
        $query->where('rbt',1);
    }
    public function scopeNotification($query){
        $query->where('notification',1);
    }
    public function scopeAudio($query){
        $query->where('notification',0)->where('rbt',0);
    }
}
