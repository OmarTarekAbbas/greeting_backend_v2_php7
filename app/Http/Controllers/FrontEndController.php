<?php

namespace App\Http\Controllers;

use App\GreetingimgOperator;
use DB;
use App\Generatedurl;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use App\Category;
use App\Processedimg;
use App\Processedvid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\rbtCode;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;
use App\Notify;
use App\Msisdn;
use App\AdvertisingUrl;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class FrontEndController extends Controller
{

    public $front_view = "front.";
    // --------------Live -----------------//
    private $privateKey = "6g8UUH6mlUilXpOSssp8";
    private $publicKey = "fhCP5KoWwDET9G9N9odF";
    private $subscriptionPlanId = 514;
    private $service_name = "yallawaffar";
    public $customerAccountNumber = "customer159635721";
    private $status = "live";

    public function getMediaType($UID)
    {

        $urlDetect = Generatedurl::where('UID', $UID)->get();
        if ($urlDetect->isEmpty()) {
            return view('front.error');
        } else {

            return view('front.chooseVideo');
        }
    }

    public function ShowImages(Request $request, $UID)
    {

        $url = Generatedurl::where('UID', $UID)->first();
        if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
            if ($request->has("SearchKey")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->where('title', 'like', "%$request->SearchKey%")->get();
            } elseif ($request->has("featured")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->where('featured', 1)->get();
            } elseif ($request->has("recent")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->orderBy('created_at', 'desc')->get();
            } elseif ($request->has("popular")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->orderBy('popular_count', 'desc')->get();
            }
            $occasions_array = [];
            foreach ($greetingImgs as $img) {
                array_push($occasions_array, $img->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $occasions[$k] = Occasion::where('id', $occasion)->first();
            }
            return view('front.greetingImg', compact('occasions', 'greetingImgs'));
        } else {
//images inside operator
            $greetingImgs = $url->operator->greetingimgs()->published()->get();
//dd($greetingImgs->with('occasion')->get());
            $occasion_id = $url->occasion_id;

//images belonging to a certain occasion in the specified operator
            $greetingImgsForOcc = $url->operator->greetingimgs()->publishedocc($url->occasion_id)->get();

//            if ($greetingImgsForOcc->isEmpty()) {
            if ($url->img != 1) {
                return view('front.greetingImg', compact('greetingImgs'));
            } else {

//get occasion for each image
                $occasions_array = [];
                foreach ($greetingImgs as $img) {
                    if ($url->video === 1) {
                        $Occasions = Occasion::find($img->occasion->id)->greetingaudios()->published()->count();
                        if ($Occasions == 0) {

                        } else {
                            array_push($occasions_array, $img->occasion);
                        }
                    } else {
                        array_push($occasions_array, $img->occasion);
                    }
                }
//convert array to laravel collection
                $occasions_coll = Collection::make($occasions_array);
                $occasions = $occasions_coll->unique();

//get the default occasion from url
                $default = $url->occasion_id;
                return view('front.greetingImg', compact('occasions', 'default', 'greetingImgsForOcc', 'greetingImgs', 'url'));
            }
        }
    }

    public function ShowVideos(Request $request, $UID)
    {
        $url = Generatedurl::where('UID', $UID)->first();
        if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
            if ($request->has("SearchKey")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->where('title', 'like', "%$request->SearchKey%")->get();
            } elseif ($request->has("featured")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->where('featured', 1)->get();
            } elseif ($request->has("recent")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->orderBy('created_at', 'desc')->get();
            } elseif ($request->has("popular")) {
                $greetingImgs = $url->operator->greetingimgs()->published()->orderBy('popular_count', 'desc')->get();
            }
            $occasions_array = [];
            foreach ($greetingImgs as $img) {
                if ($url->video === 1) {
                    $Occasions = Occasion::find($img->occasion->id)->greetingaudios()->published()->count();
                    if ($Occasions == 0) {

                    } else {
                        array_push($occasions_array, $img->occasion_id);
                    }
                } else {
                    array_push($occasions_array, $img->occasion_id);
                }
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $occasions[$k] = Occasion::where('id', $occasion)->first();
            }
            return view('front.greetingVideo', compact('occasions', 'greetingImgs'));
        } else {
//images inside operator
            $greetingImgs = $url->operator->greetingimgs()->published()->get();
//dd($greetingImgs->with('occasion')->get());
            $occasion_id = $url->occasion_id;

//images belonging to a certain occasion in the specified operator
            $greetingImgsForOcc = $url->operator->greetingimgs()->publishedocc($url->occasion_id)->get();

            if ($greetingImgsForOcc->isEmpty()) {
                return view('front.greetingVideo', compact('greetingImgs'));
            } else {

//get occasion for each image
                $occasions_array = [];
                foreach ($greetingImgs as $img) {
                    if ($url->video === 1) {
                        $Occasions = Occasion::find($img->occasion->id)->greetingaudios()->published()->count();
                        if ($Occasions == 0) {

                        } else {
                            array_push($occasions_array, $img->occasion);
                        }
                    } else {
                        array_push($occasions_array, $img->occasion);
                    }
                }
//convert array to laravel collection
                $occasions_coll = Collection::make($occasions_array);
                $occasions = $occasions_coll->unique();

//get the default occasion from url
                $default = $url->occasion_id;

                $greetingAudiosForOcc = $url->operator->greetingaudios()->publishedocc($default)->get();
//return $greetingAudiosForOcc;
                if ($greetingAudiosForOcc->isEmpty()) {
                    return view('front.greetingVideo', compact('greetingImgs', 'greetingAudiosForOcc'));
                } else {

//get provider for each audio
                    $providers_array = [];
                    foreach ($greetingAudiosForOcc as $greetingAudio) {
                        array_push($providers_array, $greetingAudio->cprovider);
                    }
//convert array to laravel collection
                    $providers_coll = Collection::make($providers_array);
                    $providers = $providers_coll->unique();
//return $providers;
//get audios for first provider in list
                    $firstProvider = $providers->first()->id;
                    $greetingAudiosForOccProv = $url->operator->greetingaudios()->publishedocc($default)
                        ->where('cprovider_id', $firstProvider)
                        ->get();
//return $firstProvider;
                    return view('front.greetingVideo', compact('occasions', 'default', 'greetingImgsForOcc', 'greetingImgs', 'greetingAudiosForOccProv', 'greetingAudiosForOcc', 'url', 'providers'));

// if audio
                }
            }
        }
    }

    public function InputImage($image_id, $UID)
    {
        return view('front.input_image', compact('UID', 'image_id'));
    }

    public function InputVideo($image_id, $UID)
    {
        $image = Greetingimg::Find($image_id);
        $operator_id = OP();
        $occasion_id = $image->occasion_id;
//choose provider for default occasion
        $greetingAudiosForOcc = Operator::find($operator_id)->greetingaudios()->published()->where('occasion_id', $occasion_id)->get();
//return $greetingAudiosForOcc;
//get provider for each audio
        $providers_array = [];
        foreach ($greetingAudiosForOcc as $greetingAudio) {
            array_push($providers_array, $greetingAudio->cprovider);
        }
//convert array to laravel collection
        $providers_coll = Collection::make($providers_array);
        $providers = $providers_coll->unique();

        return view('front.input_video', compact('UID', 'image', 'providers'));
    }

    public function getAudiosForProvider()
    {
        $operator_id = $_GET['operator_id'];
        $occasion_id = $_GET['occasion_id'];
        $cprovider_id = $_GET['cprovider_id'];
        $greetingAudiosForOccProv = Operator::find($operator_id)->greetingaudios()->published()
            ->where('occasion_id', $occasion_id)
            ->where('cprovider_id', $cprovider_id)
            ->get();
//return $greetingAudiosForOccProv;
        return view('front._greetingAudios', compact('greetingAudiosForOccProv'));
    }

    public function processImage(Request $request, $UID)
    {

        $image_id = $request->input('image');
        $text = $request->input('name');

        $IncludeGreeting = new GprocessorController();
        $Response = $IncludeGreeting->ArabicGreetingProcessor($image_id, $text);
// return $Response;
        return view('front.item_image', compact('Response'));
    }

    public function processVideo(Request $request, $UID)
    {

        $image_id = $request->input('image');
        $text = $request->input('name');
        $audio_id = $request->input('audio');

        $IncludeGreeting = new GprocessorController();
        $Response = $IncludeGreeting->VideoProcessor($image_id, $audio_id, 'ar', $text);
//return $Response;
        return view('front.item_video', compact('Response'));
    }

    public function viewImg($FID)
    {
        $greeting = Processedimg::where('FID', $FID)->firstOrFail();
        $this->popularCount('greetingimgs', $greeting->greetingimg_id);
        return response()->download($greeting->path);
//return 'success';
    }

    public function viewVid($FID)
    {
        $greeting = Processedvid::where('FID', $FID)->firstOrFail();
        $this->popularCount('greetingimgs', $greeting->greetingimg_id);
        return response()->download($greeting->path);
//return 'success';
    }

    public function error()
    {
        return view('front.error');
    }

    public function chooseImgVid()
    {
        return view('greeting.chooseVideo');
    }

    public function popularCount($table, $ID)
    {
        DB::table($table)
            ->where('id', $ID)
            ->increment('popular_count');
    }

    public function PublishedRbt(Request $request, $UID)
    {
        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url))
            return view('front.error');
        if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
            if ($request->has("SearchKey")) {
                $Rdata = $url->operator->greetingaudios()->PublishedRbt()->where('title', 'like', "%$request->SearchKey%")->get();
            } elseif ($request->has("featured")) {
                $Rdata = $url->operator->greetingaudios()->PublishedRbt()->where('featured', 1)->get();
            } elseif ($request->has("recent")) {
                $Rdata = $url->operator->greetingaudios()->PublishedRbt()->orderBy('created_at', 'desc')->get();
            } elseif ($request->has("popular")) {
                $Rdata = $url->operator->greetingaudios()->PublishedRbt()->orderBy('popular_count', 'desc')->get();
            }
        } else {
            $Rdata = $url->operator->greetingaudios()->PublishedRbt()->get();
        }
        if ($Rdata->isEmpty()) {
            return view('front.rbts', compact('Rdata'));
        }
        $rbt_sms = $url->operator->rbt_sms;
        $occasions_array = [];
        $codes = [];
        foreach ($Rdata as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
            $codes[$key] = rbtCode::where('audio_id', $value->id)->where('operator_id', OP())->first()->code;
        }
        $occasions_array = array_unique($occasions_array);
        foreach ($occasions_array as $k => $occasion) {
            $occasions[$k] = Occasion::where('id', $occasion)->first();
        }
        return view('front.rbts', compact('occasions', 'Rdata', 'rbt_sms', 'codes'));
    }

    public function PublishedNotification(Request $request, $UID)
    {
        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url))
            return view('front.error');
        if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
            if ($request->has("SearchKey")) {
                $Rdata = $url->operator->greetingaudios()->PublishedNotification()->where('title', 'like', "%$request->SearchKey%")->get();
            } elseif ($request->has("featured")) {
                $Rdata = $url->operator->greetingaudios()->PublishedNotification()->where('featured', 1)->get();
            } elseif ($request->has("recent")) {
                $Rdata = $url->operator->greetingaudios()->PublishedNotification()->orderBy('created_at', 'desc')->get();
            } elseif ($request->has("popular")) {
                $Rdata = $url->operator->greetingaudios()->PublishedNotification()->orderBy('popular_count', 'desc')->get();
            }
        } else {
            $Rdata = $url->operator->greetingaudios()->PublishedNotification()->get();
        }
        if ($Rdata->isEmpty()) {
            return view('front.notification', compact('Rdata'));
        }
        $occasions_array = [];
        foreach ($Rdata as $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);
        foreach ($occasions_array as $k => $occasion) {
            $occasions[$k] = Occasion::where('id', $occasion)->first();
        }
        return view('front.notification', compact('occasions', 'Rdata'));
    }

    public function downloadAudio($ID)
    {
        $audio = DB::table('greetingaudios')
            ->where('id', $ID)
            ->first();
        $this->popularCount('greetingaudios', $ID);
        return response()->download($audio->path);
    }

    public function Audio($ID)
    {
        $audio = DB::table('greetingaudios')
            ->where('id', $ID)
            ->first();
        if (is_null($audio))
            return view('front.error');
        if ($audio->rbt == 1) {
            $type = 'RBT';
            $rbt_sms = rbtSMS();
            $code = rbtCode::where('audio_id', $ID)->where('operator_id', OP())->first()->code;
        } elseif ($audio->notification == 1) {
            $type = 'notification';
            $rbt_sms = null;
            $code = null;
        }
        $title = $audio->title;
// dd($audio);
        return view('front.audios', compact('audio', 'title', 'type', 'rbt_sms', 'code'));
    }

    public function Search(Request $request, $UID)
    {
        $url = Generatedurl::where('UID', UID())->first();
        if (is_null($url))
            return view('front.error');
        $Count = $terms = $SearchKey = null;
        if ($request->has("SearchKey")) {
            $SearchKey = $request->SearchKey;
            $Count['Imgs'] = $url->operator->greetingimgs()->published()->where('title', 'like', "%$SearchKey%")->count();
            $Count['Snap'] = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$SearchKey%")->count();
            $Count['Rbts'] = $url->operator->greetingaudios()->PublishedRbt()->where('title', 'like', "%$SearchKey%")->count();
            $Count['Notifications'] = $url->operator->greetingaudios()->PublishedNotification()->where('title', 'like', "%$SearchKey%")->count();
            if ($url->video == 1)
                $Count['Video'] = $Count['Imgs'];
            else
                $Count['Video'] = 0;
            $terms = 'SearchKey=' . $SearchKey;
        } elseif ($request->has("featured")) {
            $Count['Imgs'] = $url->operator->greetingimgs()->published()->where('featured', 1)->count();
            $Count['Snap'] = $url->operator->greetingimgs()->PublishedSnap()->where('featured', 1)->count();
            $Count['Rbts'] = $url->operator->greetingaudios()->PublishedRbt()->where('featured', 1)->count();
            $Count['Notifications'] = $url->operator->greetingaudios()->PublishedNotification()->where('featured', 1)->count();
            if ($url->video == 1)
                $Count['Video'] = $Count['Imgs'];
            else
                $Count['Video'] = 0;
            $terms = 'featured=1';
        } elseif ($request->has("popular") || $request->has("recent")) {
            $Count['Imgs'] = $url->operator->greetingimgs()->published()->count();
            $Count['Snap'] = $url->operator->greetingimgs()->PublishedSnap()->count();
            $Count['Rbts'] = $url->operator->greetingaudios()->PublishedRbt()->count();
            $Count['Notifications'] = $url->operator->greetingaudios()->PublishedNotification()->count();
            if ($url->video == 1)
                $Count['Video'] = $Count['Imgs'];
            else
                $Count['Video'] = 0;
            if ($request->has("popular"))
                $terms = 'popular=1';
            if ($request->has("recent"))
                $terms = 'recent=1';
        }
        return view('front.search', compact('Count', 'SearchKey', 'terms'));
    }

    public function snap(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $oc_id = 0;
            if (is_null($url))
                return view('front.error');
            $SearchKey = null;
            if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
                if ($request->has("SearchKey")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->get();
                    $type = 'SearchKey';
                    $SearchKey = $request->SearchKey;
                } elseif ($request->has("featured")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('featured', 1)->get();
                    $type = 'featured';
                } elseif ($request->has("recent")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
                    $type = 'recent';
                } elseif ($request->has("popular")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('popular_count', 'desc')->get();
                    $type = 'recent';
                }
            } else {
                $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
                $type = 'list';
            }
            if ($Rdata->isEmpty()) {
                return view('front.snap', compact('Rdata'));
            }
            $occasions_array = [];
            $codes = [];
            foreach ($Rdata as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                if ($url->occasion_id == $occasion) {
                    $oc_id = $k;
                }
                $occasions[$k] = Occasion::where('id', $occasion)->first();
                if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
                    if ($request->has("SearchKey")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->get();
                    } elseif ($request->has("featured")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('featured', 1)->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->get();
                    } elseif ($request->has("recent")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->get();
                    } elseif ($request->has("popular")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->orderBy('popular_count', 'desc')->get();
                    }
                } else {
                    $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();
                }
                foreach ($Snapdata[$k] as $key => $value) {
                    if ($value->rbt_id != null) {
                        $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', OP())->first();
                        $codes[$k][$key] = $rbtCode ? $rbtCode->code : null;
                    }
                }
            }
            $rbt_sms = $url->operator->rbt_sms;

            return view('front.snap', compact('codes', 'occasions', 'Rdata', 'Snapdata', 'rbt_sms', 'type', 'SearchKey', 'oc_id'));
        } else {

            return redirect(redirect_operator() . '?prev_url=' . $current_url);
        }
    }

    public function list_occasion($UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            return view('front.list_occasion');
        } else {
            return redirect(redirect_operator() . '?prev_url=' . $current_url);
        }
    }

    public function list_snap_v1(Request $request, $ID, $UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();

            if (is_null($url))
                return view('front.error');
            $SearchKey = null;
            if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
                if ($request->has("SearchKey")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->get();
                    $type = 'SearchKey';
                    $SearchKey = $request->SearchKey;
                } elseif ($request->has("featured")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('featured', 1)->get();
                    $type = 'featured';
                } elseif ($request->has("recent")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
                    $type = 'recent';
                } elseif ($request->has("popular")) {
                    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('popular_count', 'desc')->get();
                    $type = 'recent';
                }
            } else {
                $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $ID)->orderBy('RDate', 'desc')->get();
                $type = 'list';
            }
            if ($Rdata->isEmpty()) {
                return view('front.list_snap_v1', compact('Rdata', 'ID', 'type', 'SearchKey'));
            }
            $occasions_array = [];
            $codes = [];
            foreach ($Rdata as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }

            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $occasions[$k] = Occasion::where('id', $occasion)->first();

                if ($request->has("SearchKey") || $request->has("featured") || $request->has("recent") || $request->has("popular")) {
                    if ($request->has("SearchKey")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->get();
                    } elseif ($request->has("featured")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('featured', 1)->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->get();
                    } elseif ($request->has("recent")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->get();
                    } elseif ($request->has("popular")) {
                        $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->limit(get_settings('pagination_limit'))->orderBy('popular_count', 'desc')->get();
                    }
                } else {
                    $Snapdata[$k] = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion)->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();
                }
                foreach ($Snapdata[$k] as $key => $value) {
                    if ($value->rbt_id != null) {
                        $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', OP())->first();
                        $codes[$k][$key] = $rbtCode ? $rbtCode->code : null;
                    }
                }
            }
            $rbt_sms = $url->operator->rbt_sms;
            //return $Snapdata;
            return view('front.list_snap_v1', compact('ID', 'codes', 'occasions', 'Rdata', 'Snapdata', 'rbt_sms', 'type', 'SearchKey'));
        } else {

            return redirect(redirect_operator() . '?prev_url=' . $current_url);
        }
    }

    public function Search_v1(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url))
                return view('front.error');
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->limit(get_settings('pagination_limit'))->get();
            $type = 'SearchKey';
            $SearchKey = $request->SearchKey;
            foreach ($Rdata as $key => $value) {
                if ($value->rbt_id != null) {
                    $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', OP())->first();
                    $codes[$key] = $rbtCode ? $rbtCode->code : null;
                }
            }
            $rbt_sms = $url->operator->rbt_sms;
            return view('front.search_page', compact('codes', 'Rdata', 'rbt_sms', 'type', 'SearchKey'));
        } else {

            return redirect(redirect_operator() . '?prev_url=' . $current_url);
        }
    }

    public function inner_snap($ID, $uid)
    {
        $rbt_sms = $code = $title = null;
        $url = Generatedurl::where('UID', UID())->first();
        if (is_null($url))
            return view('front.error');
        $snap = Greetingimg::Find($ID);
        if (is_null($snap))
            return view('front.error');
        $this->popularCount('greetingimgs', $ID);
        $recommend = $url->operator->greetingimgs()->PublishedSnap()->where('id', '!=', $ID)->take(4)->get();
        if ($snap->rbt_id) {
            $rbt_sms = rbtSMS();
            $code = rbtCode::where('audio_id', $snap->rbt_id)->where('operator_id', OP())->first();
            if (!is_null($code))
                $code = $code->code;
        }
        $title = $snap->title;
        return view('front.inner_snap', compact('title', 'snap', 'recommend', 'rbt_sms', 'code'));
    }

    public function inner_snap2($ID, $uid)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $rbt_sms = $code = $title = null;
            $url = Generatedurl::where('UID', UID())->first();
            if (is_null($url))
                return view('front.error');
            $snap = Greetingimg::Find($ID);
            if (is_null($snap))
                return view('front.error');
            $this->popularCount('greetingimgs', $ID);
            $greetingimg_operator = \DB::table('greetingimg_operator')->where('operator_id',OP())->where('greetingimg_id',$ID)->first(); //count in table greetingimg_operator
            $this->popularCount('greetingimg_operator', $greetingimg_operator->id);
            if ($snap->rbt_id) {
                $rbt_sms = rbtSMS();
                $code = rbtCode::where('audio_id', $snap->rbt_id)->where('operator_id', OP())->first();
                if (!is_null($code))
                    $code = $code->code;
            }

            $title = $snap->title;

            $Occasion = Occasion::where('id', $snap->occasion_id)->first();
            $pageTitle = $snap->getTranslation('title',getCode());


            return view('front.newdesign.list_snap_inner', compact('pageTitle', 'snap', 'rbt_sms', 'code', 'Occasion'));
        } else {
            return redirect(redirect_operator() . '?prev_url=' . $current_url);
        }
    }

    public function like_dislike(request $request)
    {
        $greetingimg_operator  = \App\GreetingimgOperator::where('operator_id',OP())->where('greetingimg_id',$request->id)->first();

        $greetingimg           = \App\Greetingimg::where('id',$request->id)->first();
        if($request->type == 1){
            $greetingimg_operator->like  += 1;
            $greetingimg_operator->save();
            $greetingimg->like  += 1;
            $greetingimg->save();
        }
        else{
            $greetingimg_operator->dislike  += 1;
            $greetingimg_operator->save();
            $greetingimg->dislike  += 1;
            $greetingimg->save();
        }
        return 'yes';
    }

// notification url for viva kuwait
    // http://localhost/greeting_backend_v2/notification?action=5&mnc=102&msisdn=96555417870&opsid=3&status=RS   // viva = opsid=3
    // http://localhost/greeting_backend_v2/notification?action=5&mnc=103&msisdn=96599104715&opsid=1&status=RS   // zain kuwait = opsid=1
    public function notification(request $request)
    {
        $message = "";
        $subscribe_for_first_time = 0;
        date_default_timezone_set("Africa/Cairo");
        // fixed paramters
        if ($request->input('msisdn') != NULL) {
            $msisdn = $request->input('msisdn');
        } else {
            $msisdn = $request->input('MSISDN');
        }


        if ($request->input('status') != NULL) {
            $status = $request->input('status');
        } else {
            $status = $request->input('Status');
        }

        $mnc = $request->input('mnc');
        $opsid = $request->input('opsid');
        // changable parameters
        $action = $request->input('action');
        $company = $request->input('AdsCompany');


        // make log for every hit
        $actionName = "Notification Hits";
        $not_URL = $request->fullUrl();
        $parameters_arr = array(
            'MSISDN' => $msisdn,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
        );
        $this->log($actionName, $not_URL, $parameters_arr);


        if (isset($msisdn) && isset($status) && isset($opsid) && isset($action) && ($opsid == 1 || $opsid == 2 || $opsid == 3)) {


            // add notify
            $notify = new Notify();
            $notify->complete_url = \Request::fullUrl();
            $notify->msisdn = $msisdn;
            $notify->action = $action;
            $notify->status = $status;
            $notify->save();


            if ($opsid == 1) {   // zain
                $operator_id = 8;
                $operator_name = "zain_kuwait";
            } elseif ($opsid == 2) { // ooredoo
                $operator_id = 50;
                $operator_name = "ooredoo_kuwait";
            } elseif ($opsid == 3) { // viva
                $operator_id = 51;
                $operator_name = "viva_kuwait";
            }


            // viva check if alreday subscribe

            $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->orderBy('id', 'DESC')->first();
            if ($Msisdn) {  // found in our DB
                $Msisdn->ooredoo_notify_id = $notify->id;
                $Msisdn->operator_id = $operator_id;

                if ($status == "US" || $status == "U") {  // want to unsub if already sub
                    $Msisdn->final_status = 0;
                    $message = "تم الغاء اشتراكك ";
                } elseif ($status == "SS" || $status == "S21") { // want to sub
                    $Msisdn_before = Msisdn::where('msisdn', '=', $msisdn)->where('final_status', '=', 1)->orderBy('id', 'DESC')->first();
                    if ($Msisdn_before) {
                        $message = "انت مشترك بالفعل ";
                    } else {
                        $message = "تم الاشتراك";
                        $Msisdn->final_status = 1;
                        $subscribe_for_first_time = 1;
                    }
                } elseif ($status == "RS") { // renew sub
                    $Msisdn->final_status = 1;
                    $message = "تم تجديد الاشتراك ";
                } elseif ($status == "S6") { // already subscribe
                    $message = "انت مشترك بالفعل ";
                } elseif ($status == "S3") { // already subscribe
                    $message = "حدث خطأ في صفحة التاكيد ";
                }
                $Msisdn->save();
            } else {  // not found in our DB = like come by SC
                $Msisdn = new Msisdn();
                $Msisdn->msisdn = $msisdn;
                $Msisdn->operator_id = $operator_id;
                $Msisdn->ooredoo_notify_id = $notify->id;

                if ($status == "SS" || $status == "S21") {  // subscribe success
                    $Msisdn->final_status = 1;
                    $message = "تم الاشتراك";
                    $subscribe_for_first_time = 1;
                } elseif ($status == "RS") { //   renew success
                    $Msisdn->final_status = 1;
                    $message = "تم تجديد الاشتراك";
                } elseif ($status == "S6") { // already subscribe
                    $message = "انت مشترك بالفعل ";
                } elseif ($status == "S3") { // already subscribe
                    $message = "حدث خطأ في صفحة التاكيد ";
                } else {
                    $Msisdn->final_status = 0;
                    $message = "تم الغاء اشتراكك";
                }
                $Msisdn->ad_company = "DF";
                $Msisdn->save();
            }


            // ads handling

            if ($status == "SS") { // subscribe for the first time  SO notify ads comapny
                // notify ads company
                $ad_company = $Msisdn->ad_company;
                $transaction_id = $Msisdn->transaction_id;
                $ads_ur_id = $Msisdn->ads_ur_id;

                $AdvertisingUrlOld = AdvertisingUrl::where('id', $ads_ur_id)->first();

                if ($AdvertisingUrlOld) {
                    if ($ad_company == "headway") {  // HEADWAY integration
                        // call Headway api to notify that msisdn is subscribe successfully
                        // https://lead.mobra.in/18020607a4a0700ab706ec07?token=7c97db9
                        $HeadWay_URL = "https://lead.mobra.in/" . $transaction_id . "?token=7c97db9";
                       //  $HeadWay_result = file_get_contents($HeadWay_URL);
                        $HeadWay_result =  $this->GetPageData($HeadWay_URL) ;

                        if ($HeadWay_result != "Click already converted") {
                            $AdvertisingUrl = new AdvertisingUrl();
                            $AdvertisingUrl->adv_url = $AdvertisingUrlOld->adv_url;
                            $AdvertisingUrl->msisdn = $msisdn;
                            $AdvertisingUrl->operatorId = $operator_id;
                            $AdvertisingUrl->operatorName = $operator_name;
                            $AdvertisingUrl->status = 1;  // subscribe success
                            $AdvertisingUrl->ads_compnay_name = $ad_company;
                            $AdvertisingUrl->publisherId_macro = $AdvertisingUrlOld->publisherId_macro;
                            $AdvertisingUrl->transaction_id = $transaction_id;
                            $AdvertisingUrl->save();

                            // make log
                            $company = $this->detectCompnay();
                            $URL = $HeadWay_URL;
                            $actionName = "Headway Subscribe Success " . $operator_name;
                            $parameters_arr = array(
                                'MSISDN' => $msisdn,
                                'link' => $HeadWay_URL,
                                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                                'result' => (array)$HeadWay_result
                            );
                            $this->log($actionName, $URL, $parameters_arr);
                        }
                    } elseif ($ad_company == "intech") {  // intech integration
                        // call intech  api to notify that msisdn is subscribe successfully
                        $ADV_URL = "http://ict.intech-mena.com/Universal/v2.0/API/Postback?msisdn=" . $msisdn . "&operaterName=$operator_name&operatorId=$operator_id&" . $AdvertisingUrlOld->adv_url;
                      //  $adv_result = file_get_contents($ADV_URL);
                        $adv_result = $this->GetPageData($ADV_URL) ;
                        $adv_result = (array)json_decode($adv_result);


                        if ($adv_result['UET Offer Log'] == "SUCCESS") {
                            $AdvertisingUrl = new AdvertisingUrl();
                            $AdvertisingUrl->adv_url = $AdvertisingUrlOld->adv_url;
                            $AdvertisingUrl->msisdn = $msisdn;
                            $AdvertisingUrl->operatorId = $operator_id;
                            $AdvertisingUrl->operatorName = $operator_name;
                            $AdvertisingUrl->status = 1;  // subscribe success
                            $AdvertisingUrl->ads_compnay_name = $ad_company;
                            $AdvertisingUrl->save();

                            // make log
                            $company = $this->detectCompnay();
                            $actionName = "Intech Subscribe Success " . $operator_name;
                            $URL = $ADV_URL;
                            $parameters_arr = array(
                                'MSISDN' => $msisdn,
                                'link' => $ADV_URL,
                                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                                'result' => $adv_result
                            );
                            $this->log($actionName, $URL, $parameters_arr);
                        }
                    } elseif ($ad_company == "DF") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = "";
                        $AdvertisingUrl->msisdn = $msisdn;
                        $AdvertisingUrl->operatorId = $operator_id;
                        $AdvertisingUrl->operatorName = $operator_name;
                        $AdvertisingUrl->status = 1;  // subscribe success
                        $AdvertisingUrl->ads_compnay_name = $ad_company;
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "DF Subscribe Success " . $operator_name;
                        $URL = $request->fullUrl();
                        $parameters_arr = array(
                            'MSISDN' => $msisdn,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                }
            }


            // make log for all Notification api
            $ad_company = $Msisdn->ad_company;
            $URL = \Request::fullUrl();
            $actionName = $operator_name . " Notification Api ";
            $parameters_arr = array(
                'action' => $action,
                'status' => $status,
                'msisdn' => $msisdn,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'notify_id' => $notify->id,
                'company' => $ad_company
            );
            $this->log($actionName, $URL, $parameters_arr);

            $result = array();
            $result['type'] = $operator_name . " Notification api ";
            $result['notify_id'] = $notify->id;
            $result['url'] = $URL;
            $result['message'] = $message;


//            if ($opsid == 1) { // zain
//                $result['status'] = "OK";
//                return json_encode($result);
//            } else {
//                return view('landing.notificatiobResult', compact('message', 'subscribe_for_first_time', 'operator_name'));
//            }

            return view('landing.notificatiobResult', compact('message', 'subscribe_for_first_time', 'operator_name'));
        } else {
            $message = "";
            $subscribe_for_first_time = 0;
            $operator_name = "";
            return view('landing.notificatiobResult', compact('message', 'subscribe_for_first_time', 'operator_name'));
        }
    }


    public function tpay_notification(request $request)
    {
        echo "tpay_notification";
    }

    public function vivaCheckSubscribe(Request $request)
    {

        $msisdn = '965' . $request->msisdn;
        $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->where('final_status', '=', 1)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {
            $result['status'] = 1;
            $result['msisdn'] = $Msisdn;
            echo json_encode($result);
            // return Response(array('data' => $result));
        } else {
            $result['status'] = 0;
            // return Response(array('data' => $result));
            echo json_encode($result);
        }
    }

    // public function log($actionName, $URL, $parameters_arr) {
    //     date_default_timezone_set("Africa/Cairo");
    //     $date = date("Y-m-d");
    //     $log = new Logger($actionName);
    //     // to create new folder with current date  // if folder is not found create new one
    //     if (!File::exists(storage_path('logs/' . $date . '/' . $actionName))) {
    //         File::makeDirectory(storage_path('logs/' . $date . '/' . $actionName), 0775, true, true);
    //     }
    //     $log->pushHandler(new StreamHandler(storage_path('logs/' . $date . '/' . $actionName . '/logFile.log', Logger::INFO)));
    //     $log->addInfo($URL, $parameters_arr);
    // }
    // new pages
    public function landing(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing.index');
    }

    // new pages
    public function landing_viva(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing.index_viva');
    }

    public function landing_v1()
    {
        return view('landing_v2.index');
    }

    // new pages
    public function landing_ooredoo(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');

//        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
//            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
//        } else {
//            $MSISDN = "";
//        }
//


        if ($request->input('MSISDN') != NULL) {
            $MSISDN = $request->input('MSISDN');
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->save();

        return view('landing.index_ooredoo', compact('MSISDN'));
    }

    public function confirm()
    {
        return view('landing.confirm');
    }

    public function notificatiobResult()
    {
        $message = "";
        $subscribe_for_first_time = 0;
        $operator_name = "";
        return view('landing.notificatiobResult', compact('message', 'subscribe_for_first_time', 'operator_name'));
    }

    public function pincode()
    {
        return view('landing.pincode');
    }

    // load more snap
    public function loadMoreSnap(Request $request)
    {
        $url = Generatedurl::where('UID', $request->UID)->first();
        $codes = [];
        if ($request->type == "SearchKey") {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', "%$request->SearchKey%")->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } elseif ($request->type == "featured") {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->where('featured', 1)->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } elseif ($request->type == "recent") {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } elseif ($request->type == "popular") {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->orderBy('popular_count', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } else {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        }
        foreach ($Snapdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }

        $rbt_sms = $url->operator->rbt_sms;
        $view = view('front.snap_load', compact('Snapdata', 'codes', 'rbt_sms'))->render();
        return Response(array('html' => $view));
    }

    public function snapCategory(Request $request, $UID)
    {

        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url))
            return view('front.error');
        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
        if ($Rdata->isEmpty()) {
            return view('front.newdesign.snap', compact('Rdata'));
        }
        $occasions_array = [];
        foreach ($Rdata as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);
        $occasions = Occasion::whereIn('id', $occasions_array)->get();
        $pageTitle = 'التصنيفات';
        return view('front.newdesign.snap', compact('pageTitle', 'occasions', 'Rdata'));
    }

    public function listSnap($ID, $UID)
    {

        $url = Generatedurl::where('UID', $UID)->first();
        // if (is_null($url))
        //     return view('front.error');

        $occasion_id = $ID;
        $codes = [];
        // dd($url);
        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();

        // if ($Rdata->isEmpty()) {
        //     return view('front.newdesign.snap', compact('Rdata'));
        // }
        foreach ($Rdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }
        $rbt_sms = $url->operator->rbt_sms;
        $Occasion = Occasion::where('id', $occasion_id)->first();
        // dd($occasion_id);
        $pageTitle = $Occasion->getTranslation('title',getCode());
        $child_occasions =[];
        $childs = Occasion::where('parent_id',$occasion_id)->get(); // occasion_id parent_id



        foreach($childs as $value){

            $depend = Occasion::where('parent_id', $value->id)->first();
            // dd($depend);
            if(!empty($depend)){ //check if there is a child for a parent occassion
                // $check = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $value->id)->first();
                // if($check){
                    $child_occasions[] = $value;
                // }
            }else{ // cheack if leafe occassion
                $check = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $value->id)->first();
                if(!empty($check)){
                    $child_occasions[] = $value;
                }
            }
        }
        // dd($child_occasions);
        return view('front.newdesign.list_snap', compact('pageTitle', 'Rdata','child_occasions' ,'rbt_sms', 'codes', 'occasion_id', 'Occasion'));
    }

    public function cuurentSnap($UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {

            $url = Generatedurl::where('UID', $UID)->first();


            if(OP() ==  16  || OP() ==  MOBILY_OP_ID){

                    if(OP() ==  16  &&  Session::has('currentOp')  && Session::get('currentOp') == 16  ){  //  ZAIN NKSA

                    }else{
                        return redirect(url(redirect_operator()));
                    }

                    if(OP() ==  MOBILY_OP_ID   &&  Session::has('currentOp')  && Session::get('currentOp') == MOBILY_OP_ID   ){  // Mobily ksa

                    } else{
                        return redirect(url(redirect_operator()));
                    }



            }







            // if (is_null($url))
            //     return view('front.error');

            $occasion_id = Occasion();
            $codes = [];
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();
            // if ($Rdata->isEmpty()) {
                //     return view('front.newdesign.snap', compact('Rdata'));
                // }
                //return $Rdata;
                foreach ($Rdata as $key => $value) {
                    $operator_id = $value->pivot->operator_id;
                    $greetingimg_id = $value->pivot->greetingimg_id;
                    $gop = GreetingimgOperator::where('greetingimg_id', $greetingimg_id)->where('operator_id', $url->operator_id)->first();

                    // dd($gop->popular_count);
                    $gop->popular_count = $gop->popular_count + 1;
                    $gop->save();
                if ($value->rbt_id != null) {
                    $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                    $codes[$key] = $rbtCode ? $rbtCode->code : null;
                }
            }
            $rbt_sms = $url->operator->rbt_sms;
            // dd($occasion_id);
            $Occasion = Occasion::where('id', $occasion_id)->first();
            $pageTitle = $Occasion->getTranslation('title',getCode());
            $child_occasions =[];
            $childs = Occasion::where('parent_id',$occasion_id)->get(); // occasion_id parent_id
            foreach($childs as $value){
                $check = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $value->id)->first();
                if($check){
                    $child_occasions[] = $value;
                }
            }

            // dd('here');
            return view('front.newdesign.list_snap', compact('pageTitle','child_occasions', 'Rdata', 'rbt_sms', 'codes', 'occasion_id', 'Occasion'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }

    public function loadMoreSnapNew(Request $request)
    {
        // dd('here');

        $url = Generatedurl::where('UID', $request->UID)->first();
        $codes = [];
        $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        if($request->has('search')){
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        }
        foreach ($Snapdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }
        $rbt_sms = $url->operator->rbt_sms;
        $view = view('front.newdesign.snap_load', compact('Snapdata', 'codes', 'rbt_sms', 'url'))->render();
        return Response(array('html' => $view));
    }

    public function logout()
    {
        Session::flush();
        return redirect('/landing');
    }

    //new route landing_v2
    public function landing_viva_v2(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.viva');
    }

    public function landing_ooredoo_v2(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');

        //   old HE
        //        if (isset($_SERVER['HTTP_MSISDN'])) {
        //            $MSISDN = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        //        } else {
        //            $MSISDN = "";
        //        }
        //


        if ($request->input('MSISDN') != NULL) {
            $MSISDN = $request->input('MSISDN');
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page Ooredoo";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = 50; // ooredoo kuwait
        $AdvertisingUrl->save();

        if ($MSISDN == "") { // user will enter his phone and subscribe
            return view('landing_v2.ooredoo', compact('MSISDN'));
        } else {


            // redirect directly to consent page
            // CG page for ooredoo


            $msisdn = "965" . $MSISDN;
            $Msisdn = Msisdn::where('msisdn', '=', $msisdn)->where('operator_id', '=', 50)->orderBy('id', 'DESC')->first();
            if ($Msisdn && $Msisdn->final_status == 1) {  // already subscribe
                //   session()->flash('failed', 'انت مشترك بالفعل');
                //   return back();
                // redirect to last zain kuwait link
                session(['MSISDN' => $msisdn, 'Status' => 'active']);
                if (isset($request->prev_url) && $request->prev_url != "") {
                    return redirect($request->prev_url);
                } else {
                    $Url = Generatedurl::where('operator_id', ooredoo_kuwait_operator_id)->latest()->first();
                    if ($Url)
                        return redirect(url() . "/cuurentSnap/" . $Url->UID);
                    else
                        return redirect(url() . "/landing_ooredoo");
                }
            } else {
                // redirect directly to consent page
                // CG page for ooredoo
                // $AdvertisingUrl->status  // 1 mean this click turn to redirect But not subscribed yet as subscribe show in notification page
                $company = "Og";
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn;
                $AdvertisingUrl->status = 1;    // 1 mean this click turn to redirect But not subscribed yet as subscribe show in notification page
                $AdvertisingUrl->operatorId = 50;
                $AdvertisingUrl->operatorName = "ooredoo_kuwait";
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();


                //  $company = $this->detectCompnay();
                $company = "Og-" . $AdvertisingUrl->id;  // this new request from azeem to compare new ads company made by oneglobal
                //    $URL = "http://ikwm-appvas.isys.mobi:2009/OoredooConsentInit/Consent.aspx?MSISDN=" . $msisdn . "&Scode=1368&ServiceID=S-SnaFiEwMY2&ServiceType=P-tQX2zvEwMY2&AdsCompany=" . $company;  // old ooredoo CG url
                $URL = "http://ikwm-appvas.isys.mobi:2025/consentrequest.aspx?MSISDN=" . $msisdn . "&Scode=1368&ServiceId=S-SnaFiEwMY2&ClientId=1935&UserId=O@IV&Password=O@iv@s&TranId=$AdvertisingUrl->id";


                // make log
                $actionName = "Oreedo Subscribe Track";
                $parameters_arr = array(
                    'MSISDN' => $msisdn,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'company' => $company
                );
                $this->log($actionName, $URL, $parameters_arr);


                // msisdn last update
                if ($Msisdn) {
                    $Msisdn->operator_id = 50;  // ooredoo
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->save();
                } else {
                    $Msisdn = new Msisdn();
                    $Msisdn->msisdn = $msisdn;
                    $Msisdn->operator_id = 50; // ooredoo
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->save();
                }


                return redirect($URL);
            }
        }
    }

    public function landing_zain_v2(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page Zain";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = 8;  // zain
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.zain');
    }

    public function landing_zain_ksa(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page Zain KSA";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = 16;  // zain KSA
        $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.zain_ksa', compact('MSISDN'));
    }

    public function landing_mobily_ksa(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page Mobily KSA";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = MOBILY_OP_ID;  // Mobily KSA
        $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.mobily_ksa', compact('MSISDN'));
    }

public function zain_ksa_test(Request $request){

    $msisdn = "123456578" ;
    session(['MSISDN' => $msisdn, 'Status' => 'active']);
        $Url = Generatedurl::where('operator_id', 16)->latest()->first();
        $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
        ->where('greetingimg_operator.operator_id', '=', 16)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

        if ($snap) {
        return redirect(url('viewSnap2/' . $snap->id . '/' . $Url->UID));
        } else {
        return redirect(url('cuurentSnap/' . $Url->UID));
        }
    }

    public function landing_ksa(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');
        session::forget('message');
        session::forget('adv_params');
        session::forget('transaction_id');
        session::forget('publisherId_macro');


        if (isset($_SERVER['HTTP_MSISDN'])) {  // old HE
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

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
            $ip = $_SERVER['HTTP_CLIENT_IP'];


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
        $result['AllHeaders'] = $_SERVER;

        // make log
        $actionName = "Hit page Mobily KSA";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);


        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $MSISDN;
        $AdvertisingUrl->operatorId = MOBILY_OP_ID;  // Mobily KSA
        $AdvertisingUrl->status = 1; // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->transaction_id = $transaction_id;  // for Headway ads
        $AdvertisingUrl->publisherId_macro = $publisherId_macro;  // for Headway  ads
        $AdvertisingUrl->ads_compnay_name = $company;  //  intech  or headway
        $AdvertisingUrl->save();

        return view('landing_v2.landing_ksa', compact('MSISDN'));
    }

    public function ZainKsaPinCodeSend(request $request)
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
        //     $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/getSubscriberStatus?msisdn=$msisdn_wcc&servId=665";  // mobily
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/getSubscriberStatus?msisdn=$msisdn_wcc&servId=656";  // zain saudi


      //  $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

        // make log
        $company = $this->detectCompnay();
        $actionName = "Zain KSA Check Status On Arpu DB";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result
        );
        $this->log($actionName, $URL, $parameters_arr);

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 16)->orderBy('id', 'DESC')->first();

        if ($result == "Active") {
            //session()->flash('error', 'هذا الرقم مشرك بالفعل');
            // return back();

            // check status for zain

            if ($Msisdn && $Msisdn->final_status == 1) {
                //  session()->flash('failed', 'انت مشترك بالفعل');
                // return back();
                session(['MSISDN' => $msisdn, 'Status' => 'active' ,'currentOp'=>16]);
                if (isset($request->prev_url) && $request->prev_url != "") {
                    return redirect($request->prev_url);
                } else {
                    // redirect to last zain kuwait link
                    $Url = Generatedurl::where('operator_id', 16)->latest()->first();
                    // if ($Url)
                    //     return redirect(url() . "/cuurentSnap/" . $Url->UID);
                    // else
                    //     return redirect(url() . "/landing_zain_ksa");

                    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                        ->where('greetingimg_operator.operator_id', '=', 16)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                    if ($snap) {
                        $url = Generatedurl::where('operator_id', 16)->orderBy('created_at', 'desc')->first();
                        return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                    } else {
                        return redirect(url('cuurentSnap/' . $Url->UID));
                    }


                }
            }

        }


        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn_wcc;
        $AdvertisingUrl->operatorId = 16;
        $AdvertisingUrl->status = 2;   // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->operatorName = "zain_ksa";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
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
        $Msisdn->operator_id = 16; // zain_ksa
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();


        //  Zain KSA send Pincode
        //   $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=$msisdn_wcc&serv=f";  // mobily
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=$msisdn_wcc&serv=f";
      //  $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result= preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

        // make log
        $company = $this->detectCompnay();
        $actionName = "Zain KSA Pincode Send";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result
        );
        $this->log($actionName, $URL, $parameters_arr);


        if ($result == "7" || $result == "1") {  // pincode send successfully  // 7 : the number is new on Arpu   1 : the number is saved in DB on Arpu
            return view('landing_v2.zain_ksa_pinCode', compact('msisdn'));
        } else {  // error
            $request->session()->flash('failed', 'pincode send is failed');
            $MSISDN = $msisdn;
            return view('landing_v2.zain_ksa', compact('MSISDN'));
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


    public function MobilyKsaPinCodeSend(request $request)
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
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/getSubscriberStatus?msisdn=$msisdn_wcc&servId=665";  // mobily
      //  $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

        // make log
        $company = $this->detectCompnay();
        $actionName = "Mobily KSA Check Status On Arpu DB";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result
        );
        $this->log($actionName, $URL, $parameters_arr);

        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 14)->orderBy('id', 'DESC')->first();

        if ($result == "Active") {
            //session()->flash('error', 'هذا الرقم مشرك بالفعل');
            // return back();

            // check status for zain

            if ($Msisdn && $Msisdn->final_status == 1) {
                //  session()->flash('failed', 'انت مشترك بالفعل');
                // return back();
                session(['MSISDN' => $msisdn, 'Status' => 'active','currentOp'=>MOBILY_OP_ID]);
                if (isset($request->prev_url) && $request->prev_url != "") {
                    return redirect($request->prev_url);
                } else {
                    $Url = Generatedurl::where('operator_id', 14)->latest()->first();


                    $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                        ->where('greetingimg_operator.operator_id', '=', MOBILY_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                    if ($snap) {
                        $url = Generatedurl::where('operator_id', MOBILY_OP_ID)->orderBy('created_at', 'desc')->first();
                        return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                    } else {
                        return redirect(url('cuurentSnap/' . $Url->UID));
                    }


                }
            }

        }


        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = $msisdn_wcc;
        $AdvertisingUrl->operatorId = MOBILY_OP_ID;
        $AdvertisingUrl->status = 2;   // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
        $AdvertisingUrl->operatorName = "mobily_ksa";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
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
        $Msisdn->operator_id = MOBILY_OP_ID; // Mobily ksa
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();


        //  Mobily KSA send Pincode
        $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=$msisdn_wcc&serv=f";
     //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
        $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

        // make log
        $company = $this->detectCompnay();
        $actionName = "Mobily KSA Pincode Send";
        $parameters_arr = array(
            'MSISDN' => $msisdn_wcc,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result
        );
        $this->log($actionName, $URL, $parameters_arr);


        if ($result == "7" || $result == "1") {  // pincode send successfully  // 7 : the number is new on Arpu   1 : the number is saved in DB on Arpu
            return view('landing_v2.mobily_ksa_pinCode', compact('msisdn'));
        } else {  // error
            $request->session()->flash('failed', 'pincode send is failed');
            $MSISDN = $msisdn;
            return view('landing_v2.mobily_ksa', compact('MSISDN'));
        }
    }


    public function zain_ksa_pincode_confirm(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');
        $MSISDN = $msisdn;
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.zain_ksa_pinCode', compact('msisdn'));
        }


        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 16)->orderBy('id', 'DESC')->first();

        if($Msisdn){

            //  Zain KSA verify pincode
            //    $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=$msisdn_wcc&serv=f&pincode=$pincode";  // mobily
            $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=$msisdn_wcc&serv=f&pincode=$pincode";
         //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
            $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain KSA Pincode verify";
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => $result
            );
            $this->log($actionName, $URL, $parameters_arr);


            if ($result == "0") {  // pincode verify success and the user is now subscribe
                //update my database
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wcc;
                $AdvertisingUrl->operatorId = 16;
                $AdvertisingUrl->status = 3;  // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                $AdvertisingUrl->operatorName = "zain_ksa";
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();

                // update msisdn
                $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                $Msisdn->ad_company = $company;
                if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                    $Msisdn->transaction_id = session::get('transaction_id');
                }
                $Msisdn->final_status = 1;
                $Msisdn->save();


                // update intech
                if ($company == "intech") {  // intech integration
                    // call intech  api to notify that msisdn is subscribe successfully
                    $ADV_URL = "http://ict.intech-mena.com/Universal/v2.0/API/Postback?msisdn=" . $msisdn_wcc . "&operaterName=zain_ksa&operatorId=16&" . session::get('adv_params');
                    $adv_result = $this->GetPageData($ADV_URL);
                    $adv_result = (array)json_decode($adv_result);

                    // make log
                    $company = $this->detectCompnay();
                    $actionName = "Intech Hits Zain KSA Logs";
                    $URL = $ADV_URL;
                    $parameters_arr = array(
                        'MSISDN' => $msisdn_wcc,
                        'link' => $ADV_URL,
                        'date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'result' => $adv_result
                    );
                    $this->log($actionName, $URL, $parameters_arr);


                    if ($adv_result['UET Offer Log'] == "SUCCESS") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = session::get('adv_params');
                        $AdvertisingUrl->msisdn = $msisdn_wcc;
                        $AdvertisingUrl->operatorId = 16;
                        $AdvertisingUrl->status = 4;  // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                        $AdvertisingUrl->operatorName = "zain_ksa";
                        $AdvertisingUrl->ads_compnay_name = $company;
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "Intech Zain KSA Subscribe Success";
                        $URL = $ADV_URL;
                        $parameters_arr = array(
                            'MSISDN' => $msisdn_wcc,
                            'link' => $ADV_URL,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                            'result' => $adv_result
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                }


//                session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
//                return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=4&status=SS");
                //  $request->session()->flash('success', 'تم الاشتراك بنجاح');
                //return view('landing_v2.zain_ksa', compact('MSISDN'));

                session(['MSISDN' => $msisdn, 'Status' => 'active','currentOp'=>16]);
                $Url = Generatedurl::where('operator_id', 16)->latest()->first();

                $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                    ->where('greetingimg_operator.operator_id', '=', 16)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                if ($snap) {
                    $url = Generatedurl::where('operator_id', 16)->orderBy('created_at', 'desc')->first();
                    return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                } else {

                    return redirect(url('cuurentSnap/' . $Url->UID));
                }


            } elseif ($result == "Theproducthasbeensubscribed.") {  // alreday subscribe
                session(['MSISDN' => $msisdn, 'Status' => 'active','currentOp'=>16]);
                $Url = Generatedurl::where('operator_id', 16)->latest()->first();

                $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                    ->where('greetingimg_operator.operator_id', '=', 16)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                if ($snap) {
                    $url = Generatedurl::where('operator_id', 16)->orderBy('created_at', 'desc')->first();
                    return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                } else {

                    return redirect(url('cuurentSnap/' . $Url->UID));
                }

            } else {
                $request->session()->flash('failed', 'pincode verified failed');
                return view('landing_v2.zain_ksa_pinCode', compact('msisdn'));
            }
        } else {
            $request->session()->flash('failed', 'حدث خطأ');
            return view('landing_v2.zain_ksa', compact('MSISDN'));
        }
    }


    public function mobily_ksa_pincode_confirm(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');
        $MSISDN = $msisdn;
        $msisdn_wcc = zain_ksa_prefix . $msisdn;

        if (!preg_match('/^[0-9]{9}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.zain_ksa_pinCode', compact('msisdn'));
        }


        $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', MOBILY_OP_ID)->orderBy('id', 'DESC')->first();
        if ($Msisdn) {

            //  mobily KSA verify pincode
            $URL = "http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=$msisdn_wcc&serv=f&pincode=$pincode";  // mobily
         //   $result = preg_replace('/\s+/', '', file_get_contents($URL));
            $result = preg_replace('/\s+/', '', $this->GetPageData($URL)) ;

            // make log
            $company = $this->detectCompnay();
            $actionName = "Mobily KSA Pincode verify";
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => $result
            );
            $this->log($actionName, $URL, $parameters_arr);


            if ($result == "0") {  // pincode verify success and the user is now subscribe
                //update my database
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wcc;
                $AdvertisingUrl->operatorId = MOBILY_OP_ID;
                $AdvertisingUrl->status = 3;  // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                $AdvertisingUrl->operatorName = "zain_ksa";
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();

                // update msisdn
                $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                $Msisdn->ad_company = $company;
                if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                    $Msisdn->transaction_id = session::get('transaction_id');
                }
                $Msisdn->final_status = 1;
                $Msisdn->save();


                // update intech
                if ($company == "intech") {  // intech integration
                    // call intech  api to notify that msisdn is subscribe successfully
                    $ADV_URL = "http://ict.intech-mena.com/Universal/v2.0/API/Postback?msisdn=" . $msisdn_wcc . "&operaterName=zain_ksa&operatorId=16&" . session::get('adv_params');
                    $adv_result = $this->GetPageData($ADV_URL);
                    $adv_result = (array)json_decode($adv_result);


                    if ($adv_result['UET Offer Log'] == "SUCCESS") {
                        $AdvertisingUrl = new AdvertisingUrl();
                        $AdvertisingUrl->adv_url = session::get('adv_params');
                        $AdvertisingUrl->msisdn = $msisdn;
                        $AdvertisingUrl->operatorId = MOBILY_OP_ID;
                        $AdvertisingUrl->status = 4;  // 1 = hit , 2 = pincode send  , 3 pincode verify success  , 4 = intech subscribe success
                        $AdvertisingUrl->operatorName = "zain_ksa";
                        $AdvertisingUrl->ads_compnay_name = $company;
                        $AdvertisingUrl->save();

                        // make log
                        $company = $this->detectCompnay();
                        $actionName = "Intech Mobily KSA Subscribe Success";
                        $URL = $ADV_URL;
                        $parameters_arr = array(
                            'MSISDN' => $msisdn_wcc,
                            'link' => $ADV_URL,
                            'date' => Carbon::now()->format('Y-m-d H:i:s'),
                            'result' => $adv_result
                        );
                        $this->log($actionName, $URL, $parameters_arr);
                    }
                }


//                session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
//                return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=4&status=SS");
                //  $request->session()->flash('success', 'تم الاشتراك بنجاح');
                //return view('landing_v2.zain_ksa', compact('MSISDN'));

                session(['MSISDN' => $msisdn, 'Status' => 'active','currentOP'=>MOBILY_OP_ID]);
                $Url = Generatedurl::where('operator_id', MOBILY_OP_ID)->latest()->first();

                $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                    ->where('greetingimg_operator.operator_id', '=', MOBILY_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                if ($snap) {
                    $url = Generatedurl::where('operator_id', MOBILY_OP_ID)->orderBy('created_at', 'desc')->first();
                    return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                } else {
                    return redirect(url('cuurentSnap/' . $Url->UID));
                }


            } elseif ($result == "Theproducthasbeensubscribed.") {  // alreday subscribe
                session(['MSISDN' => $msisdn, 'Status' => 'active','currentOP'=>MOBILY_OP_ID]);
                $Url = Generatedurl::where('operator_id', MOBILY_OP_ID)->latest()->first();

                $snap = Greetingimg::select('greetingimgs.*')->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
                    ->where('greetingimg_operator.operator_id', '=', MOBILY_OP_ID)->where('greetingimgs.snap', 1)->where('greetingimgs.Rdate', '<=', Carbon::now()->format('Y-m-d'))->orderBy('greetingimgs.Rdate', 'desc')->first();

                if ($snap) {
                    $url = Generatedurl::where('operator_id', MOBILY_OP_ID)->orderBy('created_at', 'desc')->first();
                    return redirect(url('viewSnap2/' . $snap->id . '/' . $url->UID));
                } else {
                    return redirect(url('cuurentSnap/' . $Url->UID));
                }

            } else {
                $request->session()->flash('failed', 'pincode verified failed');
                return view('landing_v2.mobily_ksa_pinCode', compact('msisdn'));
            }


        }else {
                $request->session()->flash('failed', 'pincode verified failed');
                return view('landing_v2.mobily_ksa_pinCode', compact('msisdn'));
            }

    }

    public function subscribeZain_v2(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        session::forget('message');
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }


        // check status for zain
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
        if ($Msisdn && $Msisdn->final_status == 1) {
            /*
              session()->flash('failed', 'انت مشترك بالفعل');
              return back();
             */

            // set session

            session(['MSISDN' => $msisdn, 'Status' => 'active']);
            if (isset($request->prev_url) && $request->prev_url != "") {
                return redirect($request->prev_url);
            } else {
                // redirect to last zain kuwait link
                $Url = Generatedurl::where('operator_id', zain_kuwait_operator_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap/" . $Url->UID);
                else
                    return redirect(url() . "/landing_zain");
            }
        } else {

            $company = $this->detectCompnay();
            // continue to subscribe
            // insert log in our database
            $AdvertisingUrl = new AdvertisingUrl();
            $AdvertisingUrl->adv_url = session::get('adv_params');
            $AdvertisingUrl->msisdn = "965" . $msisdn;
            $AdvertisingUrl->operatorId = 8;
            $AdvertisingUrl->operatorName = "zain_kuwait";
            $AdvertisingUrl->ads_compnay_name = $company;
            if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                $AdvertisingUrl->transaction_id = session::get('transaction_id');
            }
            $AdvertisingUrl->save();

            if ($Msisdn) {

            } else {
                $Msisdn = new Msisdn();
                $Msisdn->msisdn = "965" . $msisdn;
            }

            $Msisdn->ad_company = $company;
            $Msisdn->operator_id = 8; // zain
            $Msisdn->ads_ur_id = $AdvertisingUrl->id;
            $Msisdn->ad_company = $company;
            if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                $Msisdn->transaction_id = session::get('transaction_id');
            }
            $Msisdn->save();


            if ($Msisdn) {  // continue to subscribe
                $msisdn_wcc = "965" . $msisdn;

                // zain subscribe api
                $zain_user_name = zain_user_name_alafay;
                $zain_password = zain_password_alafay;
                //  Zain subscribe api
                $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&originator=$msisdn_wcc&recipient=96946&messagedata=WEBSUBEN";
                $result = simplexml_load_file($URL); // Interprets an XML file into an object
                // make log
                $company = $this->detectCompnay();
                $actionName = "Zain Subscribe Url";
                $parameters_arr = array(
                    'MSISDN' => $msisdn_wcc,
                    'link' => $URL,
                    'date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'company' => $company,
                    'result' => (array)$result->data->acceptreport,
                    'statuscode' => (array)$result->data->acceptreport->statuscode
                );
                $this->log($actionName, $URL, $parameters_arr);


                $status_code = $result->data->acceptreport->statuscode;
                if ($status_code == 0) { // success
                    $AdvertisingUrl = new AdvertisingUrl();
                    $AdvertisingUrl->adv_url = session::get('adv_params');
                    $AdvertisingUrl->msisdn = $msisdn_wcc;
                    $AdvertisingUrl->operatorId = 8;
                    $AdvertisingUrl->operatorName = "zain_kuwait";
                    $AdvertisingUrl->status = 1;   // subscribe success BUT acutal subscribe come after notification
                    $AdvertisingUrl->ads_compnay_name = $company;
                    if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                        $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                        $AdvertisingUrl->transaction_id = session::get('transaction_id');
                    }
                    $AdvertisingUrl->save();


                    // update msisdn
                    $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
                    if ($Msisdn) {
                        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                        $Msisdn->ad_company = $company;
                        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                            $Msisdn->transaction_id = session::get('transaction_id');
                        }
                        $Msisdn->final_status = 1;
                        $Msisdn->save();
                    }

                    session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
                    //    return redirect("/landing");
                    return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=1&status=SS");
                } else {
                    session()->flash('failed', 'حدث خطأ');
                    return back();
                }
            } else {
                session()->flash('failed', 'حدث خطأ');
                return back();
            }
        }
    }

    public function subscribeZainConfirm_v2(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }

        $company = $this->detectCompnay();

        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
        if ($Msisdn_old) {
            //  session()->flash('failed', 'انت مشترك بالفعل');
            // return back();
            session(['MSISDN' => $msisdn, 'Status' => 'active']);
            if (isset($request->prev_url) && $request->prev_url != "") {
                return redirect($request->prev_url);
            } else {
                // redirect to last zain kuwait link
                $Url = Generatedurl::where('operator_id', zain_kuwait_operator_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap/" . $Url->UID);
                else
                    return redirect(url() . "/landing_zain");
            }
        }

        // continue to subscribe
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();

        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = "965" . $msisdn;
        $AdvertisingUrl->operatorId = 8;
        $AdvertisingUrl->operatorName = "zain_kuwait";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();


        // create unique pincode
        while (true) {
            $bin_code = rand(pow(10, 4), pow(10, 5) - 1);
            if (Msisdn::where('pincode', '=', $bin_code)->get()->isEmpty()) {
                break;
            }
        }

        Session::put('pincode', $bin_code);


        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = "965" . $msisdn;
        }

        $Msisdn->ad_company = $company;
        $Msisdn->operator_id = 8; // zain
        $Msisdn->pincode = $bin_code;
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();


        $msisdn_w_cc = "965" . $msisdn;
        $zain_user_name = zain_user_name;
        $zain_password = zain_password;
        $messagedata = "رجاء ادخال رمز التفعيل  ";
        $messagedata .= $bin_code;
        $message = urlencode($messagedata);

        //  Zain send messages
        $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&recipient=$msisdn_w_cc&messagedata=$message";
        $result = simplexml_load_file($URL); // Interprets an XML file into an object
        // make log
        $actionName = "Zain Pincode Send";
        $parameters_arr = array(
            'msisdn' => $msisdn_w_cc,
            'pincode' => $bin_code,
            'link' => $URL,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => (array)$result->data->acceptreport,
            'statuscode' => (array)$result->data->acceptreport->statuscode
        );
        $this->log($actionName, $URL, $parameters_arr);

        $status_code = $result->data->acceptreport->statuscode;
        if ($status_code == 0) { // success
            return view('landing_v2.pinCode', compact('msisdn'));
        } else {  // error
            $request->session()->flash('failed', 'statuscode not success');
            return view('landing_v2.pinCode', compact('msisdn'));
        }
    }

    public function subscribeZainPincodeConfirm_v2(request $request)
    {
        $pincode = $request->input('pincode');
        $msisdn = $request->input('msisdn');

        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('msisdn');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            $request->session()->flash('error', 'هذا الرقم غير صحيح');
            return view('landing_v2.pinCode', compact('msisdn'));
        }


        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->where('pincode', '=', $pincode)->orderBy('id', 'DESC')->first();

        if ($Msisdn) {  // pincode confirm is success
            $msisdn_wcc = "965" . $msisdn;

            $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
            if ($Msisdn_old) {
                session()->flash('failed', 'انت مشترك بالفعل');
                return view('landing_v2.pinCode', compact('msisdn'));
            }

            // zain subscribe api
            $zain_user_name = zain_user_name_alafay;
            $zain_password = zain_password_alafay;
            //  Zain subscribe api
            $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&originator=$msisdn_wcc&recipient=96946&messagedata=WEBSUBEN";
            $result = simplexml_load_file($URL); // Interprets an XML file into an object
            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain Subscribe Url";
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => (array)$result->data->acceptreport,
                'statuscode' => (array)$result->data->acceptreport->statuscode
            );
            $this->log($actionName, $URL, $parameters_arr);


            $status_code = $result->data->acceptreport->statuscode;
            if ($status_code == 0) { // success
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wcc;
                $AdvertisingUrl->operatorId = 8;
                $AdvertisingUrl->operatorName = "zain_kuwait";
                $AdvertisingUrl->status = 1;   // subscribe success BUT acutal subscribe come after notification
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();


                // update msisdn
                $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->final_status = 1;
                    $Msisdn->save();
                }

                session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
                //    return redirect("/landing");
                return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=1&status=SS");
            } else {
                session()->flash('failed', 'حدث خطأ');
                return view('landing_v2.pinCode', compact('msisdn'));
            }
        } else {
            session()->flash('failed', 'الكود الذي ادخلته غير صحيح.حاول مرة اخري');
            return view('landing_v2.pinCode', compact('msisdn'));
        }
    }

    public function subscribeZainConfirm_without_pinflow(request $request)
    {
        date_default_timezone_set("Africa/Cairo");
        $msisdn = $request->input('number');

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }

        $company = $this->detectCompnay();

        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
        if ($Msisdn_old) {
            session()->flash('failed', 'انت مشترك بالفعل');
            return back();
        }

        // continue to subscribe
        $Msisdn = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();

        // insert log in our database
        $AdvertisingUrl = new AdvertisingUrl();
        $AdvertisingUrl->adv_url = session::get('adv_params');
        $AdvertisingUrl->msisdn = "965" . $msisdn;
        $AdvertisingUrl->operatorId = 8;
        $AdvertisingUrl->operatorName = "zain_kuwait";
        $AdvertisingUrl->ads_compnay_name = $company;
        if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
            $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
            $AdvertisingUrl->transaction_id = session::get('transaction_id');
        }
        $AdvertisingUrl->save();

        if ($Msisdn) {

        } else {
            $Msisdn = new Msisdn();
            $Msisdn->msisdn = "965" . $msisdn;
        }

        $Msisdn->ad_company = $company;
        $Msisdn->operator_id = 8; // zain
        $Msisdn->ads_ur_id = $AdvertisingUrl->id;
        $Msisdn->ad_company = $company;
        if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
            $Msisdn->transaction_id = session::get('transaction_id');
        }
        $Msisdn->save();


        if ($Msisdn) {  // continue to subscribe
            $msisdn_wcc = "965" . $msisdn;

            // zain subscribe api
            $zain_user_name = zain_user_name_alafay;
            $zain_password = zain_password_alafay;
            //  Zain subscribe api
            $URL = "http://appvas7.isys.mobi:2006/api?action=sendmessage&username=$zain_user_name&password=$zain_password&originator=$msisdn_wcc&recipient=96946&messagedata=WEBSUBEN";
            $result = simplexml_load_file($URL); // Interprets an XML file into an object
            // make log
            $company = $this->detectCompnay();
            $actionName = "Zain Subscribe Url";
            $parameters_arr = array(
                'MSISDN' => $msisdn_wcc,
                'link' => $URL,
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'company' => $company,
                'result' => (array)$result->data->acceptreport,
                'statuscode' => (array)$result->data->acceptreport->statuscode
            );
            $this->log($actionName, $URL, $parameters_arr);


            $status_code = $result->data->acceptreport->statuscode;
            if ($status_code == 0) { // success
                $AdvertisingUrl = new AdvertisingUrl();
                $AdvertisingUrl->adv_url = session::get('adv_params');
                $AdvertisingUrl->msisdn = $msisdn_wcc;
                $AdvertisingUrl->operatorId = 8;
                $AdvertisingUrl->operatorName = "zain_kuwait";
                $AdvertisingUrl->status = 1;   // subscribe success BUT acutal subscribe come after notification
                $AdvertisingUrl->ads_compnay_name = $company;
                if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                    $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                    $AdvertisingUrl->transaction_id = session::get('transaction_id');
                }
                $AdvertisingUrl->save();


                // update msisdn
                $Msisdn = Msisdn::where('msisdn', '=', $msisdn_wcc)->where('operator_id', '=', 8)->orderBy('id', 'DESC')->first();
                if ($Msisdn) {
                    $Msisdn->ads_ur_id = $AdvertisingUrl->id;
                    $Msisdn->ad_company = $company;
                    if (session::get('transaction_id') !== NULL && session::get('transaction_id') != "") {
                        $Msisdn->transaction_id = session::get('transaction_id');
                    }
                    $Msisdn->final_status = 1;
                    $Msisdn->save();
                }

                session()->flash('success', 'تم تسجيلك بنجاح في خدمة  فلاتر سناب شات');
                //    return redirect("/landing");
                return redirect("/notification?action=5&mnc=103&msisdn=$msisdn_wcc&opsid=1&status=SS");
            } else {
                session()->flash('failed', 'حدث خطأ');
                return back();
            }
        } else {
            session()->flash('failed', 'حدث خطأ');
            return back();
        }
    }

    public function subscribeVivaKuwait_v2(request $request)
    {
        session::forget('message');
        if (isset($_SERVER['HTTP_MSISDN'])) {
            $msisdn = str_replace("965", "", $_SERVER['HTTP_MSISDN']);
        } else {
            $msisdn = $request->input('number');
        }

        if (!preg_match('/^[0-9]{8}$/', $msisdn)) {
            // session::flash('message', "رقم الجوال غير صحيح");
            session()->flash('error', 'هذا الرقم غير صحيح');
            return back();
        }


        // check status for zain
        $Msisdn_old = Msisdn::where('msisdn', '=', "965" . $msisdn)->where('final_status', '=', 1)->where('operator_id', '=', 51)->orderBy('id', 'DESC')->first();
        if ($Msisdn_old) {
            /*
              session()->flash('failed', 'انت مشترك بالفعل');
              return back();
             */

            // redirect to last zain kuwait link

            session(['MSISDN' => $msisdn, 'Status' => 'active']);
            if (isset($request->prev_url) && $request->prev_url != "") {
                return redirect($request->prev_url);
            } else {
                $Url = Generatedurl::where('operator_id', viva_kuwait_operator_id)->latest()->first();
                if ($Url)
                    return redirect(url() . "/cuurentSnap_v2/" . $Url->UID);
                else
                    return redirect(url() . "/landing_viva_v2");
            }
        } else {
            // insert log in our database for viva kuwait
            $company = $this->detectCompnay();
            $AdvertisingUrl = new AdvertisingUrl();
            $AdvertisingUrl->adv_url = session::get('adv_params');
            $AdvertisingUrl->msisdn = "965" . $msisdn;
            $AdvertisingUrl->operatorId = 51;
            $AdvertisingUrl->operatorName = "viva_kuwait";
            $AdvertisingUrl->ads_compnay_name = $company;
            if (session::get('publisherId_macro') !== NULL && session::get('publisherId_macro') != "") {
                $AdvertisingUrl->publisherId_macro = session::get('publisherId_macro');
                $AdvertisingUrl->transaction_id = session::get('transaction_id');
            }
            $AdvertisingUrl->save();

            return redirect("http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=4493&ServiceID=221&ImageURL=&CPWEBChannelID=4&INITAction=True");
        }
    }

    public function cuurentSnap_v2($UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url))
                return view('front.error');
            $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->get();
            $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->get();
            $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            $occasions_array = [];
            $occasions = [];
            foreach ($snap as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $sliders[] = Occasion::where('id', $occasion)->where('slider', 1)->first();
            }
            $sliders = array_filter($sliders);
            //$sliders = $url->operator->greetingimgs()->PublishedSnap()->Slider()->orderBy('RDate', 'desc')->get();
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->get(); // published filter only
            }

            return view('front.new_snap_v2.home', compact('Rdata_today', 'favourites', 'sliders', 'suggests', 'populars'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function home_v2($UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            // if (is_null($url))
            //     return view('front.error');
            $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->get();
            $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->get();
            $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            $occasions_array = [];
            $occasions = [];
            foreach ($snap as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $sliders[] = Occasion::where('id', $occasion)->where('slider', 1)->first();
            }
            $sliders = array_filter($sliders);
            //$sliders = $url->operator->greetingimgs()->PublishedSnap()->Slider()->orderBy('RDate', 'desc')->get();
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->get();
            }


            ///////////////////////////////////////////////////////

            $Rdata_today2 = $url->operator->greetingimgs()->PublishedSnapComming()->GroupBy('greetingimgs.occasion_id')->orderBy('RDate', 'asc')->orderBy('greetingimgs.id', 'asc')->limit(10)->get();

            // dd($Rdata_today2);

            // foreach ($Rdata_today2 as $filter) {
            //       echo $filter->id."========". $filter->occasion_id."============". $filter->title."================". $filter->RDate;
            //       echo "<hr>" ;
            //     }



            //  $sqlQuery = "SELECT greetingimgs.id as greetingimgID , greetingimgs.title as greetingTitle , greetingimgs.occasion_id as gtOccassion , greetingimgs.RDate as RDate , greetingimg_operator.id as grImgOperatorId FROM `greetingimgs` INNER JOIN greetingimg_operator on greetingimgs.id = greetingimg_operator.greetingimg_id WHERE greetingimg_operator.operator_id = 8 AND greetingimgs.snap = 1 and greetingimgs.EXDate >= '2019-11-18' GROUP BY greetingimgs.occasion_id ORDER BY greetingimgs.RDate ASC , greetingimgs.id LIMIT 50";
            //  $Rdata_today2 = DB::select(DB::raw($sqlQuery));

          //   print_r($Rdata_today2) ; die;

            //   foreach ($Rdata_today2 as $filter) {
            //       echo $filter->greetingimgID."========". $filter->gtOccassion."============". $filter->greetingTitle."================". $filter->RDate;
            //       echo "<hr>" ;
            //     }
            //     die;




            return view('front.newdesign.home', compact('Rdata_today', 'favourites', 'sliders', 'suggests', 'populars', 'Rdata_today2'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* start new design v4 *//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
    function get_root($occasion)
    {
        //$UID = UID();
        //$url = Generatedurl::where('UID', $UID)->first();
        //$check_parent = isset($occasion->parent_id) ? $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion->parent_id)->first():0;
        if(isset($occasion->parent_id)){
        $occasion = Occasion::where('id',$occasion->parent_id)->first();
        return get_root($occasion);
        }
        return $occasion;
    }

    public function newdesignv4($UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            // if (is_null($url))
            //     return view('front.error');
            $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->get();
            $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->get();
            $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();

            $newsnap = $url->operator->greetingimgs()->PublishedSnap()->whereNotNull('vid_path')->orderBy('id', 'desc')->limit(4)->get();

            // dd($newsnap);
            // foreach($newsnap as $id){
            //     echo $id->id;
            // }die;

            $occasions_array = [];
            $occasions = [];
            foreach ($snap as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $sliders[] = Occasion::where('id', $occasion)->first();
            }
            $sliders = array_filter($sliders);
            // dd($sliders);
            //$sliders = $url->operator->greetingimgs()->PublishedSnap()->Slider()->orderBy('RDate', 'desc')->get();
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->get();
            }

            // get popluar filters according to greetingimg_operator.poplar_count   = actual popluar count
            $Rdata_today2 = $url->operator->greetingimgs()->PublishedSnap()->orderBy('greetingimg_operator.popular_count', 'desc')->orderBy('RDate', 'desc')->orderBy('greetingimgs.id', 'desc')->GroupBy('greetingimgs.occasion_id')->limit(10)->get();


            return view('front.newdesignv4.home', compact('newsnap', 'Rdata_today', 'favourites', 'sliders', 'suggests', 'populars', 'Rdata_today2'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }

    public function occasions_v4(Request $request, $UID){


        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url))
            return view('front.error');
        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
        $occasions_array = [];
        $occasions = [];
        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);
        foreach ($occasions_array as $k => $occasion) {
            $sliders[] = Occasion::where('id', $occasion)->first();
        }
        $sliders = array_filter($sliders);

        // dd(count($sliders));
        $page = \Input::get('page', 1); // Get the ?page=1 from the url
        $perPage = 8; // Number of items per page
        $offset = ($page * $perPage) - $perPage;

        $Occasions = array_slice($sliders, $offset, $perPage, true);

        // dd($Occasions);

        if($request->ajax()){
            return view('front.newdesignv4.presult', compact('Occasions'));
        }

        return view('front.newdesignv4.search_page', compact('Occasions'));

    }
    public function suboccasions_v4(Request $request, $OID, $UID){

        $url = Generatedurl::where('UID', $UID)->first();
         if (is_null($url))
             return view('front.error');

        $occasion_id = $OID;
        $codes = [];

        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->paginate(8);

        // if ($Rdata->isEmpty()) {
        //       return view('front.error');
        // }
        foreach ($Rdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }
        $rbt_sms = $url->operator->rbt_sms;
        $Occasion = Occasion::where('id', $occasion_id)->first();

        $pageTitle = $Occasion->getTranslation('title',getCode());
        $child_occasions =[];
        $childs = Occasion::where('parent_id',$occasion_id)->get(); // occasion_id parent_id
        foreach($childs as $value){
            $check = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $value->id)->first();
            if($check){
                $child_occasions[] = $value;
            }
        }

        $page = \Input::get('page', 1); // Get the ?page=1 from the url
        $perPage = 8; // Number of items per page
        $offset = ($page * $perPage) - $perPage;

        $child_occasions = array_slice($child_occasions, $offset, $perPage, true);

        if($request->ajax())
            return view('front.newdesignv4.snapsresult', compact('pageTitle', 'Rdata','child_occasions' ,'rbt_sms', 'codes', 'occasion_id', 'Occasion'));

        return view('front.newdesignv4.sub_categories', compact('pageTitle', 'Rdata','child_occasions' ,'rbt_sms', 'codes', 'occasion_id', 'Occasion'));

    }

    public function filter_v4($OID, $UID){

        $url = Generatedurl::where('UID', $UID)->first();
        $occasion_id = $OID;
        $Rdata = Greetingimg::where('id', $OID)->first();
        return view('front.newdesignv4.inner_page', compact('Rdata'));

    }


    public function Search_v4(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $search = $request->search;
        Session::put('search', $search);
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url))
                return view('front.error');
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->paginate(8);
            $codes = [];
            foreach ($Rdata as $key => $value) {
                if ($value->rbt_id != null) {
                    $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                    $codes[$key] = $rbtCode ? $rbtCode->code : null;
                }
            }

            if ( OP() == ooredoo) {
                if(Session::has('currentOp') && Session::get('currentOp') == ooredoo){

                 }else{
                   return redirect(url(redirect_operator()));
                 }
             }

            $rbt_sms = $url->operator->rbt_sms;
            if($request->ajax())
                return view('front.newdesignv4.spresult', compact('Rdata', 'search','rbt_sms','codes'));
            return view('front.newdesignv4.categories', compact('Rdata', 'search','rbt_sms','codes'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }

    public function favouritesv4(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();

            $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->paginate(8);

            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->paginate(8);
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->paginate(8);
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->paginate(8);
            }

            // dd($suggests);
            if($request->ajax())
                return view('front.newdesignv4.fpresult', compact('favourites', 'suggests', 'populars'));

            return view('front.newdesignv4.filter', compact('favourites', 'suggests', 'populars'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* end new design v4 *////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* start rotana v5 *//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


public function rotana($UID)
{
    $current_url = \Request::fullUrl();

    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
        $url = Generatedurl::where('UID', $UID)->first();

        if(OP() ==  STC_OP_ID)
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == STC_OP_ID  ){  //  ZAIN NKSA

          }else{
              return redirect(url(roatan_ksa_redirect_operator()));
          }
        }
        if(OP() ==  ZAIN_OP_ID)
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == ZAIN_OP_ID   ){  // Mobily ksa

          } else{
              return redirect(url(roatan_ksa_redirect_operator()));
          }
        }


        if(OP() ==  ooredoo)
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == ooredoo   ){  // Mobily ksa

          } else{
              return redirect(url(roatan_ksa_redirect_operator()));
          }
        }

        if(OP() ==  du_operator_id)
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == du_operator_id   ){  // Du check

          } else{
              return redirect('du_landing_rotana');
          }
        }

        if(OP() ==  imi_op_id())
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == imi_op_id()   ){  // Mobily ksa

          } else{
              return redirect(url(roatan_ksa_redirect_operator()));
          }
        }


        if(OP() ==  MOBILY_KSA_HE())
        {
          if(Session::has('currentOp')  && Session::get('currentOp') == MOBILY_KSA_HE()   ){  // Mobily Ksa

          } else{
            return redirect(url(roatan_ksa_redirect_operator()));
          }

        }

        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();

        $newsnap = $url->operator->greetingimgs()->PublishedSnap()->whereNotNull('vid_path')->orderBy('id', 'desc')->limit(4)->get();

        $occasions_array = [];
        $categories = [];

        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);

        foreach ($occasions_array as $k => $occasion) {
            $sliders[] = Occasion::where('id', $occasion)->first();
        }
        $sliders = array_filter($sliders);

        foreach($sliders as $slider){
            array_push($categories, $slider->category()->first());
        }
        $categories = array_unique($categories);

        return view('front.rotanav2.home', compact('newsnap', 'categories'));
    } else {
        return redirect(url(roatan_ksa_redirect_operator()));
    }
}

public function occasions_rotana(Request $request, $CID, $UID){

    $occasions = Category::where('id', $CID)->first();
    if(!empty($occasions)){
        $Occasions = $occasions->occasions()->paginate(get_settings('pagination_limit'));

        if($request->ajax()){
            return view('front.rotanav2.ajaxoccasions', compact('Occasions'));
        }

        return view('front.rotanav2.occasions', compact('Occasions'));
    }else{
        return view('errors.404');
    }
}

public function filter_rotana(Request $request, $OID, $UID){

    $filters = Greetingimg::where('occasion_id', $OID)->paginate(get_settings('pagination_limit'));

    if($request->ajax()){
        return view('front.rotanav2.ajaxfilters', compact('filters'));
    }

    return view('front.rotanav2.filters', compact('filters'));

}

public function favorites_rotana(Request $request, $UID){
    return view('front.rotanav2.fav');
}

public function favorites_rotana_load(Request $request, $UID){
    $ids = $request->ids;
    $url = Generatedurl::where('UID', $UID)->first();

    if(!empty($ids)){
        $idsArray = explode(",", $ids);
        $snap = $url->operator->greetingimgs()->PublishedSnap()->whereIn('greetingimgs.id', $idsArray)->orderBy('RDate', 'desc')->paginate(get_settings('pagination_limit'));
        return view('front.rotanav2.ajaxfav', compact('snap'));
    }else{
        if(get_settings('only_favorites') == 0){
            $snap = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->paginate(12);
            session()->flash('only_favorites', 'only_favorites');
            return view('front.rotanav2.ajaxfav', compact('snap'));
        }else{
            return view('front.rotanav2.nofilter');
        }
    }

}

public function rotanav2_today($UID){
    $current_url = \Request::fullUrl();
    $favourites = [];
    $fav_id = [];
    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
        $url = Generatedurl::where('UID', $UID)->first();
        $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->first();
        if(isset($Rdata_today)){
            $occasi = Occasion::where('id', $Rdata_today->occasion_id)->first();
            $cat = Category::where('id',$occasi->category_id)->first();
            $occasis = Occasion::where('category_id', $cat->id)->paginate(get_settings('pagination_limit'));
                return view('front.rotanav2.today', compact('Rdata_today','occasi','cat','occasis'));
            }else{
              $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '<', Carbon::now()->format('Y-m-d'))->orderBy('greetingimg_operator.popular_count', 'desc')->orderBy('RDate', 'desc')->orderBy('greetingimgs.id', 'desc')->GroupBy('greetingimgs.occasion_id')->first();
              $occasi = Occasion::where('id', $Rdata_today->occasion_id)->first();
              // dd($occasi);
              $cat = Category::where('id',$occasi->category_id)->first();
              $occasis = Occasion::where('category_id', $cat->id)->paginate(get_settings('pagination_limit'));
              return view('front.rotanav2.today', compact('Rdata_today','occasi','cat','occasis'));
            }
    }else {
        return redirect(url(redirect_operator()));
    }
}

public function Search_v6(Request $request, $UID)
{
    $current_url = \Request::fullUrl();
    $search = $request->search;
    Session::put('search', $search);
    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
      $url = Generatedurl::where('UID', $UID)->first();
      if (is_null($url))
      return view('front.error');
      $Rdata = $url->operator->greetingimgs()->PublishedSnap()
        ->join('translatables','translatables.record_id','=','greetingimgs.id')
        ->join('tans_bodies','tans_bodies.translatable_id','translatables.id')
        ->where('translatables.table_name','greetingimgs')
        ->where('translatables.column_name','title')
        ->where(function($q) use ($request){
          $q->where('greetingimgs.title', 'like', '%' . $request->search . '%');
          $q->orWhere('tans_bodies.body', 'like', '%' . $request->search . '%');
        })
      ->limit(get_settings('pagination_limit'))
      ->orderBy('RDate', 'desc')
      ->paginate(get_settings('pagination_limit'));
        $codes = [];
        foreach ($Rdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }
        $rbt_sms = $url->operator->rbt_sms;

        if($request->ajax())
        return view('front.rotanav2.snapsresult', compact('Rdata', 'search','rbt_sms','codes'));
        return view('front.rotanav2.search1', compact('Rdata', 'search','rbt_sms','codes'));
    } else {
        return redirect(url(redirect_operator()));
    }
}

public function filter_inner($FID, $UID){
    $url = Generatedurl::where('UID', $UID)->first();
    if ($url == !null) {
        $occasion_id = $FID;
        $Rdata = Greetingimg::where('id', $FID)->first();
        //  dd($Rdata == !null);
        if($Rdata == !null){
          $occasi = Occasion::where('id', $Rdata->occasion_id)->first();
          $cat = Category::where('id',$occasi->category_id)->first();
          $occasis = Occasion::where('category_id', $cat->id)->get();
          //  dd($occasis);
          if(OP() ==  STC_OP_ID)
          {

            if(Session::has('currentOp')  && Session::get('currentOp') == STC_OP_ID  ){  //  STC KSA
            }else{
                return redirect(url(roatan_ksa_redirect_operator()));
            }
          }
          if(OP() ==  ZAIN_OP_ID)
          {
            if(Session::has('currentOp')  && Session::get('currentOp') == ZAIN_OP_ID   ){  // Mobily ksa

            } else{
                return redirect(url(roatan_ksa_redirect_operator()));
            }
          }
          if(OP() ==  ooredoo)
          {
            if(Session::has('currentOp')  && Session::get('currentOp') == ooredoo   ){   // Timwe

            } else{
                return redirect(url(roatan_ksa_redirect_operator()));
            }
          }

          if(OP() ==  du_operator_id)
          {
            if(Session::has('currentOp')  && Session::get('currentOp') == du_operator_id   ){  // Du check
  
            } else{
                return redirect('du_landing_rotana');
            }
          }

          if(OP() ==  imi_op_id())
          {
            if(Session::has('currentOp')  && Session::get('currentOp') == imi_op_id()   ){  // IMI

            } else{
                return redirect(url(roatan_ksa_redirect_operator()));
            }

          }
          if(OP() ==  MOBILY_KSA_HE())
          {
            if(Session::has('currentOp')  && Session::get('currentOp') == MOBILY_KSA_HE()   ){  // IMI

            } else{
              return redirect(url(roatan_ksa_redirect_operator()));
            }

          }


          return view('front.rotanav2.inner_page', compact('Rdata','occasi','cat','occasis'));
        }else{
            return view('errors.404');
        }
    }else{
        return view('errors.404');
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* end rotana v5 *////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* start mbc  *//////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


public function mbc($UID)
{
    $current_url = \Request::fullUrl();
    $favourites = [];
    $fav_id = [];
    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
        $url = Generatedurl::where('UID', $UID)->first();
        // if (is_null($url))
        //     return view('front.error');
        $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->get();
        $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->get();
        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();

        $newsnap = $url->operator->greetingimgs()->PublishedSnap()->whereNotNull('vid_path')->orderBy('id', 'desc')->limit(4)->get();

        // dd($newsnap);
        // foreach($newsnap as $id){
        //     echo $id->id;
        // }die;

        $occasions_array = [];
        $occasions = [];
        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);
        foreach ($occasions_array as $k => $occasion) {
            $sliders[] = Occasion::where('id', $occasion)->first();
        }
        $sliders = array_filter($sliders);
        // dd($sliders);
        //$sliders = $url->operator->greetingimgs()->PublishedSnap()->Slider()->orderBy('RDate', 'desc')->get();
        if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
            $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
        if ($favourites) {
            foreach ($favourites as $fav) {
                array_push($fav_id, $fav->id);
            }
            $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
        } else {
            $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->get();
        }

        // get popluar filters according to greetingimg_operator.poplar_count   = actual popluar count
        $Rdata_today2 = $url->operator->greetingimgs()->PublishedSnap()->orderBy('greetingimg_operator.popular_count', 'desc')->orderBy('RDate', 'desc')->orderBy('greetingimgs.id', 'desc')->GroupBy('greetingimgs.occasion_id')->limit(10)->get();


        return view('front.mbc.home', compact('newsnap', 'Rdata_today', 'favourites', 'sliders', 'suggests', 'populars', 'Rdata_today2'));
    } else {
        return redirect(url(redirect_operator()));
    }
}

public function occasions_mbc(Request $request, $UID){


    $url = Generatedurl::where('UID', $UID)->first();
    if (is_null($url))
        return view('front.error');
    $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
    $occasions_array = [];
    $occasions = [];
    foreach ($snap as $key => $value) {
        array_push($occasions_array, $value->occasion_id);
    }
    $occasions_array = array_unique($occasions_array);
    foreach ($occasions_array as $k => $occasion) {
        $sliders[] = Occasion::where('id', $occasion)->first();
    }
    $sliders = array_filter($sliders);

    // dd(count($sliders));
    $page = \Input::get('page', 1); // Get the ?page=1 from the url
    $perPage = 8; // Number of items per page
    $offset = ($page * $perPage) - $perPage;

    $Occasions = array_slice($sliders, $offset, $perPage, true);

    // dd($Occasions);

    if($request->ajax()){
        return view('front.mbc.presult', compact('Occasions'));
    }

    return view('front.mbc.search_page', compact('Occasions'));

}
public function suboccasions_mbc(Request $request, $OID, $UID){

    $url = Generatedurl::where('UID', $UID)->first();
     if (is_null($url))
         return view('front.error');

    $occasion_id = $OID;
    $codes = [];

    $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->orderBy('id', 'desc')->paginate(8);

    // if ($Rdata->isEmpty()) {
    //       return view('front.error');
    // }
    foreach ($Rdata as $key => $value) {
        if ($value->rbt_id != null) {
            $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
            $codes[$key] = $rbtCode ? $rbtCode->code : null;
        }
    }
    $rbt_sms = $url->operator->rbt_sms;
    $Occasion = Occasion::where('id', $occasion_id)->first();

    $pageTitle = $Occasion->getTranslation('title',getCode());
    $child_occasions =[];
    $childs = Occasion::where('parent_id',$occasion_id)->get(); // occasion_id parent_id
    foreach($childs as $value){
        $check = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $value->id)->first();
        if($check){
            $child_occasions[] = $value;
        }
    }

    $page = \Input::get('page', 1); // Get the ?page=1 from the url
    $perPage = 8; // Number of items per page
    $offset = ($page * $perPage) - $perPage;

    $child_occasions = array_slice($child_occasions, $offset, $perPage, true);

    if($request->ajax())
        return view('front.mbc.snapsresult', compact('pageTitle', 'Rdata','child_occasions' ,'rbt_sms', 'codes', 'occasion_id', 'Occasion'));

    return view('front.mbc.sub_categories', compact('pageTitle', 'Rdata','child_occasions' ,'rbt_sms', 'codes', 'occasion_id', 'Occasion'));

}

public function filter_mbc($OID, $UID){

    $url = Generatedurl::where('UID', $UID)->first();
    $occasion_id = $OID;
    $Rdata = Greetingimg::where('id', $OID)->first();
    return view('front.mbc.inner_page', compact('Rdata'));

}


public function Search_mbc(Request $request, $UID)
{
    $current_url = \Request::fullUrl();
    $search = $request->search;
    Session::put('search', $search);
    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url))
            return view('front.error');
        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->paginate(8);
        $codes = [];
        foreach ($Rdata as $key => $value) {
            if ($value->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$key] = $rbtCode ? $rbtCode->code : null;
            }
        }
        $rbt_sms = $url->operator->rbt_sms;
        if($request->ajax())
            return view('front.mbc.spresult', compact('Rdata', 'search','rbt_sms','codes'));
        return view('front.mbc.categories', compact('Rdata', 'search','rbt_sms','codes'));
    } else {
        return redirect(url(redirect_operator()));
    }
}

public function favouritesmbc(Request $request, $UID)
{
    $current_url = \Request::fullUrl();
    $favourites = [];
    $fav_id = [];
    if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
        $url = Generatedurl::where('UID', $UID)->first();

        $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->paginate(8);

        if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
            $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->paginate(8);
        if ($favourites) {
            foreach ($favourites as $fav) {
                array_push($fav_id, $fav->id);
            }
            $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->paginate(8);
        } else {
            $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('like', 'desc')->paginate(8);
        }

        // dd($suggests);
        if($request->ajax())
            return view('front.mbc.fpresult', compact('favourites', 'suggests', 'populars'));

        return view('front.mbc.filter', compact('favourites', 'suggests', 'populars'));
    } else {
        return redirect(url(redirect_operator()));
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////* end mbc *////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


    public function all_occasions($UID)
    {
        $UID = UID();
        $fav_id = [];
        $favourites = [];
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            $occasions_array = [];
            $occasions = [];
            foreach ($snap as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            foreach ($occasions_array as $k => $occasion) {
                $occasions[] = Occasion::where('id', $occasion)->where('slider', 0)->first();
            }
            $occasions = array_filter($occasions);
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            }
            return view('front.new_snap_v2.occasion', compact('occasions', 'suggests'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function main_occasions($UID)
    {
        $UID = UID();
        $fav_id = [];
        $favourites = [];
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            $occasions_array = [];
            $occasions = [];
            foreach ($snap as $key => $value) {
                array_push($occasions_array, $value->occasion_id);
            }
            $occasions_array = array_unique($occasions_array);
            // foreach ($occasions_array as $k => $occasion) {
            //     $parent = Occasion::where('id', $occasion)->first();
            //     if (isset($parent) && $parent->parent_id) {
            //         //check that parent in this operator
            //         $check_parent = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $parent->parent_id)->get();
            //         $occasion = $parent->parent_id;
            //     }
            //     $occasions[] = Occasion::where('id', $occasion)->first();
            // }
            foreach ($occasions_array as $k => $occasion_id) {
                $occasion = Occasion::where('id', $occasion_id)->first(); //check an parent 1 e3rd kl parent_id fe el menu else e3rd kol 7aga
                $occasion = get_root($occasion);
                $occasions[]  = $occasion;
            }
            $occasions = array_filter($occasions);
            $occasions = array_unique($occasions);
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
            if ($favourites) {
                foreach ($favourites as $fav) {
                    array_push($fav_id, $fav->id);
                }
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
            } else {
                $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
            }
            //return $occasions;
            return view('front.new_snap_v2.main_occasion', compact('occasions', 'suggests'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function all_favourite($UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();
            return view('front.new_snap_v2.favourite', compact('favourites'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function get_occasion($occasion_id, $UID)
    {
        $UID = UID();
        $fav_id = [];
        $favourites = [];
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->limit(get_settings('pagination_limit'))->get();
            $populars = $url->operator->greetingimgs()->PublishedSnap()->Popular()->where('occasion_id', $occasion_id)->orderBy('RDate', 'desc')->get();
            $occasion = Occasion::where('id', $occasion_id)->first();
            if (count($occasion->sub_occasions) > 0) {
                $url = Generatedurl::where('UID', $UID)->first();
                $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
                $occasions_array = [];
                $occasions = [];
                foreach ($snap as $key => $value) {
                    array_push($occasions_array, $value->occasion_id);
                }
                $occasions_array = array_unique($occasions_array);
                foreach ($occasions_array as $k => $occasion) {
                    $occasions[] = Occasion::where('id', $occasion)->where('parent_id', $occasion_id)->first();
                }
                $occasions = array_filter($occasions);
                //$occasions   = $occasion->sub_occasions;
                if ((Session::has('MSISDN') && Session::get('Status') == 'active'))
                    $favourites = $url->operator->greetingimgs()->Favourite(Session::get('MSISDN'))->PublishedSnap()->orderBy('RDate', 'desc')->limit(10)->get();
                if ($favourites) {
                    foreach ($favourites as $fav) {
                        array_push($fav_id, $fav->id);
                    }
                    $suggests = $url->operator->greetingimgs()->PublishedSnap()->whereNotIn('greetingimgs.id', $fav_id)->orderBy('RDate', 'desc')->get();
                } else {
                    $suggests = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();
                }
                return view('front.new_snap_v2.main_occasion', compact('occasions', 'suggests', 'Rdata', 'occasion'));
            } else {
                return view('front.new_snap_v2.snap', compact('Rdata', 'populars', 'occasion_id', 'occasion'));
            }
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function inner_snap_v2($greetingimg_id, $UID)
    {
        $current_url = \Request::fullUrl();
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.id', $greetingimg_id)->first();
            $codes = [];
            if ($Rdata->rbt_id != null) {
                $rbtCode = rbtCode::where('audio_id', $Rdata->rbt_id)->where('operator_id', $url->operator_id)->first();
                $codes[$Rdata->rbt_id] = $rbtCode ? $rbtCode->code : null;
            }
            $rbt_sms = $url->operator->rbt_sms;
            $this->popularCount('greetingimgs', $greetingimg_id);
            return view('front.new_snap_v2.inner_snap', compact('Rdata',  'codes', 'rbt_sms'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function Search_v2(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $search = $request->search;
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url))
                return view('front.error');
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->get();
            return view('front.new_snap_v2.search', compact('Rdata', 'search'));
        } else {
            return redirect(url(redirect_operator() . '?prev_url=' . $current_url));
        }
    }

    public function Search_v3(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $search = $request->search;
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url))
                return view('front.error');
            $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->limit(get_settings('pagination_limit'))->orderBy('RDate', 'desc')->get();
            $codes = [];
            foreach ($Rdata as $key => $value) {
                if ($value->rbt_id != null) {
                    $rbtCode = rbtCode::where('audio_id', $value->rbt_id)->where('operator_id', $url->operator_id)->first();
                    $codes[$key] = $rbtCode ? $rbtCode->code : null;
                }
            }
            $rbt_sms = $url->operator->rbt_sms;
            return view('front.newdesign.search', compact('Rdata', 'search','rbt_sms','codes'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }


    public function loadMoreSnapNew_v2($uid, Request $request)
    {
        $url = Generatedurl::where('UID', $uid)->first();
        $codes = [];
        $Snapdata = [];
        if ($request->type == 'favourite') {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->Favourite(Session::get('MSISDN'))->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } else if ($request->type == 'snap') {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('occasion_id', $request->occasion_id)->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        } else {
            $Snapdata = $url->operator->greetingimgs()->PublishedSnap()->where('greetingimgs.title', 'like', '%' . $request->search . '%')->orderBy('RDate', 'desc')->offset($request->start)->limit(get_settings('pagination_limit'))->get();
        }
        $view = view('front.new_snap_v2.snap_load', compact('Snapdata', 'url'))->render();
        return Response(array('html' => $view));
    }

    public function logout_v2()
    {
        Session::flush();
        $current_url = \Request::fullUrl();
        return redirect(url(redirect_operator()));
    }

    public function add_favourite($uid, $number, $greeting_id)
    {

        $url = Generatedurl::where('UID', $uid)->first();
        if ($url->operator_id == 16) {
            $prefix = "966";
        } else {
            $prefix = "965";
        }
        $msisdn = \App\Msisdn::where('msisdn', $prefix . $number)->where('operator_id', OP_switch($uid))->first();
        $check_old = \App\MsisdnGreetingimg::where('msisdn_id', $msisdn->id)->where('greetingimg_id', $greeting_id)->first();
        if (!$check_old) {
            \App\MsisdnGreetingimg::create([
                'greetingimg_id' => $greeting_id,
                'msisdn_id' => $msisdn->id
            ]);
        }
        return $check_old ? 'error' : 'success';
    }

    public function delete_favourite($uid, $number, $greeting_id)
    {
        $url = Generatedurl::where('UID', $uid)->first();
        if ($url->operator_id == 16) {
            $prefix = "966";
        } else {
            $prefix = "965";
        }
        $msisdn = \App\Msisdn::where('msisdn', $prefix . $number)->first();
        \App\MsisdnGreetingimg::where('msisdn_id', $msisdn->id)->where('greetingimg_id', $greeting_id)->delete();
        return 'success';
    }

    public function random_view()
    {
        $greetings = Greetingimg::all();
        foreach ($greetings as $greeting) {
            $greeting->popular_count = rand(1, 1000);
            $greeting->save();
        }
    }

    public function cat()
    {
        return view('front.new_snap_v2.categories');
    }

    public function zain_ksa_unsub()
    {
        return view('landing_v2.cancel');
    }

    public function zain_ksa_unsub_action()
    {
        return view('landing_v2.cancel');
    }

    public function unsusbcribe_zain_ksa(Request $request)
    {
        $messidn = zain_ksa_prefix . $request->number;
        //  $url = 'http://smsgisp.eg.mobizone.mobi/gisp-admin/MobilyKSAAPI?msisdn=' . $messidn . '&serv=f&action=unsub'; // Mobily
        $url = 'http://smsgisp.eg.mobizone.mobi/gisp-admin/ZainKSAAPI?msisdn=' . $messidn . '&serv=f&action=unsub'; // zain saudi
     //   $result = preg_replace('/\s+/', '', file_get_contents($url));
        $result = preg_replace('/\s+/', '', $this->GetPageData($url)) ;


        $company = $this->detectCompnay();
        $actionName = "Zain Ksa Unsub";
        $parameters_arr = array(
            'MSISDN' => $messidn,
            'link' => $url,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'company' => $company,
            'result' => $result
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


    public function unsub(Request $request)
    {

        Session::forget('contract_id'); // to remove any contract_id from session
        Session::forget('phone_number'); // to remove any contract_id from session

        if (isset($_GET['operator_id']) && !empty($_GET['operator_id']))
            $operator_id = $_GET['operator_id'];
        return view('front.unsub', compact('operator_id', 'request'));
    }

    public function new_landing(Request $request)
    {
        // if (Session::has('phone_number') && Session::has('status') && Session::get('status') == "active") {
        //     return redirect('/');
        // }else{
        // header inrichemnt DETECT
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


        $actionName = "Hits";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);  // log in

        return view($this->front_view . 'new_landing');
        //    }
    }

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
          //  $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

            $ipdat  = @json_decode($this->GetPageData("http://www.geoplugin.net/json.gp?ip=" . $ip)) ;

            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
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

    public function AddSubscriptionContractRequest(Request $request)
    {

        $phone_number = $request->MSISDN;

        $operatorCode = $request['operatorCode'];


        // make validation for egypt numbers that start with 2
        if (!preg_match('/^([0-9]{1})?[0-9]{11}$/', $phone_number)) {
            $request->session()->flash('failed', 'هذا الرقم غير صحيح');
            return back();
        }

        if (preg_match('/^2[0-9]{11}$/', $phone_number)) {  // mean this number is leading with 2   for egypt operators => so we remove 2
            $phone_number = ltrim($phone_number, '2');
        }

        $msisdn = Msisdn::where('phone_number', $phone_number)->orderBy('id', 'Desc')->first();
        if ($msisdn && $msisdn->status == 'active') {

            $shortCode = $this->shortCode($msisdn->operatorCode);
            $bin = Bin::where('msisdn_id', $msisdn->id)->orderBy('id', 'DESC')->first();
            if ($bin) {
                // already subscribe message
                //    لديك اشتراك مفعل فى خدمة استقيموا من IVAS بقيمة 2 جنيها يوميا  للوصول الى الخدمة قم بزيارة URL لإلغاء الاشتراك ارسل stop EST الى Short code
                $messageBody = "لديك اشتراك مفعل فى خدمة يلا وفر من IVAS بقيمة 2 جنيها يوميا للوصول الى الخدمة قم بزيارة ";
                $messageBody .= url("loginPC") . "/" . $msisdn->phone_number . "/" . $bin->bin;
                $messageBody .= "    تكلفة الخدمة 2 جنيها يوميا ";
                $messageBody .= " لإلغاء الاشتراك ارسل stop waffar الى ";
                $messageBody .= $shortCode;
                $messageBody .= "  مجانا  ";

                $link = url("loginPC") . "/" . $msisdn->phone_number . "/" . $bin->bin;

                $request->session()->flash('link', $link);
                $request->session()->flash('shortCode', $shortCode);

                $request->session()->flash('success_url_resend_again', $messageBody);
                $request->session()->flash('succss_subscribe_before', $messageBody);
                $request->session()->flash('msisdn_subscribe_before', $msisdn->phone_number);
            } else {
                $request->session()->flash('failed', 'حدث خطأ');
            }
            return redirect('landing');  // old confirm
        } elseif ($msisdn && $msisdn->status == "inactive") {
            $request->session()->flash('success_pincode', 'تم تسجيل هذا الرقم من قبل لكن لم يتم تأكيده رجاء ادخال كود التفعيل ');
            session(['contract_id' => $msisdn->contract_id]);
            return redirect('landing');  // old confirm
        } elseif ($msisdn && $msisdn->status == "pending") {
            $request->session()->flash('failed', 'رقمك موقوف');
            session(['contract_id' => $msisdn->contract_id]);
            return redirect('landing');  // old confirm
        } elseif ($msisdn && $msisdn->status == "under_processing") {
            $request->session()->flash('failed', 'طلبك تحت المعالجة ');
            session(['contract_id' => $msisdn->contract_id]);
            return redirect('landing');  // old confirm
        } elseif ($msisdn && $msisdn->status == "error") {
            $request->session()->flash('failed', 'جدث خطأ');
            session(['contract_id' => $msisdn->contract_id]);
            return redirect('new_landing');  // old confirm
        }


        $URL = "http://$this->status.tpay.me/api/TPaySubscription.svc/json/AddSubscriptionContractRequest";
        $startDate = gmdate("Y-m-d H:i:s\Z");
        $startDate = date('Y-m-d H:i:s\Z', strtotime($startDate . " +1 hour"));  // only in local
        $endDate = date('Y-m-d H:i:s\Z', strtotime($startDate . " +1 year"));

        // 012 -> 60201 orange
        // 010 -> 60202 vodafone
        // 011 -> 60203 etisalat

        $customerAccountNumber = $this->customerAccountNumber;
        $msisdn = $_REQUEST['MSISDN'];

        $operatorCode = $request['operatorCode'];

        $subscriptionPlanId = $this->subscriptionPlanId;
        $initialPaymentproductId = $this->service_name;
        $initialPaymentDate = $startDate;
        $executeInitialPaymentNow = "false";
        $recurringPaymentproductId = $this->service_name;
        $productCatalogName = $this->service_name;
        $executeRecurringPaymentNow = "false";
        $contractStartDate = $startDate;
        $contractEndDate = $endDate;
        $autoRenewContract = "true";
        $language = 2;
        $sendVerificationSMS = "true";
        $allowMultipleFreeStartPeriods = "false";
        $headerEnrichmentReferenceCode = "";
        $smsId = "";

        $message = $customerAccountNumber . $msisdn . $operatorCode . $subscriptionPlanId . $initialPaymentproductId .
            $initialPaymentDate . $executeInitialPaymentNow . $recurringPaymentproductId .
            $productCatalogName . $executeRecurringPaymentNow . $contractStartDate .
            $contractEndDate . $autoRenewContract .
            $language . $sendVerificationSMS . $allowMultipleFreeStartPeriods . $headerEnrichmentReferenceCode . $smsId;

        $privateKey = $this->privateKey;
        $signature = $this->publicKey . ":" . hash_hmac('sha256', $message, $privateKey);

        $parameters_arr = array(
            "signature" => $signature,
            "customerAccountNumber" => $customerAccountNumber,
            "msisdn" => $msisdn,
            "operatorCode" => $operatorCode,
            "subscriptionPlanId" => $subscriptionPlanId,
            "initialPaymentproductId" => $initialPaymentproductId,
            "initialPaymentDate" => $initialPaymentDate,
            "executeInitialPaymentNow" => 'false',
            "recurringPaymentproductId" => $recurringPaymentproductId,
            "productCatalogName" => $productCatalogName,
            "executeRecurringPaymentNow" => 'false',
            "contractStartDate" => $contractStartDate,
            "contractEndDate" => $contractEndDate,
            "autoRenewContract" => 'true',
            "language" => $language,
            "sendVerificationSMS" => 'true',
            "allowMultipleFreeStartPeriods" => "false",
            "headerEnrichmentReferenceCode" => "",
            "smsId" => ""
        );

        $result_json = $this->get_content_post($URL, $parameters_arr);

        // print_r($result_json); die;

        $result = json_decode($result_json);

        // create a log channel
        $actionName = "AddSubscriptionContractRequest";
        $this->log($actionName, $URL, $parameters_arr);  // log in
        $result_arr = (array)$result;
        $this->log($actionName, $URL, $result_arr);  // log out

        if ($result->operationStatusCode == 51) {

            // return back();
            if ($result->errorMessage == "This user already subscribed to the given product") {
                $request->session()->flash('success_url_resend_again', "انت مشترك بالفعل");

                $msisdn = Msisdn::where('phone_number', $msisdn)->where('status', 'active')->orderBy('id', 'Desc')->first();
                if ($msisdn) {
                    $shortCode = $this->shortCode($msisdn->operatorCode);
                    $bin = Bin::where('msisdn_id', $msisdn)->orderBy('id', 'DESC')->first();
                    $link = url("loginPC") . "/" . $msisdn . "/" . $bin->bin;
                    $request->session()->flash('link', $link);
                    $request->session()->flash('shortCode', $shortCode);
                } else {
                    $request->session()->flash('failed', "جدث خطأ");
                }

                return redirect('landing');
            } elseif (strpos($result->errorMessage, "wait for 2 minutes before issuing same request") !== false) {
                $request->session()->flash('failed', "يجب الانتظار دقيقتين");
                return back();
            } else {
                $request->session()->flash('failed', $result->errorMessage);
                return back();
            }
        } else {
            $request->session()->flash('success_pincode', 'تم ارسال رقم التاكيد رجاء ادخاله');
            // insert here in our database
            $msisdn = new Msisdn();
            $msisdn->phone_number = $phone_number;
            $msisdn->status = 'inactive';
            $msisdn->operatorCode = $operatorCode;
            $msisdn->save();
            $Msisdn = Msisdn::find($msisdn->id);

            //  session(['phone_number' => $Msisdn->phone_number]);
            session(['contract_id' => $result->subscriptionContractId]);
            $Msisdn->contract_id = $result->subscriptionContractId;
            $Msisdn->save();

            return redirect('landing');
        }
    }

    public function get_content_post($URL, $param)
    {

        $content = json_encode($param);

        //   print_r($content); die;

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
    public function zain_iraq_header(Request $request){
        //dd('ok');
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


        $actionName = "ZainIraqHeader";
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);  // log in
        //dd($request);
    }

    public function zain_iraq_landing(Request $request)
    {
        $this->zain_iraq_header($request);
        return view('front.zain_iraq.zain_iraq_landing');
    }

    public function zain_iraq_faild(Request $request)
    {
        $this->zain_iraq_header($request);
        return view('front.zain_iraq.zain_iraq_faild');
    }

    public function zain_iraq_success(Request $request)
    {
        $this->zain_iraq_header($request);
        return view('front.zain_iraq.zain_iraq_success');
    }

    public function du_landing()
    {
        return view('landing_v2.du_landing');
    }

    public function du_pinCode()
    {
        return view('landing_v2.du_pinCode');
    }

    public function du_unsub()
    {
        return view('landing_v2.du_unsub');
    }

    public function logout_zain_ksa($uid){
        Session::flush();
        return redirect('landing_zain_ksa');
    }

    public function logout_mobily_ksa($uid){
        Session::flush();
        return redirect('landing_mobily_ksa');
    }

    public function landing_kuwait(Request $request){


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
       // $result['AllHeaders'] = $_SERVER;
        $actionName = "Kuwait logs";
        if($request->has('operator_name')){
            $result['operator'] = $request->operator_name.' Kuwait';
            $actionName = $request->operator_name." Kuwait logs";

        }
        if($request->has('enterbtn')){
            $result['enterbtn'] = 'Enter Kuwait';
            $actionName = "Enter Kuwait logs";
        }
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr);  // log in
        if($request->ajax()){
            return 'done';
        }
        return view('landing_v2.landing_kuwait');
    }

    public function landing_kuwait_rotana(Request $request){

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
     // $result['AllHeaders'] = $_SERVER;
      $actionName = "Kuwait Rotana logs";
      if($request->has('operator_name')){
          $result['operator'] = $request->operator_name.' Kuwait';
          $actionName = $request->operator_name." Kuwait Rotana logs";

      }
      if($request->has('enterbtn')){
          $result['enterbtn'] = 'Enter Kuwait';
          $actionName = "Enter Kuwait logs";
      }
      $URL = $request->fullUrl();
      $parameters_arr = $result;
      $this->log($actionName, $URL, $parameters_arr);  // log in
      if($request->ajax()){
          return 'done';
      }
      return view('landing_v2.landing_kuwait_rotana');
  }

    public function landing_du_sub(Request $request)
    {
        $ip = $_SERVER["REMOTE_ADDR"];

        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }



        $country_from_ip = $this->ip_info("Visitor", "Country");
        $result['date'] = Carbon::now()->format('Y-m-d H:i:s');
        $result['ip'] = $ip;
        $result['country'] = $country_from_ip;
        // $result['AllHeaders'] = $_SERVER;
        $actionName = "Du Landing";
        if ($request->has('operator_name')) {
            $result['operator'] = $request->operator_name . '  Emirates';
            $actionName = $request->operator_name . " Clicks logs";

        }
        if ($request->has('enterbtn')) {
            $result['enterbtn'] = 'Enter Du';
            $actionName = "Enter Du logs";
        }
        $URL = $request->fullUrl();
        $parameters_arr = $result;
        $this->log($actionName, $URL, $parameters_arr); // log in
        if ($request->ajax()) {
            return 'done';
        }
        $peroid = isset( $request->peroid )  ?  $request->peroid  : "daily" ;
        $lang =  isset($request->lang) ? $request->lang : "ar" ;
        return view('landing_v2.du_sub_landing',compact("peroid","lang"));
    }
}
