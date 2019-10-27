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

class OperatorSnapController extends Controller
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
            ->join('greetingimg_operator', 'greetingimg_operator.greetingimg_id', '=', 'greetingimgs.id')
            ->select(['greetingimgs.id','greetingimg_operator.popular_count as count',  'occasion_id', 'greetingimgs.title', 'path', 'RDate', 'EXDate', 'featured', 'rbt_id', 'occasions.title as occasionsTitle', 'categories.title as categoriesTitle'])
            ->orderBy('count', 'desc')
            ->get();
        return view('admin.operatorsnap.index',compact('GreetingImgs'));
    }


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
