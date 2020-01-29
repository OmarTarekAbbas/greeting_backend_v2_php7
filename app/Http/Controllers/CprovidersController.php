<?php

namespace App\Http\Controllers;

use App\Cprovider;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CprovidersController extends Controller
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
        $Cproviders = Cprovider::paginate(15);
        return view('admin.cproviders.index', compact('Cproviders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);
        Cprovider::create($request->all());
        return redirect(url('admin/cproviders'));
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
        $Cprovider = Cprovider::find($id);
        return view('admin.cproviders.edit', compact('Cprovider'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);
        Cprovider::find($id)->update($request->all());
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
        Cprovider::destroy($id);
        return redirect(url('admin/cproviders'));
    }
}
