<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\File;

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

    public function notificationMO(Request $request, $PartnerCode)
    {
        $PartnerCode = $PartnerCode;

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

        $vars['serviceId'] = $request->serviceId;
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
        $ReqResponse['requestId'] = 'requestId';
        $ReqResponse['code'] = 'SUCCESS';

        return json_encode($ReqResponse);
    }

    public function notificationOptIn(Request $request, $PartnerCode)
    {
        $PartnerCode = $PartnerCode;

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

        $vars['serviceId'] = $request->serviceId;
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
        $ReqResponse['requestId'] = 'requestId';
        $ReqResponse['code'] = 'SUCCESS';

        return json_encode($ReqResponse);
    }

    public function notificationOptOut(Request $request, $PartnerCode)
    {
        $PartnerCode = $PartnerCode;

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

        $vars['serviceId'] = $request->serviceId;
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
        $ReqResponse['requestId'] = 'requestId';
        $ReqResponse['code'] = 'SUCCESS';

        return json_encode($ReqResponse);
    }

    public function notificationRenewed(Request $request, $PartnerCode)
    {
        $PartnerCode = $PartnerCode;

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

        $vars['serviceId'] = $request->serviceId;
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
        $ReqResponse['requestId'] = 'requestId';
        $ReqResponse['code'] = 'SUCCESS';

        return json_encode($ReqResponse);
    }

}
