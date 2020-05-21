<?php

namespace App\Http\Controllers;

use App\Generatedurl;
use App\Greetingimg;
use App\ImiNotification;
use App\ImiRequests;
use App\ImiUnsubscriber;
use App\Subscriber;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Validator;

class ImiController extends Controller
{

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

    public function landing()
    {
        return view('landing_v2.imi.imi_landing');
    }

    public function pinCode()
    {
        return view('landing_v2.imi.imi_pinCode');
    }

    public function unsub()
    {
        return view('landing_v2.imi.imi_unsub');
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

    public function authorization()
    {
        // $Authorization = UserID . ':' . Password;
        // $Authorization1 = mb_convert_encoding($Authorization, 'ASCII');
        // $Authorization1 = mb_convert_encoding($Authorization, "UTF-8", "UTF-8");
        // $Authorization1 = iconv('ASCII', 'UTF-8//IGNORE', $Authorization);
        // $Authorization2 = '';
        // for ($i = 0; $i < mb_strlen($Authorization, 'ASCII'); $i++) {
        //     $Authorization2 .= ord($Authorization[$i]);
        // }
        // $Base64String = 'Basic ' . base64_encode($Authorization1);
        // return $Base64String;
        // return "Basic dmVuaXNvOnZlbmlzbzEyMw==";
        return authorization;
    }

    public function charging()
    {

        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['ChargeUser']["msisdn"] = session()->get('msisdn');
        $vars['ChargeUser']["otpid"] = session()->get('otpid');
        $vars['ChargeUser']["transid"] = microtime();
        $vars['ChargeUser']["ctype"] = "SUB";
        $vars['ChargeUser']["pcode"] = "1.00";
        $vars['ChargeUser']["chnl"] = "WAP";
        $vars['ChargeUser']["vendor"] = vendor;
        $vars['ChargeUser']["subctype"] = "01";

        $JSON = json_encode($vars);

        $URL = chargingUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Charging';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        return $ReqResponse;
    }

    public function getServices()
    {

        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['service']["reqtype"] = "SERVICES";
        $vars['service']["msisdn"] = "9741234567";
        $vars['service']["serviceid"] = imi_serviceId;
        $vars['service']["chnl"] = "WAP";

        $JSON = json_encode($vars);

        $URL = getServicesUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = $ReqResponse;
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI GetServices';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        return $ReqResponse;
    }

    public function subscriptionsRequest()
    {
        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['service']["reqtype"] = "SUB";
        $vars['service']["msisdn"] = session()->get('msisdn');
        $vars['service']["serviceid"] = imi_serviceId;
        $vars['service']["chnl"] = "WAP";
        $vars['service']["scode"] = shortCode;
        $vars['service']["otpid"] = session()->get('otpid');

        $JSON = json_encode($vars);

        $URL = subscriptionsRequestUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Subscription Request';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        if ($ReqResponse['service']['status'] == 0) {
            Subscriber::create([
                'msisdn' => session()->get('msisdn'),
                'serviceId' => imi_serviceId,
                'requestId' => $imi->id,
            ]);
            // $this->charg ing();
            session(['MSISDN' => session()->get('msisdn'), 'status' => 'active', 'currentOp' => imi_op_id()]);

            $Url = Generatedurl::where('operator_id', imi_op_id())->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', imi_op_id())->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        } else {
            return redirect('imi/pincode')->with('failed', 'لقد حدث خطأ, برجاء المحاولة مرة اخري');
        }
    }

    public function unsubscription(Request $request)
    {
        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['service']["reqtype"] = "UNSUB";
        $vars['service']["msisdn"] = phoneKey . $request->number;
        $vars['service']["serviceid"] = imi_serviceId;
        $vars['service']["chnl"] = "WAP";
        $vars['service']["scode"] = shortCode;

        $JSON = json_encode($vars);

        $URL = unsubscriptionUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Unsubscription';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        if ($ReqResponse['service']['status'] == 0) {
            $subscriber = Subscriber::where('msisdn', phoneKey . $request->number)->where('serviceId', imi_serviceId)->first();
            $subscriber->delete();

            $unsubscribe = ImiUnsubscriber::where('msisdn', phoneKey . $request->number)->where('serviceId', imi_serviceId)->first();

            if (empty($unsubscribe)) {
                ImiUnsubscriber::create([
                    'msisdn' => phoneKey . $request->number,
                    'serviceId' => imi_serviceId,
                    'requestId' => $imi->id,
                ]);
            }
        }

        return redirect('imi/unsubscribe')->with('success', $ReqResponse['service']['resdescription']);
    }

    public function subscriptionsCheck(Request $request)
    {

        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['service']["reqtype"] = "CHECK";
        $vars['service']["msisdn"] = phoneKey . $request->number;

        // optional params if we need a specific service id
        $vars['service']["serviceid"] = imi_serviceId;
        $vars['service']["Status"] = "Active";
        $vars['service']["scode"] = shortCode;

        $JSON = json_encode($vars);

        $URL = subscriptionsCheckUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Check Status';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        $request->session()->put('msisdn', phoneKey . $request->number);

        if (isset($ReqResponse['services']) && count($ReqResponse['services']) > 0) { // user has subscribe sevices

            foreach ($ReqResponse['services'] as $service) {

                if ($service['serviceid'] == imi_serviceId) {

                    $subscriber = Subscriber::where('msisdn', session()->get('msisdn'))->where('serviceId', imi_serviceId)->first();
                    if (empty($subscriber)) {
                        Subscriber::create([
                            'msisdn' => session()->get('msisdn'),
                            'serviceId' => imi_serviceId,
                            'requestId' => $imi->id,
                        ]);
                    }

                    session(['MSISDN' => session()->get('msisdn'), 'status' => 'active' , 'currentOp' => imi_op_id()]);

                    $Url = Generatedurl::where('operator_id', imi_op_id())->latest()->first();
        
                    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                        ->where('greetingimg_operator.operator_id', '=', imi_op_id())->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();
        
                    if ($snap) {
                        return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
                    } else {
                        return redirect(url('rotanav2/' . $Url->UID));
                    }

                }

            }

        } else {
            return $this->generateOTP();
        }

    }

    /*
    localhost/mondia_php7/imi/notification?msisdn=<msisdn>&svcid=<svcid_value>&channel=XXX&action=<SUB/UNSUB/REN>&status=<Status>&Nextrenewaldate=2020-05-11 12.22.11&TransactionID=!Transactionid!
     */
    public function imi_notification(Request $request)
    {
        $vars['msisdn'] = $request->msisdn;
        $vars['svcid'] = $request->svcid;
        $vars['channel'] = $request->channel;
        $vars['action'] = $request->action;
        $vars['status'] = $request->status;
        $vars['Nextrenewaldate'] = $request->Nextrenewaldate;
        $vars['TransactionID'] = $request->TransactionID;

        $validator = Validator::make($request->all(), [
            'msisdn' => 'required',
            'svcid' => 'required',
            // 'channel' => 'required',
            'action' => 'required',
            'status' => 'required',
            // 'Nextrenewaldate' => 'required',
            'TransactionID' => 'required',
        ]);

        if ($validator->fails()) {
            $reesponse['status'] = 1;
            $reesponse['message'] = $validator->errors();
            return $reesponse;
        }

        $URL = \Request::fullUrl();
        $result['params'] = $vars;
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Notification';
        $this->log($actionName, $URL, $result);

        $vars['link'] = $URL;
        $imi = ImiNotification::create($vars);

        $reesponse['status'] = 0;
        $reesponse['description'] = 'success';
        $reesponse['responseId'] = $imi->id;

        return $reesponse;
    }

    public function generateOTP()
    {
        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars["reqtype"] = "GENOTP";
        $vars["msisdn"] = session()->get('msisdn');
        $vars["serviceid"] = imi_serviceId;
        $vars["chnl"] = "WAP";
        $vars["scode"] = shortCode;

        $JSON = json_encode($vars);

        $URL = generateOTPUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Generate OTP';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        session()->put('otpid', $ReqResponse['response']['otpid']);

        return view("landing_v2.imi.imi_pinCode");
    }

    public function generateOTPValidate(Request $request)
    {
        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $otpid = $request->session()->get('otpid');
        $msisdn = $request->session()->get('msisdn');

        $vars["reqtype"] = "VALOTP";
        $vars["msisdn"] = $msisdn;
        $vars["otpid"] = $otpid; // Otpid returned by the GenerateOTP method.
        $vars["otp"] = $request->pincode; // OTP value entered by the subscriber

        $JSON = json_encode($vars);

        $URL = generateOTPValidateUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Validate OTP';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        if ($ReqResponse['response']['status'] == 0) { // true pincode
            $request->session()->put('otpid', $ReqResponse['response']['otpid']);
            return $this->subscriptionsRequest();
        } else {
            return redirect('imi/pincode')->with('failed', 'الكود خاظئ, برجاء المحاولة مرة اخري');
        }
    }

    public function man_elkeal_check_status(Request $request)
    {

        $headers = array(
            "Accept:: application/json",
            "Content-Type: application/json",
            "Authorization: " . $this->authorization(),
        );

        $vars['service']["reqtype"] = "CHECK";
        $vars['service']["msisdn"] = $request->number;

        // optional params if we need a specific service id
        $vars['service']["serviceid"] = 9; // man elkeal sub keyword
        $vars['service']["Status"] = "Active";
        $vars['service']["scode"] = shortCode;

        $JSON = json_encode($vars);

        $URL = subscriptionsCheckUrl;
        $ReqResponse = $this->SendRequest($URL, $JSON, $headers);

        $result['request'] = $vars;
        $result['headers'] = $headers;
        $result['response'] = json_decode($ReqResponse, true);
        $result['date'] = date('Y-m-d H:i:s');

        $actionName = 'IMI Check Status';
        $this->log($actionName, $URL, $result);

        $ReqResponse = json_decode($ReqResponse, true);

        $imi = ImiRequests::create([
            'header' => json_encode($headers),
            'request' => $JSON,
            'response' => json_encode($ReqResponse),
            'type' => $actionName,
        ]);

        if ($ReqResponse['response']['status'] == '0') {
            $res['status'] = 0;
            $res['message'] = 'success';
        } else {
            $res['status'] = 1;
            $res['message'] = 'fail';
        }

        return json_encode($res);
    }

    public function logout()
    {
        session()->forget('MSISDN');
        session()->forget('status');
        session()->forget('imi_op_id');

        return redirect('imi/login');
    }
}
