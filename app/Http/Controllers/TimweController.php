<?php

namespace App\Http\Controllers;

use App\Respo;
use App\TimWe;
use Validator;
use Carbon\Carbon;
use Monolog\Logger;
use App\Greetingimg;
use App\Generatedurl;

use App\AdvertisingUrl;
use App\PostbackRequest;
use App\timweSubscriber;
use App\timweUnsubscriber;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class TimweController extends Controller
{



  public function ooredoo_qatar_login()
  {
    return view('timweLanding.timwe_login');
  }

  public function index(Request $request)
  {
    $URL = $request->fullUrl();
    $respo= new Respo();
    $respo->complete_url = $URL;
    $respo->respons = "landing";
    $respo->op = "o_q";
    $respo->save();

    if($request->clickid){
      Session::put('clickid', $request->clickid);
    }

    if($request->click_id3){
      Session::put('click_id3', $request->click_id3);
    }

    if($request->aff_id3){
      Session::put('aff_id3', $request->aff_id3);
    }

    if(isset($_SERVER['HTTP_CLI'])){
      $msisdn = $_SERVER['HTTP_CLI'] ;
      session()->put('userIdentifier',$msisdn);
    }else{
      $msisdn =  session()->get('userIdentifier');
    }

    $msisdn = str_replace("974", "", $msisdn);



    $actionName = 'Timwe_HE';
    $URL = url()->full();


    // $vars['server'] = $_SERVER;
    $vars['HTTP_CLI'] = $_SERVER['HTTP_CLI'] ?? "";

    $this->log($actionName, $URL, $vars);

  $AdvertisingUrl = new AdvertisingUrl();
  $AdvertisingUrl->adv_url =  $URL;
  $AdvertisingUrl->msisdn =  $_SERVER['HTTP_CLI'] ?? session()->get('userIdentifier');
  $AdvertisingUrl->operatorId = 51;
  $AdvertisingUrl->operatorName = "oq";
  $AdvertisingUrl->ads_compnay_name = "intech";
  $AdvertisingUrl->publisherId_macro = session::get('click_id3')??"";
  $AdvertisingUrl->transaction_id = session::get('aff_id3')??"";
  $AdvertisingUrl->save();


    return view('timweLanding.timwe_landing', compact('msisdn'));
  }

  public function pincode()
  {
    return view('timweLanding.timwe_pinCode');
  }

  public function unsubscribe()
  {
    return view('timweLanding.timwe_unsub');
  }

  public function landing_timwe_he(Request $request)
  {
    $result = array();
    // get client ip
    $ip = $_SERVER["REMOTE_ADDR"];

    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
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
    $result['deviceModel'] = $deviceModel;
    $result['AllHeaders'] = $_SERVER;

    $actionName = "Timwe Header Enrichment";
    $URL = $request->fullUrl();
    $parameters_arr = $result;
    $this->log($actionName, $URL, $parameters_arr); // log in

    return view('timweLanding.timwe_landing_he');
  }

  public function contentLinkWithMsisdn(Request $request)
  {
    $encryptedMsisdn = $request->msisdn;
    $msisdn = $this->decryptMsisdn($encryptedMsisdn);

    $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
      ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

    if ($snap) {
      return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID .'?timwe_msisdn='. $msisdn));
    } else {
      return redirect(url('newdesignv4/' . $Url->UID .'?timwe_msisdn='. $msisdn));
    }

  }

  public function heRedirect()
  {
    return redirect('http://helm.tekmob.com/pim/ooredooqaohe?redirectURL=' . url('/contentLinkWithMsisdn') . "&user=" . heUser . "&pass=" . hePass);
  }

  public function notificationMo(Request $request, $partnerRole)
  {
    $partnerRoleId = $partnerRole;

    $validator = Validator::make($request->all(), [
      'productId' => 'required',
      'pricepointId' => 'required',
      'mcc' => 'required',
      'mnc' => 'required',
      'text' => 'required',
      'msisdn' => 'required',
      'largeAccount' => 'required',
      'transactionUUID' => 'required',
      'tags' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors()->toJson();
    }

    $headers = array(
      "Content-Type: application/json",
      "external-tx-id: " . $this->gen_uuid(),
    );

    $vars['productId'] = (int)$request->productId;
    $vars['pricepointId'] = (int)$request->pricepointId;
    $vars['mcc'] = $request->mcc;
    $vars['mnc'] = $request->mnc;
    $vars['text'] = $request->text;
    $vars['msisdn'] = $request->msisdn;
    $vars['largeAccount'] = $request->largeAccount;
    $vars['transactionUUID'] = $request->transactionUUID;
    $vars['tags'] = $request->tags;

    // here json
    $JSON = $vars;

    $actionName = "Notification MO";
    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $vars);

    $ReqResponse['requestId'] = '44:1507734322453';
    $ReqResponse['code'] = 'SUCCESS';
    $ReqResponse['inError”'] = 'false';
    $ReqResponse['message'] = 'string';
    $ReqResponse['partnerNotifResponseBody'] = array('test1', 'test2');

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    return json_encode($ReqResponse);
  }

  public function notificationMtDn(Request $request, $partnerRole)
  {
    $partnerRoleId = $partnerRole;

    $validator = Validator::make($request->all(), [
      'productId' => 'required',
      'pricepointId' => 'required',
      'mcc' => 'required',
      'mnc' => 'required',
      'transactionUUID' => 'required',
      'userIdentifier' => 'required',
      'largeAccount' => 'required',
      'mnoDeliveryCode' => 'required',
      'tags' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors()->toJson();
    }

    $headers = array(
      "Content-Type: application/json",
      "external-tx-id: " . $this->gen_uuid(),
    );

    $vars['productId'] = (int)$request->productId;
    $vars['pricepointId'] = (int)$request->pricepointId;
    $vars['mcc'] = $request->mcc;
    $vars['mnc'] = $request->mnc;
    $vars['transactionUUID'] = $request->transactionUUID;
    $vars['userIdentifier'] = $request->userIdentifier;
    $vars['largeAccount'] = $request->largeAccount;
    $vars['mnoDeliveryCode'] = $request->mnoDeliveryCode;
    $vars['tags'] = $request->tags;

    // here json
    $JSON = $vars;

    $actionName = "Notification MT DN";
    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $vars);

    $ReqResponse['requestId'] = '44:1507734322453';
    $ReqResponse['code'] = 'SUCCESS';
    $ReqResponse['inError”'] = 'false';
    $ReqResponse['message'] = 'string';
    $ReqResponse['partnerNotifResponseBody'] = array('test1', 'test2');

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);
    return json_encode($ReqResponse);
  }

  public function notificationUserOptin(Request $request, $partnerRole)
  {
    $partnerRoleId = $partnerRole;

    $validator = Validator::make($request->all(), [
      'productId' => 'required',
      'pricepointId' => 'required',
      'mcc' => 'required',
      'mnc' => 'required',
      'text' => 'required',
      'msisdn' => 'required',
      'entryChannel' => 'required',
      'largeAccount' => 'required',
      'transactionUUID' => 'required',
      'tags' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors()->toJson();
    }

    $headers = array(
      "Content-Type: application/json",
      "external-tx-id: " . $this->gen_uuid(),
    );

    $vars['productId'] = (int)$request->productId;
    $vars['pricepointId'] = (int)$request->pricepointId;
    $vars['mcc'] = $request->mcc;
    $vars['mnc'] = $request->mnc;
    $vars['text'] = $request->text;
    $vars['msisdn'] = $request->msisdn;
    $vars['entryChannel'] = $request->entryChannel;
    $vars['largeAccount'] = $request->largeAccount;
    $vars['transactionUUID'] = $request->transactionUUID;
    $vars['tags'] = $request->tags;

    // here json
    $JSON = $vars;

    $actionName = "Notification User Optin";
    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $vars);

    $ReqResponse['requestId'] = '44:1507734322453';
    $ReqResponse['code'] = 'SUCCESS';
    $ReqResponse['inError”'] = 'false';
    $ReqResponse['message'] = 'string';
    $ReqResponse['partnerNotifResponseBody'] = array('test1', 'test2');

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    return json_encode($ReqResponse);
  }

  public function notificationUserOptout(Request $request, $partnerRole)
  {
    $partnerRoleId = $partnerRole;

    $validator = Validator::make($request->all(), [
      'productId' => 'required',
      'pricepointId' => 'required',
      'mcc' => 'required',
      'mnc' => 'required',
      'msisdn' => 'required',
      'entryChannel' => 'required',
      'largeAccount' => 'required',
      'transactionUUID' => 'required',
      'tags' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors()->toJson();
    }

    $headers = array(
      "Content-Type: application/json",
      "external-tx-id: " . $this->gen_uuid(),
    );

    $vars['productId'] = (int)$request->productId;
    $vars['pricepointId'] = (int)$request->pricepointId;
    $vars['mcc'] = $request->mcc;
    $vars['mnc'] = $request->mnc;
    $vars['text'] = $request->text;
    $vars['entryChannel'] = $request->entryChannel;
    $vars['largeAccount'] = $request->largeAccount;
    $vars['transactionUUID'] = $request->transactionUUID;
    $vars['tags'] = $request->tags;

    // here json
    $JSON = $vars;

    $actionName = "Notification User Optout";
    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $vars);

    $ReqResponse['requestId'] = '44:1507734322453';
    $ReqResponse['code'] = 'SUCCESS';
    $ReqResponse['inError”'] = 'false';
    $ReqResponse['message'] = 'string';
    $ReqResponse['partnerNotifResponseBody'] = array('test1', 'test2');

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    return json_encode($ReqResponse);
  }

  public function notificationUserRenewed(Request $request, $partnerRole)
  {
    $partnerRoleId = $partnerRole;

    $validator = Validator::make($request->all(), [
      'productId' => 'required',
      'pricepointId' => 'required',
      'mcc' => 'required',
      'mnc' => 'required',
      'msisdn' => 'required',
      'entryChannel' => 'required',
      'largeAccount' => 'required',
      'transactionUUID' => 'required',
      'text' => 'required',
      'tags' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors()->toJson();
    }

    $headers = array(
      "Content-Type: application/json",
      "external-tx-id: " . $this->gen_uuid(),
    );

    $vars['productId'] = (int)$request->productId;
    $vars['pricepointId'] = (int)$request->pricepointId;
    $vars['mcc'] = $request->mcc;
    $vars['mnc'] = $request->mnc;
    $vars['text'] = $request->text;
    $vars['entryChannel'] = $request->entryChannel;
    $vars['largeAccount'] = $request->largeAccount;
    $vars['transactionUUID'] = $request->transactionUUID;
    $vars['text'] = $request->text;
    $vars['tags'] = $request->tags;

    // here json
    $JSON = $vars;

    $actionName = "Notification User Renewed";
    $URL = $request->fullUrl();
    $this->log($actionName, $URL, $vars);

    $ReqResponse['requestId'] = '44:1507734322453';
    $ReqResponse['code'] = 'SUCCESS';
    $ReqResponse['inError”'] = 'false';
    $ReqResponse['message'] = 'string';
    $ReqResponse['partnerNotifResponseBody'] = array('test1', 'test2');

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'type' => $actionName,
    ]);

    return json_encode($ReqResponse);
  }

  public function gen_uuid()
  {
    return sprintf(
      '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff)
    );
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

  public function generateKey($presharedKey)
  {
    date_default_timezone_set('Asia/Qatar');

    // dd(time());

    $presharedKey = $presharedKey; //PSK shared by TIMWE
    $phrasetoEncrypt = TimweServiceId . "#" . round(microtime(true) * 1000); // Service Id shared by TIMWE

    // $encryptionAlgorithm = "AES/ECB/PKCS5Padding";
    $encrypted = "";

    if ($presharedKey != null && $phrasetoEncrypt != "") {
      $method = "aes-128-ecb";
      $encrypted = openssl_encrypt($phrasetoEncrypt, $method, $presharedKey, OPENSSL_PKCS1_PADDING);
      $result = base64_encode($encrypted);
      return $result;
    } else {
      return "String to encrypt, Key is required.";
    }
  }

  public function decryptMsisdn($encryptedMsisdn)
  {
    // $phrasetoEncrypt = base64_decode('IKWpOq9rhTAz/K1ZR0znPA=='); // msisdn encrypted
    $phrasetoEncrypt = $encryptedMsisdn; // msisdn encrypted

    $iv = base64_decode('yzXzUhr3OAt1A47g7zmYxw=='); //iv
    $presharedKey = base64_decode('r/RloSflFkLj3Pq2gFmdBQ=='); //key encryption
    $method = "AES-128-CBC"; // method

    $decrypted = openssl_decrypt($phrasetoEncrypt, $method, $presharedKey, OPENSSL_PKCS1_PADDING, $iv);
    return $decrypted; // msisdn decrypted
  }

  public function testMT()
  {
    $sendMT = new Request();
    $sendMT->msisdn = session('userIdentifier');
    $sendMT->sms = url('/?OpID='.ooredoo);
    return $this->sendMt($sendMT);
  }

  public function timwe_test()
  {

    session(['MSISDN' => '97466671329', 'Status' => 'active', 'currentOp' => ooredoo]);
    $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
      ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

    if ($snap) {
      return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID));
    } else {
      return redirect(url('newdesignv4/' . $Url->UID));
    }



  }

  public function rotana_timwe_get_lastest_url()
  {

    $link = "";
    $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
      ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

    if ($snap) {
      $link = url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID);
    } else {
      $link = url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID);
    }

    $result['link'] = $link;

    return json_encode($result);

  }

  public function sendMt(Request $request)
  {
    date_default_timezone_set('Asia/Qatar');

    $channel = 'sms';
    $partnerRoleId = partnerRoleId;

    require_once 'uuid/UUID.php';
    $trxid = \UUID::v4();

    $headers = array(
      "Content-Type: application/json",
      "apikey: " . apikeysendMt,
      "authentication: " . $this->generateKey(presharedkeysendMt),
      "external-tx-id: " . $trxid,
    );

    $now = strtotime(now());
    $sendDate = gmdate(DATE_W3C, $now);

    $vars["productId"] = productId;
    $vars["pricepointId"] = MTFreePricepointId;
    $vars["mcc"] = "427";
    $vars["mnc"] = "01";
    $vars["text"] = $request->sms;
    $vars["msisdn"] = $request->msisdn;
    $vars["largeAccount"] = largeAccount;
    $vars["sendDate"] = "'.$sendDate.'";
    $vars["priority"] = "NORMAL";
    $vars["timezone"] = "Asia/Qatar";
    $vars["context"] = "STATELESS";
    $vars["moTransactionUUID"] = "";

    $JSON = json_encode($vars);

    $actionName = "Send MT";
    $URL = url()->current();

    $URL = "https://qao.timwe.com/external/v2/" . $channel . "/mt/" . $partnerRoleId . "/";
    $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
    $ReqResponse = json_decode($ReqResponse, true);

    //log request and response
    $result = [];
    $result['request'] = $vars;
    $result['headers'] = $headers;
    $result['response'] = $ReqResponse;
    $result['date'] = date('Y-m-d H:i:s');

    $this->log($actionName, $URL, $result);

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    return $ReqResponse;
  }

  public function subscriptionOptIn(Request $request, $partnerRole)
  {
    $msisdn = $request->number ?? session('pincodephone');

    $check = $this->checkStatus($msisdn);

    if ($check['subscriptionResult'] == 'GET_STATUS_OK') {

      $this->checksub('subscribe', $msisdn, $check['timweId']);

      session(['MSISDN' => '974' . $msisdn, 'Status' => 'active', 'currentOp' => ooredoo]);
      $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

      $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

      if ($snap) {
        return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('newdesignv4/' . $Url->UID));
      }

    } else {
      date_default_timezone_set('Asia/Qatar');

      $partnerRoleId = $partnerRole;

      require_once 'uuid/UUID.php';
      $trxid = \UUID::v4();

      $headers = array(
        "Content-Type: application/json",
        "apikey: " . apikeysubscription,
        "authentication: " . $this->generateKey(presharedkeysubscription),
        "external-tx-id: " . $trxid,
      );

      $now = strtotime(now());
      $sendDate = gmdate(DATE_W3C, $now);

      $vars["userIdentifier"] = '974' . $msisdn;
      session()->put('userIdentifier', '974' . $msisdn);
      session()->put('pincodephone', $msisdn);
      $vars["userIdentifierType"] = "MSISDN";
      $vars["productId"] = productId;
      $vars["mcc"] = "427";
      $vars["mnc"] = "01";
      $vars["entryChannel"] = "WEB";
      $vars["largeAccount"] = largeAccount;
      $vars["subKeyword"] = "";
      // $vars["trackingId"] = "12637414527";
      // $vars["clientIP"] = "127.0.0.1";
      // $vars["campaignUrl"] = "";
      // $vars["optionalParams"] = "";

      $JSON = json_encode($vars);

      $actionName = "Timwe Subscription OptIn";
      $URL = url()->current();

      $URL = "https://qao.timwe.com/external/v2/subscription/optin/" . $partnerRoleId;
      $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
      $ReqResponse = json_decode($ReqResponse, true);

      //log request and response
      $result = [];
      $result['request'] = $vars;
      $result['headers'] = $headers;
      $result['response'] = $ReqResponse;
      $result['date'] = date('Y-m-d H:i:s');

      $this->log($actionName, $URL, $result);

      $timewe = TimWe::create([
        'api_request' => $URL,
        'payload' => json_encode($vars),
        'response' => json_encode($ReqResponse),
        'header' => json_encode($headers),
        'type' => $actionName,
      ]);

      if ($ReqResponse['responseData']['subscriptionResult'] == 'OPTIN_ALREADY_ACTIVE') {
        $subscribe = timweSubscriber::where('msisdn', session('userIdentifier'))->where('serviceId', productId)->first();

        if (empty($subscribe)) {
          timweSubscriber::create([
            'msisdn' => session('userIdentifier'),
            'serviceId' => productId,
            'requestId' => $timewe->id,
          ]);
        }

        session(['MSISDN' => '974' . $msisdn, 'Status' => 'active', 'currentOp' => ooredoo]);
        $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

        $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
          ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

        if ($snap) {
          return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID));
        } else {
          return redirect(url('newdesignv4/' . $Url->UID));
        }

      } else {
        if ($ReqResponse['code'] == 'SUCCESS') {
          if (session('applocale') == 'ar')
            return redirect('ooredoo_q_pin')->with('success', '!تم ارسال رمز التحقق');
          return redirect('ooredoo_q_pin')->with('success', 'Pincode Sent!');
        } else {
          if (session('applocale') == 'ar')
            return redirect('ooredoo_q')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
          return redirect('ooredoo_q')->with('failed', 'Error, please try again later');
        }
      }
    }
  }

  public function subscriptionConfirm(Request $request, $partnerRole)
  {
    date_default_timezone_set('Asia/Qatar');

    $partnerRoleId = $partnerRole;

    require_once 'uuid/UUID.php';
    $trxid = \UUID::v4();

    $headers = array(
      "Content-Type: application/json",
      "apikey: " . apikeysubscription,
      "authentication: " . $this->generateKey(presharedkeysubscription),
      "external-tx-id: " . $trxid,
    );

    $now = strtotime(now());
    $sendDate = gmdate(DATE_W3C, $now);

    if (session()->has('userIdentifier')) {
      $vars["userIdentifier"] = session('userIdentifier');
    } else {
      $vars["userIdentifier"] = 'no session found';
    }
    $vars["userIdentifierType"] = "MSISDN";
    $vars["productId"] = productId;
    $vars["mcc"] = "427";
    $vars["mnc"] = "01";
    $vars["entryChannel"] = "WEB";
    $vars["clientIp"] = "";
    $vars["transactionAuthCode"] = $request->pincode;

    $JSON = json_encode($vars);

    $actionName = "Timwe subscription Confirm";
    $URL = url()->current();

    $URL = "https://qao.timwe.com/external/v2/subscription/optin/confirm/" . $partnerRoleId;
    $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
    $ReqResponse = json_decode($ReqResponse, true);

    //log request and response
    $result = [];
    $result['request'] = $vars;
    $result['headers'] = $headers;
    $result['response'] = $ReqResponse;
    $result['date'] = date('Y-m-d H:i:s');

    $this->log($actionName, $URL, $result);

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    if ($ReqResponse['code'] == 'SUCCESS') {
      if ($ReqResponse['responseData']['subscriptionResult'] == 'OPTIN_CONF_WRONG_PIN') {
        if (session('applocale') == 'ar')
        return redirect('ooredoo_q_pin')->with('failed', 'رقم التحقق خاطئ يرجي المحاولة مرة اخري');
        return redirect('ooredoo_q_pin')->with('failed', 'Wrong pincode, please try again');
      }

      $subscribe = timweSubscriber::where('msisdn', session('userIdentifier'))->where('serviceId', productId)->first();

      if (empty($subscribe)) {
        timweSubscriber::create([
          'msisdn' => session('userIdentifier'),
          'serviceId' => productId,
          'requestId' => $timewe->id,
        ]);
      }

      session(['MSISDN' => '974' . $request->number, 'Status' => 'active', 'currentOp' => ooredoo]);
      $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

      $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

        // make curl to clickid

         // first ads company = clickid    // pedtro
          $clickid = Session::get('clickid');
          $msisdn = '974' . $request->number;
         if ($clickid != '') {  // fist success billing  so hit postback
          //  http://offers.moneytize.affise.com/postback?clickid=604f4dc8d8f7150001b5bbc1
          $post_back_url = "http://offers.moneytize.affise.com/postback?clickid=$clickid" ;
          $result =  $this->GetPageData($post_back_url);
          $postback_requests = new PostbackRequest();
          $postback_requests->req = $post_back_url;
          $postback_requests->response = $result;
          $postback_requests->msisdn = $msisdn;
          $postback_requests->notification_id = "";
          $result = (array) json_decode($result);
          if($result['status'] == '1'){
            $postback_requests->status = 1 ;
          }else{
            $postback_requests->status = 0 ;
          }
          $postback_requests->save();

          }

         // Third ads company
         $click_id3 = Session::get('click_id3');
         $aff_id3 = Session::get('aff_id3');
         if ($click_id3 != '' && $aff_id3 != '') {
          $post_back_url = "https://nuvonia.offerstrack.net/advBack.php?click_id=$click_id3&adv_id=1026&offer_id=2179&aff_id=$aff_id3&security_code=2fd9f2ee6c5becde10e99a293a857b87" ;

          $result =  $this->getAdsCompanyApiResponseCode($post_back_url);

          $postback_requests = new PostbackRequest();
          $postback_requests->req = $post_back_url;
          $postback_requests->response = $result;
          $postback_requests->msisdn = $msisdn;
          $postback_requests->notification_id = "";
          if($result == '200'){
            $postback_requests->status = 1 ;
          }else{
            $postback_requests->status = 0 ;
          }
          $postback_requests->save();
          }


      if ($snap) {
        return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('newdesignv4/' . $Url->UID));
      }

    } else {
      if (session('applocale') == 'ar')
        return redirect('ooredoo_q_pin')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
      return redirect('ooredoo_q_pin')->with('failed', 'Error, please try again later');
    }
  }

  public function getAdsCompanyApiResponseCode($url)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpcode;
  }

  public function subscriptionOptOut(Request $request, $partnerRole)
  {
    date_default_timezone_set('Asia/Qatar');

    $partnerRoleId = $partnerRole;

    require_once 'uuid/UUID.php';
    $trxid = \UUID::v4();

    $headers = array(
      "Content-Type: application/json",
      "apikey: " . apikeysubscription,
      "authentication: " . $this->generateKey(presharedkeysubscription),
      "external-tx-id: " . $trxid,
    );

    $now = strtotime(now());
    $sendDate = gmdate(DATE_W3C, $now);

    $vars["userIdentifier"] = '974' . $request->number;
    $vars["userIdentifierType"] = "MSISDN";
    $vars["productId"] = productId;
    $vars["mcc"] = "427";
    $vars["mnc"] = "01";
    $vars["entryChannel"] = "WEB";
    $vars["largeAccount"] = largeAccount;
    $vars["subKeyword"] = "SUB";
    // $vars["trackingId"] = "12637414527";
    // $vars["clientIP"] = "127.0.0.1";
    // $vars["controlKeyword"] = "";
    // $vars["controlServiceKeyword"] = "";
    // $vars["subId"] = "";
    // $vars["cancelReason"] = "";
    // $vars["cancelSource"] = "";

    $JSON = json_encode($vars);

    $actionName = "Timwe subscription OptOut";
    $URL = url()->current();

    $URL = "https://qao.timwe.com/external/v2/subscription/optout/" . $partnerRoleId;
    $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
    $ReqResponse = json_decode($ReqResponse, true);

    //log request and response
    $result = [];
    $result['request'] = $vars;
    $result['headers'] = $headers;
    $result['response'] = $ReqResponse;
    $result['date'] = date('Y-m-d H:i:s');

    $this->log($actionName, $URL, $result);

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    // dd($ReqResponse['responseData']['subscriptionResult']);
    if ($ReqResponse['responseData']['subscriptionResult'] == 'OPTOUT_CANCELED_OK') {
      $subscribe = timweSubscriber::where('msisdn', '974' . $request->number)->where('serviceId', productId)->first();
      $subscribe->delete();

      timweUnsubscriber::create([
        'msisdn' => '974' . $request->number,
        'serviceId' => productId,
        'requestId' => $timewe->id,
      ]);
      if (session('applocale') == 'ar')
        return redirect('ooredoo_q_unsub')->with('success', 'تم الغاء الاشتراك بنجاح');
      return redirect('ooredoo_q_unsub')->with('success', 'Unsubscribe succesfully');
    } else {
      if (session('applocale') == 'ar')
        return redirect('ooredoo_q_unsub')->with('failed', 'هذا الرقم غير مشترك بالخدمة');
      return redirect('ooredoo_q_unsub')->with('failed', 'This number is not subscribed');
    }
  }

  public function checksub($state, $msisdn, $timeweId)
  {
    if ($state == 'subscribe') {
      $subscribe = timweSubscriber::where('msisdn', '974' . $msisdn)->where('serviceId', productId)->first();

      if (empty($subscribe)) {
        timweSubscriber::create([
          'msisdn' => '974' . $msisdn,
          'serviceId' => productId,
          'requestId' => $timeweId,
        ]);
      }
    } elseif ($state == 'unsubscribe') {
      $subscribe = timweSubscriber::where('msisdn', '974' . $msisdn)->where('serviceId', productId)->first();
      $subscribe->delete();

      timweUnsubscriber::create([
        'msisdn' => '974' . $msisdn,
        'serviceId' => productId,
        'requestId' => $timeweId,
      ]);
    }
    return 'success';
  }

  public function checkStatus($number)
  {
    $partnerRoleId = partnerRoleId;

    require_once 'uuid/UUID.php';
    $trxid = \UUID::v4();

    $headers = array(
      "Content-Type: application/json",
      "apikey: " . apikeysubscription,
      "authentication: " . $this->generateKey(presharedkeysubscription),
      "external-tx-id: " . $trxid,
    );

    $vars["userIdentifier"] = '974' . $number;
    session()->put('landing_msisdn', $number);
    $vars["userIdentifierType"] = 'MSISDN';
    $vars["productId"] = productId;
    $vars["mcc"] = "427";
    $vars["mnc"] = "01";
    $vars["entryChannel"] = 'WEB';

    $JSON = json_encode($vars);

    $actionName = "Check Status";

    $URL = "https://qao.timwe.com/external/v2/subscription/status/" . $partnerRoleId . "/";
    $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
    $ReqResponse = json_decode($ReqResponse, true);

    //log request and response
    $result = [];
    $result['request'] = $vars;
    $result['headers'] = $headers;
    $result['response'] = $ReqResponse;
    $result['date'] = date('Y-m-d H:i:s');

    $this->log($actionName, $URL, $result);

    $timewe = TimWe::create([
      'api_request' => $URL,
      'payload' => json_encode($vars),
      'response' => json_encode($ReqResponse),
      'header' => json_encode($headers),
      'type' => $actionName,
    ]);

    $response['subscriptionResult'] = $ReqResponse['responseData']['subscriptionResult'];
    $response['timweId'] = $timewe->id;
    return $response;
  }

  public function checkStatusLogin(Request $request)
  {

    $check = $this->checkStatus($request->number);

    if ($check['subscriptionResult'] == 'GET_STATUS_SUB_NOT_EXIST') {

      return redirect('ooredoo_q')->with('failed', 'انت غير مشترك حاليا, برجاء الاشتراك');

    } elseif ($check['subscriptionResult'] == 'GET_STATUS_OK') {

      $this->checksub('subscribe', $request->number, $check['timweId']);

      session(['MSISDN' => '974' . $request->number, 'Status' => 'active', 'currentOp' => ooredoo]);

      $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

      $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

      if ($snap) {
        return redirect(url('newdesignv4/filter/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('newdesignv4/' . $Url->UID));
      }

    } else {
      if (session('applocale') == 'ar')
        return redirect('ooredoo_q_login')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
      return redirect('ooredoo_q_login')->with('failed', 'Error, please try again later');
    }

  }

  public function SendRequest($URL, $JSON, $headers)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON);
    $sOutput = curl_exec($ch);
    curl_close($ch);

    return $sOutput;
  }

  public function timwe_logout(){
    session()->forget('userIdentifier');
    session()->forget('status');
    session()->forget('currentOp');

    return redirect('ooredoo_q');
  }


      public function postback_requests_test(Request $request)
      {

        /*
        $clickid = Session::get('clickid');
        $msisdn = '97412345678';
       if ($clickid != '') {  // fist success billing  so hit postback
        //  http://offers.moneytize.affise.com/postback?clickid=604f4dc8d8f7150001b5bbc1
        $post_back_url = "http://offers.moneytize.affise.com/postback?clickid=$clickid" ;
        $result =  $this->GetPageData($post_back_url);
        $postback_requests = new PostbackRequest();
        $postback_requests->req = $post_back_url;
        $postback_requests->response = $result;
        $postback_requests->msisdn = $msisdn;
        $postback_requests->notification_id = "";
        $result = (array) json_decode($result);
        if($result['status'] == '1'){
          $postback_requests->status = 1 ;
        }else{
          $postback_requests->status = 0 ;
        }
        $postback_requests->save();
        }
*/




     // Third ads company
     $click_id3 = Session::get('click_id3');
     $aff_id3 = Session::get('aff_id3');
     $msisdn = '97412345678';
     if ($click_id3 != '' && $aff_id3 != '') {
      $post_back_url = "https://nuvonia.offerstrack.net/advBack.php?click_id=$click_id3&adv_id=1026&offer_id=2179&aff_id=$aff_id3&security_code=2fd9f2ee6c5becde10e99a293a857b87" ;

      $result =  $this->getAdsCompanyApiResponseCode($post_back_url);

      $postback_requests = new PostbackRequest();
      $postback_requests->req = $post_back_url;
      $postback_requests->response = $result;
      $postback_requests->msisdn = $msisdn;
      $postback_requests->notification_id = "";
      if($result == '200'){
        $postback_requests->status = 1 ;
      }else{
        $postback_requests->status = 0 ;
      }
      $postback_requests->save();
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
          return $data;
      }
}
