<?php

namespace App\Http\Controllers;

use App\Category;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class OccasionsController extends Controller {

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
        $Occasions = Occasion::whereNull('parent_id')->paginate(15);
        return view('admin.occasions.index', compact('Occasions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        $Occasion =null;
        $occasion_parent   = Occasion::pluck('title', 'id');
        //$occasion_parent->prepend('Please Select Parent','Null');
        $Categories = Category::pluck('title', 'id');
        return view('admin.occasions.add', compact('Categories','Occasion','occasion_parent'));
    }


        public function operatorAddSnapFromCategoypForm() {
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Occasions = Occasion::pluck('title', 'id');
         $Ops = Operator::all();
        $Operators = array();
        foreach ($Ops as $Op) {
            $Operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }

        return view('admin.occasions.addToOperator', compact('Occasions','Operators'));
    }

     public function operatorAddSnapFromCategoySave(Request $request) {
           $occ_id=  $request->occasion_id ;
           $op_id =  $request->operator_id ;
           $all_op = '';
           foreach ($op_id as $opid) {
             $Operator =  Operator::findOrFail($opid);
             $sql = "SELECT id   FROM greetingimgs WHERE snap = 1 AND  ( occasion_id = $occ_id ) ";
             $res = \DB::select($sql);
            foreach ($res as $snap) {
              $snap_op = \App\GreetingimgOperator::where('operator_id',$opid)->where('greetingimg_id',$snap->id)->first();
              if(!$snap_op)
              {
                \App\GreetingimgOperator::create([
                  'greetingimg_id' => $snap->id,
                  'operator_id' => $opid
                ]);
              }

            }
            $all_op .=$Operator->name.' & ';
           }
           $all_op=rtrim($all_op,"& ");
        session()->flash('success','snap added successfully to '.$all_op);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //
        $this->validate($request, [
            'title' => 'required|max:60',
            'category_id' => 'required'
        ]);
        $Items = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uniqueID = time();
            $path = "Greetings/Occasion/";
            $file->move(public_path($path), $uniqueID . "." . $file->getClientOriginalExtension());
            $Items['image'] = $path . $uniqueID . "." . $file->getClientOriginalExtension();
        }
        Occasion::create($Items);
        return redirect(url('admin/occasions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $occasion  = Occasion::find($id);
      $Occasions =$occasion->sub_occasions()->paginate(15);
      $Occasions->setPath($id);
      return view('admin.occasions.index', compact('Occasions','occasion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $Categories = Category::pluck('title', 'id');
        $Occasion   = Occasion::find($id);
        $occasion_parent   = Occasion::pluck('title', 'id');
        //$occasion_parent->prepend('Please Select Parent','Null');
        return view('admin.occasions.edit', compact('Categories', 'Occasion','occasion_parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
        $this->validate($request, [
            'title' => 'required|max:60',
            'category_id' => 'required'
        ]);
        $Occasion = Occasion::find($id);
        $Items = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uniqueID = time();
            $path = "Greetings/Occasion/";
            $file->move(public_path($path), $uniqueID . "." . $file->getClientOriginalExtension());
            File::delete(public_path($Occasion->image));
            $Items['image'] = $path . $uniqueID . "." . $file->getClientOriginalExtension();
        }
        $Occasion->update($Items);
        return redirect(url($request->input('redirects_to')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        Occasion::destroy($id);
        return redirect(url('admin/occasions'));
    }

    public function AddImages($id) {
        return view('admin.occasions.addimages', compact('id'));
    }

    public function UploadImages($id, Request $request) {

        $this->validate($request, [
            'file' => 'mimes:png',
        ]);
        $Items = $request->all();
        $Path = $this->UploadContent($request->file('file'), 'bala7');
        $Items['path'] = $Path;
        $File = $request->file('file');
        $Items['title'] = $File->getClientOriginalName();
        $Items['occasion_id'] = $id;
        $Items['RDate'] = Carbon::now()->format('Y-m-d');
        $Items['EXDate'] = Carbon::now()->addMonth()->format('Y-m-d');
        Greetingimg::create($Items);
    }

    public function UploadContent($File, $Path) {
        $Name = $File->getClientOriginalName();
        $NewName = rand(100, 999) . ' - ' . $Name;
        $File->move(public_path('Greetings/' . $Path), $NewName);

        return 'Greetings/' . $Path . '/' . $NewName;
    }

}
