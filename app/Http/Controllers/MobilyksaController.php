<?php

namespace App\Http\Controllers;

use App\Generatedurl;
use App\Greetingimg;
use App\MONotification;
use App\OptInNotification;
use App\OptoutNotification;
use App\RenewalNotification;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\File;

class MobilyksaController extends Controller
{


  public function landing_rotana_mobily_ksa(Request $request)
  {

    $ip = $_SERVER["REMOTE_ADDR"];

    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
        $ip = $_SERVER['HTTP_CLIENT_IP'];

        $country_from_ip = $this->ip_info("Visitor", "Country");

    $actionName = "Mobily KSA Binary landing Page";
    $parameters_arr = array(
      'date' => Carbon::now()->format('Y-m-d H:i:s'),
      'ip'=> $ip ,
      'country'=>$country_from_ip

    );

    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $parameters_arr);

    return view('landing_v2.mobily.rotana_mobily_landing');
  }

  public function RotanaMobilyKsaSend(Request $request)
  {

    date_default_timezone_set("Africa/Cairo");
    $msisdn = $request->input('number');
    $code = 966;
    if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
      session()->flash('error', 'هذا الرقم غير صحيح');
      return back();
    }
    $URL = "http://34.77.117.25/MobilyApi/api/Subscribe/ConfirmSub/$code$msisdn/102"; // mobily
    $result = preg_replace('/\s+/', '', $this->GetPageData($URL));
    $JSON = json_decode($result);
    $JSON = $JSON->responseData->subscriptionStatus;

    $actionName = "Mobily KSA Binary Check Status";
    $parameters_arr = array(
      'MSISDN' => $code.$msisdn,
      'link' => $URL,
      'date' => Carbon::now()->format('Y-m-d H:i:s'),
      'result' => json_decode($result,true)
    );

    $this->log($actionName, $URL, $parameters_arr);
    if (isset($JSON)) {
      if ($JSON == "CANCELED") {
        session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => MOBILY_KSA_OP_ID]);
        $Url = Generatedurl::where('operator_id', MOBILY_KSA_OP_ID)->latest()->first();
        $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
          ->where('greetingimg_operator.operator_id', '=', MOBILY_KSA_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();
        if ($snap) {
          return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
        } else {
          return redirect(url('rotanav2/' . $Url->UID));
        }
      } else {
        session()->flash('error', 'هذا الرقم غير مشترك');
        return view('landing_v2.mobily.rotana_mobily_landing');
      }
    }


  }


  public static function GetPageData($URL)
  {

    $ch = curl_init();
    $timeout = 500;
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return ($data);

  }

  public function log($actionName, $URL, $parameters_arr)
  {
    date_default_timezone_set("Africa/Cairo");
    $date = date("Y-m-d");
    $log = new Logger($actionName);

    if (!File::exists(storage_path('logs/' . $date . '/' . $actionName))) {
      File::makeDirectory(storage_path('logs/' . $date . '/' . $actionName), 0775, true, true);
    }

    $log->pushHandler(new StreamHandler(storage_path('logs/' . $date . '/' . $actionName . '/logFile.log', Logger::INFO)));
    $log->addInfo($URL, $parameters_arr);
  }

  function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
  {
      $output = NULL;
      if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
          $ip = $_SERVER["REMOTE_ADDR"];
          if ($deep_detect) {
              if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
              if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                  $ip = $_SERVER['HTTP_CLIENT_IP'];
          }
      }
      $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
      $support = array("country", "countrycode", "state", "region", "city", "location", "address");
      $continents = array(
          "AF" => "Africa",
          "AN" => "Antarctica",
          "AS" => "Asia",
          "EU" => "Europe",
          "OC" => "Australia (Oceania)",
          "NA" => "North America",
          "SA" => "South America"
      );
      if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        //  $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

          $ipdat  = @json_decode($this->GetPageData("http://www.geoplugin.net/json.gp?ip=" . $ip)) ;

          if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
              switch ($purpose) {
                  case "location":
                      $output = array(
                          "city" => @$ipdat->geoplugin_city,
                          "state" => @$ipdat->geoplugin_regionName,
                          "country" => @$ipdat->geoplugin_countryName,
                          "country_code" => @$ipdat->geoplugin_countryCode,
                          "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                          "continent_code" => @$ipdat->geoplugin_continentCode
                      );
                      break;
                  case "address":
                      $address = array($ipdat->geoplugin_countryName);
                      if (@strlen($ipdat->geoplugin_regionName) >= 1)
                          $address[] = $ipdat->geoplugin_regionName;
                      if (@strlen($ipdat->geoplugin_city) >= 1)
                          $address[] = $ipdat->geoplugin_city;
                      $output = implode(", ", array_reverse($address));
                      break;
                  case "city":
                      $output = @$ipdat->geoplugin_city;
                      break;
                  case "state":
                      $output = @$ipdat->geoplugin_regionName;
                      break;
                  case "region":
                      $output = @$ipdat->geoplugin_regionName;
                      break;
                  case "country":
                      $output = @$ipdat->geoplugin_countryName;
                      break;
                  case "countrycode":
                      $output = @$ipdat->geoplugin_countryCode;
                      break;
              }
          }
      }
      return $output;
  }


}
