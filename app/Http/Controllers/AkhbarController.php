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
use App\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AkhbarController extends Controller
{
    public function index($UID)
    {
        $current_url = \Request::fullUrl();

        $url = Generatedurl::where('UID', $UID)->first();

        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->paginate(18);

        $occasions_array = [];

        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);

        $news = News::whereIn('occasion_id', $occasions_array)->where('published_date', '=', Carbon::now()->format('Y-m-d'))->get();

        if(request()->ajax()){
            return view('front.akhbar.ajaxfilters', compact('snap'));
        }

        return view('front.akhbar.home', compact('snap' , 'news'));
    }

    public function news($NID,$UID)
    {
        $current_url = \Request::fullUrl();
        $favourites = [];
        $fav_id = [];
        $url = Generatedurl::where('UID', $UID)->first();
        $Rdata_today = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '=', Carbon::now()->format('Y-m-d'))->orderBy('RDate', 'desc')->first();
        $occasi = Occasion::where('id', $Rdata_today->occasion_id)->first();
        $cat = Category::where('id', $occasi->category_id)->first();
        $occasis = Occasion::where('category_id', $cat->id)->paginate(get_settings('pagination_limit'));
        return view('front.akhbar.today', compact('Rdata_today', 'occasi', 'cat', 'occasis'));
        // $current_url = \Request::fullUrl();
        // $url = Generatedurl::where('UID', $UID)->first();
        // $news = News::where('id', $NID)->where('published_date', '<=', Carbon::now()->format('Y-m-d'))->get();
        // return view('front.akhbar.today', compact('news'));
    }

    public function search(Request $request, $UID)
    {
        $current_url = \Request::fullUrl();
        $search = $request->search;
        Session::put('search', $search);
        $url = Generatedurl::where('UID', $UID)->first();
        if (is_null($url)) {
            return view('front.error');
        }

        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', '%' . $request->search . '%')->paginate(18);

        if ($request->ajax()) {
            return view('front.akhbar.snapsresult', compact('Rdata', 'search'));
        }

        return view('front.akhbar.search1', compact('Rdata', 'search'));
    }

    public function filter_inner($FID, $UID)
    {
        $url = Generatedurl::where('UID', $UID)->first();
        if ($url == !null) {
            $occasion_id = $FID;
            $Rdata = Greetingimg::where('id', $FID)->first();
            if ($Rdata == !null) {
                return view('front.akhbar.inner_page', compact('Rdata'));
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
