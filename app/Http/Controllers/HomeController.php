<?php

namespace App\Http\Controllers;

use App\User;
use App\Notify;
use App\Msisdn;
use App\AdvertisingUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Generatedurl;
use App\Greetingimg;
use App\DuIntgration;
class HomeController extends Controller {

    public function test2(Request $request) {


        return view('home.test');


        $URL = "http://ikwm-appvas.isys.mobi:2022/ooredooKWHE/userconfig.aspx";
        $result = simplexml_load_file($URL); // Interprets an XML file into an object
        // make log
        $actionName = "Header Check";
        $parameters_arr = array(
            'URL' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'DeviceIP' => (array) $result->DeviceIP,
            'MSISDN' => (array) $result->MSISDN
        );
        $this->log($actionName, $URL, $parameters_arr);



        /*
          // test send message
          $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=httpIVAS&password=httpIV@S&recipient=96599104715&messagedata=123456";
          //   $result = file_get_contents($URL);
          $result = simplexml_load_file($URL); // Interprets an XML file into an object
          $status_code = $result->data->acceptreport->statuscode;


          print_r($result);

          var_dump($status_code) ;

          if ($status_code == 0) { // success
          echo "succccccccc";
          }

          die;
         */


        $result = $this->ip_info("Visitor", "location");
        print_r($result);

        $ddress = urlencode($result['state'] . ", " . $result['city'] . ", " . $result['country'] . ", " . $result['continent']);


        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$ddress&&api_key=AIzaSyBq_cqVw7nU_UOcwfk8AFDs3UJOdApzZ5U&sensor=false";

        echo 'URL: ' . $url;
        echo '<br />';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson);

        if ($response->status == 'OK') {
            $latitude = $response->results[0]->geometry->location->lat;
            $longitude = $response->results[0]->geometry->location->lng;
            echo 'Latitude: ' . $latitude;
            echo '<br />';
            echo 'Longitude: ' . $longitude;

            $latitude_round = round($latitude);
            $longitude_round = round($latitude);
            echo '<br />';
            echo 'Latitude Rounded: ' . $latitude_round;
            echo '<br />';
            echo 'Longitude Rounded: ' . $longitude_round;
        } else {
            echo $response->status;
            var_dump($response);
            exit;
        }
    }

    public function test(Request $request) {


        $result = array();
        // get client ip
        $ip = $_SERVER["REMOTE_ADDR"];

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];

        // HE
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }


        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $deviceModel = $_SERVER['HTTP_USER_AGENT'];
        } else {
            $deviceModel = "";
        }


        $country_from_ip = $this->ip_info("Visitor", "Country");
        $result['date'] = Carbon::now()->format('Y-m-d H:i:s');
        $result['ip'] = $ip;
        $result['country'] = $country_from_ip;
        $result['HeadeEnriched'] = $MSISDN;
        $result['deviceModel'] = $deviceModel;
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        print_r($_SERVER);
        die;
    }

    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
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

    public function HEDetect() {
        $arr = array();
        $HE = 0;
        // header inrichemnt DETECT
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
            $HE = 1;
        } else {
            $MSISDN = "";
        }

        $arr['HE'] = $HE;
        $arr['msisdn'] = $MSISDN;

        return json_encode($arr);
    }

    public function index(Request $request) {

        date_default_timezone_set('Asia/Beirut');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        // header inrichemnt DETECT
        $MSISDN = $request['MSISDN'];

        //   echo $MSISDN ; die;

        if ($MSISDN != NULL) {  // NEW HE
            $MSISDN = $request['MSISDN'];
        } elseif (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }


        // setting all sessions
        session::set('adv_params', $_SERVER['QUERY_STRING']);

        // make check on transaction_id ( clickid_macro ) for headwar ads company
        if (isset($_REQUEST['transaction_id']) && $_REQUEST['transaction_id'] != "") {
            $transaction_id = $_REQUEST['transaction_id'];
            session::set('transaction_id', $transaction_id);
        } else {
            $transaction_id = "";
        }


        if (isset($_REQUEST['publisherId_macro']) && $_REQUEST['publisherId_macro'] != "") {
            $publisherId_macro = $_REQUEST['publisherId_macro'];
            session::set('publisherId_macro', $publisherId_macro);
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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();


        return view('home.index', compact('MSISDN'));
    }

    public function vod(Request $request) {

        date_default_timezone_set('Asia/Beirut');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');

        // header inrichemnt DETECT
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }


        // setting all sessions
        session::set('adv_params', $_SERVER['QUERY_STRING']);

        // make check on transaction_id ( clickid_macro ) for headwar ads company
        if (isset($_REQUEST['transaction_id']) && $_REQUEST['transaction_id'] != "") {
            $transaction_id = $_REQUEST['transaction_id'];
            session::set('transaction_id', $transaction_id);
        } else {
            $transaction_id = "";
        }


        if (isset($_REQUEST['publisherId_macro']) && $_REQUEST['publisherId_macro'] != "") {
            $publisherId_macro = $_REQUEST['publisherId_macro'];
            session::set('publisherId_macro', $publisherId_macro);
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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();


        // return view('home.index', compact('MSISDN'));

        return redirect("http://localhost/aflamy?MSISDN=$MSISDN");
    }

    public function log($actionName, $URL, $parameters_arr) {
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d");
        $log = new Logger($actionName);
        // to create new folder with current date  // if folder is not found create new one
        if (!File::exists(storage_path('logs/' . $date . '/' . $actionName))) {
            File::makeDirectory(storage_path('logs/' . $date . '/' . $actionName), 0775, true, true);
        }

        $log->pushHandler(new StreamHandler(storage_path('logs/' . $date . '/' . $actionName . '/logFile.log', Logger::INFO)));
        $log->addInfo($URL, $parameters_arr);
    }

    public function subscribeZain(request $request) {
        session::forget('message');
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }


        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();

        if ($Msisdn_old) {
            /*
              session()->flash('failed', 'انت مشترك بالفعل');
              return back();
             */

            // set session

            session(['MSISDN' => $msisdn, 'Status' => 'active']);
            if (isset($request->prev_url) && $request->prev_url != "") {
                return redirect($request->prev_url);
            } else {
                // redirect to last zain kuwait link
                $Url = Generatedurl::where('operator_id', zain_kuwait_operator_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap/" . $Url->UID);
                else
                    return redirect(url() . "/landing");
            }
        }


        return view('home.subscribeZain', compact('msisdn'));
    }

    public function subscribeZainConfirm(request $request) {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }


        $msisdn = "965" . $msisdn;

        //  Zain Check Status Before Try To Subs
        $URL = "http://62.150.213.170:1001/ivasafasy/status.asp?mob=" . $msisdn;
       // $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;


        // make log
        $company = $this->detectCompnay();
        $actionName = "Zain Check Status Before Try To Subs";
        $parameters_arr = array(
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => (array) $result
        );
        $this->log($actionName, $URL, $parameters_arr);


        if ($result == "<html><body>Deletion" || $result == "<html><body>SubscriberNotFound") {  // initiate susbcription
            $URL = "http://62.150.213.170:1001/ivasafasy/sendmsg.asp?mob=" . $msisdn . "&mesg=A";
            $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain Hit Url";
            $parameters_arr = array(
                'MSISDN' => $msisdn,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => (array) $result
            );
            $this->log($actionName, $URL, $parameters_arr);


            if ($result == "<html><body>Success") {   // response deliver to azeem
                // sleep 20 seconds to can delay request ... THEN check status
                //  sleep(20);

                /*
                  // Zain Check Status After Try To Subs
                  $URL = "http://62.150.213.170:1001/ivasafasy/status.asp?mob=" . $msisdn;
                  $result = preg_replace('/\s+/', '', file_get_contents($URL));

                  // make log
                  $company = $this->detectCompnay();
                  $actionName = "Zain Check Status After Try To Subs";
                  $parameters_arr = array(
                  'MSISDN' => $msisdn,
                  'link' => $URL,
                  'date' => Carbon::now()->format('Y-m-d H:i:s'),
                  'company' => $company,
                  'result' => (array)$result
                  );
                  $this->log($actionName, $URL, $parameters_arr);
                 */


                //  if ($result == "<html><body>Addition") {  // success billing
                session::flash('message', 'تم تسجيلك بنجاح وسوف يذهب جزء من ريع الاشتراك للمساهمه في مساعدة الايتام');


                if ($company == "headway") {  // HEADWAY integration
                    // call Headway api to notify that msisdn is subscribe successfully
                    // https://lead.mobra.in/18020607a4a0700ab706ec07?token=7c97db9
                    $HeadWay_URL = "https://lead.mobra.in/" . session::get('transaction_id') . "?token=7c97db9";
                    $HeadWay_result = $this->GetPageData($HeadWay_URL);

                    if ($HeadWay_result != "Click already converted") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = session::get('adv_params');
                        $AdvertisingUrl->msisdn = $msisdn;
                        $AdvertisingUrl->operatorId = 8;
                        $AdvertisingUrl->operatorName = "zain_kuwait";
                        $AdvertisingUrl->status = 1;  // subscribe success
                        $AdvertisingUrl->ads_compnay_name = $company;
                        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                            $AdvertisingUrl->transaction_id = session::get('transaction_id');
                        }
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "headway Zain Subscribe Success";
                        $URL = $HeadWay_URL;
                        $parameters_arr = array(
                            'MSISDN' => $msisdn,
                            'link' => $HeadWay_URL,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                            'result' => (array) $HeadWay_result
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                } elseif ($company == "intech") {  // intech integration
                    // call intech  api to notify that msisdn is subscribe successfully
                    $ADV_URL = "http://ict.intech-mena.com/Universal/v1.0/UET?msisdn=" . $msisdn . "&operaterName=zain_kuwait&operatorId=8&" . session::get('adv_params');
                    $adv_result = $this->GetPageData($ADV_URL);
                    $adv_result = (array) json_decode($adv_result);


                    if ($adv_result['UET Offer Log'] == "SUCCESS") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = session::get('adv_params');
                        $AdvertisingUrl->msisdn = $msisdn;
                        $AdvertisingUrl->operatorId = 8;
                        $AdvertisingUrl->operatorName = "zain_kuwait";
                        $AdvertisingUrl->status = 1;  // subscribe success
                        $AdvertisingUrl->ads_compnay_name = $company;
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "Intech Zain Subscribe Success";
                        $URL = $ADV_URL;
                        $parameters_arr = array(
                            'MSISDN' => $msisdn,
                            'link' => $ADV_URL,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                            'result' => $adv_result
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                } elseif ($company == "DF") {
                    $AdvertisingUrl = new AdvertisingUrl();
                    $AdvertisingUrl->adv_url = NULL;
                    $AdvertisingUrl->msisdn = $msisdn;
                    $AdvertisingUrl->operatorId = 8;
                    $AdvertisingUrl->operatorName = "zain_kuwait";
                    $AdvertisingUrl->status = 1;  // subscribe success
                    $AdvertisingUrl->ads_compnay_name = $company;
                    $AdvertisingUrl->save();

                    // make log
                    $company = $this->detectCompnay();
                    $actionName = "DF Zain Subscribe Success";
                    $URL = $request->fullUrl();
                    $parameters_arr = array(
                        'MSISDN' => $msisdn,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    );
                    $this->log($actionName, $URL, $parameters_arr);
                } else {
                    session::flash('message', "حدث خطأ");
                }


                // msisdn last update
                $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    $Msisdn->operator_id = 8;  // zain
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->final_status = 1;
                    $Msisdn->save();
                } else {
                    $Msisdn = new Msisdn();
                    $Msisdn->msisdn = $msisdn;
                    $Msisdn->operator_id = 8;  // zain
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->final_status = 1;
                    $Msisdn->save();
                }


                /* } else {
                  session::flash('message', "حدث خطأ");
                  } */
            } else {
                session::flash('message', "حدث خطأ");
            }
        } elseif ($result == "<html><body>Addition") {
            session::flash('message', 'انت مشترك بالفعل');
        } else {
            session::flash('message', 'حدث خطأ');
        }


        return view('home.subscribeZainConfirmation', compact('msisdn'));
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
        return $data;
    }

    public function subscribeZainConfirm_new(request $request) {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }

        $company = $this->detectCompnay();

        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
        if ($Msisdn_old) {
            session()->flash('failed', 'انت مشترك بالفعل');
            return back();
        }

        // continue to subscribe
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();

        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = "965" . $msisdn;
        $AdvertisingUrl->operatorId = 8;
        $AdvertisingUrl->operatorName = "zain_kuwait";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();


        // create unique pincode
        while (true) {
            $bin_code = rand(pow(10, 4), pow(10, 5) - 1);
            if (Msisdn::where('pincode', '=', $bin_code)->get()->isEmpty()) {
                break;
            }
        }

        session::set('pincode', $bin_code);


        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = "965" . $msisdn;
        }

        $Msisdn->ad_company = $company;
        $Msisdn->operator_id = 8; // zain
        $Msisdn->pincode = $bin_code;
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();


        $msisdn_w_cc = "965" . $msisdn;
        $zain_user_name = zain_user_name;
        $zain_password = zain_password;
        $messagedata = "رجاء ادخال رمز التفعيل  ";
        $messagedata .= $bin_code;
        $message = urlencode($messagedata);

        //  Zain send messages
        $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&recipient=$msisdn_w_cc&messagedata=$message";
        $result = simplexml_load_file($URL); // Interprets an XML file into an object
        // make log
        $actionName = "Zain Pincode Send";
        $parameters_arr = array(
            'msisdn' => $msisdn_w_cc,
            'pincode' => $bin_code,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => (array) $result->data->acceptreport,
            'statuscode' => (array) $result->data->acceptreport->statuscode
        );
        $this->log($actionName, $URL, $parameters_arr);

        $status_code = $result->data->acceptreport->statuscode;
        if ($status_code == 0) { // success
            return view('landing.pinCode', compact('msisdn'));
        } else {  // error
            $request->session()->flash('failed', 'statuscode not success');
            return view('landing.pinCode', compact('msisdn'));
        }
    }

    public function subscribeZainPincodeConfirm(request $request) {
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');

        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('msisdn');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('home.pinCode', compact('msisdn'));
        }


        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->where('pincode', '=', $pincode)->orderBy('id', 'DESC')->first();

        if ($Msisdn) {  // pincode confirm is success
            $msisdn_wcc = "965" . $msisdn;

            $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
            if ($Msisdn_old) {
                session()->flash('failed', 'انت مشترك بالفعل');
                return view('home.pinCode', compact('msisdn'));
            }

            // zain subscribe api
            $zain_user_name = zain_user_name_alafay;
            $zain_password = zain_password_alafay;
            //  Zain subscribe api
            $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&originator=$msisdn_wcc&recipient=96946&messagedata=WEBSUBEN";
            $result = simplexml_load_file($URL); // Interprets an XML file into an object
            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain Subscribe Url";
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => (array) $result->data->acceptreport,
                'statuscode' => (array) $result->data->acceptreport->statuscode
            );
            $this->log($actionName, $URL, $parameters_arr);


            $status_code = $result->data->acceptreport->statuscode;
            if ($status_code == 0) { // success
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wcc;
                $AdvertisingUrl->operatorId = 8;
                $AdvertisingUrl->operatorName = "zain_kuwait";
                $AdvertisingUrl->status = 1;   // subscribe success BUT acutal subscribe come after notification
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();


                // update msisdn
                $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->final_status = 1;
                    $Msisdn->save();
                }

                session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
                //    return redirect("/landing");
                return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=1&status=SS");
            } else {
                session()->flash('failed', 'حدث خطأ');
                return view('landing.pinCode', compact('msisdn'));
            }
        } else {
            session()->flash('failed', 'الكود الذي ادخلته غير صحيح.حاول مرة اخري');
            return view('landing.pinCode', compact('msisdn'));
        }
    }

    /*   // used for testing
      public function pinCode(request $request)
      {
      $msisdn = 99104715;
      return view('home.pinCode', compact('msisdn'));
      }
     */

    public function detectCompnay() {
        $company = "";
        if (session::get('adv_params') !== NULL && session::get('adv_params') != "") {
            if (session::get('publisherId_macro') !== NULL && session::get('transaction_id') != "") {
                $company = "headway";
            } else {

                $company = "intech";
            }
        } else {
            $company = "DF";
        }

        return $company;
    }

    public function unsubZain() {
        // header inrichemnt for zain kuwait
        session::forget('message');
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }


        return view('home.unsubZain', compact('MSISDN'));
    }

    public function unsubscribeZain(request $request) {
        date_default_timezone_set("Africa/Cairo");
        if ($request->input('number') !== NULL) {
            $msisdn = "965" . $request->input('number');
        } else {
            $msisdn = "";
        }


        if (!preg_match('/^[0-9]{8}$/', $request->input('number'))) {

            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return redirect('');
        }


        $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {
            // zain subscribe api
            $zain_user_name = zain_user_name;
            $zain_password = zain_password;
            //  Zain subscribe api
            $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&originator=$msisdn&recipient=96946&messagedata=WEBUNSUBEN";
            $result = simplexml_load_file($URL); // Interprets an XML file into an object
            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain UnSubscribe";
            $parameters_arr = array(
                'MSISDN' => $msisdn,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => (array) $result->data->acceptreport,
                'statuscode' => (array) $result->data->acceptreport->statuscode
            );
            $this->log($actionName, $URL, $parameters_arr);


            $status_code = $result->data->acceptreport->statuscode;
            if ($status_code == 0) { // unsub success
                $Msisdn->final_status = 0;
                $Msisdn->save();

                session::flash('message', 'تم الغاء الخدمه');
            } else {
                session::flash('message', "حدث خطأ");
            }
        } else {
            session::flash('message', "حدث خطأ");
        }

        return view('home.unsubZainResult', compact('msisdn'));
    }

	public function subscribeOreedo(request $request) {
        $msisdn = $request['number'];

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
                // session::flash('message', "رقم الجوال غير صحيح");
                session()->flash('error', 'هذا الرقم غير صحيح');
                return redirect(url('ooredoo_login'));
        }

        $msisdn_wsc = "965" . $msisdn;
        $company = $this->detectCompnay();

        // check status for zain
        $Msisdn = Msisdn::where('phone_number', '=', $msisdn_wsc)->where('operator_id', '=', 50)->orderBy('id', 'DESC')->first();
        if ($Msisdn && $Msisdn->final_status == 1) {
                /*
                    session()->flash('failed', 'انت مشترك بالفعل');
                    return back();
                 */
                session(['phone_number' => $msisdn, 'status' => 'active']);
                return redirect(url('/'));
        } else {
                // redirect directly to consent page
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wsc;
                $AdvertisingUrl->status = 1;    // 1 mean this click turn to redirect But not subscribed yet as subscribe show in notification page
                $AdvertisingUrl->operatorId = 50;
                $AdvertisingUrl->operatorName = "ooredoo_kuwait";
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                        $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                        $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();



                $productID = productID;
                $pName = pName;
                $pPrice = "150";  // not clear
                $pVal = "1";  // not clear
                $CpId = CpId;
                $CpPwd = CpPwd;
                $CpName = CpName;
                $sRenewalPrice = "150";  // not clear
                $sRenewalValidity = "1";  // not clear
                $ismID =ismID;
                $image = image;
                //  $transID =  $AdvertisingUrl->id;
                $transID = uniqid();

                /*
                    production url :
                    http://consent.ooredoo.com.kw:8093/API/CCG

                    http://testconsent.ooredoo.com.kw:8280/API/CCG?MSISDN=XXXXXXX&productID=<jhdfjshfhf>&pName=<kljseuhsdfm>&pPrice=<price_in_fils>&pVal=<validity_in_days>&CpId=<jkhdNS>&CpPwd=<jdh35e22>&CpName=<sjsisfj>&sRenewalPrice=<price_in_fils>&sRenewalValidity=<validity_in_days>&reqMode=WAP&reqType=Subscription&ismID=<XXX>&transID=1122232&tncFontFamily=times&cpBgColor=silver&Wap_mdata=http://XXX.XXX.XX.XXX/image.jpg

                 */

                $URL_before_encrpty = "http://consent.ooredoo.com.kw:8093/API/CCG?MSISDN=$msisdn&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";


                //checksum genaration with cpid
$requestParam="MSISDN=$MSISDN&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";
$signkey=CpId;//cpid
$sign=hash_hmac("sha256", utf8_encode($requestParam),utf8_encode($signkey),false);

$sign=$this->hextobin($sign);
$checksum=urlencode(base64_encode($sign));

//encryption with key
$key = base64_encode(pack("H*","37417B093AD16DD4C8F949117E14F0D2DE03A44F2BB9B9754B11EAEADEFE972E"));
$plaintext ="MSISDN=$MSISDN&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";

$result=base64_encode($this->aes256_cbc_encrypt($key, $plaintext, "0000000000000000"));

$URL = "http://consent.ooredoo.com.kw:8093/API/CCG?requestParam=$result&checksum=$checksum&CpId=$CpId";



                // make log

                $actionName = "Oreedoo CG hit";
                $parameters_arr = array(
                        'MSISDN' => $msisdn,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'company' => $company ,
                        'URL_before_encrpty' => $URL_before_encrpty ,
                        'URL_after_encrpty' =>  $URL ,

                );
                $this->log_2($actionName, $URL, $parameters_arr);


                // msisdn last update
                if ($Msisdn) {
                        $Msisdn->operator_id = 50;  // ooredoo
                        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                        $Msisdn->ad_company = $company;
                        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                                $Msisdn->transaction_id = session::get('transaction_id');
                        }
                        $Msisdn->save();
                } else {
                        $Msisdn = new Msisdn();
                        $Msisdn->phone_number = $msisdn;
                        $Msisdn->operator_id = 50; // ooredoo
                        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                        $Msisdn->ad_company = $company;
                        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                                $Msisdn->transaction_id = session::get('transaction_id');
                        }
                        $Msisdn->save();
                }


                return redirect($URL);
        }


        // return view('home.subscribeOreedo', compact('msisdn'));
}

    public function subscribeVivaKuwait(request $request) {
        session::forget('message');
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $msisdn = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $msisdn = $request->input('number');
        }

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }


        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 51)->orderBy('id', 'DESC')->first();
        if ($Msisdn_old) {
            /*
              session()->flash('failed', 'انت مشترك بالفعل');
              return back();
             */

            // redirect to last zain kuwait link

            session(['MSISDN' => $msisdn, 'Status' => 'active']);
            if (isset($request->prev_url) && $request->prev_url != "") {
                return redirect($request->prev_url);
            } else {
                $Url = Generatedurl::where('operator_id', viva_kuwait_operator_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap/" . $Url->UID);
                else
                    return redirect(url() . "/landing");
            }
        }else {
            // insert log in our database for viva kuwait
            $company = $this->detectCompnay();
            $AdvertisingUrl = new AdvertisingUrl();
            $AdvertisingUrl->adv_url = session::get('adv_params');
            $AdvertisingUrl->msisdn = "965" . $msisdn;
            $AdvertisingUrl->operatorId = 51;
            $AdvertisingUrl->operatorName = "viva_kuwait";
            $AdvertisingUrl->ads_compnay_name = $company;
            if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                $AdvertisingUrl->transaction_id = session::get('transaction_id');
            }
            $AdvertisingUrl->save();

            return redirect("http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=4493&ServiceID=221&ImageURL=&CPWEBChannelID=4&INITAction=True");
        }
    }

    public function subscribeOreedoConfirm(request $request) {
        date_default_timezone_set("Africa/Cairo");
        session::forget('message');
        $msisdn = $request->input('number');
        $msisdn = "965" . $msisdn;


        $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 50)->orderBy('id', 'DESC')->first();
        $company = $this->detectCompnay();
        $URL = "http://ikwm-appvas.isys.mobi:2009/OoredooConsentInit/Consent.aspx?MSISDN=" . $msisdn . "&Scode=1368&ServiceID=S-SnaFiEwMY2&ServiceType=P-tQX2zvEwMY2&AdsCompany=" . $company;
        // make log
        $actionName = "Oreedo Subscribe Track";
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company
        );
        $this->log($actionName, $URL, $parameters_arr);


        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn;
        $AdvertisingUrl->operatorId = 50;
        $AdvertisingUrl->operatorName = "ooredoo_kuwait";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();


        // msisdn last update
        $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {
            $Msisdn->operator_id = 50;  // ooredoo
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->save();
        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = $msisdn;
            $Msisdn->operator_id = 50; // ooredoo
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->save();
        }


        return redirect($URL);
    }

    public function unsubOroodo() {
        session::forget('message');
        return view('home.unsubOroodo');
    }

    public function unsubscribeOoredoo(request $request) {
        date_default_timezone_set("Africa/Cairo");
        session::forget('message');
        $msisdn = $request->input('number');
        $msisdn = "965" . $msisdn;

        if (!preg_match('/^[0-9]{8}$/', $request->input('number'))) {
            //   session::flash('message', 'هذا الرقم غير صحيح');
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return redirect('');
        }

        $URL = "http://dev.ivashosting.com/landing/soup_api/ooreoo_kuwait_unsub.php?MSISDN=" . $msisdn;

        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        if ($result == "S0") {
            $status = "Success";
            session::flash('message', 'تم الغاء الخدمه');

            // update msisdn
            $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
            $Msisdn->final_status = 0;
            $Msisdn->save();
        } elseif ($result == "NotEligible") {
            $status = "Error";
            session::flash('message', 'يجب ادخال رقم اودريو صحيح');
        } else {
            $status = "Error";
            session::flash('message', "حدث خطأ");
        }


        // make log
        $actionName = "Oreedo UnSubscribe";
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'Status' => $status,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'result' => (array) $result
        );
        $this->log($actionName, $URL, $parameters_arr);

        return view('home.unsubOroodoResult', compact('msisdn'));
    }

    // http://localhost/landing_laravel/redirect?msisdn=96565867860&mnc=102&opsid=2&mnc=102&action=1&status=S21
    public function redirect(request $request) {

        date_default_timezone_set("Africa/Cairo");
        session::forget('message');
        // fixed paramters
        if ($request->input('msisdn') != NULL) {
            $msisdn = $request->input('msisdn');
        } else {
            $msisdn = $request->input('MSISDN');
        }


        if ($request->input('status') != NULL) {
            $status = $request->input('status');
        } else {
            $status = $request->input('Status');
        }

        $mnc = $request->input('mnc');
        $opsid = $request->input('opsid');
        // changable parameters
        $action = $request->input('action');
        $company = $request->input('AdsCompany');


        // make log for every hit
        $actionName = "Notification Hits";
        $not_URL = $request->fullUrl();
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
        );
        $this->log($actionName, $not_URL, $parameters_arr);


        if (isset($opsid) && ($opsid == 1 || $opsid == 2 || $opsid == 3)) {

            if ($msisdn == NULL && $status == NULL) {  // already subscribe for viva
                $message = "انت مشترك بالفعل";
                \Session::flash('message', $message);
                return view('home.subscribeOreedoConfirmation');
            }



            // add notify
            $notify = new Notify();
            $notify->complete_url = \Request::fullUrl();
            $notify->msisdn = $msisdn;
            $notify->action = $action;
            $notify->status = $status;
            $notify->save();


            if ($opsid == 1) {   // zain
                $operator_id = 8;
                $operator_name = "zain_kuwait";
            } elseif ($opsid == 2) { // ooredoo
                $operator_id = 50;
                $operator_name = "ooredoo_kuwait";
            } elseif ($opsid == 3) { // viva
                $operator_id = 51;
                $operator_name = "viva_kuwait";
            }


            // msisdn last update
            $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
            if ($Msisdn) {
                $Msisdn->ooredoo_notify_id = $notify->id;
                $Msisdn->operator_id = $operator_id;


                if ($status == "US") {  // all cases are except US is suc
                    $Msisdn->final_status = 0;
                } else {
                    $Msisdn->final_status = 1;
                }
                $Msisdn->save();
            } else {  // notify me if user subscriber by short code not by landing
                $Msisdn = new Msisdn();
                $Msisdn->msisdn = $msisdn;
                $Msisdn->operator_id = $operator_id;
                $Msisdn->ooredoo_notify_id = $notify->id;
                if ($status == "SS" || $status == "S21" || $status == "RS") {  // subscribe success or  renew success
                    $Msisdn->final_status = 1;
                } else {
                    $Msisdn->final_status = 0;
                }
                $Msisdn->ad_company = "DF";
                $Msisdn->save();
            }


            if ($status == "SS") { // subscribe for the first time  SO notify ads comapny
                // notify ads company
                $ad_company = $Msisdn->ad_company;
                $transaction_id = $Msisdn->transaction_id;
                $ads_ur_id = $Msisdn->ads_ur_id;

                $AdvertisingUrlOld = AdvertisingUrl::where('id', $ads_ur_id)->first();

                if ($AdvertisingUrlOld) {
                    if ($ad_company == "headway") {  // HEADWAY integration
                        // call Headway api to notify that msisdn is subscribe successfully
                        // https://lead.mobra.in/18020607a4a0700ab706ec07?token=7c97db9
                        $HeadWay_URL = "https://lead.mobra.in/" . $transaction_id . "?token=7c97db9";
                        $HeadWay_result = $this->GetPageData($HeadWay_URL);

                        if ($HeadWay_result != "Click already converted") {
                            $AdvertisingUrl = new AdvertisingUrl();
                            $AdvertisingUrl->adv_url = $AdvertisingUrlOld->adv_url;
                            $AdvertisingUrl->msisdn = $msisdn;
                            $AdvertisingUrl->operatorId = $operator_id;
                            $AdvertisingUrl->operatorName = $operator_name;
                            $AdvertisingUrl->status = 1;  // subscribe success
                            $AdvertisingUrl->ads_compnay_name = $ad_company;
                            $AdvertisingUrl->publisherId_macro = $AdvertisingUrlOld->publisherId_macro;
                            $AdvertisingUrl->transaction_id = $transaction_id;
                            $AdvertisingUrl->save();

                            // make log
                            $company = $this->detectCompnay();
                            $URL = $HeadWay_URL;
                            $actionName = "Headway Subscribe Success " . $operator_name;
                            $parameters_arr = array(
                                'MSISDN' => $msisdn,
                                'link' => $HeadWay_URL,
                                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                                'result' => (array) $HeadWay_result
                            );
                            $this->log($actionName, $URL, $parameters_arr);
                        }
                    } elseif ($ad_company == "intech") {  // intech integration
                        // call intech  api to notify that msisdn is subscribe successfully
                        $ADV_URL = "http://ict.intech-mena.com/Universal/v1.0/UET?msisdn=" . $msisdn . "&operaterName=$operator_name&operatorId=8&" . $AdvertisingUrlOld->adv_url;
                        $adv_result = $this->GetPageData($ADV_URL);
                        $adv_result = (array) json_decode($adv_result);


                        if ($adv_result['UET Offer Log'] == "SUCCESS") {
                            $AdvertisingUrl = new AdvertisingUrl();
                            $AdvertisingUrl->adv_url = $AdvertisingUrlOld->adv_url;
                            $AdvertisingUrl->msisdn = $msisdn;
                            $AdvertisingUrl->operatorId = $operator_id;
                            $AdvertisingUrl->operatorName = $operator_name;
                            $AdvertisingUrl->status = 1;  // subscribe success
                            $AdvertisingUrl->ads_compnay_name = $ad_company;
                            $AdvertisingUrl->save();

                            // make log
                            $company = $this->detectCompnay();
                            $actionName = "Intech Subscribe Success " . $operator_name;
                            $URL = $ADV_URL;
                            $parameters_arr = array(
                                'MSISDN' => $msisdn,
                                'link' => $ADV_URL,
                                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                                'result' => $adv_result
                            );
                            $this->log($actionName, $URL, $parameters_arr);
                        }
                    } elseif ($ad_company == "DF") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = "";
                        $AdvertisingUrl->msisdn = $msisdn;
                        $AdvertisingUrl->operatorId = $operator_id;
                        $AdvertisingUrl->operatorName = $operator_name;
                        $AdvertisingUrl->status = 1;  // subscribe success
                        $AdvertisingUrl->ads_compnay_name = $ad_company;
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "DF Subscribe Success " . $operator_name;
                        $URL = $request->fullUrl();
                        $parameters_arr = array(
                            'MSISDN' => $msisdn,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                }
            }


            // make log for all Notification api
            $ad_company = $Msisdn->ad_company;
            $URL = \Request::fullUrl();
            $actionName = $operator_name . " Notification Api ";
            $parameters_arr = array(
                'action' => $action,
                'status' => $status,
                'msisdn' => $msisdn,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'notify_id' => $notify->id,
                'company' => $ad_company
            );
            $this->log($actionName, $URL, $parameters_arr);


            if ($opsid == 1) { // zain
                $result = array();
                $result['notify_id'] = $notify->id;
                return json_encode($result);
            } else {
                // Ooredoo cases or viva
                switch ($status) {
                    case "SS":
                        $message = "تم تسجيلك بنجاح وسوف يذهب جزء من ريع الاشتراك للمساهمه في مساعدة الايتام";
                        break;
                    case "U":
                        $message = "تم الغاء الاشتراك بنجاح";
                        break;
                    case "S21":
                        $message = "تم تسجيلك بنجاح وسوف يذهب جزء من ريع الاشتراك للمساهمه في مساعدة الايتام";
                        break;
                    case "BF":
                        $message = "حدث خطأ";
                        break;
                    case "RS":
                        $message = "تم التجديد بنجاح";
                        break;
                    case "RF":
                        $message = "حدث خطأ";
                        break;

                    default:
                        $message = "حدث خطأ";
                }

                \Session::flash('message', $message);
                return view('home.subscribeOreedoConfirmation');
            }
        }
    }

    public function subscribeViva(request $request) {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }

        $msisdn = "964" . $msisdn;
        $URL = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=" . $msisdn . "&ChannelID=1211&ServiceID=221&ImageURL=&CPWEBChannelID=1&INITAction=True";

        // make log
        $company = $this->detectCompnay();
        $actionName = "Viva Subscribe Track";
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company
        );
        $this->log($actionName, $URL, $parameters_arr);

        return redirect($URL);
    }

    // vival integration functions
    public function subscribeViva_1(request $request) {
        date_default_timezone_set("Africa/Cairo");
        $ivas_portal_link = urlencode(SNAP_VIVA_URL);


        if (isset($_REQUEST['msisdn']) && $_REQUEST['msisdn'] != "") {
            $msisdn = $_REQUEST['msisdn'];
            $pended_url = "&msisdn=" . $msisdn;
        } else {
            $msisdn = "";
            $pended_url = "";
        }


        $URL = "http://cg.mobi-mind.net/?ID=370,458bc531,661,8061,3,IVAS,$ivas_portal_link$pended_url";

        // make log
        $actionName = "Viva Subscribe Track";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL
        );
        $this->log($actionName, $URL, $parameters_arr);

        return redirect($URL);
    }

    public function du_landing(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landing_v2.du_landing',compact("peroid","lang"));
    }

    public function DuSecureRedirect(request $request) {
        date_default_timezone_set("Africa/Cairo");

        if (isset($_REQUEST['number']) && $_REQUEST['number'] != "") {
            $msisdn = $_REQUEST['number'];
            $msisdn="971".$msisdn ;
        } else {
            $msisdn = "";
        }


        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        if (isset($_REQUEST['peroid']) && $_REQUEST['peroid'] != "") {
            $plan = $_REQUEST['peroid'];

            if($plan  == "daily"){
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1 ;
            }elseif ($plan  == "weekly") {
                $serviceid = "flaterweekly";
                $price = 14 ;
                $num= 7;

            }else{
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1;
            }
        }else{ // default is daily
            $serviceid = "flaterdaily";
            $plan = "daily";
            $price = 2 ;
            $num= 1;
        }


        if (isset($_REQUEST['lang']) && $_REQUEST['lang'] != "") {
            $local = $_REQUEST['lang'];
        }else{ // default is arabic
            $local= "ar" ;
        }

        $redirectUrl=  url('/newdesignv4/9130281/');



        // activation api :   http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=56833e8d-c21b-453b-9e2a-f33f20415ae2&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar
        //  f5d1048a-995e-11e7-abc4-cec278b6b50a

        $URL = "http://pay-with-du.ae/20/digizone/digizone-{$serviceid}-{$num}-{$local}-doi-web?origin=digizone&uid=$msisdn&trxid=$trxid&serviceProvider=secured&serviceid=$serviceid&plan=$plan&price=$price&locale=$local&redirectUrl=";

        // make log
        $actionName = "DU SecureD Pincode Send";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL
        );
        $this->log($actionName, $URL, $parameters_arr);

     $DuIntgration =    new DuIntgration();
     $DuIntgration->url = $URL ;
     $DuIntgration->trxid = $trxid ;
     $DuIntgration->uid = $msisdn ;
     $DuIntgration->serviceid = $serviceid ;
     $DuIntgration->plan = $plan ;
     $DuIntgration->price = $price ;
     $DuIntgration->local = $local ;
     $DuIntgration->save();

        return redirect($URL);
    }



    public function du_landing_success()
    {
        date_default_timezone_set("Africa/Cairo");
        $URL = \Request::fullUrl();
          // make log
          $actionName = "DU SecureD Pincode Success";
          $parameters_arr = array(
              'date' => Carbon::now()->format('Y-m-d H:i:s'),
              'URL' => $URL
          );
          $this->log($actionName, $URL, $parameters_arr);


        return view('landing_v2.du_landing_success');
    }

    public function du_unsubc(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landing_v2.du_unsub',compact("peroid","lang"));
    }

    public function du_unsubcr(request $request)
    {
        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        $number ="971".$request->number;
        $pero =$request->peroid;
        //dd($number);
        $URL = "https://dev.digizone.com.kw/du_system/api/test";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "msisdn=".$number."&serviceid=flater".$pero);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        if ($server_output == false) {
            return redirect('du_landing')->with('success', 'تم الغاء الاشتراك بنجاح');
        } else {
            return redirect('du_unsubc')->with('failed', 'الرقم غير صحيح');
        }

    }
    public function du_unsubc_v4(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landing_v2lan.du_unsub',compact("peroid","lang"));
    }
    public function du_unsubcr_v4(request $request)
    {
        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        $number ="971".$request->number;
        $pero =$request->peroid;
        //dd($number);
        $URL = "https://dev.digizone.com.kw/du_system/api/test";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "msisdn=".$number."&serviceid=flater".$pero);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        if ($server_output == false) {
            return redirect('du_landing_v4')->with('success', 'تم الغاء الاشتراك بنجاح');
        } else {
            return redirect('du_unsubc_v4')->with('failed', 'الرقم غير صحيح');
        }

    }
    public function du_landingrotana(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landingrotana.du_landing',compact("peroid","lang"));
    }

    public function du_landing_successrotana(request $request) {
        date_default_timezone_set("Africa/Cairo");

        if (isset($_REQUEST['number']) && $_REQUEST['number'] != "") {
            $msisdn = $_REQUEST['number'];
            $msisdn="971".$msisdn ;
        } else {
            $msisdn = "";
        }


        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        if (isset($_REQUEST['peroid']) && $_REQUEST['peroid'] != "") {
            $plan = $_REQUEST['peroid'];

            if($plan  == "daily"){
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1 ;
            }elseif ($plan  == "weekly") {
                $serviceid = "flaterweekly";
                $price = 14 ;
                $num= 7;

            }else{
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1;
            }
        }else{ // default is daily
            $serviceid = "flaterdaily";
            $plan = "daily";
            $price = 2 ;
            $num= 1;
        }


        if (isset($_REQUEST['lang']) && $_REQUEST['lang'] != "") {
            $local = $_REQUEST['lang'];
        }else{ // default is arabic
            $local= "ar" ;
        }

        $redirectUrl=  url('/newdesignv4/9130281/');



        // activation api :   http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=56833e8d-c21b-453b-9e2a-f33f20415ae2&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar
        //  f5d1048a-995e-11e7-abc4-cec278b6b50a

        $URL = "http://pay-with-du.ae/20/digizone/digizone-{$serviceid}-{$num}-{$local}-doi-web?origin=digizone&uid=$msisdn&trxid=$trxid&serviceProvider=secured&serviceid=$serviceid&plan=$plan&price=$price&locale=$local&redirectUrl=";

        // make log
        $actionName = "DU SecureD Pincode Send";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL
        );
        $this->log($actionName, $URL, $parameters_arr);

     $DuIntgration =    new DuIntgration();
     $DuIntgration->url = $URL ;
     $DuIntgration->trxid = $trxid ;
     $DuIntgration->uid = $msisdn ;
     $DuIntgration->serviceid = $serviceid ;
     $DuIntgration->plan = $plan ;
     $DuIntgration->price = $price ;
     $DuIntgration->local = $local ;
     $DuIntgration->save();

        return redirect($URL);
    }



    public function DuSecureRedirectrotana()
    {
        date_default_timezone_set("Africa/Cairo");
        $URL = \Request::fullUrl();
          // make log
          $actionName = "DU SecureD Pincode Success";
          $parameters_arr = array(
              'date' => Carbon::now()->format('Y-m-d H:i:s'),
              'URL' => $URL
          );
          $this->log($actionName, $URL, $parameters_arr);


        return view('landingrotana.du_landing_success');
    }
    public function du_unsubcrotana(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landingrotana.du_unsub',compact("peroid","lang"));
    }

    public function du_unsubcrrotana(request $request)
    {
        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        $number ="971".$request->number;
        $pero =$request->peroid;
        //dd($number);
        $URL = "https://dev.digizone.com.kw/du_system/api/test";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "msisdn=".$number."&serviceid=flater".$pero);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        if ($server_output == false) {
            return redirect('du_landingrotana')->with('success', 'تم الغاء الاشتراك بنجاح');
        } else {
            return redirect('du_unsubcrotana')->with('failed', 'الرقم غير صحيح');
        }

    }

    public function du_landing_v2(request $request)
    {

        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landing_v2lan.du_landing',compact("peroid","lang"));
    }

    public function du_landing_success_v2(request $request) {
        date_default_timezone_set("Africa/Cairo");

        if (isset($_REQUEST['number']) && $_REQUEST['number'] != "") {
            $msisdn = $_REQUEST['number'];
            $msisdn="971".$msisdn ;
        } else {
            $msisdn = "";
        }


        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        if (isset($_REQUEST['peroid']) && $_REQUEST['peroid'] != "") {
            $plan = $_REQUEST['peroid'];

            if($plan  == "daily"){
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1 ;
            }elseif ($plan  == "weekly") {
                $serviceid = "flaterweekly";
                $price = 14 ;
                $num= 7;

            }else{
                $serviceid = "flaterdaily";
                $price = 2 ;
                $num= 1;
            }
        }else{ // default is daily
            $serviceid = "flaterdaily";
            $plan = "daily";
            $price = 2 ;
            $num= 1;
        }


        if (isset($_REQUEST['lang']) && $_REQUEST['lang'] != "") {
            $local = $_REQUEST['lang'];
        }else{ // default is arabic
            $local= "ar" ;
        }

        $redirectUrl=  url('/newdesignv4/9130281/');



        // activation api :   http://pay-with-du.ae/20/digizone/digizone-flaterdaily-1-ar-doi-web?origin=digizone&uid=971555802322&trxid=56833e8d-c21b-453b-9e2a-f33f20415ae2&serviceProvider=secured&serviceid=flaterdaily&plan=daily&price=2&locale=ar
        //  f5d1048a-995e-11e7-abc4-cec278b6b50a

        $URL = "http://pay-with-du.ae/20/digizone/digizone-{$serviceid}-{$num}-{$local}-doi-web?origin=digizone&uid=$msisdn&trxid=$trxid&serviceProvider=secured&serviceid=$serviceid&plan=$plan&price=$price&locale=$local&redirectUrl=";

        // make log
        $actionName = "DU SecureD Pincode Send";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL
        );
        $this->log($actionName, $URL, $parameters_arr);

     $DuIntgration =    new DuIntgration();
     $DuIntgration->url = $URL ;
     $DuIntgration->trxid = $trxid ;
     $DuIntgration->uid = $msisdn ;
     $DuIntgration->serviceid = $serviceid ;
     $DuIntgration->plan = $plan ;
     $DuIntgration->price = $price ;
     $DuIntgration->local = $local ;
     $DuIntgration->save();

        return redirect($URL);
    }



    public function DuSecureRedirect_v2()
    {
        date_default_timezone_set("Africa/Cairo");
        $URL = \Request::fullUrl();
          // make log
          $actionName = "DU SecureD Pincode Success";
          $parameters_arr = array(
              'date' => Carbon::now()->format('Y-m-d H:i:s'),
              'URL' => $URL
          );
          $this->log($actionName, $URL, $parameters_arr);


        return view('landing_v2lan.du_landing_success');
    }

    //===============================Viva Integration "David" ==========================================//

    public function viva_login(request $request)
    {
        if (isset($_REQUEST['msisdn']) && $_REQUEST['msisdn'] != "") {
            $msisdn = preg_replace('/^965/', '', $_REQUEST['msisdn']);
        } else {
            $msisdn = "";
        }
        return view('landing_v2.viva_landing', compact('msisdn'));
    }
    public function viva_login_action(request $request)
    {
        $msisdn = $request->input('number');
        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            $request->session()->flash('failed', 'هذا الرقم غير صحيح');
            return back();
        }

        // check subscribe
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 51)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {
            session(['MSISDN' => $msisdn, 'status' => 'active']);
            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator','greetingimg_operator.greetingimg_id','=','greetingimgs.id')
                    ->where('greetingimg_operator.operator_id','=',13)->where('greetingimgs.snap',1)->where('greetingimgs.Rdate','<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate','desc')->first();

            if($snap){
                $url = Generatedurl::where('operator_id',13)->where('occasion_id',$snap->occasion_id)->orderBy('created_at','desc')->first();
                return redirect(url('viewSnap2/'.$snap->id.'/'.$url->UID));
            }
        } else {
            return redirect(url('/landing_stc_1?msisdn=965' . $msisdn));
        }
    }
    public function viva_notification(request $request)
    {


        /*
          Activation: https://filters.digizone.com.kw/viva_notification?ChannelID=4493&ServiceID=808&User=kuwait@idex&Password=kuwait@!dex&STATUS=ACT-SB&OperatorID=41904&MSISDN=96555410856&RequestID=303263614

          First Failed billing: https://filters.digizone.com.kw/viva_notification?Password=kuwait@!dex&ServiceID=808&OperatorID=41904&ChannelID=4493&STATUS=FFL-BL&User=kuwait@idex&MSISDN=96555410856&RequestID=303270353

          renewal success: https://filters.digizone.com.kw/viva_notification?Password=kuwait@!dex&ServiceID=808&OperatorID=41904&ChannelID=4493&STATUS=RSC-BL&User=kuwait@idex&MSISDN=96555410856&RequestID=303270353


          Viva Service link :   https://filters.digizone.com.kw/landing_viva_new?msisdn=96555410856


          Other possible status:

          RSC-BL: renewal success
          FSC-BL: fist success billing
          BLD-SB: unsubscription


         */


        date_default_timezone_set("Africa/Cairo");
        $URL = \Request::fullUrl();
        $today = date("Y-m-d");
        $time = strtotime($today);




        $msisdn = $request->input('MSISDN');
        $STATUS = $request->input('STATUS');  // // "success" if successfully billed or "Fail"
        $message = "";

        // make check
        $ChannelID = $request->input('ChannelID');
        $ServiceID = $request->input('ServiceID');
        $User = $request->input('User');
        $Password = $request->input('Password');
        $OperatorID = $request->input('OperatorID');

        if ($ChannelID == SNAP_VIVA_CHANNEL_ID  && $ServiceID == 808 && $User == "kuwait@idex" && $Password == "kuwait@!dex" && $OperatorID == 41904) {


            /*
              - summary :
              1- user subscribed but not billed yet   =   ACT-SB
              2-fist success billing  = FSC-BL      /   First Failed billing  =  FFL-BL
              3- renewal success   = RSC-BL
              4- BLD-SB: unsubscription


             */
            if ($STATUS == "ACT-SB" || $STATUS == "FSC-BL" || $STATUS == "RSC-BL" || $STATUS == "FFL-BL") {//  USER want to subscribe or renew
                $action = "sub";
            } else {
                $action = "usub";
            }

            $parameters_arr = array(
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'action' => $action
            );


            // log for all history
            $actionName = "Viva Notification Url";
            $this->log($actionName, $URL, $parameters_arr);



            if (isset($msisdn) && !is_null($msisdn) && isset($STATUS) && !is_null($STATUS)) {

                //  zain jordon notify = all notification history
                $notify = new Notify();
                $notify->complete_url = \Request::fullUrl();
                $notify->msisdn = $msisdn;
                $notify->action = $action;
                $notify->status = $STATUS;
                $notify->save();


                // update msisdn status
                $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    if ($STATUS == "ACT-SB") {
                        $Msisdn->final_status = 0;
                        $message = "user subscribed but not billed yet";
                    } elseif ($STATUS == "FFL-BL") { // First Failed billing
                        $Msisdn->final_status = 0;
                        $message = "First Failed billing";
                    } elseif ($STATUS == "BLD-SB") {
                        $Msisdn->final_status = 0;
                        $message = "unsubscription";
                    } elseif ($STATUS == "FSC-BL") {
                        $Msisdn->final_status = 1;
                        $message = "fist success billing";
                    } elseif ($STATUS == "RSC-BL") { // First Failed billing   OR   unsubscription
                        $Msisdn->final_status = 1;
                        $message = "renewal success ";
                    }

                    $Msisdn->ooredoo_notify_id = $notify->id;
                    $Msisdn->subscribe_date = $today;
                    $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    $Msisdn->plan = "d";  // weekly
                    $Msisdn->save();
                } else {

                    $Msisdn = new Msisdn();
                    $Msisdn->msisdn = $msisdn;
                    $Msisdn->operator_id = 51; // viva
                    $Msisdn->ad_company = "";
                    if ($STATUS == "ACT-SB") {
                        $Msisdn->final_status = 0;
                        $message = "user subscribed but not billed yet";
                    } elseif ($STATUS == "FFL-BL") { // First Failed billing
                        $Msisdn->final_status = 0;
                        $message = "First Failed billing";
                    } elseif ($STATUS == "BLD-SB") {
                        $Msisdn->final_status = 0;
                        $message = "unsubscription";
                    } elseif ($STATUS == "FSC-BL") {
                        $Msisdn->final_status = 1;
                        $message = "fist success billing";
                    } elseif ($STATUS == "RSC-BL") { // First Failed billing   OR   unsubscription
                        $Msisdn->final_status = 1;
                        $message = "renewal success ";
                    }
                    $Msisdn->ooredoo_notify_id = $notify->id;
                    $Msisdn->subscribe_date = $today;
                    $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    $Msisdn->plan = "d";  // weekly
                    $Msisdn->save();
                }
            }

            $result = array();
            $result['status'] = "Success";
            $result['type'] = "viva_notification_url";
            $result['url'] = $URL;
            $result['status'] = $STATUS;
            $result['message'] = $message;
        } else {
            $result = array();
            $result['status'] = "Fail";
            $result['type'] = "viva_notification_url";
            $result['url'] = $URL;
            $result['message'] = "wrong parameters";
        }

        return Response(array('result' => $result));
    }


    public function mobily_notification(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $URL = \Request::fullUrl();
        $today = date("Y-m-d");
        $time = strtotime($today);


            $parameters_arr = array(
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
            );


            // log for all history
            $actionName = "Mobily Notification Url";
            $this->log($actionName, $URL, $parameters_arr);




            $result = array();
            $result['status'] = "success";
            $result['type'] = "mobily_notification_url";
            $result['url'] = $URL;

        return Response(array('result' => $result));
    }

    public function viva_profile($uid){
        $phone=  \Session::get('MSISDN') ;
         if(isset($phone)){
             $msisden = Msisdn::where('msisdn', '=', "965" . \Session::get('MSISDN'))->where('final_status', '=', 1)->first();
             if($msisden){
                 return view('front.newdesign.viva_profile',compact('msisden'));
             }else{
                 return redirect(url('/landing_viva_1?msisdn=965' . \Session::get('MSISDN')));
             }
         }else{
             return redirect(url('/landing_viva_new'));
         }


     }
    public function logout($uid){
        Session::flush();
        return redirect('landing_viva_new');
    }


    //===============================Viva Integration "David" ==========================================//






    //======================================Ooredoo direct integration =============================================//

        // ========= ooredoo sequemce =============== //
        public function he_redirect(Request $request) {   // this must be login page
            // 	HE Detect   //
            $productID = productID;
            $pName = pName;
            // plan will be calculate from above
            $CpId = CpId;
            $CpPwd = CpPwd;
            $CpName = CpName;
            $transID = uniqid();

            $pName = pName ;

            $url = "http://singlehe.ooredoo.com.kw:9989/SingleSiteHE/getHE?productID=$productID&pName=$pName&CpId=IVAS&CpPwd=iva@123&CpName=IVAS&transID=$transID";

            // make log
            $actionName = "Ooredoo He Forward";
            $parameters_arr = array(
                'link' => $url,
                'date' => Carbon::now()->format('Y-m-d H:i:s')
            );
            $this->log($actionName, $url, $parameters_arr);

            return redirect($url);
        }


          //   http://localhost/waffarly_kuwait/ooredoo_he?MSISDN=96550167685
    public function ooredoo_he(Request $request) {


        if ($request->input('MSISDN') != NULL) {  // HE detect
            $MSISDN = $request->input('MSISDN');  // will be in format 965 XXX XXXX
            $MSISDN = str_replace("965", "", $MSISDN);  // remove 965
            // make log for HE foward
            $actionName = "Ooredoo He Detect";
            $not_URL = $request->fullUrl();
            $parameters_arr = array(
                'link' => $not_URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s')
            );
            $this->log($actionName, $not_URL, $parameters_arr);


            $msisdn = "965" . $MSISDN;
            $Msisdn = Msisdn::where('phone_number', '=', $msisdn)->where('operator_id', '=', 50)->orderBy('id', 'DESC')->first();

            // check if alreday subscribe
            if ($Msisdn && $Msisdn->final_status == 1) {
                session(['phone_number' => $MSISDN, 'status' => 'active']);
                return redirect('/');
            }

            $subsType = $this->ooredoo_dbill_profile_check($MSISDN);  // profile check

            if ($subsType == "3") {    // non ooredoo users
                session()->flash('failed', 'Non ooredoo users');
                return redirect("ooredoo_login");
            } elseif ($subsType == "1") {  // postpaid  // monthly
                // Monthly plane
                $pPrice = "3000";
                $sRenewalPrice = "3000";
                $pVal = "30";
                $sRenewalValidity = "30";
            } elseif ($subsType == "2") {  // prepaid   //weekly or daily
                // Daily plane
                $pPrice = "150";
                $sRenewalPrice = "150";
                $pVal = "1";
                $sRenewalValidity = "1";
            }

            // Make new record for New Msisdn
            $Msisdn = new Msisdn();
            $Msisdn->phone_number = "965" . $MSISDN;
            $Msisdn->type = "HE";
            $Msisdn->operator_id = 50;
            $Msisdn->plan_id = $subsType;
            $Msisdn->subscribe_date = date("Y-m-d");
            $Msisdn->save();
        } else {  // Wifi users
            $MSISDN = "";
            $msisdn = "wifi";
            // Daily plane
            $pPrice = "150";
            $sRenewalPrice = "150";
            $pVal = "1";
            $sRenewalValidity = "1";
            $Msisdn = "";
        }



        $company = $this->detectCompnay();
        // redirect directly to consent page
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn;
        $AdvertisingUrl->status = 1;    // 1 mean go to CG page
        $AdvertisingUrl->operatorId = 50;
        $AdvertisingUrl->operatorName = "ooredoo_kuwait";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();


        $productID = productID;
        $pName = pName;
        // plan will be calculate from above
        $CpId = CpId;
        $CpPwd = CpPwd;
        $CpName = CpName;


        $ismID = "483";
        $image = image;
        //  $transID =  $AdvertisingUrl->id;
        $transID = uniqid();

        /*
          production url :
          http://consent.ooredoo.com.kw:8093/API/CCG

          // test url
          http://testconsent.ooredoo.com.kw:8280/API/CCG?MSISDN=XXXXXXX&productID=<jhdfjshfhf>&pName=<kljseuhsdfm>&pPrice=<price_in_fils>&pVal=<validity_in_days>&CpId=<jkhdNS>&CpPwd=<jdh35e22>&CpName=<sjsisfj>&sRenewalPrice=<price_in_fils>&sRenewalValidity=<validity_in_days>&reqMode=WAP&reqType=Subscription&ismID=<XXX>&transID=1122232&tncFontFamily=times&cpBgColor=silver&Wap_mdata=http://XXX.XXX.XX.XXX/image.jpg

         */

        $URL_before_encrpty = "http://consent.ooredoo.com.kw:8093/API/CCG?MSISDN=$MSISDN&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";



//checksum genaration with cpid
  $requestParam="MSISDN=$MSISDN&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";
  $signkey=CpId;//cpid
  $sign=hash_hmac("sha256", utf8_encode($requestParam),utf8_encode($signkey),false);

  $sign=$this->hextobin($sign);
  $checksum=urlencode(base64_encode($sign));

  //encryption with key
  $key = base64_encode(pack("H*","37417B093AD16DD4C8F949117E14F0D2DE03A44F2BB9B9754B11EAEADEFE972E"));
  $plaintext ="MSISDN=$MSISDN&productID=$productID&pName=$pName&pPrice=$pPrice&pVal=$pVal&CpId=$CpId&CpPwd=$CpPwd&CpName=$CpName&sRenewalPrice=$sRenewalPrice&sRenewalValidity=$sRenewalValidity&reqMode=WAP&reqType=Subscription&ismID=$ismID&transID=$transID&tncFontFamily=times&cpBgColor=silver&Wap_mdata=$image";

  $result=base64_encode($this->aes256_cbc_encrypt($key, $plaintext, "0000000000000000"));

  $URL = "http://consent.ooredoo.com.kw:8093/API/CCG?requestParam=$result&checksum=$checksum&CpId=$CpId";



        // make log
        $actionName = "Oreedoo CG hit HE";
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company ,
            'URL_before_encrpty' => $URL_before_encrpty ,
            'URL_after_encrpty' =>  $URL ,
        );
        $this->log($actionName, $URL, $parameters_arr);


        // msisdn last update
        if ($Msisdn && $Msisdn != "") {
            $Msisdn->operator_id = 50;  // ooredoo
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->save();
        } else {
            $Msisdn = new Msisdn();
            $Msisdn->phone_number = $msisdn;
            $Msisdn->operator_id = 50; // ooredoo
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->save();
        }


        return redirect($URL);
    }



      // sample for data flow :  http://ivascloud.com/waffarly_kuwait/notification?FLOW=DATAFLOW&MSISDN=60791570&Reason=Success_and_accepted_by_user&Result=SUCCESS&Songname=null&TPCGID=190502114641022391&productId=S-WafflyEwMY2&transID=5ccaae6952528
    public function notification(request $request) {
        $message = "";
        $subscribe_for_first_time = 0;
        date_default_timezone_set("Africa/Cairo");

        $prefix = "965";


        if ($request->input('MSISDN') != NULL) {
            $msisdn = $prefix . $request->input('MSISDN');
            $MSISDN = $request->input('MSISDN');
        } else {
            $msisdn = "";
            $MSISDN = "";
        }

        if ($request->input('Result') != NULL) {
            $Result = $request->input('Result');
        }

        if ($request->input('Reason') != NULL) {
            $Reason = $request->input('Reason');
        }
        if ($request->input('transID') != NULL) {
            $transID = $request->input('transID');
        }


        if ($request->input('TPCGID') != NULL) {
            $TPCGID = $request->input('TPCGID');
        }

        if ($request->input('FLOW') != NULL) {
            $FLOW = $request->input('FLOW');
            if ($FLOW == "WIFIFLOW") {
                $type = "wifi";
            } else {
                $type = "HE";
            }
        } else {
            $type = "wifi";
        }

        // make log for every hit
        $actionName = "Ooredoo Notification";
        $not_URL = $request->fullUrl();
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'notification_url' => $not_URL
        );
        $this->log($actionName, $not_URL, $parameters_arr);


        if (isset($msisdn) && $msisdn != "") {
            // add notify
            $notify = new Notify();
            $notify->complete_url = \Request::fullUrl();
            $notify->msisdn = $msisdn;
            $notify->Result = $Result;
            $notify->Reason = $Reason;
            $notify->transID = $transID;
            $notify->FLOW = $FLOW;
            $notify->save();


            $operator_id = 50;
            $operator_name = "Ooredoo Kuwait";


            // viva check if alreday subscribe

            $Msisdn = Msisdn::where('phone_number', '=', $prefix . $MSISDN)->orderBy('id', 'DESC')->first();
            // already acrive
            if (isset($Msisdn) && $Msisdn->final_status == 1 && $Msisdn->renew_date >= $today_date) {
                session(['phone_number' => $MSISDN, 'status' => 'active']);
                // return redirect('/');
                $Url = Generatedurl::where('operator_id', our_ooredoo_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap/" . $Url->UID);
                else
                    return redirect(url() . "/cuurentSnap/2516167");
            }
            if ($Msisdn) {  // found in our DB
                $Msisdn->ooredoo_notify_id = $notify->id;
                $Msisdn->operator_id = $operator_id;
                $Msisdn->save();

                // check result
                if ($Result == "SUCCESS") {
                    // user is confirm to subscribe
                    // make profile check
                    if (isset($Msisdn->plan_id) && $Msisdn->plan_id != 0) {
                        $subsType = $Msisdn->plan_id;
                    } else {
                        $subsType = $this->ooredoo_dbill_profile_check($MSISDN);
                    }

                    $arr = $this->ooredoo_dbill_subscribe($MSISDN, $subsType, $TPCGID);
                    // SN/SR/RN    Subscription success
                    // YR/RR/GR    renewal success
                    if ($arr['result'] == "OK" || $arr['optionalParameter8'] == "operation#SN" || $arr['optionalParameter8'] == "operation#SR" || $arr['optionalParameter8'] == "operation#RN" || $arr['optionalParameter8'] == "operation#YR" || $arr['optionalParameter8'] == "operation#RR" || $arr['optionalParameter8'] == "operation#GR") {
                        $Msisdn->final_status = 1;
                        $Msisdn->type = $type;
                        $Msisdn->plan_id = $subsType;
                        $Msisdn->subscribe_date = date("Y-m-d");
                        $today_date = date("Y-m-d");
                        $time = strtotime($today_date);

                        if ($subsType == "1") {  // // postpaid  // monthly
                            $Msisdn->renew_date = date("Y-m-d", strtotime("+1 month", $time));
                        } elseif ($subsType == "2") {  // // prepaid   //weekly or daily
                            $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                        }
                        $Msisdn->save();
                        $message = "تم الاشتراك بنجاح";



                        session(['phone_number' => $MSISDN, 'status' => 'active']);
                        //  return redirect('/');
                        $Url = Generatedurl::where('operator_id', our_ooredoo_id)->latest()->first();
                        if ($Url)
                            return redirect(url() . "/cuurentSnap/" . $Url->UID);
                        else
                            return redirect(url() . "/cuurentSnap/2516167");
                    } elseif ($arr['result'] == "DBILL:You have Already Subscribed Requested Services") {
                        $message = "انت مشترك بالفعل";
                        session(['phone_number' => $MSISDN, 'status' => 'active']);
                        // return redirect('/');
                        $Url = Generatedurl::where('operator_id', our_ooredoo_id)->latest()->first();
                        if ($Url)
                            return redirect(url() . "/cuurentSnap/" . $Url->UID);
                        else
                            return redirect(url() . "/cuurentSnap/2516167");
                    }
                } else {
                    $message = "لم يوافق المستخدم ";
                }
            } else {  // not found in our DB = like come by SC
                // check result
                if ($Result == "SUCCESS") {
                    // user is confirm to subscribe
                    // make profile check
                    $subsType = $this->ooredoo_dbill_profile_check($MSISDN);
                    $arr = $this->ooredoo_dbill_subscribe($MSISDN, $subsType, $TPCGID);
                    if ($arr['result'] == "OK" || $arr['optionalParameter8'] == "operation#SN" || $arr['optionalParameter8'] == "operation#SR" || $arr['optionalParameter8'] == "operation#RN" || $arr['optionalParameter8'] == "operation#YR" || $arr['optionalParameter8'] == "operation#RR" || $arr['optionalParameter8'] == "operation#GR") {
                        $Msisdn = new Msisdn();
                        $Msisdn->phone_number = $prefix . $MSISDN;
                        $Msisdn->type = $type;
                        $Msisdn->operator_id = $operator_id;
                        $Msisdn->ooredoo_notify_id = $notify->id;
                        $Msisdn->final_status = 1;
                        $Msisdn->plan_id = $subsType;
                        $Msisdn->subscribe_date = date("Y-m-d");
                        $today_date = date("Y-m-d");
                        $time = strtotime($today_date);

                        if ($subsType == "1") {  // // postpaid  // monthly
                            $Msisdn->renew_date = date("Y-m-d", strtotime("+1 month", $time));
                        } elseif ($subsType == "2") {  // // prepaid   //weekly or daily
                            $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                        } else {  // daily
                            $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                        }
                        $Msisdn->save();
                        $message = "تم الاشتراك بنجاح";

                        session(['phone_number' => $MSISDN, 'status' => 'active']);
                        //   return redirect('/');
                        $Url = Generatedurl::where('operator_id', our_ooredoo_id)->latest()->first();
                        if ($Url)
                            return redirect(url() . "/cuurentSnap/" . $Url->UID);
                        else
                            return redirect(url() . "/cuurentSnap/2516167");
                    } elseif ($arr['result'] == "DBILL:You have Already Subscribed Requested Services") {
                        $message = "انت مشترك بالفعل";
                        session(['phone_number' => $MSISDN, 'status' => 'active']);
                        // return redirect('/');
                        $Url = Generatedurl::where('operator_id', our_ooredoo_id)->latest()->first();
                        if ($Url)
                            return redirect(url() . "/cuurentSnap/" . $Url->UID);
                        else
                            return redirect(url() . "/cuurentSnap/2516167");
                    }
                } else {
                    $message = "لم يوافق المستخدم ";
                }
            }







            $result = array();
            $result['type'] = $operator_name . " Notification api ";
            $result['notify_id'] = $notify->id;
            $result['url'] = $not_URL;
            $result['message'] = $message;



            return view('front_end.notification', compact('message', 'operator_name'));
        } else {
            $message = "MSISDN not found in notification url";
            $operator_name = "";
            return view('front_end.notification', compact('message', 'subscribe_for_first_time', 'operator_name'));
        }
    }

    /*

      http://xxxxxxxxx/yyyyyyyy?callingParty=965XXXXXXXX&serviceId=SABXDFC235d&serviceType=P-DntW23fS &requestPlan=Prov_Servi_7 00&sequenceNo=156&chargeAmount=700.0&appliedPlan= Prov_Servi_Y 00&discountPlan=-1&validityDays=7&operationId=SN&bearerId=SMS&errorCode=0&result=OK&contentId=-1&category=-1&optParam1=Provider_name&optParam2=1006&optParam3=<keyword/provider_name in case of Arabic keyword> &optParam4=22-02-2017%2000:00:35&optParam5=<Short_code>


     */

    public function dBill_callback(request $request) {
        date_default_timezone_set("Africa/Cairo");
        $prefix = "965";
        $operator_name = "Ooredoo Kuwait";
        $today_date = date("Y-m-d");
        $message = "";
        // handle if callingParty has country code or not
        if ($request->input('callingParty') != NULL) {
            $msisdn = $request->input('callingParty');
            if (preg_match('/^965[0-9]{8}$/', $msisdn)) {
                $msisdn = $msisdn;
            } else {
                $msisdn = $prefix . $msisdn;
            }
        } else {
            $msisdn = "";
        }



        if ($request->input('serviceId') != NULL) {
            $serviceId = $request->input('serviceId');
        }

        if ($request->input('serviceType') != NULL) {
            $serviceType = $request->input('serviceType');
        }
        if ($request->input('requestPlan') != NULL) {
            $requestPlan = $request->input('requestPlan');
        }

        if ($request->input('sequenceNo') != NULL) {
            $sequenceNo = $request->input('sequenceNo');
        }

        if ($request->input('chargeAmount') != NULL) {
            $chargeAmount = $request->input('chargeAmount');
        }

        if ($request->input('appliedPlan') != NULL) {
            $appliedPlan = $request->input('appliedPlan');
        }

        if ($request->input('discountPlan') != NULL) {
            $discountPlan = $request->input('discountPlan');
        }

        if ($request->input('validityDays') != NULL) {
            $validityDays = $request->input('validityDays');
        }



        if ($request->input('operationId') != NULL) {
            $operationId = $request->input('operationId');
        }

        if ($request->input('bearerId') != NULL) {
            $bearerId = $request->input('bearerId');
        }

        if ($request->input('errorCode') != NULL) {
            $errorCode = $request->input('errorCode');
        }

        if ($request->input('result') != NULL) {
            $result = $request->input('result');
        }

        if ($request->input('contentId') != NULL) {
            $contentId = $request->input('contentId');
        }

        if ($request->input('optParam1') != NULL) {
            $optParam1 = $request->input('optParam1');
        }

        if ($request->input('optParam2') != NULL) {
            $optParam2 = $request->input('optParam2');
        }

        if ($request->input('optParam3') != NULL) {
            $optParam3 = $request->input('optParam3');
        }




        // make log for every hit
        $actionName = "Ooredoo dBill Callback Notifications";
        $not_URL = $request->fullUrl();
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'notification_url' => $not_URL
        );
        $this->log($actionName, $not_URL, $parameters_arr);

        if (isset($serviceId) && isset($serviceType) && $optParam1 && ( $serviceId != serviceId || $serviceType != serviceType || $optParam1 != optParam1 )) {
            $res = array();
            $message = "invalid service or Provider";
            $res['type'] = "dBill Callback Notifications";
            $res['url'] = $not_URL;
            $res['message'] = $message;

            echo json_encode($res);
            die;
        }

        if (isset($msisdn) && $msisdn != "") {
            // add notify
            $notify = new Notify();
            $notify->complete_url = \Request::fullUrl();
            $notify->msisdn = $msisdn;
            $notify->Result = $result;
            $notify->transID = $sequenceNo;
            $notify->FLOW = $bearerId;  // SMS
            $notify->save();


            $operator_id = 50;
            $operator_name = "Ooredoo Kuwait";


            // viva check if alreday subscribe

            $Msisdn = Msisdn::where('phone_number', '=', $msisdn)->orderBy('id', 'DESC')->first();
            if ($Msisdn) {  // found in our DB
                $Msisdn->ooredoo_notify_id = $notify->id;
                $Msisdn->operator_id = $operator_id;
                $Msisdn->save();
                $time = strtotime($today_date);

                // check result
                if ($result == "OK" && $optParam2 == 1006 && ($operationId == "SN" || $operationId == "SR" || $operationId == "RN" || $operationId == "YR" || $operationId == "RR" || $operationId == "GR" )) {  // subscription   SN/SR/RN  Subscription success    /  YR/RR/GR   renewal success
                    $Msisdn->final_status = 1;
                    $Msisdn->type = $bearerId;
                    $Msisdn->subscribe_date = date("Y-m-d");
                    if ($validityDays == 1) { // daily
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                        $plan = "D";
                    } elseif ($validityDays == 7) { // weekly
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+7 day", $time));
                        $plan = "W";
                    } elseif ($validityDays == 30) { // monthly
                        $subsType = 1;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 month", $time));
                        $plan = "M";
                    } elseif ($validityDays > 1 && $validityDays < 7) { // weekly but with limit Days  ex: validityDays=3
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+$validityDays day", $time));
                        $plan = "W-days";
                    } else {
                        $subsType = 2;   // default is daily
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    }

                    $Msisdn->validityDays = $validityDays;
                    $Msisdn->plan = $plan;
                    $Msisdn->plan_id = $subsType;
                    $today_date = date("Y-m-d");
                    $Msisdn->save();
                    $message = "تم الاشتراك بنجاح";



                    //   session(['phone_number' => $MSISDN, 'status' => 'active']);
                    // return redirect('/');
                } elseif ($result == "OK" && $optParam2 == 1007) { //  Un sub
                    $Msisdn->final_status = 0;
                    $Msisdn->type = $bearerId;
                    $today_date = date("Y-m-d");
                    $Msisdn->save();
                    $message = "تم الغاء الاشتراك ينجاح";
                }
            } else {  // not found in our DB = like come by SC
                $Msisdn = new Msisdn();
                $Msisdn->phone_number = $msisdn;


                if ($result == "OK" && $optParam2 == 1006 && ($operationId == "SN" || $operationId == "SR" || $operationId == "RN" || $operationId == "YR" || $operationId == "RR" || $operationId == "GR" )) {
                    $Msisdn->final_status = 1;
                    $Msisdn->type = $bearerId;
                    $Msisdn->subscribe_date = date("Y-m-d");
                    if ($validityDays == 1) { // daily
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                        $plan = "D";
                    } elseif ($validityDays == 7) { // weekly
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+7 day", $time));
                        $plan = "W";
                    } elseif ($validityDays == 30) { // monthly
                        $subsType = 1;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 month", $time));
                        $plan = "M";
                    } elseif ($validityDays > 1 && $validityDays < 7) { // weekly but with limit Days  ex: validityDays=3
                        $subsType = 2;
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+$validityDays day", $time));
                        $plan = "W-days";
                    } else {
                        $subsType = 2;   // default is daily
                        $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    }

                    $Msisdn->validityDays = $validityDays;
                    $Msisdn->plan = $plan;
                    $Msisdn->plan_id = $subsType;
                    $today_date = date("Y-m-d");
                    $Msisdn->save();
                    $message = "تم الاشتراك بنجاح";
                } elseif ($result == "OK" && $optParam2 == 1007) { //  Un sub
                    $Msisdn->final_status = 0;
                    $Msisdn->type = $bearerId;
                    $Msisdn->save();
                    $message = "تم الغاء الاشتراك ينجاح";
                }
            }







            $res = array();
            $res['type'] = "dBill Callback Notifications";
            $res['notify_id'] = $notify->id;
            $res['url'] = $not_URL;
            $res['message'] = $message;
        } else {
            $res = array();
            $res['type'] = "dBill Callback Notifications";
            $message = "MSISDN not found in notification url";
            $res['message'] = $message;
        }

        echo json_encode($res);
    }

    public function ooredoo_dbill_profile_check($MSISDN) {

        // 	SAMPLE PROFILE CHECK API   //
                $serviceNode = serviceNode;
                $sequenceNo = uniqid();
                // $callingParty = "96550167685";
                $callingParty = "965" . $MSISDN;

                $serviceType = serviceType;
                $serviceId = serviceId;
                $bearerId = "WAP";
                $asyncFlag = "N";


                // HE
                /*
                  http://localhost:8080/
                  SingleSiteHE/getHE?productID=0145019900&pName=Photo+Stories+Weekly&CpI
                  d=shf&CpPwd=shf%401920&CpName=Shotformats&transID=fhdkhfsdk
                 */

                $url = "http://singlehe.ooredoo.com.kw:9989/SingleSiteHE/getHE?productID=S-WafflyEwMY2&pName=Waffarly&CpI
        d=IVAS&CpPwd=iva@123&CpName=IVAS&transID=$sequenceNo";


                $soap_request = "<?xml version='1.0' encoding='UTF-8'?>
                    <ocsRequest>
                    <requestType>1001</requestType>
                    <serviceNode>$serviceNode</serviceNode>
                    <sequenceNo>$sequenceNo</sequenceNo>
                    <callingParty>$callingParty</callingParty>
                    <serviceType>$serviceType</serviceType>
                    <serviceId>$serviceId</serviceId>
                    <bearerId>WAP</bearerId>
                    <chargeAmount>-1</chargeAmount>
                    <planId>-1</planId>
                    <asyncFlag>N</asyncFlag>
                    <renewalFlag>-1</renewalFlag>
                    <bundleType>N</bundleType>
                    <serviceUsage>-1</serviceUsage>
                    <promoId>-1</promoId>
                    <subscriptionFlag>S</subscriptionFlag>
                    <optionalParameter1>circleName#-1</optionalParameter1>
                    <optionalParameter2>serviceProviderId#-1</optionalParameter2>
                    <optionalParameter3>subService#-1</optionalParameter3>
                    <optionalParameter4>languageId#en</optionalParameter4>
                    <optionalParameter5>channelCode#-1</optionalParameter5>
                    <optionalParameter6>genereID#-1</optionalParameter6>
                    <optionalParameter7>categoryId#-1</optionalParameter7>
                    <optionalParameter8>toneCategory#-1</optionalParameter8>
                    <optionalParameter9>rbtFeature#-1</optionalParameter9>
                    <optionalParameter10>contentId#-1</optionalParameter10>
                    <optionalParameter11>msgText#-1</optionalParameter11>
                    </ocsRequest>
        ";

                $header = array(
                    "Content-type: text/xml;charset=\"utf-8\"",
                    "Accept: text/xml",
                    "Cache-Control: no-cache",
                    "Pragma: no-cache",
                    "SOAPAction: \"run\"",
                    "Content-length: " . strlen($soap_request),
                );

                $soap_do = curl_init();
                curl_setopt($soap_do, CURLOPT_URL, "https://dbill.ooredoo.com.kw/dbill/smsc?serviceNode=IVAS");
                curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($soap_do, CURLOPT_POST, true);
                curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
                curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

                $data = curl_exec($soap_do);
                curl_close($soap_do);
                //print_r($data);

                $ob = simplexml_load_string($data);
                //  print_r($ob);
                // make log for every hit
                $actionName = "Ooredoo dBill Profile Check Api";
                $not_URL = "ooredoo_dbill_profile_check";
                $parameters_arr = array(
                    'response' => (array) $ob,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                );
                $this->log($actionName, $not_URL, $parameters_arr);

                $subsType = $ob->subsType;
                return $subsType;
            }

            public function ooredoo_dbill_subscribe($MSISDN, $subsType, $TPCGID) {

        //   SAMPLE SUBSCRIPTION  API    //


                $serviceNode = serviceNode;
                //  $sequenceNo = uniqid();
                $sequenceNo = $TPCGID;
                // $callingParty = "96550167685";
                $callingParty = "965" . $MSISDN;
                $serviceType = serviceType;
                $serviceId = serviceId;
                $bearerId = "WAP";
                $asyncFlag = "N";
                $planId = "CONTENTD1";


                if ($subsType == "1") {  // Postpaid
                    $planId = "CONTENT30";
                } elseif ($subsType == "2") {  // Prepaid
                    $planId = "CONTENTD1";
                } elseif ($subsType == "3") {  // Data/blacklisted/Non ooredoo numbers
                } else {
                    $planId = "";
                }



                $soap_request = "<?xml version='1.0' encoding='UTF-8'?>
        <ocsRequest>
        <requestType>1006</requestType>
        <serviceNode>$serviceNode</serviceNode>
        <sequenceNo>$sequenceNo</sequenceNo>
        <callingParty>$callingParty</callingParty>
        <serviceType>$serviceType</serviceType>
        <serviceId>$serviceId</serviceId>
        <bearerId>$bearerId</bearerId>
        <chargeAmount>-1</chargeAmount>
        <planId>$planId</planId>
        <asyncFlag>N</asyncFlag>
        <renewalFlag>-1</renewalFlag>
        <bundleType>$asyncFlag</bundleType>
        <serviceUsage>-1</serviceUsage>
        <promoId>-1</promoId>
        <subscriptionFlag>S</subscriptionFlag>
        <optionalParameter1>circleName#-1</optionalParameter1>
        <optionalParameter2>serviceProviderId#-1</optionalParameter2>
        <optionalParameter3>subService#-1</optionalParameter3>
        <optionalParameter4>languageId#en</optionalParameter4>
        <optionalParameter5>channelCode#-1</optionalParameter5>
        <optionalParameter6>genereID#-1</optionalParameter6>
        <optionalParameter7>categoryId#-1</optionalParameter7>
        <optionalParameter8>toneCategory#-1</optionalParameter8>
        <optionalParameter9>rbtFeature#-1</optionalParameter9>
        <optionalParameter10>contentId#-1</optionalParameter10>
        <optionalParameter11>msgText#-1</optionalParameter11>
        </ocsRequest>";





                $header = array(
                    "Content-type: text/xml;charset=\"utf-8\"",
                    "Accept: text/xml",
                    "Cache-Control: no-cache",
                    "Pragma: no-cache",
                    "SOAPAction: \"run\"",
                    "Content-length: " . strlen($soap_request),
                );

                $soap_do = curl_init();
                curl_setopt($soap_do, CURLOPT_URL, "https://dbill.ooredoo.com.kw/dbill/smsc?serviceNode=IVAS");
                curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($soap_do, CURLOPT_POST, true);
                curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
                curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

                $data = curl_exec($soap_do);
                curl_close($soap_do);
                // print_r($data);

                $ob = simplexml_load_string($data);
                //  print_r($ob);
                // make log for every hit
                $actionName = "Ooredoo dBill Subscribe Api";
                $not_URL = "ooredoo_dbill_subscribe";
                $parameters_arr = array(
                    'response' => (array) $ob,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                );
                $this->log($actionName, $not_URL, $parameters_arr);

                $result = trim($ob->result);
                $optionalParameter8 = trim($ob->optionalParameter8);
                $arr['result'] = $result;
                $arr['optionalParameter8'] = $optionalParameter8;

                return $arr;
            }

            public function ooredoo_dbill_unsub($MSISDN) {

        // 	SAMPLE PROFILE CHECK API   //
                $serviceNode = $serviceNode;
                $sequenceNo = uniqid();
                //   $callingParty = "96550167685";
                $callingParty = "965" . $MSISDN;

                $serviceType = serviceType;
                $serviceId = serviceId;
                $bearerId = "WAP";
                $asyncFlag = "N";
                $planId = "CONTENTD1";


                $soap_request = "<?xml version='1.0' encoding='UTF-8'?>
        <ocsRequest>
        <requestType>1007</requestType>
        <serviceNode>IVAS</serviceNode>
        <sequenceNo>$sequenceNo</sequenceNo>
        <callingParty>$callingParty</callingParty>
        <serviceType>$serviceType</serviceType>
        <serviceId>$serviceId</serviceId>
        <bearerId>WAP</bearerId>
        <chargeAmount>-1</chargeAmount>
        <planId>$planId</planId>
        <asyncFlag>N</asyncFlag>
        <renewalFlag>-1</renewalFlag>
        <bundleType>N</bundleType>
        <serviceUsage>-1</serviceUsage>
        <promoId>-1</promoId>
        <subscriptionFlag>S</subscriptionFlag>
        <optionalParameter1>circleName#-1</optionalParameter1>
        <optionalParameter2>serviceProviderId#-1</optionalParameter2>
        <optionalParameter3>subService#-1</optionalParameter3>
        <optionalParameter4>languageId#en</optionalParameter4>
        <optionalParameter5>channelCode#-1</optionalParameter5>
        <optionalParameter6>genereID#-1</optionalParameter6>
        <optionalParameter7>categoryId#-1</optionalParameter7>
        <optionalParameter8>toneCategory#-1</optionalParameter8>
        <optionalParameter9>rbtFeature#-1</optionalParameter9>
        <optionalParameter10>contentId#-1</optionalParameter10>
        <optionalParameter11>msgText#-1</optionalParameter11>
        </ocsRequest>
        ";

                $header = array(
                    "Content-type: text/xml;charset=\"utf-8\"",
                    "Accept: text/xml",
                    "Cache-Control: no-cache",
                    "Pragma: no-cache",
                    "SOAPAction: \"run\"",
                    "Content-length: " . strlen($soap_request),
                );

                $soap_do = curl_init();
                curl_setopt($soap_do, CURLOPT_URL, "https://dbill.ooredoo.com.kw/dbill/smsc?serviceNode=IVAS");
                curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($soap_do, CURLOPT_POST, true);
                curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
                curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

                $data = curl_exec($soap_do);
                curl_close($soap_do);
                // print_r($data);

                $ob = simplexml_load_string($data);
                //  print_r($ob);
                // make log for every hit
                $actionName = "Ooredoo DBill Unsub Api";
                $not_URL = "ooredoo_dbill_unsub";
                $parameters_arr = array(
                    'response' => (array) $ob,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                );
                $this->log($actionName, $not_URL, $parameters_arr);


                $result = $ob->result;
                $optionalParameter8 = $ob->optionalParameter8;

                $arr['result'] = $result;  // OK   //  DBILL:You have not subscribed this service      "if user is alreday unsub before"
                $arr['optionalParameter8'] = $optionalParameter8;  // operation#SS   //  operation#N/A    "if user is alreday unsub before"
                //  print_r($arr);
                return $arr;
            }

            public function ooredoo_sms_mt(request $request) {

        // 	SAMPLE SMS MT API   //
                $serviceNode = serviceNode;
                $sequenceNo = uniqid();
                $callingParty = "96550167685";
                // $callingParty = "965" . $MSISDN;

                $serviceType = serviceType;
                $serviceId = serviceId;
                $bearerId = "WAP";
                $asyncFlag = "N";
                $planId = "CONTENTD1";
                $message = "hello";
                $cli_SenderID = "1757";
                $reqSource_SenderID = "1757";


                $soap_request = "<?xml version='1.0' encoding='UTF-8'?>
        <ocsRequest>
           <requestType>2015</requestType>
           <serviceNode>$serviceNode</serviceNode>
           <bearerId>$bearerId</bearerId>
           <sequenceNo>$sequenceNo</sequenceNo>
           <callingParty>$callingParty</callingParty>
           <serviceId>S-$serviceId</serviceId>
           <serviceType>$serviceType</serviceType>
           <chargeAmount>-1</chargeAmount>
           <planId>$planId</planId>
           <promoId>-1</promoId>
           <subscriptionFlag>S</subscriptionFlag>
           <bundleType>N</bundleType>
           <serviceUsage>-1</serviceUsage>
           <asyncFlag>N</asyncFlag>
           <renewalFlag>-1</renewalFlag>
           <optionalParameter1>$cli_SenderID</optionalParameter1>
           <optionalParameter2>-1</optionalParameter2>
           <optionalParameter3>-1</optionalParameter3>
           <optionalParameter4>-1</optionalParameter4>
           <optionalParameter5>-1</optionalParameter5>
           <optionalParameter6>-1</optionalParameter6>
           <optionalParameter7>ipr#P</optionalParameter7>
           <optionalParameter8>$reqSource_SenderID</optionalParameter8>
           <optionalParameter9>languageId#-1</optionalParameter9>
           <optionalParameter10>contentId#-1</optionalParameter10>
           <optionalParameter11>$message</optionalParameter11>
           <optionalParameter12>categoryId#-1</optionalParameter12>
        </ocsRequest>
        ";

                $header = array(
                    "Content-type: text/xml;charset=\"utf-8\"",
                    "Accept: text/xml",
                    "Cache-Control: no-cache",
                    "Pragma: no-cache",
                    "SOAPAction: \"run\"",
                    "Content-length: " . strlen($soap_request),
                );

                $soap_do = curl_init();
                curl_setopt($soap_do, CURLOPT_URL, "https://dbill.ooredoo.com.kw/dbill/smsc?serviceNode=IVAS");
                curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($soap_do, CURLOPT_POST, true);
                curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
                curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

                $data = curl_exec($soap_do);
                curl_close($soap_do);
                // print_r($data);
                // make log for every hit
                $actionName = "Ooredoo Sms Mt Api";
                $not_URL = "ooredoo_sms_mt";
                $parameters_arr = array(
                    'response' => (array) $ob,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                );
                $this->log($actionName, $not_URL, $parameters_arr);

                $ob = simplexml_load_string($data);
                print_r($ob);
                $result = $ob->result; // OK
            }


             public function ooredoo_content_mt(request $request) {

        // 	SAMPLE content send for all service subscribers   //
                $serviceNode = serviceNode;
                $sequenceNo = uniqid();


                $serviceType = serviceType;
                $serviceId = serviceId;


        $DlNAME = "dl:taisna" ;
        $message = "http://ivascloud.com/snapchat/viewSnap2/938/738989";

        $shortCode = 1368 ;

                $soap_request = "<?xml version='1.0' encoding='UTF-8' ?>
        <request>
        <seqNo> $sequenceNo</seqNo>
        <dl>$DlNAME</dl>
        <cli>$shortCode</cli>
        <serviceId>$serviceId</serviceId>
        <serviceType>$serviceType</serviceType>
        <serviceNode>$serviceNode</serviceNode>
        <message><content><![CDATA[$message]]></content></message>
        </request>";

                $header = array(
                    "Content-type: text/xml;charset=\"utf-8\"",
                    "Accept: text/xml",
                    "Cache-Control: no-cache",
                    "Pragma: no-cache",
                    "SOAPAction: \"run\"",
                    "Content-length: " . strlen($soap_request),
                );

                $soap_do = curl_init();
                curl_setopt($soap_do, CURLOPT_URL, "https://dbill.ooredoo.com.kw/dl/service");   // https://dbill.ooredoo.com.kw/dl/service
                curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
                curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($soap_do, CURLOPT_POST, true);
                curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
                curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

                $data = curl_exec($soap_do);
                curl_close($soap_do);
                 var_dump($data);  // OK  for success message
                // make log for every hit
                $actionName = "Ooredoo Content Mt Api";
                $not_URL = "ooredoo_content_mt";
                $parameters_arr = array(
                     'request' =>  $soap_request,
                    'response' => (array) $data,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                );
                $this->log($actionName, $not_URL, $parameters_arr);

             //   $ob = simplexml_load_string($data);
             //   print_r($ob);
                // $result = $ob->result; // OK
            }



            	// Ooredoo Encryption function
	public function aes256_cbc_encrypt($key, $data) {
		$key = base64_decode($key);

		 echo '<br>';
		//echo strlen($iv);
		$iv = base64_decode("AAAAAAAAAAAAAAAAAAAAAA==");
		echo '<br>';
		if(32 !== strlen($key)) $key = hash('SHA256', $key, true);
		if(16 !== strlen($iv)) $iv = hash('MD5', $iv, true);
		$data = $this->pkcs7_pad($data , 16);
	   //echo $data;
		echo '<br>';
         // return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);  // this for php 5
         return openssl_encrypt($data, 'aes-256-cbc' , $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, $iv);  // encryptiom in php 7.3
	  }


	  public function pkcs7_pad($text, $blocksize)
	  {
		  $pad = $blocksize - (strlen($text) % $blocksize);
		  return $text . str_repeat(chr($pad), $pad);
	  }



	public function hextobin($hexstr)
	{
		$n = strlen($hexstr);
		$sbin="";
		$i=0;
		while($i<$n)
		{
			$a =substr($hexstr,$i,2);
			$c = pack("H*",$a);
			if ($i==0){$sbin=$c;}
			else {$sbin.=$c;}
			$i+=2;
		}
		return $sbin;
	}



	public function ooredoo_unsub() {
        $MSISDN = Session::get('phone_number');
        return view('ooredoo_landing_unsub', compact('MSISDN'));
}

public function ooredoo_unsub_action() {
        $MSISDN = Session::get('phone_number');
        $arr = $this->ooredoo_dbill_unsub($MSISDN);

        if ($arr['result'] == "OK" || $arr['optionalParameter8'] == "operation#SS") {

                $Msisdn = Msisdn::where('phone_number', '=', "965" . $MSISDN)->where('operator_id', '=', 50)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                        $Msisdn->final_status = 0;
                        $Msisdn->save();

                        session()->flash('success', 'تم الغاء الاشتراك بنجاخ');
                } else {
                        session()->flash('failed', 'هذا التليفون غير موجود');
                }
        } else {
                session()->flash('success', 'انت غير مشرك يالفعل');
        }

        return redirect('/login');
}


    //======================================Ooredoo direct integration =============================================//

    public function logoutadmin(Request $request) {
        \Auth::logout();
        return redirect('/login');
      }

}
