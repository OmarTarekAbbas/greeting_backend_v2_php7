<?php

namespace App\Http\Controllers;

use App\Country;
use App\Operator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OperatorsController extends Controller
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
        //
        $Operators = Operator::paginate(15);
        return view('admin.operators.index', compact('Operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $Countries = Country::orderBy('name', 'asc')->pluck('name', 'id');
        return view('admin.operators.add', compact('Countries'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // https://laravel.com/docs/5.1/validation
        // unique:table,column,except,idColumn
        // mnean that operator name is required and unique
        // 3 param ----  null --  to not ignore any id from that unique
        // 4 param  ---  id   -- is the id for operators table
        // country_id,'.$request->input('country_id')  ---   In the rule above, only rows with  country_id =  $request->input('country_id')  would be included in the unique check.
        $this->validate($request, array(
            'name'=>'required|unique:operators,name,null,id,country_id,'.$request->input('country_id'),
            'country_id'=>'required'
        ));
        Operator::create($request->all());
        return redirect(url('admin/operator'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $Operator = Operator::find($id);
        return view('admin.operators.show', compact('Operator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $Operator = Operator::findOrFail($id);
        $Countries = Country::orderBy('name', 'asc')->pluck('name', 'id');
        return view('admin.operators.edit', compact('Operator', 'Countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        Operator::findOrFail($id)->update($request->all());
         return redirect(url($request->input('redirects_to')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        Operator::destroy($id);
        return redirect()->back();
    }
}
