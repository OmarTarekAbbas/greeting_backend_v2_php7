<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

class AkhbarController extends Controller
{
    public function index($UID)
    {
        $current_url = \Request::fullUrl();

        $url = Generatedurl::where('UID', $UID)->first();

        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->get();

        dd($snap->take(10));
        $occasions_array = [];

        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);

        return view('front.akhbar.home', compact('snap'));
    }

    public function occasions(Request $request, $CID, $UID)
    {

        $occasions = Category::where('id', $CID)->first();
        if (!empty($occasions)) {
            $Occasions = $occasions->occasions()->paginate(get_settings('pagination_limit'));

            if ($request->ajax()) {
                return view('front.akhbar.ajaxoccasions', compact('Occasions'));
            }

            return view('front.akhbar.occasions', compact('Occasions'));
        } else {
            return view('errors.404');
        }
    }

    public function filter(Request $request, $OID, $UID)
    {

        $filters = Greetingimg::where('occasion_id', $OID)->paginate(get_settings('pagination_limit'));

        if ($request->ajax()) {
            return view('front.akhbar.ajaxfilters', compact('filters'));
        }

        return view('front.akhbar.filters', compact('filters'));

    }

    public function today($UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->first();
            if (isset($Rdata_today)) {
                $occasi = Occasion::where('id', $Rdata_today->occasion_id)->first();
                $cat = Category::where('id', $occasi->category_id)->first();
                $occasis = Occasion::where('category_id', $cat->id)->paginate(get_settings('pagination_limit'));
                return view('front.akhbar.today', compact('Rdata_today', 'occasi', 'cat', 'occasis'));
            } else {
                $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '<', Carbon::now()->format('Y-m-d'))->orderBy('greetingimg_operator.popular_count', 'desc')->orderBy('RDate', 'desc')->orderBy('greetingimgs.id', 'desc')->GroupBy('greetingimgs.occasion_id')->first();
                $occasi = Occasion::where('id', $Rdata_today->occasion_id)->first();
                // dd($occasi);
                $cat = Category::where('id', $occasi->category_id)->first();
                $occasis = Occasion::where('category_id', $cat->id)->paginate(get_settings('pagination_limit'));
                return view('front.akhbar.today', compact('Rdata_today', 'occasi', 'cat', 'occasis'));
            }
        } else {
            return redirect(url(redirect_operator()));
        }
    }

    public function search(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $search = $request->search;
        Session::put('search', $search);
        if (!check_op() || (Session::has('MSISDN') && Session::get('Status') == 'active')) {
            $url = Generatedurl::where('UID', $UID)->first();
            if (is_null($url)) {
                return view('front.error');
            }

            $Rdata = $url->operator->greetingimgs()->PublishedSnap()
                ->join('translatables', 'translatables.record_id', '=', 'greetingimgs.id')
                ->join('tans_bodies', 'tans_bodies.translatable_id', 'translatables.id')
                ->where('translatables.table_name', 'greetingimgs')
                ->where('translatables.column_name', 'title')
                ->where(function ($q) use ($request) {
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

            if ($request->ajax()) {
                return view('front.akhbar.snapsresult', compact('Rdata', 'search', 'rbt_sms', 'codes'));
            }

            return view('front.akhbar.search1', compact('Rdata', 'search', 'rbt_sms', 'codes'));
        } else {
            return redirect(url(redirect_operator()));
        }
    }

    public function filter_inner($FID, $UID)
    {
        $url = Generatedurl::where('UID', $UID)->first();
        if ($url == !null) {
            $occasion_id = $FID;
            $Rdata = Greetingimg::where('id', $FID)->first();
            //  dd($Rdata == !null);
            if ($Rdata == !null) {
                $occasi = Occasion::where('id', $Rdata->occasion_id)->first();
                $cat = Category::where('id', $occasi->category_id)->first();
                $occasis = Occasion::where('category_id', $cat->id)->get();
                return view('front.akhbar.inner_page', compact('Rdata', 'occasi', 'cat', 'occasis'));
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function favorites(Request $request, $UID){
        return view('front.akhbar.fav');
    }

    
    public function favorites_load(Request $request, $UID){
        $ids = $request->ids;
        $url = Generatedurl::where('UID', $UID)->first();

        if(!empty($ids)){
            $idsArray = explode(",", $ids);
            $snap = $url->operator->greetingimgs()->PublishedSnap()->whereIn('greetingimgs.id', $idsArray)->orderBy('RDate', 'desc')->paginate(get_settings('pagination_limit'));
            return view('front.akhbar.ajaxfav', compact('snap'));
        }else{
            if(get_settings('only_favorites') == 0){
                $snap = $url->operator->greetingimgs()->PublishedSnap()->Popular()->orderBy('RDate', 'desc')->paginate(12);
                return view('front.akhbar.ajaxfav', compact('snap'));
            }else{
                return view('front.akhbar.nofilter');
            }
        }

    }

}
