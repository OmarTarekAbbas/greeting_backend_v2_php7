<?php

namespace App\Http\Controllers;

use App\MobilySubscriber;
use App\MobilyUnsubscriber;
use App\MONotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Validator;

class MobilyController extends Controller
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

    public function notificationMO(Request $request)
    {

        $PartnerCode = PartnerCode;

        $validator = Validator::make($request->all(), [
            'serviceId' => 'required',
            'text' => 'required',
            'msisdn' => 'required',
        ]);

        if ($validator->fails()) {
            $ReqResponse['message'] = $validator->errors();
            $ReqResponse['inError'] = 'true';
            $ReqResponse['requestId'] = 'requestId';
            $ReqResponse['code'] = 'FAIL';

            return json_encode($ReqResponse);
        }

        $headers = array(
            "Content-Type: application/json",
        );

        $vars['serviceId'] = MobilyServiceId;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['PartnerCode'] = $PartnerCode;

        // here json
        $JSON = $vars;

        $actionName = "Notification MO";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $vars);

        $ReqResponse['message'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['requestId'] = md5(uniqid(rand(), true));

        $MONotification['msisdn'] = $vars['msisdn'];
        $MONotification['text'] = $vars['text'];
        $MONotification['request'] = json_encode($vars);
        $MONotification['response'] = json_encode($ReqResponse);
        $MONotification['type'] = $actionName;
        $id = MONotification::create($MONotification);

        return json_encode($ReqResponse);
    }

    public function notificationOptIn(Request $request, $PartnerCode)
    {
        $PartnerCode = PartnerCode;

        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'msisdn' => 'required',
        ]);

        if ($validator->fails()) {
            $ReqResponse['message'] = $validator->errors();
            $ReqResponse['inError'] = 'true';
            $ReqResponse['requestId'] = 'requestId';
            $ReqResponse['code'] = 'FAIL';

            return json_encode($ReqResponse);
        }

        $headers = array(
            "Content-Type: application/json",
        );

        $vars['serviceId'] = MobilyServiceId;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['PartnerCode'] = $PartnerCode;

        // here json
        $JSON = $vars;

        $actionName = "Notification Optin";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $vars);

        $ReqResponse['message'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['requestId'] = md5(uniqid(rand(), true));

        $MONotification['msisdn'] = $vars['msisdn'];
        $MONotification['text'] = $vars['text'];
        $MONotification['request'] = json_encode($vars);
        $MONotification['response'] = json_encode($ReqResponse);
        $MONotification['type'] = $actionName;
        $id = MONotification::create($MONotification);

        //condition if text success
        if($vars['text'] == 'success'){
            $MobilySubscriber = MobilySubscriber::where('msisdn', $vars['msisdn'])->first();
    
            if ($MobilySubscriber) {
                $MobilySubscriber->notificationId = $id->id;
                $MobilySubscriber->status = 1;
                $MobilySubscriber->save();
            }else{
                $MobilySubscriber['msisdn'] = $vars['msisdn'];
                $MobilySubscriber['notificationId'] = $id->id;
                $MobilySubscriber['status'] = 1;
        
                MobilySubscriber::create($MobilySubscriber);
            }
        }else{
            $MobilySubscriber = MobilySubscriber::where('msisdn', $vars['msisdn'])->first();

            if ($MobilySubscriber) {
                $MobilySubscriber->status = 0;
                $MobilySubscriber->save();
            }
        }

        return json_encode($ReqResponse);
    }

    public function notificationOptOut(Request $request, $PartnerCode)
    {
        $PartnerCode = PartnerCode;

        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'msisdn' => 'required',
        ]);

        if ($validator->fails()) {
            $ReqResponse['message'] = $validator->errors();
            $ReqResponse['inError'] = 'true';
            $ReqResponse['requestId'] = 'requestId';
            $ReqResponse['code'] = 'FAIL';

            return json_encode($ReqResponse);
        }

        $headers = array(
            "Content-Type: application/json",
        );

        $vars['serviceId'] = MobilyServiceId;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['PartnerCode'] = $PartnerCode;

        // here json
        $JSON = $vars;

        $actionName = "Notification OptOut";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $vars);

        $ReqResponse['message'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['requestId'] = md5(uniqid(rand(), true));

        $MONotification['msisdn'] = $vars['msisdn'];
        $MONotification['text'] = $vars['text'];
        $MONotification['request'] = json_encode($vars);
        $MONotification['response'] = json_encode($ReqResponse);
        $MONotification['type'] = $actionName;
        $id = MONotification::create($MONotification);

        $MobilySubscriber = MobilySubscriber::where('msisdn', $vars['msisdn'])->first();
        if ($MobilySubscriber) {
            $MobilySubscriber->delete();
        }

        $MobilyUnsubscriber = MobilyUnsubscriber::where('msisdn', $vars['msisdn'])->first();

        if ($MobilyUnsubscriber) {
            $MobilyUnsubscriber->notificationId = $id->id;
            $MobilyUnsubscriber->save();
        }else{
            $MobilyUnsubscriber['msisdn'] = $vars['msisdn'];
            $MobilyUnsubscriber['notificationId'] = $id->id;
            
            MobilyUnsubscriber::create($MobilyUnsubscriber);
        }

        return json_encode($ReqResponse);
    }

    public function notificationRenewed(Request $request, $PartnerCode)
    {
        $PartnerCode = PartnerCode;

        $validator = Validator::make($request->all(), [
            'serviceId' => 'required',
            'text' => 'required',
            'msisdn' => 'required',
        ]);

        if ($validator->fails()) {
            $ReqResponse['message'] = $validator->errors();
            $ReqResponse['inError'] = 'true';
            $ReqResponse['requestId'] = 'requestId';
            $ReqResponse['code'] = 'FAIL';

            return json_encode($ReqResponse);
        }

        $headers = array(
            "Content-Type: application/json",
        );

        $vars['serviceId'] = MobilyServiceId;
        $vars['text'] = $request->text;
        $vars['msisdn'] = $request->msisdn;
        $vars['PartnerCode'] = $PartnerCode;

        // here json
        $JSON = $vars;

        $actionName = "Notification MO";
        $URL = $request->fullUrl();
        $this->log($actionName, $URL, $vars);

        $ReqResponse['message'] = 'SUCCESS';
        $ReqResponse['inError'] = 'false';
        $ReqResponse['code'] = 'SUCCESS';
        $ReqResponse['requestId'] = md5(uniqid(rand(), true));

        $MONotification['msisdn'] = $vars['msisdn'];
        $MONotification['text'] = $vars['text'];
        $MONotification['request'] = json_encode($vars);
        $MONotification['response'] = json_encode($ReqResponse);
        $MONotification['type'] = $actionName;
        $id = MONotification::create($MONotification);

        if($vars['text'] == 'success'){
            $MobilySubscriber = MobilySubscriber::where('msisdn', $vars['msisdn'])->first();
    
            if ($MobilySubscriber) {
                $MobilySubscriber->notificationId = $id->id;
                $MobilySubscriber->status = 1;
                $MobilySubscriber->save();
            }else{
                $MobilySubscriber['msisdn'] = $vars['msisdn'];
                $MobilySubscriber['notificationId'] = $id->id;
                $MobilySubscriber['status'] = 1;
        
                MobilySubscriber::create($MobilySubscriber);
            }
        }

        return json_encode($ReqResponse);
    }

}
