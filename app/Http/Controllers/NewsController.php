<?php

namespace App\Http\Controllers;

use App\News;
use App\Occasion;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return ('admin.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $occasions = Occasion::all();
        $news      = null;

        return view('admin.news.form',compact('occasions','news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required|string',
        'description' => 'required',
        'image'=> 'required:mimes:jpeg,png,gif,webp,jpg|max:2048',
        'occasion_id' => 'required|occasions:exsist'
      ]);

      $news = News::create($request->all());

      session()->flash('success', 'News Added Will');

      return redirect('/admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
      $occasions = Occasion::all();
      return view('admin.news.form',compact('occasions','news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
      $this->validate($request, [
        'title' => 'required|string',
        'description' => 'required',
        'image'=> '',
        'occasion_id' => 'required|occasions:exsist'
      ]);

      $news = $news->update($request->all());
      session()->flash('success', 'News update Will');
      return redirect('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        session()->flash('success', 'News Deleted Will');
        return back();
    }
}
