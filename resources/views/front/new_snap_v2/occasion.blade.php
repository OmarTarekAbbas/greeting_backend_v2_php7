@extends('front.new_snap_v2.layout')
@section('content')
<?php $uid = UID() ?>
<!-- main content -->
<div class="main">
    <div class="container">
        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form action="{{url('Search_v2/'.UID())}}" method="get">
                {{csrf_field()}}
                <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->
    </div>

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
    @foreach($occasions as $k=> $occasion)
    <!-- liked -->
    <div class="filtars">
        <div class="f_filtar">
            <div class="category_title">
                <div class="row">
                    <div class="col-4 p-0">
                        <a class="i_arrow" href="{{url('/occasion/'.$occasion->id.'/'.UID())}}">المزيد <i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="col-4 p-0">
                        <a class="a_title" href="{{url('/occasion/'.$occasion->id.'/'.UID())}}">
                            <h5>{{$occasion->title}}</h5>
                        </a>
                    </div>
                    <div class="col-4 p-0">
                        <a class="count" href="{{url('/occasion/'.$occasion->id.'/'.UID())}}">{{count( list_snap($occasion->id,$uid) )}} فلتر</a>
                        <img src="{{url($occasion->image)}}" alt="icon">
                    </div>
                </div>
            </div>
            <?php $greetingimgs =  list_snap($occasion->id,$uid) ; ?>
            @if(count($greetingimgs) > 2)
            <div class="owl_three owl-carousel owl-theme">
                @foreach($greetingimgs->take(10)->shuffle() as $greetingimg)
                <div class="item">
                    @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$greetingimg->id}}" @if(check_favourtite(Session::get('MSISDN') , $greetingimg->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                    @endif

                    <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$greetingimg->popular_count}}</span>
                    </div>

                    <a href="{{url('inner_snap_v2/'.$greetingimg->id.'/'.UID())}}">
                        <img src="{{url('/'.$greetingimg->path)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            @elseif(count($greetingimgs) == 2)
            <div class="owl_two owl-carousel owl-theme">
                @foreach($greetingimgs->take(10)->shuffle() as $greetingimg)
                <div class="item">
                    @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$greetingimg->id}}" @if(check_favourtite(Session::get('MSISDN') , $greetingimg->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                    @endif

                    <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$greetingimg->popular_count}}</span>
                    </div>

                    <a href="{{url('inner_snap_v2/'.$greetingimg->id.'/'.UID())}}">
                        <img src="{{url('/'.$greetingimg->path)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="owl_one owl-carousel owl-theme">
                @foreach($greetingimgs->take(10)->shuffle() as $greetingimg)
                <div class="item">
                    @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$greetingimg->id}}" @if(check_favourtite(Session::get('MSISDN') , $greetingimg->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                    @endif

                    <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$greetingimg->popular_count}}</span>
                    </div>

                    <a href="{{url('inner_snap_v2/'.$greetingimg->id.'/'.UID())}}">
                        <img src="{{url('/'.$greetingimg->path)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <!-- end liked -->
    @endforeach
</div>
<!-- end main content -->
@endsection
