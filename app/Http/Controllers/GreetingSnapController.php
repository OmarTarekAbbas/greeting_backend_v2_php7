<?php

namespace App\Http\Controllers;

use FFMpeg;
use App\Greetingimg;
use App\Occasion;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Language;
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
                        // ->join('greetingimg_operator','greetingimg_operator.greetingimg_id','=','greetingimgs.id')
                        // ->join('operators','operators.id','=','greetingimg_operator.operator_id')
                        // ->join('countries','countries.id','=','operators.country_id')
                        ->select(['greetingimgs.id' , 'occasion_id', 'greetingimgs.title', 'path', 'RDate', 'EXDate', 'featured', 'rbt_id', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle'])->get();

                        return Datatables::of($GreetingImgs)
                        ->addColumn('image', '<img src="{{ url($path) }}" height="90px">')
                        ->addColumn('featured', '@if($featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif')
                        ->addColumn('operators', function(Greetingimg $GreetingImg) {
                            return view('admin.gsnap.operator', compact('GreetingImg'))->render();
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
        $languages = Language::all();

        $operators = array();
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        return view('admin.gsnap.add', compact('Occasions', 'operators', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $languages = Language::all();
        $rules= array() ;
        foreach($languages as $lang){
            $rules["title.$lang->short_code"] = "required" ;
        }
        $rules['occasion_id']= "required";
        $rules['file']= "required|mimes:jpeg,jpg,png";
        $this->validate($request,$rules);

         $occasions = $request->occasion_id;
         $File = $request->file('file');
         $vidFile = $request->file('vid_file');
        //  dd($vidFile);
         $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));

            // dd($Path2);



            // $ffmpeg = FFMpeg\FFMpeg::create(
            //     array(
            // //    'ffmpeg.binaries'  => 'C:\ffmpeg\bin\ffmpeg.exe',
            // //    'ffprobe.binaries' => 'C:\ffmpeg\bin\ffprobe.exe',
            //     'timeout'          => 3600, // The timeout for the underlying process
            //     'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
            //     )
            // );
            // $video = $ffmpeg->open(public_path($Path2));
            // $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
            // $request->request->add(['image_preview' => $image_name]);
            // $frame->save($image_preview);


            $Items = $request->all();

            $Items['path'] = $Path;
            $Items['RDate'] = ($request->RDate) ? $request->RDate : Carbon::now()->format('Y-m-d');
            $Items['EXDate'] = ($request->EXDate) ? $request->EXDate : Carbon::createFromFormat('Y-m-d', $Items['RDate'])->addMonth()->format('Y-m-d');
            $Items['featured'] = ($request->input('featured') == 'on') ? 1 : 0;
            $Items['snap'] = 1;
            $num = rand (1000, 1500);
            $Items['popular_count'] = $num;

            if($request->file('vid_file')){
                $File2 = $request->file('vid_file');
                $Path2 = $this->UploadContent($request->file('vid_file'), Carbon::now()->format('d-m-Y'));

                $fileName = rand(100, 999) . '-' . $vidFile->getClientOriginalName();
                $fileName = substr($fileName, 0, -4).'.jpg';

                $image_name = time().rand(0,999);
                $image_preview = public_path('Greetings/'.Carbon::now()->format('d-m-Y').'/'.$image_name.'.jpg');
                shell_exec("ffmpeg -threads 1 -i " . public_path($Path2) . " -ss 00:00:02.00 -vframes 1 " . $image_preview);

                $Items['vid_path'] = $Path2;
                $Items['vid_type'] = 'Greetings/'.Carbon::now()->format('d-m-Y').'/'.$image_name.'.jpg';
            }
            //$Items['occasion_id'] = $occasion_id;
            $GImage = Greetingimg::create($Items);
            $GImage->fill($Items);
            foreach ($request->title as $key => $value)
            {
                $GImage->setTranslation('title', $key, $value);
            }


            // dd($GImage);
            $GImage->save();

            $sync = ($request->input('operator_list') ? : []);
            $GImage->operators()->sync($sync);
         //}
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
        $Occasions = Occasion::pluck('title', 'id');
        // $sql = 'SELECT  o.title , o.id FROM  occasions as o WHERE NOT EXISTS (select * from occasions as c where o.id = c.parent_id )';
        // $res = \DB::select($sql);
        // foreach ($res as $key => $value) {
        //   $Occasions[$value->id] = $value->title;
        // }
        $Ops = Operator::all();
        $operators = array();
        $languages = Language::all();
        foreach ($Ops as $Op) {
            $operators[$Op->id] = $Op->country->name . ' - ' . $Op->name;
        }
        return view('admin.gsnap.edit', compact('Occasions', 'GreetingImg', 'operators','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {

        $Items = $request->except('title');

        if($request->file('vid_file')){
            $GImage = Greetingimg::find($id);

            $File2 = $request->file('vid_file');
            $Path2 = $this->UploadContent($request->file('vid_file'), Carbon::now()->format('d-m-Y'));
            $fileName = rand(100, 999) . ' - ' . $File2->getClientOriginalName();
            $fileName = substr($fileName, 0, -4).'.jpg';

            // $ffmpeg = FFMpeg\FFMpeg::create(
            //     array(
            // //   'ffmpeg.binaries'  => 'C:\ffmpeg\bin\ffmpeg.exe',
            // //   'ffprobe.binaries' => 'C:\ffmpeg\bin\ffprobe.exe',
            //     'timeout'          => 3600, // The timeout for the underlying process
            //     'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
            //     )
            // );
            // $video = $ffmpeg->open(public_path($Path2));
            // $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
            $image_name = time().rand(0,999);
            $image_preview = public_path('Greetings/'.Carbon::now()->format('d-m-Y').'/'.$image_name.'.jpg');
            // $request->request->add(['image_preview' => $image_name]);
            // $frame->save($image_preview);

            shell_exec("ffmpeg -threads 1 -i " . public_path($Path2) . " -ss 00:00:02.00 -vframes 1 " . $image_preview);

            $Items['vid_path'] = $Path2;
            $Items['vid_type'] = 'Greetings/'.Carbon::now()->format('d-m-Y').'/'.$image_name.'.jpg';
            $GImage->update($Items);
         }



        // if (Auth::user()->admin == true) {  // if user is admin -- the operators multi select and startDate and endDate  will show --- so we make validation that  End date must be greater than start date
            if ($request->input('RDate') < $request->input('EXDate')) {

                $languages = Language::all();
                $rules= array() ;
                foreach($languages as $lang){
                    $rules["title.$lang->short_code"] = "required" ;
                }
                $this->validate($request,$rules);

                if (is_null($request->file('file'))) {  // not change image
                    $GImage = Greetingimg::find($id);

                    $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                    $Items['snap'] = 1;
                  //  $GImage->fill($Items);
                    foreach ($request->title as $key => $value)
                    {
                        $GImage->setTranslation('title', $key, $value);
                    }

                    $GImage->update($Items);
                } else {  // change greeting image
                    $GImage = Greetingimg::find($id);
                    File::delete(public_path($GImage->path));
                    $Path = $this->UploadContent($request->file('file'), Carbon::now()->format('d-m-Y'));
                    $Items = $request->except('title');
                    $Items['path'] = $Path;
                    $Items['featured'] = ($request->featured == 'on') ? 1 : 0;
                    $Items['snap'] = 1;

                    $GImage->fill($Items);
                    foreach ($request->title as $key => $value)
                    {
                        $GImage->setTranslation('title', $key, $value);
                    }
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
        $Name = str_replace(' ', '', $Name);
        // dd($Name);
        $NewName = rand(100, 999) . '-' . $Name;
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


    public function getDate(Request $request)
    {
        $dates = \App\Occasion::find($request->id);

        return  ['RDate' => $dates->occasion_RDate , 'EXDate' => $dates->occasion_EXDate];
    }
}
