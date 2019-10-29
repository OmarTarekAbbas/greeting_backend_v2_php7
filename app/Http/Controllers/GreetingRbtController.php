<?php

namespace App\Http\Controllers;

use App\Cprovider;
use App\Greetingaudio;
use App\Occasion;
use App\Operator;
use App\rbtCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Greetingimg;
use Validator;
use Datatables;

class GreetingRbtController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        //

        $snap = 0;
        if ($request->snap) {
            $Img = Greetingimg::find($request->snap);
            $GreetingAudios = Greetingaudio::where("id", $Img->rbt_id)->paginate(15);
            $snap = $request->snap;
        }
        return view('admin.grbts.index', compact('snap'));
    }

    public function allData(Request $request) {
        //
        if ($request->snap) {
            $Img = Greetingimg::find($request->snap);
        }
        $GreetingAudios = Greetingaudio::where('rbt', 1)
                ->join('occasions', 'occasions.id', '=', 'greetingaudios.occasion_id')
                ->join('categories', 'categories.id', '=', 'occasions.category_id')
                ->join('cproviders', 'cproviders.id', '=', 'greetingaudios.cprovider_id')
                ->select(['greetingaudios.id', 'occasion_id', 'greetingaudios.title', 'path', 'RDate', 'EXDate', 'featured', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle', 'cproviders.name as cproviderName']);
        if ($request->snap) {
            $GreetingAudios = $GreetingAudios->where("greetingaudios.id", $Img->rbt_id);
        }
        $GreetingAudios = $GreetingAudios->get();

        return Datatables::of($GreetingAudios)
                        ->addColumn('featured', '@if($featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif')
                        ->addColumn('operators', function(Greetingaudio $GreetingAudio) {
                            $Ops = '';
                            foreach ($GreetingAudio->operators as $Op) {
                                $Ops.= $Op->name . '-' . $Op->country->name . ', ';
                            }
                            return '<a href="#" data-toggle="tooltip" data-placement="right" title="' . $Ops . '">' . $GreetingAudio->operators->count() . '</a>';
                        })
                        ->addColumn('action', '@if(Auth::user()->admin == true)
                                {!! Form::open(array("class" => "form-inline col-xs-1","method" => "DELETE", "action" => array("GreetingRbtController@destroy", $id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm("Are you sure you want to delete {{ $title }}")">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                {!! Form::close() !!}
                                @endif
                                {!! Form::open(array("class" => "form-inline col-lg-1","method" => "GET", "action" => array("GreetingRbtController@edit", $id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                {!! Form::close() !!}
                                <audio src="{{ url($path) }}" controls onplay="pauseOther(this)"></audio>
                                ')
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $Greetingaudio = null;
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Cproviders = Cprovider::pluck('name', 'id');
        $codes = null;
        $Ops = Operator::all();
        $operators = array();
        $operators[0] = "";
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        $Img = null;
        if ($request->snapID) {
            $Img = Greetingimg::find($request->snapID);
        }
        return view('admin.grbts.add', compact('Img', 'codes', 'Occasions', 'Cproviders', 'Greetingaudio', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
                    'file' => 'required',
                    'title' => 'required',
                    'occasion_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $File = $request->file('file');
        if ($File->getClientOriginalExtension() == 'mp3') {

            $Items = $request->all();
            $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
            $Items['path'] = $Path;
            $Items['RDate'] = ($request->RDate) ? $request->RDate : Carbon::now()->format('Y-m-d');
            $Items['EXDate'] = ($request->EXDate) ? $request->EXDate : Carbon::createFromFormat('Y-m-d', $Items['RDate'])->addMonth()->format('Y-m-d');
            $Items['notification'] = 0;
            $Items['rbt'] = 1;
            $Items['featured'] = ($request->input('featured')) ? 1 : 0;
            $Greetingaudio = Greetingaudio::create($Items);
            if ($request->operator_id[0] != 0) {
                $sync = ($request->input('operator_id') ? : []);
                $Greetingaudio->operators()->sync($sync);
            }
            foreach ($request->operator_id as $k => $value) {
                if ($value != 0) {
                    $code['operator_id'] = $value;
                    $code['code'] = $request->code[$k];
                    $code['audio_id'] = $Greetingaudio->id;
                    rbtCode::create($code);
                }
            }
            Log::info('User ' . Auth::user()->name . ' Added audio ' . $request->input('title'));
            if ($request->snapID) {
                $Img = Greetingimg::find($request->snapID);
                $Img->rbt_id = $Greetingaudio->id;
                $Img->save();
                return redirect(url('admin/gsnap'));
            }
            return redirect(url('admin/grbts'));
        } else {
            return redirect()->back()->withErrors(['exerror' => 'You should upload mp3 file']);
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
        $Img = null;
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Cproviders = Cprovider::pluck('name', 'id');
        $Greetingaudio = Greetingaudio::find($id);
        $Ops = Operator::all();
        $operators = array();
        $operators[0] = "";
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        $codes = rbtCode::where('audio_id', $id)->get();
        return view('admin.grbts.edit', compact('Img', 'codes', 'Occasions', 'Cproviders', 'Greetingaudio', 'operators'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $collection = collect($request['operator_id']);
        foreach ($collection as $key => $value) {
            if ($value == 0)
                $collection->pull($key);
        }
        $request['operator_id'] = $collection->all();
        if (!$request->has('operator_list')) {
            $request->request->add(['operator_list' => $request['operator_id']]);
            $s = $request['operator_list'];
        }
        if ($request->input('RDate') < $request->input('EXDate')) {

            $Greetingaudio = Greetingaudio::find($id);
            if (is_null($request->file('file'))) {
                $Items = $request->all(); // user not change audio file
                $Items['featured'] = ($request->input('featured')) ? 1 : 0;
                $Greetingaudio->update($Items);
                $sync = ($request->input('operator_id') ? : []);
                $Greetingaudio->operators()->sync($sync);
                foreach ($request->operator_id as $k => $value) {
                    if ($value != '') {
                        $code['operator_id'] = $value;
                        $code['code'] = $request->code[$k];
                        if (isset($request->code_id[$k])) {
                            $rbtCode = rbtCode::find($request->code_id[$k]);
                            $rbtCode->update($code);
                        } else {
                            $code['audio_id'] = $id;
                            rbtCode::create($code);
                        }
                    }
                }
                return redirect(url($request->input('redirects_to')));
            } else {  // // user  change audio file
                $File = $request->file('file');
                if ($File->getClientOriginalExtension() == 'mp3') {

                    $Path = $this->UploadContent($File, Carbon::now()->format('d-m-Y'));
                    File::delete($Greetingaudio->path);
                    $Items = $request->all();
                    $Items['path'] = $Path;
                    $Items['notification'] = ($request->input('type') == '1') ? 1 : 0;
                    $Items['rbt'] = ($request->input('type') == '2') ? 1 : 0;
                    $Items['featured'] = ($request->input('featured')) ? 1 : 0;
                    $Greetingaudio->update($Items);
                    $sync = ($request->input('operator_id') ? : []);
                    $Greetingaudio->operators()->sync($sync);
                    foreach ($request->operator_id as $k => $value) {
                        if ($value != '') {
                            $code['operator_id'] = $value;
                            $code['code'] = $request->code[$k];
                            if (isset($request->code_id[$k])) {
                                $rbtCode = rbtCode::find($request->code_id[$k]);
                                $rbtCode->update($code);
                            } else {
                                $code['audio_id'] = $id;
                                rbtCode::create($code);
                            }
                        }
                    }
                    return redirect(url($request->input('redirects_to')));
                } else {
                    return redirect()->back()->withErrors(['exerror' => 'You should upload mp3 file']);
                }
            }
        } else {
            return redirect()->back()->withErrors(['rdate' => 'Start Date must be smaller than end date']);
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
        $Greetingaudio = Greetingaudio::find($id);
        //  File::delete($Greetingaudio->path);
        File::delete(base_path($Greetingaudio->path));
        $Greetingaudio->delete();
        return redirect(url('admin/grbts'));
    }

    public function UploadContent($File, $Path) {
        $Name = $File->getClientOriginalName();
        $NewName = rand(100, 999) . ' - ' . $Name;
        $File->move(public_path('Audios/' . $Path), $NewName);

        return 'Audios/' . $Path . '/' . $NewName;
    }

    public function showAudiosOfOperator($id) {
        $Operator = Operator::find($id);
        return view('admin.operators.showaudio', compact('Operator'));
    }

    public function DeAttachAudiosFromOperator($OpID, $AudId) {
        //return $OpID;
        $Operator = Operator::find($OpID);
        $Operator->greetingaudios()->detach($AudId);



        return redirect()->back();
    }

    public function del_code(Request $request) {
        $id = $request->id;
        $rbtCode = rbtCode::find($id);
        $del = $rbtCode->delete();
        if ($del)
            return Response('success');
        return Response('failed');
    }

}
