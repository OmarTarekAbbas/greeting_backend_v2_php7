<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\File;

class TimweController extends Controller
{

    public function index()
    {
        return view('landingrotana.timwe_landing');
    }

    public function pincode()
    {
        return view('landingrotana.timwe_pinCode');
    }

    public function unsubscribe()
    {
        return view('landingrotana.timwe_unsub');
    }

    public function notificationMo(Request $request, $partnerRole)
    {
        $partnerRoleId =$partnerRole;

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
            "external-tx-id: ".$this->gen_uuid()
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

        return json_encode($ReqResponse);
    }

    public function notificationMtDn(Request $request, $partnerRole)
    {
        $partnerRoleId =$partnerRole;

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
            "external-tx-id: ".$this->gen_uuid()
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

        return json_encode($ReqResponse);
    }

    public function notificationUserOptin(Request $request, $partnerRole)
    {
        $partnerRoleId =$partnerRole;

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
            "external-tx-id: ".$this->gen_uuid()
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

        return json_encode($ReqResponse);
    }

    public function notificationUserOptout(Request $request, $partnerRole)
    {
        $partnerRoleId =$partnerRole;

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
            "external-tx-id: ".$this->gen_uuid()
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

        return json_encode($ReqResponse);
    }

    public function notificationUserRenewed(Request $request, $partnerRole)
    {
        $partnerRoleId =$partnerRole;

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
            "external-tx-id: ".$this->gen_uuid()
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

    public function sendMt($channel, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $channel = $channel;
        $partnerRoleId = $partnerRole;

        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: ".apikeysendMt,
            "authentication: ".$this->generateKey(presharedkeysendMt),
            "external-tx-id: ".$trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["productId"] = 10461;
        $vars["pricepointId"] = MTFreePricepointId;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["text"] = "MESSAGE TO BE SENT TO USER";
        $vars["msisdn"] = "9741234567";
        $vars["largeAccount"] = largeAccount;
        $vars["sendDate"] = "'.$sendDate.'";
        $vars["priority"] = "NORMAL";
        $vars["timezone"] = "Asia/Qatar";
        $vars["context"] = "STATELESS";
        $vars["moTransactionUUID"] = "";

        $JSON = json_encode($vars);

        $actionName = "Send MT";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/".$channel."/mt/".$partnerRoleId."/";
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        return $ReqResponse;
    }

    public function subscriptionOptIn(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: ".apikeysubscription,
            "authentication: ".$this->generateKey(presharedkeysubscription),
            "external-tx-id: ".$trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["userIdentifier"] = '974'.$request->number;
        session()->put('userIdentifier', '974'.$request->number);
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = productId;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
        $vars["largeAccount"] = largeAccount;
        $vars["subKeyword"] = "";
        // $vars["trackingId"] = "12637414527";
        // $vars["clientIP"] = "127.0.0.1";
        // $vars["campaignUrl"] = "";
        // $vars["optionalParams"] = "";

        $JSON = json_encode($vars);

        $actionName = "Timwe Subscription OptIn";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/subscription/optin/".$partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        if($ReqResponse['code'] == 'SUCCESS'){
            return view('landingrotana.timwe_pinCode');
        }else{
            return redirect('ooredoo_qatar_landing')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
        }
    }

    public function subscriptionConfirm(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: ".apikeysubscription,
            "authentication: ".$this->generateKey(presharedkeysubscription),
            "external-tx-id: ".$trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        if(session()->has('userIdentifier')){
            $vars["userIdentifier"] = session('userIdentifier');
        }else{
            $vars["userIdentifier"] = 'no session found';
        }
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = productId;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
        $vars["clientIp"] = "";
        $vars["transactionAuthCode"] = $request->pincode;

        $JSON = json_encode($vars);

        $actionName = "Timwe subscription Confirm";
        $URL = url()->current();

        $URL = "https://qao.timwe.com/external/v2/subscription/optin/confirm/".$partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        if($ReqResponse['code'] == 'SUCCESS'){
            //sessions
            //redirect landing
        }else{
            return redirect('ooredoo_qatar_pin')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
        }
    }

    public function subscriptionOptOut(Request $request, $partnerRole)
    {
        date_default_timezone_set('Asia/Qatar');

        $partnerRoleId = $partnerRole;

        require('uuid/UUID.php');
        $trxid = \UUID::v4();

        $headers = array(
            "Content-Type: application/json",
            "apikey: ".apikeysubscription,
            "authentication: ".$this->generateKey(presharedkeysubscription),
            "external-tx-id: ".$trxid
        );

        $now = strtotime(now());
        $sendDate = gmdate(DATE_W3C, $now);

        $vars["userIdentifier"] = '974'.$request->number;
        $vars["userIdentifierType"] = "MSISDN";
        $vars["productId"] = productId;
        $vars["mcc"] = "427";
        $vars["mnc"] = "01";
        $vars["entryChannel"] = "WAP";
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

        $URL = "https://qao.timwe.com/external/v2/subscription/optout/".$partnerRoleId;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);
        $ReqResponse = json_decode($ReqResponse, true);

        //log request and response
        $result = [];
        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $this->log($actionName, $URL, $result);

        if($ReqResponse['code'] == 'SUCCESS'){
            return redirect('ooredoo_qatar_unsub')->with('success', 'تم الغاء الاشتراك بنجاح');
        }else{
            return redirect('ooredoo_qatar_unsub')->with('failed', 'لقد حدث خطأ, برجاء المحاولة لاحقا');
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
