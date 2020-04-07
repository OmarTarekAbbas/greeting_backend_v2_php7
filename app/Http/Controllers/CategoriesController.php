<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Language;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminindex(){
        return view('admin.master');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $Categories = Category::paginate(15);
        $languages = Language::all();
        return view('admin.categories.index', compact('Categories','languages'));
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
            'title' => 'required'
        ]);

        $category = new Category();
        foreach ($request->title as $key => $value)
        {
            $category->setTranslation('title', $key, $value);
        }

        $category->save();
        return redirect('admin/categories');
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
        $Category = Category::findOrFail($id);
        $languages = Language::all();
        return view('admin.categories.edit', compact('Category','languages'));
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
        $category = Category::find($id);
        foreach ($request->title as $key => $value)
        {
            $category->setTranslation('title', $key, $value);
        }

        $category->save();
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
        Category::destroy($id);
        return redirect()->back();
    }

    public function addOccasion($id)
    {
        return view('admin.categories.add_occasion', compact('id'));
    }
}
