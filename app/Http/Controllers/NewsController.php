<?php

namespace App\Http\Controllers;

use App\News;
use App\Occasion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $news = News::latest('created_at');
      if($request->has('search_value')){
        $news = $news->whereLike(['title','published_date','description'],$request->search_value)
                ->orWhereHas('occasion',function($q) use ($request){
                  $q->whereLike(['title'],$request->search_value);
                });
      }
      $news = $news->paginate(10);
      if ($request->ajax()) {
          return view('admin.news.result',compact('news'));
      }
        return view('admin.news.index', compact('news'));
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

        return view('admin.news.add',compact('occasions','news'));
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
        'occasion_id' => 'required'
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
      // return $news;
      $occasions = Occasion::all();
      return view('admin.news.edit',compact('occasions','news'));
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
        'occasion_id' => 'required'
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
