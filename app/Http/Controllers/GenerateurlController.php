<?php

namespace App\Http\Controllers;

use App\Generatedurl;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class GenerateurlController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        if (!file_exists('Greetings/url')) {
            mkdir('Greetings/url', 0777, true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $URLs = Generatedurl::all();
        //return $URLs;
        return view('admin.urls.index', compact('URLs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Ops = Operator::all();
        $Operators = array();
        foreach ($Ops as $Op) {
            $Operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        $GeneratedURL = null;
        return view('admin.urls.add', compact('Occasions', 'Operators', 'GeneratedURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //

        /* $this->validate($request, [
          'type' => 'required'
          ]); */

        /*
          - when create new greeting url :
          - We select occasion and operator and image or/and video .
          -If we not choose image and video , an error message appear
          “You can't generate URL without selecting type of url”.
          -If we choose image and there is no images in the selected operator , an error message appear “You can't generate URL without Images In operator”.
          -If we choose video and there is no images in the selected operator , an error message appear “You can't generate URL without Images In operator”.
          -the generated url  has UID = greetingUrl->id+random key.

         */

         //return $request->all();
         $Occasions = [];
         $count_snap = 0;
         $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
         $res = \DB::select($sql);
         foreach ($res as $key => $value) {
           array_push($Occasions,$value->id);
         }
         //get all snap in child
         $childs = Occasion::where('parent_id',$request->input('occasion_id'))->get();
         foreach ($childs as $child) {
           $Operator = Operator::find($request->input('operator_id'));
           $snap = $Operator->greetingimgs()->PublisheSnapdocc($child->id)->count();
           $count_snap +=$snap;
         }
        $Items = $request->all();
        //dd($request->input('img'));
        $Items['img'] = ($request->input('img') == 'on') ? true : false;
        $Items['audio'] = ($request->input('type') == 'audio') ? true : false;
        $Items['video'] = ($request->input('video') == 'on') ? true : false;

        if(in_array($request->input('occasion_id'),$Occasions) || $count_snap == 0)
        {
          if ($request->input('img') !== 'on' && $request->input('video') !== 'on') {  // you cant create url without select image and videos
              return redirect()->back()->withErrors(['emptytype' => "You can't generate URL without selecting type of url"]);
          } else {

              $OpID = $request->input('operator_id');
              $OccID = $request->input('occasion_id');
              $Operator = Operator::find($OpID);
              $Occasion = Occasion::find($OccID);
              if ($Items['img'] == true && ( $Operator->greetingimgs()->PublisheSnapdocc($OccID)->count() == 0)) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate URL without Images In operator"]);
              } elseif ($Items['video'] == true && $Operator->greetingaudios()->publishedocc($OccID)->count() == 0) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate Video URL without Audios In operator"]);
              } elseif ($Items['video'] == true && $Operator->greetingimgs()->publishedocc($OccID)->count() == 0) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate URL without Images In operator"]);
              } else {
                  if ($request->hasFile('file')) {
                      $file = $request->file('file');
                      $uniqueID = time();
                      $path = "Greetings/url/";
                      $file->move(public_path($path), $uniqueID . "." . $file->getClientOriginalExtension());
                      $Items['url_occasion_image'] = $path . $uniqueID . "." . $file->getClientOriginalExtension();
                  }
                  $GeneratedUrl = Generatedurl::create($Items);
                  $GeneratedUrl->update(['UID' => rand(1000, 9999) . $GeneratedUrl->id]);

                  $UID = $GeneratedUrl->UID;
                  $snap = $GeneratedUrl->operator->greetingimgs()->PublishedSnap()->count();
                  return view('admin.urls.generated', compact('UID', 'snap'));
              }
          }
        }
        else
        {
          $GeneratedUrl = Generatedurl::create($Items);
          $GeneratedUrl->update(['UID' => rand(1000, 9999) . $GeneratedUrl->id]);

          $UID = $GeneratedUrl->UID;
          $snap = $GeneratedUrl->operator->greetingimgs()->PublishedSnap()->count();
          return view('admin.urls.generated', compact('UID', 'snap'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Ops = Operator::all();
        $Operators = array();
        foreach ($Ops as $Op) {
            $Operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        $GeneratedURL = Generatedurl::find($id);

        return view('admin.urls.edit', compact('Occasions', 'Operators', 'GeneratedURL'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $GeneratedURL = Generatedurl::findOrFail($id);
        $Occasions = [];
        $count_snap = 0;
        $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        $res = \DB::select($sql);
        foreach ($res as $key => $value) {
          array_push($Occasions,$value->id);
        }
        //get all snap in child
        $childs = Occasion::where('parent_id',$request->input('occasion_id'))->get();
        foreach ($childs as $child) {
          $Operator = Operator::find($request->input('operator_id'));
          $snap = $Operator->greetingimgs()->PublisheSnapdocc($child->id)->count();
          $count_snap +=$snap;
        }
       $Items = $request->all();
       //dd($request->input('img'));
       $Items['img'] = ($request->input('img') == 'on') ? true : false;
       $Items['audio'] = ($request->input('type') == 'audio') ? true : false;
       $Items['video'] = ($request->input('video') == 'on') ? true : false;

       if(in_array($request->input('occasion_id'),$Occasions) || $count_snap == 0)
       {
          if ($request->input('img') !== 'on' && $request->input('video') !== 'on') {  // you cant create url without select image and videos
              return redirect()->back()->withErrors(['emptytype' => "You can't generate URL without selecting type of url"]);
          } else {

              $OpID = $request->input('operator_id');
              $OccID = $request->input('occasion_id');
              $Operator = Operator::find($OpID);
              $Occasion = Occasion::find($OccID);
              if ($Items['img'] == true && $Operator->greetingimgs()->PublisheSnapdocc($OccID)->count() == 0) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate URL without Images In operator"]);
              } elseif ($Items['video'] == true && $Operator->greetingaudios()->publishedocc($OccID)->count() == 0) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate Video URL without Audios In operator"]);
              } elseif ($Items['video'] == true && $Operator->greetingimgs()->publishedocc($OccID)->count() == 0) {
                  return redirect()->back()->withErrors(['emptyImages' => "You can't generate URL without Images In operator"]);
              } else {
                  if ($Items['img'] != true || $Items['video'] != true) {
                      $Items['url_occasion_text'] = null;
                      $Items['url_occasion_image'] = '';
                      File::delete(public_path($GeneratedURL->url_occasion_image));
                  } else {
                      if ($request->hasFile('file')) {
                          $file = $request->file('file');
                          $uniqueID = time();
                          $path = "Greetings/url/";
                          $file->move(public_path($path), $uniqueID . "." . $file->getClientOriginalExtension());
                          File::delete(public_path($GeneratedURL->url_occasion_image));
                          $Items['url_occasion_image'] = $path . $uniqueID . "." . $file->getClientOriginalExtension();
                      }
                  }
                  $GeneratedURL->update($Items);
                  $UID = $GeneratedURL->UID;
                  $snap = $GeneratedURL->operator->greetingimgs()->PublishedSnap()->count();
                  return view('admin.urls.generated', compact('UID', 'snap'));
              }
          }
      }
      else
      {
        $GeneratedURL->update($Items);
        $UID = $GeneratedURL->UID;
        $snap = $GeneratedURL->operator->greetingimgs()->PublishedSnap()->count();
        return view('admin.urls.generated', compact('UID', 'snap'));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        Generatedurl::destroy($id);
        return redirect()->back();
    }

    public function insertsnap() {
        $sql = "SELECT id   FROM greetingimgs WHERE snap = 1 AND  ( occasion_id = 62 OR occasion_id = 63 OR occasion_id = 64 OR occasion_id = 65 OR occasion_id = 69  ) ";

        $res = \DB::select($sql);



        foreach ($res as $snap) {

            \DB::table('greetingimg_operator')->insert(
                    ['greetingimg_id' => $snap->id, 'operator_id' => 24]
            );
        }
    }




}
