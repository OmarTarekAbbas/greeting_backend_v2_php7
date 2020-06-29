<?php

namespace App\Http\Controllers;

use App\AdvertisingUrl;
use App\Generatedurl;
use App\Greetingimg;
use App\Msisdn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class KsaController extends Controller
{
    // Zain ksa integration

    public function landing_rotana_zain_ksa(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');

        if (isset($_SERVER['HTTP_MSISDN'])) { // old HE
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }

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

        $company = $this->detectCompnay();

        $country_from_ip = $this->ip_info("Visitor", "Country");
        $result['date'] = Carbon::now()->format('Y-m-d H:i:s');
        $result['ip'] = $ip;
        $result['country'] = $country_from_ip;
        $result['HeadeEnriched'] = $MSISDN;
        $result['adsCompnayName'] = $company;
        $result['deviceModel'] = $deviceModel;
        //  $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page ZAIN KSA";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);

        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = ZAIN_OP_ID; // ZAIN KSA
        $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->transaction_id = $transaction_id; // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro; // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company; //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.ksa.zain.rotana_zain_landing', compact('MSISDN'));
    }

    public function RotanaZainKsaPinCodeSend(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }
        $company = $this->detectCompnay();
        // check status on Arpu
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/getSubscriberStatus?msisdn=$msisdn_wcc&servId=706"; // ZAIN

        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "ZAIN KSA Check Status On Arpu DB";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', ZAIN_OP_ID)->orderBy('id', 'DESC')->first();

        if ($result == "Active") {
            //session()->flash('error', 'هذا الرقم مشرك بالفعل');
            // return back();

            // check status for zain

            //   if ($Msisdn && $Msisdn->final_status == 1) {
            //  session()->flash('failed', 'انت مشترك بالفعل');
            // return back();
            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => ZAIN_OP_ID]);
            $Url = Generatedurl::where('operator_id', ZAIN_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', ZAIN_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }
            // }

        }

        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn_wcc;
        $AdvertisingUrl->operatorId = ZAIN_OP_ID;
        $AdvertisingUrl->status = 2; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->operatorName = "zain_ksa";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== null && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();

        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = $msisdn_wcc;
        }

        $Msisdn->ad_company = $company;
        $Msisdn->operator_id = ZAIN_OP_ID; // ZAIN ksa
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== null && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();

        //  ZAIN KSA send Pincode
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=$msisdn_wcc&serv=d";
        //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "ZAIN KSA Pincode Send";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        if ($result == "7" || $result == "1") { // pincode send successfully  // 7 : the number is new on Arpu   1 : the number is saved in DB on Arpu
            return view('landing_v2.ksa.zain.zain_ksa_pinCode', compact('msisdn'));
        } elseif ($result == "Aninternalservererroroccurs.") {
            $request->session()->flash('failed', 'An internal server error occurs');
            $MSISDN = $msisdn;
            return view('landing_v2.ksa.zain.rotana_zain_landing', compact('msisdn'));

        } else { // error
            $request->session()->flash('failed', 'pincode send is failed');
            $MSISDN = $msisdn;
            return view('landing_v2.ksa.zain.rotana_zain_landing', compact('msisdn'));
        }
    }

    public function rotana_zain_ksa_pincode_confirm(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');
        $MSISDN = $msisdn;
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.ksa.zain.zain_ksa_pinCode', compact('msisdn'));
        }

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', ZAIN_OP_ID)->orderBy('id', 'DESC')->first();

        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = $msisdn_wcc;
            $Msisdn->operator_id = ZAIN_OP_ID;
        }

        //   if ($Msisdn) {

        //  ZAIN KSA verify pincode
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=$msisdn_wcc&serv=d&pincode=$pincode"; // ZAIN
        //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "ZAIN KSA Pincode verify";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        if ($result == "0") { // pincode verify success and the user is now subscribe
            //update my database
            $AdvertisingUrl = new AdvertisingUrl();
            $AdvertisingUrl->adv_url = session::get('adv_params');
            $AdvertisingUrl->msisdn = $msisdn_wcc;
            $AdvertisingUrl->operatorId = ZAIN_OP_ID;
            $AdvertisingUrl->status = 3; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
            $AdvertisingUrl->operatorName = "zain_ksa";
            $AdvertisingUrl->ads_compnay_name = $company;
            if (session::get('publisherId_macro') !== null && session::get('publisherId_macro') != "") {
                $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                $AdvertisingUrl->transaction_id = session::get('transaction_id');
            }
            $AdvertisingUrl->save();

            // update msisdn
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== null && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->final_status = 1;
            $Msisdn->save();

            // make log
            $actionName = "ZAIN KSA pincode Verify Success";
            $URL = $ADV_URL;
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
            );
            $this->log($actionName, $URL, $parameters_arr);

            // update intech
            if ($company == "intech") { // intech integration
                // call intech  api to notify that msisdn is subscribe successfully
                $ADV_URL = "http://ict.intech-mena.com/Universal/v2.0/API/Postback?msisdn=" . $msisdn_wcc . "&operaterName=zain_ksa&operatorId=16&" . session::get('adv_params');
                $adv_result = $this->GetPageData($ADV_URL);
                $adv_result = (array) json_decode($adv_result);

                if ($adv_result['UET Offer Log'] == "SUCCESS") {
                    $AdvertisingUrl = new AdvertisingUrl();
                    $AdvertisingUrl->adv_url = session::get('adv_params');
                    $AdvertisingUrl->msisdn = $msisdn;
                    $AdvertisingUrl->operatorId = ZAIN_OP_ID;
                    $AdvertisingUrl->status = 4; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                    $AdvertisingUrl->operatorName = "zain_ksa";
                    $AdvertisingUrl->ads_compnay_name = $company;
                    $AdvertisingUrl->save();

                    // make log
                    $company = $this->detectCompnay();
                    $actionName = "Intech ZAIN KSA Subscribe Success";
                    $URL = $ADV_URL;
                    $parameters_arr = array(
                        'MSISDN' => $msisdn_wcc,
                        'link' => $ADV_URL,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'result' => $adv_result,
                    );
                    $this->log($actionName, $URL, $parameters_arr);
                }
            }

            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => ZAIN_OP_ID]);
            $Url = Generatedurl::where('operator_id', ZAIN_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', ZAIN_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        } elseif ($result == "Theproducthasbeensubscribed.") { // alreday subscribe
            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => ZAIN_OP_ID]);
            $Url = Generatedurl::where('operator_id', ZAIN_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', ZAIN_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        } else {
            $request->session()->flash('failed', 'pincode verified failed');
            return view('landing_v2.ksa.zain.zain_ksa_pinCode', compact('msisdn'));
        }

        // }else {
        //         $request->session()->flash('failed', 'pincode verified failed');
        //         return view('landing_v2.ksa.zain.zain_ksa_pinCode', compact('msisdn'));
        //     }

    }

    public function RotanaZainKsaUnsub()
    {
        return view('landing_v2.ksa.zain.cancel');
    }

    public function RotanaZainKsaUnsubAction(Request $request)
    {
        $messidn = zain_ksa_prefix . $request->number;
        //  $url = 'http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=' . $messidn . '&serv=f&action=unsub'; // Mobily
        $url = 'http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=' . $messidn . '&serv=f&action=unsub'; // zain saudi
        //   $result = preg_replace('/\s+/', '', file_get_contents($url));
        $result = preg_replace('/\s+/', '', $this->GetPageData($url));

        $company = $this->detectCompnay();
        $actionName = "Zain Ksa Unsub";
        $parameters_arr = array(
            'MSISDN' => $messidn,
            'link' => $url,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $url, $parameters_arr);

        if ($result == '0') {
            $msisdn = Msisdn::where('msisdn', $messidn)->orderBy('id', 'Desc')->first();
            if ($msisdn) {
                $msisdn->final_status = 0;
                $msisdn->save();
            }
            Session::flash('success', 'لقد تم الغاء اشتراكك بنجاح');
        } else {
            Session::flash('failed', 'حدث مشكلة اثناء العملية من فضلك ادخل الرقم مرة اخرى');
        }
        return back();
    }

    // ZAIN ksa integration
    public function landing_stc_ksa(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');

        if (isset($_SERVER['HTTP_MSISDN'])) { // old HE
            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $MSISDN = "";
        }

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
        $actionName = "Hit page STC KSA";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);

        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = STC_OP_ID; // STC KSA
        $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->transaction_id = $transaction_id; // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro; // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company; //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.ksa.stc.rotana_stc_landing', compact('MSISDN'));
    }

    public function landing_rotana(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');

        // make log with all parameters
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

        // make log for views
        if($request->ajax()){
            $actionName = "Landing Rotana Views";
            $URL = $request->fullUrl();
            $parameters_arr = $result;
            $this->log($actionName, $URL, $parameters_arr);
            return 'done';
        }
        // make log
        $actionName = "Landing Rotana";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);

        return view('landing_v2.landing_rotana');
    }

    public function RotanaStcKsaPinCodeSend(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }
        $company = $this->detectCompnay();
        // check status on Arpu
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/getSubscriberStatus?msisdn=$msisdn_wcc&servId=715"; // STC
        //  $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "STC KSA Check Status On Arpu DB";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', STC_OP_ID)->orderBy('id', 'DESC')->first();

        if ($result == "Active") {

            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => STC_OP_ID]);
            $Url = Generatedurl::where('operator_id', STC_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', STC_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        }

        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn_wcc;
        $AdvertisingUrl->operatorId = STC_OP_ID;
        $AdvertisingUrl->status = 2; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->operatorName = "stc_ksa";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== null && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();

        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = $msisdn_wcc;
        }

        $Msisdn->ad_company = $company;
        $Msisdn->operator_id = STC_OP_ID; // STC ksa
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== null && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();

        //  STC KSA send Pincode
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/KSAIntegrationAPI?msisdn=$msisdn_wcc&serviceID=715";
        //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "STC KSA Pincode Send";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        if ($result == "7" || $result == "1" ) {
            // pincode send successfully  // 7 : the number is new on Arpu   1 : the number is saved in DB on Arpu
            return view('landing_v2.ksa.stc.stc_ksa_pinCode', compact('msisdn'));
        } else { // error
            $request->session()->flash('failed', 'pincode send is failed');
            $MSISDN = $msisdn;
            return view('landing_v2.ksa.stc.rotana_stc_landing', compact('MSISDN'));
        }
    }

    public function rotana_stc_ksa_pincode_confirm(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');
        $MSISDN = $msisdn;
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.ksa.stc.stc_ksa_pinCode', compact('msisdn'));
        }

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', STC_OP_ID)->orderBy('id', 'DESC')->first();

        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = $msisdn_wcc;
            $Msisdn->operator_id = STC_OP_ID;
        }

        //  STC KSA verify pincode
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/KSAIntegrationAPI?msisdn=$msisdn_wcc&serviceID=715&pincode=$pincode"; // STC
        //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL));

        // make log
        $company = $this->detectCompnay();
        $actionName = "STC KSA Pincode verify";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $URL, $parameters_arr);

        if ($result == "0") { // pincode verify success and the user is now subscribe
            //update my database
            $AdvertisingUrl = new AdvertisingUrl();
            $AdvertisingUrl->adv_url = session::get('adv_params');
            $AdvertisingUrl->msisdn = $msisdn_wcc;
            $AdvertisingUrl->operatorId = STC_OP_ID;
            $AdvertisingUrl->status = 3; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
            $AdvertisingUrl->operatorName = "stc_ksa";
            $AdvertisingUrl->ads_compnay_name = $company;
            if (session::get('publisherId_macro') !== null && session::get('publisherId_macro') != "") {
                $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                $AdvertisingUrl->transaction_id = session::get('transaction_id');
            }
            $AdvertisingUrl->save();

            // update msisdn
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== null && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->final_status = 1;
            $Msisdn->save();

            // make log
            $actionName = "STC KSA Pincode Verify Success" ;
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
            );
            $this->log($actionName, $URL, $parameters_arr);

            // update intech
            if ($company == "intech") { // intech integration
                // call intech  api to notify that msisdn is subscribe successfully
                $ADV_URL = "http://ict.intech-mena.com/Universal/v2.0/API/Postback?msisdn=" . $msisdn_wcc . "&operaterName=zain_ksa&operatorId=16&" . session::get('adv_params');
                $adv_result = $this->GetPageData($ADV_URL);
                $adv_result = (array) json_decode($adv_result);

                if ($adv_result['UET Offer Log'] == "SUCCESS") {
                    $AdvertisingUrl = new AdvertisingUrl();
                    $AdvertisingUrl->adv_url = session::get('adv_params');
                    $AdvertisingUrl->msisdn = $msisdn_wcc;
                    $AdvertisingUrl->operatorId = STC_OP_ID;
                    $AdvertisingUrl->status = 4; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                    $AdvertisingUrl->operatorName = "stc_ksa";
                    $AdvertisingUrl->ads_compnay_name = $company;
                    $AdvertisingUrl->save();

                    // make log
                    $company = $this->detectCompnay();
                    $actionName = "Intech STC KSA Subscribe Success";
                    $URL = $ADV_URL;
                    $parameters_arr = array(
                        'MSISDN' => $msisdn_wcc,
                        'link' => $ADV_URL,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'result' => $adv_result,
                    );
                    $this->log($actionName, $URL, $parameters_arr);
                }
            }

            // Redirect to Stc content page
            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => STC_OP_ID]);
            $Url = Generatedurl::where('operator_id', STC_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', STC_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        } elseif ($result == "Theproducthasbeensubscribed.") { // alreday subscribe
            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => STC_OP_ID]);
            $Url = Generatedurl::where('operator_id', STC_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', STC_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }

        } else {
            $request->session()->flash('failed', 'pincode verified failed');
            return view('landing_v2.ksa.stc.stc_ksa_pinCode', compact('msisdn'));
        }

    }


    public function stc_ksa_login()
    {

        // Redirect to Stc content page
        $msisdn = "559209701" ;
            session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => STC_OP_ID]);
            $Url = Generatedurl::where('operator_id', STC_OP_ID)->latest()->first();

            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                ->where('greetingimg_operator.operator_id', '=', STC_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
                return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } else {
                return redirect(url('rotanav2/' . $Url->UID));
            }
    }

    public function RotanaStcKsaUnsub()
    {
        return view('landing_v2.ksa.stc.cancel');
    }

    public function RotanaStcKsaUnsubAction(Request $request)
    {
        $messidn = zain_ksa_prefix . $request->number;
        $url = 'http://smsgisp.eg.mobizone.mobi/gisp-admin/KSAIntegrationAPI?msisdn=' . $messidn . '&serviceID=715&action=unsub'; // STC KSA

        //   $result = preg_replace('/\s+/', '', file_get_contents($url));
        $result = preg_replace('/\s+/', '', $this->GetPageData($url));

        $company = $this->detectCompnay();
        $actionName = "Rotana STC Ksa Unsub";
        $parameters_arr = array(
            'MSISDN' => $messidn,
            'link' => $url,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result,
        );
        $this->log($actionName, $url, $parameters_arr);

        if ($result == '0') {
            $msisdn = Msisdn::where('msisdn', $messidn)->orderBy('id', 'Desc')->first();
            if ($msisdn) {
                $msisdn->final_status = 0;
                $msisdn->save();
            }
            Session::flash('success', 'لقد تم الغاء اشتراكك بنجاح');
        } else {
            Session::flash('failed', 'حدث مشكلة اثناء العملية من فضلك ادخل الرقم مرة اخرى');
        }
        return back();
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

}
