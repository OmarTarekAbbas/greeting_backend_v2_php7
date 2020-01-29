@extends('front.new_snap_v2.layout')
@section('content')

<style type="text/css">
  body {
    /*height: 100%;*/
  }
</style>

<!-- main content -->
<div class="main">

    <div class="owl_main owl-carousel owl-theme">
        @foreach($sliders as $slider)
        <div class="item">
            <a href="{{url('occasion/'.$slider->id.'/'.UID())}}">
                <img src="{{url('/'.$slider->image)}}" alt="">
            </a>
        </div>
        @endforeach

    </div>

    <!------------------------------------------------>

    <div class="container">

        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form  action="{{url('Search_v2/'.UID())}}" method="get">
              {{csrf_field()}}
              <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->

    </div>

    @if(isset($Rdata_today[0]))
    <!-- daily post -->
    <div class="daily_post">
        <div class="daily_title">
            <h4>{!! static_lang('todayfilter')?static_lang('todayfilter') : 'فلتر اليوم'  !!}</h4>
        </div>
        <div class="poster">
            <div class="border_poster">
                <div class="container">
                  <div class="row">
                      <div class="col-8 0 p-0">
                          <div class="poster_title">
                              <h3>{{$Rdata_today[0]->title}}</h3>
                          </div>
                          <div class="p_poster">
                              <h4>{{$Rdata_today[0]->getTranslation('title',getCode())}}</h4>
                          </div>
                      </div>
                      <div class="col-4 p-0">
                          <div class="poster_filtar">
                            @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                              <i id="{{$Rdata_today[0]->id}}" @if(check_favourtite(Session::get('MSISDN') , $Rdata_today[0]->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                            @endif
                              <a href="{{url('inner_snap_v2/'.$Rdata_today[0]->id.'/'.UID())}}">
                                  <img src="{{url('/'.$Rdata_today[0]->path)}}" alt="">

                                  <div class="view">
                                    <i id="eye" class="fas fa-eye"></i> <span> {{$Rdata_today[0]->popular_count}}</span>
                                  </div>

                              </a>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end daily post -->
    @endif


    <!-- Suggestion -->
    <div class="filtars">
        <div class="f_title">
            <h4>فلاتر مقترحة لك</h4>
        </div>
        <div class="f_filtar">
          @if(count($suggests) > 2)
            <div class="owl_three owl-carousel owl-theme">
              @foreach($suggests->take(10)->shuffle() as $suggest)
                <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                  </div>

                    <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                        <img src="{{url('/'.$suggest->path)}}" alt="">
                    </a>
                </div>
              @endforeach
            </div>
          @elseif(count($suggests) == 2)
            <div class="owl_two owl-carousel owl-theme">
            @foreach($suggests->take(10)->shuffle() as $suggest)
              <div class="item">
                @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                @endif

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                </div>
                  <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                      <img src="{{url('/'.$suggest->path)}}" alt="">
                  </a>
              </div>
            @endforeach
          </div>
          @else
            <div class="owl_one owl-carousel owl-theme">
             @foreach($suggests->take(10)->shuffle() as $suggest)
              <div class="item">
                @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                @endif

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                </div>
                  <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                      <img src="{{url('/'.$suggest->path)}}" alt="">
                  </a>
              </div>
            @endforeach
          </div>
          @endif
        </div>
    </div>
    <!-- end Suggestion -->

    <!-- Suggestion -->
    <div class="filtars">
        <div class="f_title">
            <h4>{!! static_lang('mostp')?static_lang('mostp') : 'الاكثر شيوعا'  !!}</h4>
        </div>
        <div class="f_filtar">
          @if(count($populars) > 2)
            <div class="owl_three owl-carousel owl-theme">
              @foreach($populars->take(10)->shuffle() as $popular)
                <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$popular->id}}" @if(check_favourtite(Session::get('MSISDN') , $popular->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$popular->popular_count}}</span>
                  </div>

                    <a href="{{url('inner_snap_v2/'.$popular->id.'/'.UID())}}">
                        <img src="{{url('/'.$popular->path)}}" alt="">
                    </a>
                </div>
              @endforeach
            </div>
          @elseif(count($populars) == 2)
            <div class="owl_two owl-carousel owl-theme">
            @foreach($populars->take(10)->shuffle() as $popular)
              <div class="item">
                @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$popular->id}}" @if(check_favourtite(Session::get('MSISDN') , $popular->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                @endif

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> {{$popular->popular_count}}</span>
                </div>

                  <a href="{{url('inner_snap_v2/'.$popular->id.'/'.UID())}}">
                      <img src="{{url('/'.$popular->path)}}" alt="">
                  </a>
              </div>
            @endforeach
          </div>
          @else
          <div class="owl_one owl-carousel owl-theme">
            @foreach($populars->take(10)->shuffle() as $popular)
              <div class="item">
                @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$popular->id}}" @if(check_favourtite(Session::get('MSISDN') , $popular->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                @endif

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> {{$popular->popular_count}}</span>
                </div>

                  <a href="{{url('inner_snap_v2/'.$popular->id.'/'.UID())}}">
                      <img src="{{url('/'.$popular->path)}}" alt="">
                  </a>
              </div>
            @endforeach
          </div>
          @endif
        </div>
    </div>
    <!-- end Suggestion -->

    @if(count($favourites) > 0)
    <!-- liked -->
    <div class="filtars">
        <div class="f_title">
            <h4>فلاتر اعجبتني</h4>
        </div>
         <div class="f_filtar">
           @if(count($favourites) > 2)
            <div class="owl_three owl-carousel owl-theme">
              @foreach($favourites->take(10) as $fav)
                <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$fav->id}}" @if(check_favourtite(Session::get('MSISDN') , $fav->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$fav->popular_count}}</span>
                  </div>

                    <a href="{{url('inner_snap_v2/'.$fav->id.'/'.UID())}}">
                        <img src="{{url('/'.$fav->path)}}" alt="">
                    </a>
                </div>
              @endforeach
            </div>
           @elseif(count($favourites) == 2)
            <div class="owl_two owl-carousel owl-theme">
             @foreach($favourites->take(10) as $fav)
               <div class="item">
                 @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                   <i id="{{$fav->id}}" @if(check_favourtite(Session::get('MSISDN') , $fav->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                 @endif

                 <div class="view">
                   <i id="eye" class="fas fa-eye"></i> <span> {{$fav->popular_count}}</span>
                 </div>


                   <a href="{{url('inner_snap_v2/'.$fav->id.'/'.UID())}}">
                       <img src="{{url('/'.$fav->path)}}" alt="">
                   </a>
               </div>
             @endforeach
           </div>
           @else
             <div class="owl_one owl-carousel owl-theme">
              @foreach($favourites->take(10) as $fav)
                <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$fav->id}}" @if(check_favourtite(Session::get('MSISDN') , $fav->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$fav->popular_count}}</span>
                  </div>

                    <a href="{{url('inner_snap_v2/'.$fav->id.'/'.UID())}}">
                        <img src="{{url('/'.$fav->path)}}" alt="">
                    </a>
                </div>
              @endforeach
             </div>
          @endif
        </div>
    </div>
    <!-- end liked -->
    @endif


</div>
<!-- end main content -->
@endsection
