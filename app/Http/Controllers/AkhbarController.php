<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Generatedurl;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use App\News;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AkhbarController extends Controller
{
    public function index($UID)
    {
        $current_url = \Request::fullUrl();

        $url = Generatedurl::where('UID', $UID)->first();

        $snap = $url->operator->greetingimgs()->PublishedSnap()->orderBy('RDate', 'desc')->paginate(15);

        $occasions_array = [];

        foreach ($snap as $key => $value) {
            array_push($occasions_array, $value->occasion_id);
        }
        $occasions_array = array_unique($occasions_array);

        $news = News::whereIn('occasion_id', $occasions_array)->where('published_date', '<=', Carbon::now()->format('Y-m-d'))->latest('published_date')->limit(6)->get();

        if(request()->ajax()){
            return view('front.akhbar.ajaxfilters', compact('snap'));
        }

        return view('front.akhbar.home', compact('snap' , 'news'));
    }

    public function news($NID,$UID)
    {
        $current_url = \Request::fullUrl();
        $url = Generatedurl::where('UID', $UID)->first();
        $snaps = $url->operator->greetingimgs()->PublishedSnap()->where('RDate', '<=', Carbon::now()->format('Y-m-d'))->limit(3)->get();
        $news = News::where('id', $NID)->where('published_date', '<=', Carbon::now()->format('Y-m-d'))->first();
        return view('front.akhbar.today', compact('snaps', 'news'));
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

        $Rdata = $url->operator->greetingimgs()->PublishedSnap()->where('title', 'like', '%' . $request->search . '%')->paginate(15);

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
                session()->flash('only_favorites', 'only_favorites');
                return view('front.akhbar.ajaxfav', compact('snap'));
            }else{
                return view('front.akhbar.nofilter');
            }
        }

    }

}
