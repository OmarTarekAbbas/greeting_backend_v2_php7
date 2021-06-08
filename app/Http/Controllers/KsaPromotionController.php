<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;
use App\Msisdn;
use App\AdvertisingUrl;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Generatedurl;
use App\Greetingimg;
use App\PostbackRequest;
use App\Respo;

class KsaPromotionController extends Controller
{
  public function getLanding(Request $request)
  {

    date_default_timezone_set('Africa/Cairo');
    session::forget('message');
    session::forget('adv_params');
    session::forget('transaction_id');
    session::forget('publisherId_macro');


    if (isset($_SERVER['HTTP_MSISDN'])) {
      $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
    } else {
      $MSISDN = "";
    }


    /*
      // setting all sessions
      Session::put('adv_params', $_SERVER['QUERY_STRING']);

      // make check on transaction_id ( clickid_macro ) for headwar ads company
      if (isset($_REQUEST['transaction_id']) && $_REQUEST['transaction_id'] != "") {
          $transaction_id = $_REQUEST['transaction_id'];
          Session::put('transaction_id', $transaction_id);
      } else {
          $transaction_id = "";
      }


      if (isset($_REQUEST['publisherId_macro']) && $_REQUEST['publisherId_macro'] != "") {
          $publisherId_macro = $_REQUEST['publisherId_macro'];
          Session::put('publisherId_macro', $publisherId_macro);
      } else {
          $publisherId_macro = "";
      }


      // make log with all parameters
      $result = array();
      // get client ip
      $ip = $_SERVER["REMOTE_ADDR"];

      if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_CLIENT_IP'];


      if (isset($_SERVER['HTTP_USER_AGENT'])) {
          $deviceModel = $_SERVER['HTTP_USER_AGENT'];
      } else {
          $deviceModel = "";
      }

      $company = $this->detectCompnay();

      $country_from_ip = $this->ip_info("Visitor", "Country");
      $result['date'] = Carbon::now()->format('Y-m-d H:i:s');
      $result['ip'] = $ip;
      $result['country'] = $country_from_ip;
      $result['HeadeEnriched'] = $MSISDN;
      $result['adsCompnayName'] = $company;
      $result['deviceModel'] = $deviceModel;
     // $result['AllHeaders'] = $_SERVER;

      // make log
      $actionName = "Ksa Landing Promotion";
      $URL = $request->fullUrl();
      $parameters_arr = $result;
      $this->log($actionName, $URL, $parameters_arr);


       if($request->click_id3){
         Session::put('click_id3', $request->click_id3);
       }

       if($request->aff_id3){
         Session::put('aff_id3', $request->aff_id3);
       }

      $AdvertisingUrl = new AdvertisingUrl();
      $AdvertisingUrl->adv_url =  $URL;
      $AdvertisingUrl->msisdn =  $MSISDN;
      $AdvertisingUrl->operatorId = STC_OP_ID; // Mobily KSA
      $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
      $AdvertisingUrl->operatorName = "Stc Ksa Landing";
      $AdvertisingUrl->ads_compnay_name = $company; //  intech  or headway
      $AdvertisingUrl->publisherId_macro = session::get('click_id3') ?? "";
      $AdvertisingUrl->transaction_id = session::get('aff_id3') ?? "";
      $AdvertisingUrl->save();
      */

    return view('landing_v2.ksa_landing_promotion', compact('MSISDN'));
  }
}
