<?php

namespace App\Http\Controllers;

use App\Generatedurl;
use App\Greetingimg;
use App\MONotification;
use App\OptInNotification;
use App\OptoutNotification;
use App\RenewalNotification;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Facades\File;

class MobilyksaController extends Controller
{


  public function landing_rotana_mobily_ksa()
  {

    return view('landing_v2.mobily.rotana_mobily_landing');
  }

  public function RotanaMobilyKsaSend(Request $request)
  {

    date_default_timezone_set("Africa/Cairo");
    $msisdn = $request->input('number');
    $code = 966;
    if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
      session()->flash('error', 'هذا الرقم غير صحيح');
      return back();
    }
    $URL = "http://34.77.117.25/MobilyApi/api/Subscribe/ConfirmSub/$code$msisdn/102"; // mobily
    $result = preg_replace('/\s+/', '', $this->GetPageData($URL));
    $JSON = json_decode($result);
    $JSON = $JSON->responseData->subscriptionStatus;

    $actionName = "Mobily KSA Check";
    $parameters_arr = array(
      'MSISDN' => $code.$msisdn,
      'link' => $URL,
      'date' => Carbon::now()->format('Y-m-d H:i:s'),
      'result' => $result,
    );

    $this->log($actionName, $URL, $parameters_arr);
    if (isset($JSON)) {
      if ($JSON == "CANCELED") {
        session(['MSISDN' => $msisdn, 'Status' => 'active', 'currentOp' => MOBILY_KSA_OP_ID]);
        $Url = Generatedurl::where('operator_id', MOBILY_KSA_OP_ID)->latest()->first();
        $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
          ->where('greetingimg_operator.operator_id', '=', MOBILY_KSA_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();
        if ($snap) {
          return redirect(url('rotanav2/inner/' . $snap->id . '/' . $Url->UID));
        } else {
          return redirect(url('rotanav2/' . $Url->UID));
        }
      } else {
        session()->flash('error', 'هذا الرقم غير مشترك');
        return view('landing_v2.mobily.rotana_mobily_landing');
      }
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
    return ($data);

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

}
