<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Language;
use Validator;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
            \App::setLocale($lang);
        }

		$filteredURL = preg_replace('~(\?|&)lang=[^&]*~', '$1', \URL::previous());
        return Redirect::to($filteredURL);
    }

    public function index()
    {
    	$languages = Language::all();
    	return view('admin.language.index',compact('languages'));
    }

    public function create()
    {
    	return view('admin.language.create');
    }

    public function store(Request $request)
    {
			// dd('here');
    	// return $request->all();
    	$validator = Validator::make($request->all(),[
    	                "title" => "required|unique:languages,title",
    	                "short_code" => "required|unique:languages,short_code",
    	                "rtl" => "required"
    	            ]);

    	if ($validator->fails()) {
    		return back()->withErrors($validator)->withInput();
    	}

    	$language = Language::create($request->all());
    	$request->session()->flash('success', 'Created Successfully');
			
			return redirect('admin/language');
    }

    public function edit($id)
    {
    	$language = Language::find($id);
    	return view('admin.language.create',compact('language'));
    }

    public function update($id,Request $request)
    {
    	$validator = Validator::make($request->all(),[
    	                "title" => "required|unique:languages,title,".$id,
    	                "short_code" => "required|unique:languages,short_code,".$id,
    	                "rtl" => "required"
    	            ]);

    	if ($validator->fails()) {
    		return back()->withErrors($validator)->withInput();
    	}

    	$language = Language::find($id);
    	$language->update($request->all());
    	$request->session()->flash('success', 'Updated Successfully');
    	return redirect('admin/language');
    }

    public function destroy($id)
    {
    	Language::destroy($id);
    	\Session::flash('success', 'Deleted Successfully');
    	return redirect('admin/language');
    }
}
