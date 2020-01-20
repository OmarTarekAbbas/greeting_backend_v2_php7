<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Greetingimg extends Model {

    //
    use Translatable;
    protected $table = 'greetingimgs';

    protected $fillable = ['title', 'path', 'vid_path', 'vid_type', 'occasion_id', 'RDate', 'EXDate', 'featured', 'popular_count', 'snap', 'snap_link'];

    protected static function boot(){
        parent::boot();

    }

    public function occasion() {
        return $this->belongsTo('App\Occasion');
    }

    public function operators() {
        return $this->belongsToMany('App\Operator')->withTimestamps();
    }

    public function msisdns() {
        return $this->belongsToMany('App\Msisdn','msisdn_greetingimgs','greetingimg_id','msisdn_id')->withTimestamps();
    }

    public function getOperatorListAttribute() {
        return $this->operators->lists('id')->all();
    }

    public function processedimgs() {
        return $this->hasMany('App\Processedimg');
    }

    public function scopePublished($query) {
        $query->where('snap', 0)->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->where('EXDate', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopePublishedocc($query, $OccID) {
        $query->where('snap', 0)->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->where('EXDate', '>=', Carbon::now()->format('Y-m-d'))->where('occasion_id', '=', $OccID);
    }

    public function scopePublisheSnapdocc($query, $OccID) {
        $query->where('snap', 1)->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->where('EXDate', '>=', Carbon::now()->format('Y-m-d'))->where('occasion_id', '=', $OccID);
    }

    public function scopeOccasionslist($query) {
        $query->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->where('EXDate', '>=', Carbon::now()->format('Y-m-d'))->occasion()->unique()->lists('title', 'id');
    }

    public function scopePublishedSnap($query) {
        $query->where('snap', 1)->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->where('EXDate', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopePublishedSnapComming($query) {
        $query->where('snap', 1)->where('EXDate', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopeSlider($query) {
        $query->where('featured', 1);
    }

    public function scopePopular($query) {
        $query->orderBy('popular_count','desc');
    }

    public function scopeFavourite($query,$number) {
      $OP=OP();
      $operator = Operator::find(OP());


        if($operator->id == 8)
        {
          $OP=8;
          $prefix = "965" ;
        }
        else if($operator->id == 13)  // viva
        {
          $OP=51;
           $prefix = "965" ;
        }
        else if($operator->id == 12)  // ooredoo
        {
          $OP=50;
           $prefix = "965" ;
        } else if($operator->id == 16 )
        {
          $OP=16;
           $prefix = "966" ;
        }else{
            $prefix = "965" ;
        }

      $msisdn = \App\Msisdn::where('msisdn',$prefix.$number)->where('operator_id',$OP)->first();
      if($msisdn)
      {
        $favs   =\App\MsisdnGreetingimg::where('msisdn_id',$msisdn->id)->get();
        $greetingImg = [];
        foreach ($favs as $fav) {
          array_push($greetingImg,$fav->greetingimg_id);
        }
        $query->whereIn('greetingimgs.id',$greetingImg);
      }
      else{
        $query->whereIn('greetingimgs.id',[]);
      }


        // $query->join('msisdns', 'msisdns.operator_id', '=', 'greetingimg_operator.operator_id')
        //       ->join('msisdn_greetingimgs',function($join){
        //               $join->on('msisdn_greetingimgs.greetingimg_id','=','greetingImgs.id'); // i want to join the users table with either of these columns
        //               $join->On('msisdn_greetingimgs.msisdn_id','=','msisdns.id');
        //         })->where('msisdns.msisdn','965'.$number);
    }


    public function Rbt() {
        return $this->belongsTo('App\Greetingaudio','rbt_id');
    }

    public function scopeImg($query){
        $query->where('snap',0);
    }
    public function scopeSnap($query){
        $query->where('snap',1);
    }


}

//App\Greetingimg::create(['title'=>'عيد الفطر 1','path'=>'Eid Fitr Greetings2-01.png','occasion_id'=>1]);
/*
$g = App\Greetingimg::find(1);
$g->operators()->attach(1,['Rdate'=>'2015-08-17','exdate'=>'2015-08-31']);
 */
