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
use DataTables;

class GreetingaudiosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //

        return view('admin.gaudios.index');
    }

    public function allData() {
        //
        $GreetingAudios = Greetingaudio::where('rbt', 0)->where('notification', 0)
                        ->join('occasions', 'occasions.id', '=', 'greetingaudios.occasion_id')
                        ->join('categories', 'categories.id', '=', 'occasions.category_id')
                        ->join('cproviders', 'cproviders.id', '=', 'greetingaudios.cprovider_id')
                        ->select(['greetingaudios.id', 'occasion_id', 'greetingaudios.title', 'path', 'RDate', 'EXDate', 'featured','occasions.title as occasionsTitle', 'categories.title as categoriesTitle','cproviders.name as cproviderName'])->get();

        return DataTables::of($GreetingAudios)
                        ->addColumn('featured', '@if($featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <buttonaddColumn type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif')
                        ->addColumn('operators', function(Greetingaudio $GreetingAudio) {
                            $Ops = '';
                            foreach ($GreetingAudio->operators as $Op) {
                                $Ops.= $Op->name . '-' . $Op->country->name . ', ';
                            }
                            return '<a href="#" data-toggle="tooltip" data-placement="right" title="'.$Ops.'">'.$GreetingAudio->operators->count().'</a>';
                        })
                        ->addColumn('action', '@if(Auth::user()->admin == true)
                                {!! Form::open(array("class" => "form-inline col-xs-1","method" => "DELETE", "action" => array("GreetingaudiosController@destroy", $id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm("Are you sure you want to delete {{ $title }}")">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                {!! Form::close() !!}
                                @endif
                                {!! Form::open(array("class" => "form-inline col-lg-1","method" => "GET", "action" => array("GreetingaudiosController@edit", $id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                {!! Form::close() !!}
                                <audio src="{{ url($path) }}" controls onplay="pauseOther(this)"></audio>
                                ')
            ->escapeColumns([])

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $Greetingaudio = null;
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Cproviders = Cprovider::pluck('name', 'id');
        $Ops = Operator::all();
        $operators = array();
        $operators[0] = "";
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        return view('admin.gaudios.add', compact('Occasions', 'Cproviders', 'Greetingaudio', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'file' => 'required',
            'title' => 'required',
            'occasion_id' => 'required'
        ]);
        $File = $request->file('file');

        if ($File->getClientOriginalExtension() == 'mp3') {

            $Items = $request->all();
            $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
            $Items['path'] = $Path;
            $Items['RDate'] = ($request->RDate) ? $request->RDate : Carbon::now()->format('Y-m-d');
            $Items['EXDate'] = ($request->EXDate) ? $request->EXDate : Carbon::createFromFormat('Y-m-d', $Items['RDate'])->addMonth()->format('Y-m-d');
            $Items['notification'] = 0;
            $Items['rbt'] = 0;
            $Items['featured'] = ($request->input('featured')) ? 1 : 0;
            $Greetingaudio = Greetingaudio::create($Items);
            $sync = ($request->input('operator_list') ? : []);
            $Greetingaudio->operators()->sync($sync);
            Log::info('User ' . Auth::user()->name . ' Added audio ' . $request->input('title'));
            return redirect(url('admin/gaudios'));
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
        return view('admin.gaudios.edit', compact('codes', 'Occasions', 'Cproviders', 'Greetingaudio', 'operators'));
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
                $sync = ($request->input('operator_list') ? : []);
                $Greetingaudio->operators()->sync($sync);
                return redirect(url($request->input('redirects_to')));
            } else {  // // user  change audio file
                $File = $request->file('file');
                if ($File->getClientOriginalExtension() == 'mp3') {

                    $Path = $this->UploadContent($File, Carbon::now()->format('d-m-Y'));
                    File::delete($Greetingaudio->path);
                    $Items = $request->all();
                    $Items['path'] = $Path;
                    $Items['featured'] = ($request->input('featured')) ? 1 : 0;
                    $Greetingaudio->update($Items);
                    $sync = ($request->input('operator_list') ? : []);
                    $Greetingaudio->operators()->sync($sync);
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
        File::delete(public_path($Greetingaudio->path));
        $Greetingaudio->delete();
        return redirect(url('admin/gaudios'));
    }

    public function UploadContent($File, $Path) {
        $Name = $File->getClientOriginalName();
        $NewName = rand(100, 999) . ' - ' . $Name;
        $File->move(public_path('Audios/' . $Path), $NewName);

        return 'Audios/' . $Path . '/' . $NewName;
    }

    public function showAudiosOfOperator($id,$type) {
        $Operator = Operator::find($id);
        if($type=='audios'){
            $audios=$Operator->greetingaudios()->audio()->get();
        }
        elseif($type=='rbts'){
            $audios=$Operator->greetingaudios()->rbt()->get();
        }
        elseif($type=='notifications'){
            $audios=$Operator->greetingaudios()->Notification()->get();
        }
        return view('admin.operators.showaudio', compact('Operator','audios','type'));
    }

    public function DeAttachAudiosFromOperator($OpID, $AudId) {
        //return $OpID;
        $Operator = Operator::find($OpID);
        $Operator->greetingaudios()->detach($AudId);



        return redirect()->back();
    }

}
