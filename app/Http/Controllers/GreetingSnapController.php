<?php

namespace App\Http\Controllers;

use App\Greetingimg;
use App\Occasion;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Datatables;

class GreetingSnapController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return view('admin.gsnap.index');
    }

    public function allData() {
        //
        $GreetingImgs = Greetingimg::where("snap", 1)
                        ->join('occasions', 'occasions.id', '=', 'greetingimgs.occasion_id')
                        ->join('categories', 'categories.id', '=', 'occasions.category_id')
                        ->select(['greetingimgs.id', 'occasion_id', 'greetingimgs.title', 'path', 'RDate', 'EXDate', 'featured', 'rbt_id', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle'])->get();

        return Datatables::of($GreetingImgs)
                        ->addColumn('image', '<img src="{{ url($path) }}" height="90px">')
                        ->addColumn('featured', '@if($featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif')
                        ->addColumn('operators', function(Greetingimg $GreetingImg) {
                            return $GreetingImg->operators->count();
                        })
                        ->addColumn('action',function(Greetingimg $GreetingImg) {
                            return view('admin.gsnap.action', compact('GreetingImg'))->render();
                        })
                        ->make(true);
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
        $operators = array();
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        return view('admin.gsnap.add', compact('Occasions', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //return $request->all();
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png',
            'title' => 'required',
            'occasion_id' => 'required'
        ]);
         $occasions = $request->occasion_id;
         $File = $request->file('file');
         $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
         foreach ($occasions as $k=>$occasion_id) {
            $Items   = $request->except('occasion_id');
            if($k>0){
              $Name = $File->getClientOriginalName();
              $NewName = rand(100, 999) . ' - ' . $Name;
              $NewPath = 'Greetings/' . Carbon::now()->format('d-m-Y').'/'.$NewName;
              copy(public_path($Path),public_path($NewPath));
              $Items['path'] = $NewPath;
            }
            else
            {
              $Items['path'] = $Path;
            }
            $Items['RDate'] = ($request->RDate) ? $request->RDate : Carbon::now()->format('Y-m-d');
            $Items['EXDate'] = ($request->EXDate) ? $request->EXDate : Carbon::createFromFormat('Y-m-d', $Items['RDate'])->addMonth()->format('Y-m-d');
            $Items['featured'] = ($request->input('featured') == 'on') ? 1 : 0;
            $Items['snap'] = 1;
            $Items['occasion_id'] = $occasion_id;
            $GImage = Greetingimg::create($Items);
            $sync = ($request->input('operator_list') ? : []);
            $GImage->operators()->sync($sync);
         }
        return redirect(url('admin/gsnap'));
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
        $GreetingImg = Greetingimg::find($id);
        //$Occasions = Occasion::pluck('title', 'id');
        $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        $res = \DB::select($sql);
        foreach ($res as $key => $value) {
          $Occasions[$value->id] = $value->title;
        }
        $Ops = Operator::all();
        $operators = array();
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        return view('admin.gsnap.edit', compact('Occasions', 'GreetingImg', 'operators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        if (Auth::user()->admin == true) {  // if user is admin -- the operators multi select and startDate and endDate  will show --- so we make validation that  End date must be greater than start date
            if ($request->input('RDate') < $request->input('EXDate')) {
                if (is_null($request->file('file'))) {  // not change image
                    $GImage = Greetingimg::find($id);
                    $Items = $request->all();
                    $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                    $Items['snap'] = 1;
                    $GImage->update($Items);
                } else {  // change greeting image
                    $GImage = Greetingimg::find($id);
                    File::delete(public_path($GImage->path));
                    $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
                    $Items = $request->all();
                    $Items['path'] = $Path;
                    $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                    $Items['snap'] = 1;
                    $GImage->update($Items);
                }
                $sync = ($request->input('operator_list') ? : []);
//               /  print_r($sync); die;
                $GImage->operators()->sync($sync);  // sync()  built in laravel :     Sync the intermediate tables with a list of IDs or collection of models.
                //return $request->input('redirect_to');
                return redirect(url($request->input('redirects_to')));
            } else {
                return redirect()->back()->withErrors(['rdate' => 'Start Date must be smaller than end date']);
            }
        } else {  // the same code inside admin role but only without  date validation -- i wonder why he seperate in two sections as the code in two is the same
            if (is_null($request->file('file'))) {
                $Items = $request->all();
                $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                $Items['snap'] = 1;
                $GImage = Greetingimg::find($id);
                $GImage->update($Items);
            } else {
                $GImage = Greetingimg::find($id);
                File::delete(public_path($GImage->path));
                $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
                $Items = $request->all();
                $Items['path'] = $Path;
                $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                $Items['snap'] = 1;
                $GImage->update($Items);
            }
            $sync = ($request->input('operator_list') ? : []);
            $GImage->operators()->sync($sync);
            //return $request->input('redirect_to');
            return redirect(url($request->input('redirects_to')));
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
        $GImage = Greetingimg::find($id);
        File::delete(public_path($GImage->path));
        $GImage->delete();
        return redirect(url('admin/gsnap'));
    }

    public function UploadContent($File, $Path) {
        $Name = $File->getClientOriginalName();
        $NewName = rand(100, 999) . ' - ' . $Name;
        $File->move(public_path('Greetings/' . $Path), $NewName);
        return 'Greetings/' . $Path . '/' . $NewName;
    }

    public function showImagesOfOperator($id) {  // to show the images for that operator by use  many to many relation  greetingimgs()  in operator model
        $Operator = Operator::find($id);
        return view('admin.operators.showimages', compact('Operator'));
    }

    public function DeAttachImageFromOperator($OpID, $ImgId) {  //  to remove an image for sepecfic operator  from pivot table "greetingimg_operator" by detach
        /*
          //  detach() :    Remove reationship from many-to-many models
          - link:  http://stackoverflow.com/questions/18731653/remove-reationship-from-many-to-many-models-in-laravel-4
          -example:
          $one = OneModel::findOrFail($id);
          $one->two_model()->detach($two_id);
          This will delete only the relation with one_model's table's $id and two_model's table's $two_id in your pivot table.
         */
        $Operator = Operator::find($OpID);
        $Operator->greetingimgs()->detach($ImgId);
        return redirect()->back();
    }

}
