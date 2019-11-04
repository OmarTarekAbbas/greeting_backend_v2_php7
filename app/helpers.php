<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Generatedurl;
use App\Occasion;
use App\Operator;
use App\Country;

function menu() {

    $url = "$_SERVER[REQUEST_URI]";
    $UID = basename(parse_url($url, PHP_URL_PATH));
    $urlDetect = Generatedurl::where('UID', $UID)->get();
    if ($urlDetect->isEmpty()) {
        return null;
    } else {
        $url = Generatedurl::where('UID', $UID)->first();
        $Imgs = $url->operator->greetingimgs()->Published()->count();
        $Vid = $url->video;
        $Rbt = $url->operator->greetingaudios()->PublishedRbt()->count();
        $Not = $url->operator->greetingaudios()->PublishedNotification()->count();
        $Snap = $url->operator->greetingimgs()->PublishedSnap()->count();
    }
    return compact('Imgs', 'Vid', 'Rbt', 'Not', 'Snap');
}

function UID() {

    $url = "$_SERVER[REQUEST_URI]";
    $UID = basename(parse_url($url, PHP_URL_PATH));
    return $UID;
}

function ValidUID() {

    $valid = 0;
    $urlDetect = Generatedurl::where('UID', UID())->get();
    if (!$urlDetect->isEmpty()) {
        $valid = 1;
    }
    return $valid;
}

function OP() {

    $url = Generatedurl::where('UID', UID())->first();
    $op = $url->operator_id;
    return $op;
}

function OP_switch($uid) {
    $url = Generatedurl::where('UID', $uid)->first();
    $op = $url->operator_id;
    if($op == 13){ //
       $op = 51   ;
    }elseif ( $op == 12) {
         $op = 50   ;
    }
    return $op;
}


function Occasion() {

    $url = Generatedurl::where('UID', UID())->first();
    $occasion_id = $url->occasion_id;
    return $occasion_id;
}

function rbtSMS() {

    $UID = UID();
    $url = Generatedurl::where('UID', $UID)->first();
    $rbt_sms = $url->operator->rbt_sms;
    return $rbt_sms;
}

function get_pageLength() {

    $length = 5;
    return $length;
}

function snap_Occasions() {
    $UID = UID();
    $url = Generatedurl::where('UID', $UID)->first();
    $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();

    $occasions_array = [];
    $occasions       = [];
    foreach ($snap as $key => $value) {
        array_push($occasions_array, $value->occasion_id);
    }
    $occasions_array = array_unique($occasions_array);
    foreach ($occasions_array as $k => $occasion_id) {
        $occasion = Occasion::where('id', $occasion_id)->first(); //check an parent 1 e3rd kl parent_id fe el menu else e3rd kol 7aga
        $occasion = get_root($occasion);
        $occasions[]  = $occasion;
    }
    $occasions = array_filter($occasions);
    return array_unique($occasions);
}

function get_root($occasion)
{
    //$UID = UID();
    //$url = Generatedurl::where('UID', $UID)->first();
    //$check_parent = isset($occasion->parent_id) ? $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion->parent_id)->first():0;
    if(isset($occasion->parent_id)){
       $occasion = Occasion::where('id',$occasion->parent_id)->first();
       return get_root($occasion);
    }
    return $occasion;
}

function get_paginationLimit() {

    $limit = 5;
    return $limit;
}

function get_settings($key) {

    $value = '';
    $setting = App\Setting::where('key', $key)->get()->first();
    if ($setting)
        $value = $setting->value;

    return $value;
}

function check_op() {
    $operator = Operator::findOrfail(OP());
    return $operator->close;
    // $operator = Operator::join('countries', 'operators.country_id', '=', 'countries.id')
    //                 ->where('operators.id', OP())->where('countries.name', 'like', '%Kuwait%')
    //                 ->where(function($q) {
    //                     $q->where('operators.name', 'like', '%Zain%');
    //                     $q->orwhere('operators.name', 'like', '%Viva%');
    //                     $q->orwhere('operators.name', 'like', '%Ooredoo%');
    //                 })->first();
    //
    // if ($operator) {
    //     return true;
    // } else {
    //     return false;
    // }
}

function list_snap($ID, $UID) {
    $url = Generatedurl::where('UID', $UID)->first();
    $occasion_id = $ID;
    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->get();
    return $Rdata;
}

function check_favourtite($number, $id) {
    $OP = OP();
    $operator = Operator::find(OP());


    $prefix = "965";
    if (strpos($operator->name, 'Zain') !== false && strpos($operator->country->name, 'Kuwait') !== false) {
        $OP = 8;
    } else if (strpos($operator->name, 'Viva') !== false && strpos($operator->country->name, 'Kuwait') !== false) {
        $OP = 51;
    } else if (strpos($operator->name, 'Ooredoo') !== false && strpos($operator->country->name, 'Kuwait') !== false) {
        $OP = 50;
    } else if (strpos($operator->name, 'Zain') !== false && strpos($operator->country->name, 'Saudi Arabia') !== false) {
        $OP = 16;
        $prefix = "966";
    }

    $favourite = null;
    $msisdn = \App\Msisdn::where('msisdn', $prefix . $number)->where('operator_id', $OP)->first();
    if ($msisdn)
        $favourite = \App\MsisdnGreetingimg::where('msisdn_id', $msisdn->id)->where('greetingimg_id', $id)->first();
    return $favourite ? true : false;
}

function redirect_operator() {
    $operator = Operator::find(OP());
    $country = Country::find($operator->country_id);
    $current_url = \Request::fullUrl();
    if (strpos($operator->name, 'Zain') !== false && strpos($country->name, 'Kuwait') !== false) {
        return 'landing_zain';
    } else if (strpos($operator->name, 'Viva') !== false && strpos($country->name, 'Kuwait') !== false) {
        return 'landing_viva';
    } else if (strpos($operator->name, 'Ooredoo') !== false && strpos($country->name, 'Kuwait') !== false) {
        return 'landing_ooredoo';
    } else if (strpos($operator->name, 'Zain') !== false && strpos($country->name, 'Saudi Arabia') !== false) {
        return 'landing_zain_ksa';
    } else {
        return 'landing_v1';
    }
}
