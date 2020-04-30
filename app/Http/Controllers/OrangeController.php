<?php

namespace App\Http\Controllers;

use App\Bin;
use App\GreetingimgOperator;
use App\Charging;
use App\StatusChange;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;
use App\Msisdnorange;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Validator;

class OrangeController extends Controller
{

    // public function headerEnrichment(){

    //     $dateString = date('yyyy-MM-dd HH:mm:ssZ');
    //     $serviceId = ServiceId;
    //     $ServiceAPIKey = ServiceAPIKey;
    //     $ServiceAPIPassword = ServiceAPIPassword;
    //     $signature = '';

    //     $message = $serviceId . $dateString;
    //     $hash_parm1 = array(
    //         'hashedPassword' => $ServiceAPIPassword,
    //         'msgConcatenated' => $message,
    //     );
    //     $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
    //     $hash_res = json_decode($result_jsons);

    //     $this->log('headerEnrichment', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
    //     $this->log('headerEnrichment', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);
    //     $signature = $ServiceAPIKey . ":" . $hash_res->ResultCode;


    // }

    public function notificationStatuschange(Request $request){
        $vars['serviceId'] = $request->serviceId;
        $vars['subscContractId'] = $request->subscContractId;
        $vars['statusId'] = $request->statusId;
        $vars['statusChangeDesc'] = $request->statusChangeDesc;

        $validator = Validator::make($request->all(), [
            'serviceId' => 'required',
            'subscContractId' => 'required',
            'statusId' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $url = url('notificationStatuschange');

        $this->log('Notification Status Change', $url, $vars);

        StatusChange::create($vars);

        return 'success';
    }

    public function notificationRecurringPayment(Request $request){
        $vars['serviceId'] = $request->serviceId;
        $vars['msisdn'] = $request->msisdn;
        $vars['deductedAmount'] = $request->deductedAmount;

        $validator = Validator::make($request->all(), [
            'serviceId' => 'required',
            'msisdn' => 'required',
            'deductedAmount' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $url = url('notificationRecurringPayment');

        $this->log('Notification Recurring Payment', $url, $vars);

        Charging::create($vars);

        return 'success';
    }

    public function log($actionName, $URL, $parameters_arr)
    {
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
    public function get_content_post($URL, $param)
    {

        $content = json_encode($param);

//           print_r($content); die;

        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function get_content_get($URL, $param)
    {
        $ch = curl_init();
        $data = http_build_query($param);
        $getUrl = $URL . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function log_orange($actionName, $URL, $parameters_arr)
    {
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

    public function landing_orange(Request $request)
    {
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


        $country_from_ip = $this->ip_info("Visitor", "Country");
        $result['date'] = Carbon::now()->format('Y-m-d H:i:s');
        $result['ip'] = $ip;
        $result['country'] = $country_from_ip;
        $result['deviceModel'] = $deviceModel;
        $result['AllHeaders'] = $_SERVER;


        $actionName = "Orange Binary Hits";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log_orange($actionName, $URL, $parameters_arr);  // log in

        return view('front.rotanav2.orange.new_landing');
    }

    public function AddSubscriptionContractRequest_orange(Request $request)
    {
        // 012 -> 60201 orange
        $msisdn = $request->MSISDN;
        $operatorCode = operatorCode;
        // make validation for egypt numbers that start with 2
        if (!preg_match('/^(02|2)?[0-9]{11}$/', $msisdn)) {
            session()->flash('failed', 'هذا الرقم غير صحيح');
            if ($request->ajax()){
                $data['val'] = 1;
                $data['message'] = 'هذا الرقم غير صحيح';
                return json_encode($data);
            }else{
                return back();
            }
        }
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d H:i:s");
        //first time subscribe
        $URL = test_InitializeSubscribe_url;
        $startDate = $date;
        $serviceId = ServiceId;
        $language = 2;
        $message = $serviceId . $msisdn . $operatorCode . $startDate;
        $hash_parm1 = array(
            'hashedPassword' => ServiceAPIPassword,
            'msgConcatenated' => $message,
        );
        $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
        $hash_res = json_decode($result_jsons);

        $this->log('AddSubscriptionContractRequesthash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);  // log in
        $this->log('AddSubscriptionContractRequesthash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);  // log in
        $signature = ServiceAPIKey . ":" . $hash_res->ResultCode;

        $parameters_arr = array(
            'serviceId' => $serviceId,
            "msisdn" => $msisdn,
            "operatorCode" => $operatorCode,
            "initialDate" => $startDate,
            "signature" => $signature,
            "langId" => $language,
        );

        $result_json = $this->get_content_post($URL, $parameters_arr);


        $result = json_decode($result_json);

        // create a log channel
        $actionName = "AddSubscriptionContractRequest";
        $parameters_arr['msg'] = $message;
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;

        $this->log($actionName, $URL, $result_arr);  // log out


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////*pincode api*//////////////////////////////
// $pin_url = 'http://196.219.241.226:9094/DCBAPI/Subscribe/GetVerifySubscribePinCode';
// $message_pin = $serviceId.$result->SubscriptioncontractID;
//
// $hash_parm_pin = array(
//     'hashedPassword' => ServiceAPIPassword,
//     'msgConcatenated' => $message_pin,
// );
//
//
// $result_jsons_pin = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash',$hash_parm_pin);
// $hash_res_pin = json_decode($result_jsons_pin);
// $signature_pin = ServiceAPIKey . ":" . $hash_res_pin->ResultCode;
//
// $parameters_arr_pin = array(
//     'serviceId' => $serviceId,
//     "subscContractId" => $result->SubscriptioncontractID,
//     "signature" => $signature_pin,
// );
//
// $result_json_pin = $this->get_content_post($pin_url, $parameters_arr_pin);
// $result_pin = json_decode($result_json);

///////////////////////////////*end pin*//////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
        if ($result->ResultCode == 0) {
            session()->flash('success_pincode', 'من فضلك ادخل رقم ال bin code الخاص بكم');
            // insert here in our database
            $msisdndb = Msisdnorange::where('msisdn', $msisdn)->first();
            if ($msisdndb) {
                $msisdndb->msisdn = $msisdn;
                $msisdndb->status = 'active';
                $msisdndb->operatorCode = $operatorCode;
                if ($request->ajax()){
                    $msisdndb->subscribe_type = 'HE';
                }else{
                    $msisdndb->subscribe_type = 'MB';
                }
                $msisdndb->save();
            } else {
                $msisdndb = new Msisdnorange();
                $msisdndb->msisdn = $msisdn;
                $msisdndb->status = 'active';
                $msisdndb->operatorCode = $operatorCode;
                if ($request->ajax()){
                    $msisdndb->subscribe_type = 'HE';
                }else{
                    $msisdndb->subscribe_type = 'MB';
                }
                $msisdndb->save();
            }
            Session(['contract_id' => $result->SubscriptioncontractID]);

            $Msisdndb = Msisdnorange::find($msisdndb->id);
            $Msisdndb->contract_id = $result->SubscriptioncontractID;
            $Msisdndb->save();
            if ($request->ajax()){
                $data['val'] = 2;
                $data['message'] = 'من فضلك ادخل كود التاكيد';
                $returnHTML = view('front.rotanav2.orange.pinpage', compact('msisdn'))->render();
                $data['html'] = $returnHTML;
                return json_encode($data);
            }else{
                return view('front.rotanav2.orange.pinpage', compact('msisdn'));
            }
        } else if ($result->ResultCode == 72) { // MSISDN already subscriber to the service
            $msisdndb = Msisdnorange::where('msisdn', $msisdn)->first();
            if ($msisdndb) {
                $msisdndb->msisdn = $msisdn;
                $msisdndb->status = 'active';
                $msisdndb->operatorCode = $operatorCode;
                if ($request->ajax()){
                    $msisdndb->subscribe_type = 'HE';
                }else{
                    $msisdndb->subscribe_type = 'MB';
                }
                $msisdndb->save();
            } else {
                $msisdndb = new Msisdnorange();
                $msisdndb->msisdn = $msisdn;
                $msisdndb->status = 'active';
                $msisdndb->operatorCode = $operatorCode;
                if ($request->ajax()){
                    $msisdndb->subscribe_type = 'HE';
                }else{
                    $msisdndb->subscribe_type = 'MB';
                }
                $msisdndb->save();
            }
            session::put(['phone_number' => $msisdn, 'status' => 'active']);

            session()->flash('success', 'مرحبا');
            if ($request->ajax()){
                $data['val'] = 4;
                $data['message'] = session::get('rotana_UID');
                return json_encode($data);
            }else{
                return redirect(session::get('rotana_UID'));  // old confirm
            }
        } else {
            session()->flash('failed', 'برجاء المحاولة في وقت لاحق');
            if ($request->ajax()){
                $data['val'] = 5;
                $data['message'] = 'برجاء المحاولة في وقت لاحق';
                return json_encode($data);
            }else{
                return back();
            }
        }
    }

    public function ConfirmPinCode_orange(Request $request)
    {
        $pinCode = $request->pincode;
        $msisdn = $request->msisdn;

        // date_default_timezone_set("Africa/Cairo");
        // $msisdn = $request->msisdn;

        if (!preg_match('/^(02|2)?[0-9]{11}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.pinCode', compact('msisdn'));
        }


        $URL = test_VerifySubscribe_url;
        $SubscriptioncontractID = Session::get('contract_id');


        $serviceId = ServiceId;
        $language = 2;

        $message = $serviceId . $SubscriptioncontractID . $pinCode;

        $hash_parm1 = array(
            'hashedPassword' => ServiceAPIPassword,
            'msgConcatenated' => $message,
        );


        $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
        $hash_res = json_decode($result_jsons);
        $this->log('ConfirmPinCodehash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);  // log in
        $this->log('ConfirmPinCodehash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);  // log in
        $signature = ServiceAPIKey . ":" . $hash_res->ResultCode;


        $parameters_arr = array(
            'serviceId' => $serviceId,
            "subscContractId" => $SubscriptioncontractID,
            "pinCode" => $pinCode,
            "signature" => $signature,
            "langId" => $language,
        );
        $result_json = $this->get_content_post($URL, $parameters_arr);
        $result = json_decode($result_json);

        $actionName = "VerifySubscriptionContract";
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;
        $this->log($actionName, $URL, $result_arr);  // log out

        $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
            ->orderBy('id', 'desc')->first();

        if ($result->ResultCode == 0) {

            $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
                ->orderBy('id', 'desc')
                ->first();

            // update msisdn status
            $operatorCode = $Msisdn->operatorCode;
            $Msisdn->status = "active";
            $Msisdn->pincode = $pinCode;
            $Msisdn->save();

            // create bin for this msisdn
            $bin = new Bin();
            $bin->msisdn_id = $Msisdn->id;
            $bin->bin = $pinCode;
            $bin->save();

            session([
                'contract_id' => Session::get('contract_id'),
                'phone_number' => $Msisdn->msisdn,
                'pincode' => $Msisdn->pincode,
                'status' => 'active'
            ]);

            // $this->InitializeDirectPay();

            $link = url("loginPC") . "/" . $Msisdn->msisdn . "/" . $bin->bin;
            session()->flash('success', 'لقد تم الاشتراك بنجاح');

            return redirect(session::get('rotana_UID'));


        } else if ($result->ResultCode == 62) {
            session()->flash('failed', 'رقم التحقق غير صحيح');
            return view('front.rotanav2.orange.pinpage', compact('msisdn'));
        } else {
            session()->flash('failed', 'برجاء المحاولة وقت لاحق');
            return view('front.rotanav2.orange.pinpage', compact('msisdn'));
        }

    }

    public function InitializeDirectPay()
    {

        $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
            ->orderBy('id', 'desc')
            ->first();

        // update msisdn status
        $operatorCode = $Msisdn->operatorCode;
        $msisdn = $Msisdn->msisdn;


        if (!preg_match('/^(02|2)?[0-9]{11}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return view('front.rotanav2.orange.pinpage', compact('msisdn'));
        }


        $URL = test_InitializeDirectPay_url;

        $serviceId = ServiceId;

        $message = $serviceId . $msisdn . $operatorCode;

        $hash_parm1 = array(
            'hashedPassword' => ServiceAPIPassword,
            'msgConcatenated' => $message,
        );


        $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
        $hash_res = json_decode($result_jsons);
        $this->log('InitializeDirectPayhash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);  // log in
        $this->log('InitializeDirectPayhash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);  // log in
        $signature = ServiceAPIKey . ":" . $hash_res->ResultCode;

        $parameters_arr = array(
            'serviceId' => $serviceId,
            "msisdn" => $msisdn,
            "operatorCode" => $operatorCode,
            "signature" => $signature,
        );
        $result_json = $this->get_content_post($URL, $parameters_arr);
        $result = json_decode($result_json);


        $actionName = "InitializeDirectPay";
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;
        $this->log($actionName, $URL, $result_arr);  // log out


        if ($result->ResultCode == 0) {

            $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
                ->orderBy('id', 'desc')
                ->first();

            // update msisdn status
            // $Msisdn->status = "active";
            $Msisdn->transaction_id = $result->TransactionId;
            $Msisdn->save();

            session([
                'contract_id' => Session::get('contract_id'),
                'TransactionId' => $result->TransactionId,
            ]);

            // confim pay
            // $this->ConfirmeDirectPay();


        } else {
            session()->flash('failed', $result->ResultCode);
            return view('front.rotanav2.orange.pinpage', compact('msisdn'));
        }

    }

    public function ConfirmeDirectPay(Request $request)
    {

        $URL = test_ConfirmeDirectPay_url;

        $serviceId = ServiceId;
        $transaction_id = Session::get('TransactionId');
        $pinCode = $request->pincode;
        // $pincode = "148776";

        $message = $serviceId . $transaction_id . $pinCode;

        $hash_parm1 = array(
            'hashedPassword' => ServiceAPIPassword,
            'msgConcatenated' => $message,
        );


        $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
        $hash_res = json_decode($result_jsons);
        $this->log('AddpayRequest', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);  // log in
        $this->log('AddpayRequest', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);  // log in
        $signature = ServiceAPIKey . ":" . $hash_res->ResultCode;

        $parameters_arr = array(
            'serviceId' => $serviceId,
            "transactionId" => $transaction_id,
            "pinCode" => $pinCode,
            "signature" => $signature,
        );
        $result_json = $this->get_content_post($URL, $parameters_arr);
        $result = json_decode($result_json);


        $actionName = "ConfirmeDirectPay";
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;
        $this->log($actionName, $URL, $result_arr);  // log out


        if ($result->ResultCode == 0) {

            $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
                ->orderBy('id', 'desc')
                ->first();

            // update msisdn status
            $Msisdn->status = "active";
            $Msisdn->final_status = "1";
            $Msisdn->save();

        } else {
            session()->flash('failed', $result->ResultCode);
            return view('front.rotanav2.orange.pinpage', compact('msisdn'));
        }


    }

    public function unsub_or()
    {
        Session::forget('contract_id'); // to remove any contract_id from session

        return view('front.rotanav2.orange.unsub');

    }

    public function unSubscribe_orange(Request $request)
    {

        $phone_number = $request->MSISDN;

        if (!preg_match('/^[0-9]{11}$/', $phone_number)) {
            session()->flash('failed', 'هذا الرقم غير صحيح');
            return redirect()->back();
        }

        $msisdn = Msisdnorange::where('msisdn', $phone_number)->where('status', 'active')->orderBy('id', 'DESC')->first();
        if ($msisdn) {
            $SubscriptioncontractID = $msisdn->contract_id;
        } else {
            session()->flash('failed', "هذا الرقم غير مسجل بالخدمة");
            return redirect()->back();
        }


        $URL = test_UnSubscribe_url;
        session(['phone_number' => $phone_number]);

        $serviceId = ServiceId;

        $message = $serviceId . $SubscriptioncontractID;

        $hash_parm1 = array(
            'hashedPassword' => ServiceAPIPassword,
            'msgConcatenated' => $message,
        );


        $result_jsons = $this->get_content_get('http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);
        $hash_res = json_decode($result_jsons);
        $this->log('unSubscribehash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', $hash_parm1);  // log in
        $this->log('unSubscribehash', 'http://196.219.241.226:9094/DCBAPI/KeyGenerator/GenerateHash', (array)$hash_res);  // log in
        $signature = ServiceAPIKey . ":" . $hash_res->ResultCode;

        $parameters_arr = array(
            'serviceId' => $serviceId,
            "subscContractId" => $SubscriptioncontractID,
            "signature" => $signature,
        );
        $result_json = $this->get_content_post($URL, $parameters_arr);
        $result = json_decode($result_json);

        $actionName = "unSubscribe";
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;
        $this->log($actionName, $URL, $result_arr);  // log out
        if ($result->ResultCode == 0) {  // success

            $Msisdn = Msisdnorange::where('contract_id', Session::get('contract_id'))
                ->orderBy('id', 'desc')
                ->first();

            if ($Msisdn) {
                // update msisdn status
                $Msisdn->status = "inactive";
                $Msisdn->save();

                session(['contract_id' => $result->SubscriptioncontractID]);
                session()->flash('failed', 'تم الغاء الاشتراك');

                return redirect("orange_landing");
            }
        } else if ($result->ResultCode == 72) { // MSISDN already un subscriber to the service

            $Msisdn = Msisdnorange::where('contract_id', $SubscriptioncontractID)
                ->orderBy('id', 'desc')
                ->first();

            if ($Msisdn) {
                // update msisdn status

                $Msisdn->status = "inactive";

                $Msisdn->save();

                session(['contract_id' => $result->SubscriptioncontractID]);
                session()->flash('failed', 'تم الغاء الاشتراك');
               return redirect("orange_landing");
            }
        } else {
            session()->flash('failed', 'حدث خطأ ما');
            return redirect("orange_landing");
        }

        redirect()->back();
    }
}

