<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;
use App\Notify;
use App\Msisdn;
use App\AdvertisingUrl;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\GreetingimgOperator;
use DB;
use App\Generatedurl;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use App\Category;

class RotanaController extends Controller
{
    /* ------------ vival integration functions ---------------- */
    public function rotana_subscribeViva_1(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $ivas_portal_link = urlencode(SNAP_VIVA_URL);

        if (isset($_REQUEST['msisdn']) && $_REQUEST['msisdn'] != "") {
            $msisdn = $_REQUEST['msisdn'];
            $pended_url = "&msisdn=" . $msisdn;
        } else {
            $msisdn = "";
            $pended_url = "";
        }

        $URL = "http://cg.mobi-mind.net/?ID=640,db9b99b7,661,8061,3,IVAS,$ivas_portal_link$pended_url";


        // make log
        $actionName = "Viva CG Page";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL,
        );
        $this->log($actionName, $URL, $parameters_arr);

        return redirect($URL);
    }

    public function rotana_viva_login(request $request)
    {
        // make log
        $URL = \Request::fullUrl();
        $actionName = "Viva Landing Page";
        $parameters_arr = array(
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'URL' => $URL,
        );
        $this->log($actionName, $URL, $parameters_arr);


        if (isset($_REQUEST['msisdn']) && $_REQUEST['msisdn'] != "") {
            $msisdn = preg_replace('/^965/', '', $_REQUEST['msisdn']);
        } else {
            $msisdn = "";
        }

        if (isset($_REQUEST['ads']) && $_REQUEST['ads'] != "") {
            $ads = $_REQUEST['ads'];
            session(['ads' => $ads]);
        } else {
            $ads = "";
        }

        // new case after user confirms his pin and subscribe he will redirect to this link :    http://localhost:8080/urdu_php7/landing_stc?CGSTATUS=0&CGMSISDN=96551747685

        if (isset($_REQUEST['CGMSISDN']) && $_REQUEST['CGMSISDN'] != "" && isset($_REQUEST['CGSTATUS']) && $_REQUEST['CGSTATUS'] != "") {
            $CGMSISDN = $_REQUEST['CGMSISDN'];
            $CGSTATUS = $_REQUEST['CGSTATUS'];
            if ($CGSTATUS == 0 || $CGSTATUS == 5) { // Note( CGSTATUS 0 means successful subscription and CGSTATUS 5 means already sub)

                if ($CGSTATUS == 0) {
                    $action = "new_sub";
                } elseif ($CGSTATUS == 5) {
                    $action = "old_sub";
                }

                //  viva notify = all notification history
                $notify = new Notify();
                $notify->complete_url = \Request::fullUrl();
                $notify->msisdn = $CGMSISDN;
                $notify->action = $action;
                $notify->status = $CGSTATUS;
                $notify->save();

                // update my database
                // update msisdn status
                $URL = \Request::fullUrl();
                $today = date("Y-m-d");
                $time = strtotime($today);

                  // log
              $parameters_arr = array(
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'msisdn'=>$_REQUEST['CGMSISDN'] ,
                'CGSTATUS'=>$_REQUEST['CGSTATUS'],
                'status'=>$action
            );

            $actionName = "Viva notification subscribe success";
            $this->log($actionName, $URL, $parameters_arr);

                $Msisdn = Msisdn::where('msisdn', '=', $CGMSISDN)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    $Msisdn->final_status = 1;
                    $Msisdn->subscribe_date = $today;
                    $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    $Msisdn->plan = "d"; // weekly
                    $Msisdn->plan_id = 2; // prepaid
                    $Msisdn->save();
                } else {
                    $Msisdn = new Msisdn();
                    $Msisdn->final_status = 1;
                    $Msisdn->msisdn = $CGMSISDN;
                    $Msisdn->operator_id = viva_kuwait_operator_id; // viva
                    $Msisdn->ad_company = "DF";

                    $Msisdn->ooredoo_notify_id = $notify->id;
                    $Msisdn->subscribe_date = $today;
                    $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                    $Msisdn->plan = "d"; // weekly
                    $Msisdn->plan_id = 2; // prepaid
                    $Msisdn->save();

                }

                $msisdn = preg_replace('/^965/', '', $CGMSISDN);
                session(['MSISDN_VIVA' => $msisdn, 'status' => 'active']);
              // return redirect('v1/' . viva_kuwait_operator_id);
              $Url = Generatedurl::where('operator_id', viva_kuwait_operator_id)->latest()->first();
              $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
              ->where('greetingimg_operator.operator_id', '=', viva_kuwait_operator_id)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

              if ($snap) {
              return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
              } elseif( $Url) {
              return redirect(url('rotanav2/' . $Url->UID));
              }else{
                return view('landing_v2.rotana_viva_landing', compact('msisdn'));
              }



            }

        }

        return view('landing_v2.rotana_viva_landing', compact('msisdn'));
    }
    public function rotana_viva_login_action(request $request)
    {
        $msisdn = $request->input('number');
        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            $request->session()->flash('failed', 'هذا الرقم غير صحيح');
            return back();
        }


        // check subscribe
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', viva_kuwait_operator_id)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {
            session(['MSISDN_VIVA' => $msisdn, 'status' => 'active']);
            // $post = Post::where('operator_id', viva_kuwait_operator_id)->where('active', 1)->where('created_at', '<=', Carbon::now())->latest('created_at')->first();
            // if ($post) {
            //     return redirect(viva_kuwait_operator_id . '/rotanav2/' . $post->uid);
            // } else {
            //     return redirect('v1/' . viva_kuwait_operator_id);
            // }

            $Url = Generatedurl::where('operator_id', viva_kuwait_operator_id)->latest()->first();
            $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
            ->where('greetingimg_operator.operator_id', '=', viva_kuwait_operator_id)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

            if ($snap) {
            return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
            } elseif( $Url) {
              return redirect(url('rotanav2/' . $Url->UID));
              }else{
                return view('landing_v2.rotana_viva_landing', compact('msisdn'));
              }



        } else {
            return redirect(url('rotana_landing_stc_1?msisdn=965' . $msisdn));
        }
    }
    public function rotana_viva_notification(request $request)
    {

        /*
        Activation: https://rotana.digizone.com.kw/rotana_viva_notification?ChannelID=1207&ServiceID=808&User=kuwait@idex&Password=kuwait@!dex&STATUS=ACT-SB&OperatorID=41904&MSISDN=96555410856&RequestID=303263614

        First Failed billing:  https://rotana.digizone.com.kw/rotana_viva_notification?Password=kuwait@!dex&ServiceID=808&OperatorID=41904&ChannelID=1207&STATUS=FFL-BL&User=kuwait@idex&MSISDN=96555410856&RequestID=303270353

        renewal success: https://rotana.digizone.com.kw/rotana_viva_notification?Password=kuwait@!dex&ServiceID=808&OperatorID=41904&ChannelID=1207&STATUS=RSC-BL&User=kuwait@idex&MSISDN=96555410856&RequestID=303270353

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
        $STATUS = $request->input('STATUS'); // // "success" if successfully billed or "Fail"
        $message = "";

        // make check
        $ChannelID = $request->input('ChannelID');
        $ServiceID = $request->input('ServiceID');
        $User = $request->input('User');
        $Password = $request->input('Password');
        $OperatorID = $request->input('OperatorID');

        //  if ($ChannelID == SNAP_VIVA_CHANNEL_ID && $ServiceID == 808 && $User == "kuwait@idex" && $Password == "kuwait@!dex" && $OperatorID == 41904) {

        /*
        - summary :
        1- user subscribed but not billed yet   =   ACT-SB
        2-fist success billing  = FSC-BL      /   First Failed billing  =  FFL-BL
        3- renewal success   = RSC-BL
        4- BLD-SB: unsubscription

         */
        if ($STATUS == "ACT-SB" || $STATUS == "FSC-BL" || $STATUS == "RSC-BL" || $STATUS == "FFL-BL") { //  USER want to subscribe or renew
            $action = "sub";
        } else {
            $action = "usub";
        }

        $parameters_arr = array(
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'action' => $action,
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
                    $message = "first success billing";
                } elseif ($STATUS == "RSC-BL") { // First Failed billing   OR   unsubscription
                    $Msisdn->final_status = 1;
                    $message = "renewal success ";
                }

                $Msisdn->ooredoo_notify_id = $notify->id;
                $Msisdn->subscribe_date = $today;
                $Msisdn->renew_date = date("Y-m-d", strtotime("+1 day", $time));
                $Msisdn->plan = "d"; // weekly
                $Msisdn->save();
            } else {

                $Msisdn = new Msisdn();
                $Msisdn->msisdn = $msisdn;
                $Msisdn->operator_id = viva_kuwait_operator_id; // viva
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
                $Msisdn->plan = "d"; // weekly
                $Msisdn->save();
            }
        }

        $result = array();
        $result['status'] = "Success";
        $result['type'] = "viva_notification_url";
        $result['url'] = $URL;
        $result['status'] = $STATUS;
        $result['msisdn'] = $msisdn;
        $result['message'] = $message;

        return Response(array('result' => $result));
    }
    public function rotana_logout()
    {
        \Session::flush();
        return redirect('landing_viva_new');
    }
    public function rotana_viva_profile(request $request)
    {
        if (\Session::has('MSISDN') && \Session::get('MSISDN') != "") {
            $msisdn = Msisdn::where('msisdn', '=', "965" . \Session::get('MSISDN'))->where('final_status', '=', 1)->where('operator_id', '=', viva_kuwait_operator_id)->orderBy('id', 'DESC')->first();
            return view('landing_v2.rotana_viva_profile', compact('msisdn'));
        } else {
            return redirect('rotana_landing_stc');
        }

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
