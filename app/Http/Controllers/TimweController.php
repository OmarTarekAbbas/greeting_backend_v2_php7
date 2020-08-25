<?php

namespace App\Http\Controllers;

use App\Generatedurl;
use App\Greetingimg;
use App\TimWe;
use App\timweSubscriber;
use App\timweUnsubscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Validator;

class TimweController extends Controller
{

  public function login()
  {
    return view('timweLanding.timwe_login');
  }

  public function checkStatusLogin(Request $request)
  {

    $check = $this->checkStatus($request->number);

    if ($check['subscriptionResult'] == 'GET_STATUS_SUB_NOT_EXIST') {

      return redirect('ooredoo_qatar_landing')->with('failed', 'انت غير مشترك حاليا, برجاء الاشتراك');

    } elseif ($check['subscriptionResult'] == 'GET_STATUS_OK') {

      $this->checksub('subscribe', $request->number, $check['timweId']);

      session(['MSISDN' => '974' . $request->number, 'Status' => 'active', 'currentOp' => ooredoo]);

      $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

      $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

      if ($snap) {
        return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('rotanav2/' . $Url->UID));
      }

    } else {
      if (session('applocale') == 'ar')
      return redirect('ooredoo_qatar_login')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
      return redirect('ooredoo_qatar_login')->with('failed', 'Error, please try again later');
    }

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

  public function checksub($state, $msisdn, $timeweId)
  {
    if ($state == 'subscribe') {
      $subscribe = timweSubscriber::where('msisdn', $msisdn)->where('serviceId', productId)->first();

      if (empty($subscribe)) {
        timweSubscriber::create([
          'msisdn' => $msisdn,
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


  public function index()
  {
    return view('timweLanding.timwe_landing');
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

  public function msisdnRedirect(Request $request)
  {
    $encryptedMsisdn = $request->msisdn;
    $msisdn = $this->decryptMsisdn($encryptedMsisdn);

    return ($msisdn);
  }

  public function heRedirect()
  {
    return redirect('http://helm.tekmob.com/pim/ooredooqaohe?redirectURL=' . url('/msisdnRedirect') . "&user=" . heUser . "&pass=" . hePass);
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

  public function decryptMsisdn()
  {
    $phrasetoEncrypt = base64_decode('IKWpOq9rhTAz/K1ZR0znPA=='); // msisdn encrypted

    $iv = base64_decode('yzXzUhr3OAt1A47g7zmYxw=='); //key
    $presharedKey = base64_decode('r/RloSflFkLj3Pq2gFmdBQ=='); //key encryption
    $method = "AES-128-CBC"; // method

    $decrypted = openssl_decrypt($phrasetoEncrypt, $method, $presharedKey, OPENSSL_PKCS1_PADDING, $iv);
    return $decrypted; // msisdn decrypted
  }

  public function testMT()
  {
    $sendMT = new Request();
    $sendMT->msisdn = session('userIdentifier');
    $sendMT->sms = url("/rotanav2/93047");
    return $this->sendMt($sendMT);
  }

  public function timwe_test()
  {

    session(['MSISDN' => '97466671329', 'Status' => 'active', 'currentOp' => ooredoo]);
    $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
      ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

    if ($snap) {
      return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
    } else {
      return redirect(url('rotanav2/' . $Url->UID));
    }

  }

  public function rotana_timwe_get_lastest_url()
  {

    $link = "";
    $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
      ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

    if ($snap) {
      $link = url('rotanav2/inner/' . $snap->id . '/' . $Url->UID);
    } else {
      $link = url('rotanav2/inner/' . $snap->id . '/' . $Url->UID);
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
    $check = $this->checkStatus($request->number);

    if ($check['subscriptionResult'] == 'GET_STATUS_OK') {

      $this->checksub('subscribe', $request->number, $check['timweId']);

      session(['MSISDN' => '974' . $request->number, 'Status' => 'active', 'currentOp' => ooredoo]);
      $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

      $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

      if ($snap) {
        return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('rotanav2/' . $Url->UID));
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

      $vars["userIdentifier"] = '974' . $request->number;
      session()->put('userIdentifier', '974' . $request->number);
      session()->put('pincodephone', $request->number);
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

        session(['MSISDN' => '974' . $request->number, 'Status' => 'active', 'currentOp' => ooredoo]);
        $Url = Generatedurl::where('operator_id', ooredoo)->latest()->first();

        $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
          ->where('greetingimg_operator.operator_id', '=', ooredoo)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

        if ($snap) {
          return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
        } else {
          return redirect(url('rotanav2/' . $Url->UID));
        }

      } else {
        if ($ReqResponse['code'] == 'SUCCESS') {
          return view('timweLanding.timwe_pinCode');
        } else {
          if (session('applocale') == 'ar')
          return redirect('ooredoo_qatar_landing')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
          return redirect('ooredoo_qatar_landing')->with('failed', 'Error, please try again later');
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
        return redirect('ooredoo_qatar_pin')->with('failed', 'رقم التحقق خاطئ يرجي المحاولة مرة اخري');
        return redirect('ooredoo_qatar_pin')->with('failed', 'Wrong pincode, please try again');
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

      if ($snap) {
        return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
      } else {
        return redirect(url('rotanav2/' . $Url->UID));
      }

    } else {
      if (session('applocale') == 'ar')
      return redirect('ooredoo_qatar_pin')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
      return redirect('ooredoo_qatar_pin')->with('failed', 'Error, please try again later');
    }
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
      return redirect('ooredoo_qatar_unsub')->with('success', 'تم الغاء الاشتراك بنجاح');
      return redirect('ooredoo_qatar_unsub')->with('success', 'Unsubscribe succesfully');
    } else {
      if (session('applocale') == 'ar')
      return redirect('ooredoo_qatar_unsub')->with('failed', 'هذا الرقم غير مشترك بالخدمة');
      return redirect('ooredoo_qatar_unsub')->with('failed', 'This number is not subscribed');
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
}
