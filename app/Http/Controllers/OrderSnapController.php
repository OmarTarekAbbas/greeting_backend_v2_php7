<?php

namespace App\Http\Controllers;

use App\Greetingimg;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Datatables;

class OrderSnapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $GreetingImgs = Greetingimg::where("snap", 1)
            ->join('occasions', 'occasions.id', '=', 'greetingimgs.occasion_id')
            ->join('categories', 'categories.id', '=', 'occasions.category_id')
           //->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
            ->select(['greetingimgs.id', 'greetingimgs.popular_count', 'occasion_id', 'greetingimgs.title', 'path', 'RDate', 'EXDate', 'featured', 'rbt_id', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle'])
            ->orderBy('popular_count', 'desc')
            ->get();
        return view('admin.ordersnap.index',compact('GreetingImgs'));
    }

/*    public function allData()
    {
        $GreetingImgs = Greetingimg::where("snap", 1)
            ->join('occasions', 'occasions.id', '=', 'greetingimgs.occasion_id')
            ->join('categories', 'categories.id', '=', 'occasions.category_id')
            ->select(['greetingimgs.id', 'greetingimgs.popular_count', 'occasion_id', 'greetingimgs.title', 'path', 'RDate', 'EXDate', 'featured', 'rbt_id', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle'])
            ->orderBy('popular_count', 'desc')
            ->get();
        return Datatables::of($GreetingImgs)
            ->addColumn('image', '<img src="{{ url($path) }}" height="90px">')
            ->addColumn('operators', function (Greetingimg $GreetingImg) {
                return $GreetingImg->operators->count();
            })
            ->addColumn('action', function (Greetingimg $GreetingImg) {
                return view('admin.gsnap.action', compact('GreetingImg'))->render();
            })
            ->make(true);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }


}
